<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'categories' => Category::count(),
            'products' => Product::count(),
            'active_products' => Product::where('is_active', true)->count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }
}
