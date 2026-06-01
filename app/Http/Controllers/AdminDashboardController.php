<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Products;
use App\Models\Seller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 1. Security Check
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return response()->view('welcome', [
                'page' => 'access-denied'
            ], 403);
        }

        // 2. Dynamic Seeding of Historical Data (if database is empty)
        $this->ensureHistoricalDataExists();

        // 3. Metric Calculations
        $productsCount = Products::count();
        $usersCount = User::where('role', 'customer')->count();
        $sellersCount = Seller::count();
        $totalOrdersCount = Order::count();
        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('total_amount');

        // 4. Retrieve Recent Transactions (Last 7)
        $recentTransactions = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->take(7)
            ->get();

        // 5. Retrieve Daily Transaction Stats for Chart (Last 10 Days)
        $chartData = $this->getDailyChartData(10);

        return view('admin.dashboard', compact(
            'productsCount',
            'usersCount',
            'sellersCount',
            'totalOrdersCount',
            'totalRevenue',
            'recentTransactions',
            'chartData'
        ));
    }

    /**
     * Get aggregated daily sales counts and total revenues for the last N days.
     */
    private function getDailyChartData($days = 10)
    {
        $dates = [];
        $salesCount = [];
        $revenueSum = [];

        // Generate date boundaries for the last N days
        for ($i = $days - 1; $i >= 0; $i--) {
            $dateString = Carbon::now()->subDays($i)->format('Y-m-d');
            $dates[$dateString] = [
                'label' => Carbon::now()->subDays($i)->format('d M'),
                'count' => 0,
                'revenue' => 0
            ];
        }

        // Query database to aggregate counts and total amounts grouped by date
        // Handled cleanly across SQLite/MySQL using Eloquent/Carbon
        $startDate = Carbon::now()->subDays($days - 1)->startOfDay();
        
        $dbData = Order::where('created_at', '>=', $startDate)
            ->select(
                DB::raw('DATE(created_at) as order_date'),
                DB::raw('COUNT(*) as total_orders'),
                DB::raw('SUM(total_amount) as total_sales')
            )
            ->groupBy('order_date')
            ->get();

        foreach ($dbData as $row) {
            $dateStr = $row->order_date;
            if (isset($dates[$dateStr])) {
                $dates[$dateStr]['count'] = (int) $row->total_orders;
                $dates[$dateStr]['revenue'] = (float) $row->total_sales;
            }
        }

        return [
            'labels' => array_column($dates, 'label'),
            'counts' => array_column($dates, 'count'),
            'revenues' => array_column($dates, 'revenue'),
        ];
    }

    /**
     * Seeds dummy transactions over the last 10 days if orders table is currently empty.
     * This brings the dashboard immediate visual quality.
     */
    private function ensureHistoricalDataExists()
    {
        if (Order::count() > 0) {
            return; // Data already exists
        }

        // Get or create some customers to assign orders to
        $customers = User::where('role', 'customer')->get();
        if ($customers->isEmpty()) {
            $dummyUserData = [
                ['name' => 'Budi Santoso', 'email' => 'budi@gmail.com'],
                ['name' => 'Siti Aminah', 'email' => 'siti@gmail.com'],
                ['name' => 'Andi Wijaya', 'email' => 'andi@gmail.com'],
                ['name' => 'Dewi Lestari', 'email' => 'dewi@gmail.com']
            ];

            foreach ($dummyUserData as $data) {
                User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make('password'),
                    'role' => 'customer'
                ]);
            }
            $customers = User::where('role', 'customer')->get();
        }

        // Get available products
        $products = Products::where('is_active', true)->get();
        if ($products->isEmpty()) {
            return; // Cannot seed orders without products
        }

        $addresses = [
            'Jl. Veteran No. 8, Lowokwaru, Malang',
            'Jl. Danau Toba G6-B22, Sawojajar, Malang',
            'Jl. Gajayana No. 50, Dinoyo, Malang',
            'Jl. Soekarno Hatta No. 9, Jatimulyo, Malang'
        ];

        $statuses = ['delivered', 'delivered', 'delivered', 'processing', 'pending', 'shipped', 'cancelled'];

        // Seed 12 transactions spread over the last 10 days
        DB::transaction(function () use ($customers, $products, $addresses, $statuses) {
            for ($i = 1; $i <= 12; $i++) {
                $customer = $customers->random();
                $address = $addresses[array_rand($addresses)];
                
                // Spread orders chronologically over the past 10 days
                $daysAgo = floor(($i - 1) * 10 / 12); 
                $createdAt = Carbon::now()->subDays($daysAgo)->subHours(rand(1, 12))->subMinutes(rand(1, 59));
                
                // Select 1 to 3 random products for the order
                $selectedProducts = $products->random(rand(1, min(3, $products->count())));
                $totalAmount = 0;
                $orderItemsData = [];

                foreach ($selectedProducts as $product) {
                    $qty = rand(1, 2);
                    $price = $product->price;
                    $itemTotal = $price * $qty;
                    $totalAmount += $itemTotal;

                    $orderItemsData[] = [
                        'product_id' => $product->id,
                        'seller_id' => $product->seller_id,
                        'quantity' => $qty,
                        'unit_price' => $price,
                        'fulfillment_status' => 'pending'
                    ];
                }

                $status = $statuses[array_rand($statuses)];
                if ($daysAgo > 3 && $status !== 'cancelled') {
                    $status = 'delivered'; // Older orders should be completed
                }

                // Create Order
                $order = Order::create([
                    'user_id' => $customer->id,
                    'total_amount' => $totalAmount,
                    'shipping_address' => $address,
                    'status' => $status,
                    'ordered_at' => $createdAt,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt
                ]);

                // Create Order Items
                foreach ($orderItemsData as $item) {
                    $item['order_id'] = $order->id;
                    $item['fulfillment_status'] = $status === 'delivered' ? 'delivered' : 'pending';
                    $item['created_at'] = $createdAt;
                    $item['updated_at'] = $createdAt;
                    OrderItems::create($item);
                }
            }
        });
    }
}
