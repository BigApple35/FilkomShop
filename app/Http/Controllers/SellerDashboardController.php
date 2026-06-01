<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Products;
use App\Models\Seller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SellerDashboardController extends Controller
{
    public function index()
    {
        // Security check: must be logged in as seller
        if (!Auth::check() || Auth::user()->role !== 'seller') {
            return redirect('/')->with('error', 'Access denied.');
        }

        // Find the seller profile linked to this user
        $seller = Seller::where('user_id', Auth::id())->first();

        if (!$seller) {
            return redirect('/')->with('error', 'Seller profile not found.');
        }

        // ── Metrics ──────────────────────────────────────────────────────────
        // Total products listed by this seller
        $totalProducts = Products::where('seller_id', $seller->id)->count();
        $activeProducts = Products::where('seller_id', $seller->id)->where('is_active', true)->count();

        // Total revenue from order items belonging to this seller (non-cancelled)
        $totalRevenue = OrderItems::where('seller_id', $seller->id)
            ->whereHas('order', fn($q) => $q->where('status', '!=', 'cancelled'))
            ->select(DB::raw('SUM(unit_price * quantity) as revenue'))
            ->value('revenue') ?? 0;

        // Total orders that contain at least one item from this seller
        $totalOrders = OrderItems::where('seller_id', $seller->id)
            ->distinct('order_id')
            ->count('order_id');

        // Pending fulfillments for this seller
        $pendingFulfillments = OrderItems::where('seller_id', $seller->id)
            ->where('fulfillment_status', 'pending')
            ->count();

        // ── Recent Orders ─────────────────────────────────────────────────────
        // Get the latest 7 distinct orders that contain items from this seller
        $recentOrderIds = OrderItems::where('seller_id', $seller->id)
            ->distinct('order_id')
            ->orderBy('order_id', 'desc')
            ->limit(7)
            ->pluck('order_id');

        $recentOrders = Order::with('user')
            ->whereIn('id', $recentOrderIds)
            ->orderBy('created_at', 'desc')
            ->get();

        // ── Chart Data (last 10 days) ─────────────────────────────────────────
        $chartData = $this->getDailyChartData($seller->id, 10);

        // ── Top Products ──────────────────────────────────────────────────────
        $topProducts = OrderItems::where('seller_id', $seller->id)
            ->select('product_id', DB::raw('SUM(quantity) as total_sold'), DB::raw('SUM(unit_price * quantity) as revenue'))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->with('product')
            ->get();

        return view('seller.dashboard', compact(
            'seller',
            'totalProducts',
            'activeProducts',
            'totalRevenue',
            'totalOrders',
            'pendingFulfillments',
            'recentOrders',
            'chartData',
            'topProducts'
        ));
    }

    /**
     * Get daily sales counts and revenues for the last N days for this seller.
     */
    private function getDailyChartData($sellerId, $days = 10)
    {
        $dates = [];

        for ($i = $days - 1; $i >= 0; $i--) {
            $dateString = Carbon::now()->subDays($i)->format('Y-m-d');
            $dates[$dateString] = [
                'label'   => Carbon::now()->subDays($i)->format('d M'),
                'count'   => 0,
                'revenue' => 0,
            ];
        }

        $startDate = Carbon::now()->subDays($days - 1)->startOfDay();

        $dbData = OrderItems::where('seller_id', $sellerId)
            ->whereHas('order', fn($q) => $q->where('created_at', '>=', $startDate))
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->select(
                DB::raw('DATE(orders.created_at) as order_date'),
                DB::raw('COUNT(DISTINCT orders.id) as total_orders'),
                DB::raw('SUM(order_items.unit_price * order_items.quantity) as total_sales')
            )
            ->groupBy('order_date')
            ->get();

        foreach ($dbData as $row) {
            $dateStr = $row->order_date;
            if (isset($dates[$dateStr])) {
                $dates[$dateStr]['count']   = (int) $row->total_orders;
                $dates[$dateStr]['revenue'] = (float) $row->total_sales;
            }
        }

        return [
            'labels'   => array_column($dates, 'label'),
            'counts'   => array_column($dates, 'count'),
            'revenues' => array_column($dates, 'revenue'),
        ];
    }
}
