<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.home');
    }

    public function categories()
    {
        return view('dashboard.categories');
    }

    public function products()
    {
        return view('dashboard.products');
    }
}
