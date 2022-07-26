<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Manufacture;
use Carbon\Carbon;
use Illuminate\Http\Request;

class YMLController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function settings() {
        $today = Carbon::now();
        $categories = Category::get();
        $manufactures = Manufacture::get();
        $products = Product::finaly()->published()->where('price', '>',  0)->get();

        return view('admin.yandex.settings', compact('categories'));
    }
}
