<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    public function index($id = null)
    {
        if ($id == null) {
            $products = Product::join('product_items', 'products.id', '=', 'product_items.id_product')
                ->join('product_galleries', 'product_galleries.product_item_id', '=', 'product_items.id')
                ->groupBy('product_items.id_product')
                ->get();
            return response()->json($products);
        } else {
            return Product::find($id);
        }
    }

    
    

}
