<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product_Galleries;
use Illuminate\Http\Request;

class ProductGalleriesController extends Controller
{
    public function index($id = null)
    {
        if ($id == null)
        {
            $products = 'Không tìm thấy kết quả';
            return response()->json($products);
            
        } else {

            // $products = Product_Galleries::
            // where('product_item_id',$id)
            // ->get()
            // ->map(function($products)
            // {
            //     $products->image = 'https://nightlight.asia/public/Images_product/'. $products->image;
            //     return $products;
            // });

            // return response()->json($products);

            $images = Product::
            where('products.id',$id)
            ->select('image')
            ->join('product_items','product_items.id_product','=','products.id')
            ->join('product_galleries','product_galleries.product_item_id','=','product_items.id')
            ->get();
            return response()->json($images);
        }
    }
}
