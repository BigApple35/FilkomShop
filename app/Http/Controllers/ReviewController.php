<?php

namespace App\Http\Controllers;

use App\Models\ProductReview;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $product = Products::findOrFail($productId);

        $existing = ProductReview::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($existing) {
            $existing->update([
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);
            return back()->with('success', 'Your review has been updated!');
        }

        ProductReview::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Thank you for your review!');
    }

    public function destroy($id)
    {
        $review = ProductReview::findOrFail($id);

        if (Auth::user()->role === 'admin' || Auth::id() === $review->user_id) {
            $review->delete();
            return back()->with('success', 'Review deleted successfully.');
        }

        return back()->with('error', 'Unauthorized action.');
    }
}
