<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
use App\Models\Products;

class ProductsController extends Controller
{
    public function store(Request $request)
    {
        $products = Products::all();

        return view('index', compact(['products']));
    }
}
