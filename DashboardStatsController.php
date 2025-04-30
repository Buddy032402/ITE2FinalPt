<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardStatsController extends Controller
{
    public function getStats()
    {
        $stats = [
            'total_users' => User::count(),
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'recent_users' => User::latest()->take(5)->get(),
            'product_stats' => $this->getProductStats(),
            'monthly_sales' => $this->getMonthlySales()
        ];

        return response()->json($stats);
    }

    private function getProductStats()
    {
        return Category::withCount('products')
            ->get()
            ->map(function ($category) {
                return [
                    'name' => $category->name,
                    'count' => $category->products_count
                ];
            });
    }

    private function getMonthlySales()
    {
        return Product::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->take(6)
            ->get();
    }
}