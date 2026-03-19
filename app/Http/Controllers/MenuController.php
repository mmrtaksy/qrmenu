<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SocialLink;

class MenuController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)
            ->with('activeProducts')
            ->orderBy('sort_order')
            ->get();

        $socialLinks = SocialLink::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('menu', compact('categories', 'socialLinks'));
    }
}
