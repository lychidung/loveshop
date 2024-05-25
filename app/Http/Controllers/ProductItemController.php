<?php

namespace App\Http\Controllers;

use App\Models\Product_Variation_Sizes;
use Illuminate\Http\Request;
use App\Models\ProductItem;

class ProductItemController extends Controller
{
    public function index($id = null)
    {
        if($id == null)
        {
            $products = ProductItem::
            select(
                'product_items.*',
                'products.*',
                'product_colors.*',
                'product_categories.*',
                'product_variation_sizes.*',
                'product_option_sizes.*',
                'product_categories.image as categories_image',
                'product_categories.category_name'
            )
            ->join('products', 'product_items.id_product', '=', 'products.id')
            ->join('product_colors', 'product_items.id_color', '=', 'product_colors.id')
            ->join('product_categories', 'products.id_pro_category', '=', 'product_categories.id')
            ->join('product_variation_sizes', 'product_items.id_product', '=', 'product_variation_sizes.id_product_item')
            ->join('product_option_sizes', 'product_variation_sizes.id_size', '=', 'product_option_sizes.id')
            // ->select('product_items.*', 'contacts.phone', 'orders.price')
            ->get();
        return response()->json($products);
        } else {
            $products = ProductItem::
            select(
                'product_items.*',
                'products.*',
                'product_colors.*',
                'product_categories.*',
                'product_variation_sizes.*',
                'product_option_sizes.*',
                'product_categories.image as categories_image',
                'product_categories.category_name'
            )
            ->join('products', 'product_items.id_product', '=', 'products.id')
            ->join('product_colors', 'product_items.id_color', '=', 'product_colors.id')
            ->join('product_categories', 'products.id_pro_category', '=', 'product_categories.id')
            ->join('product_variation_sizes', 'product_items.id_product', '=', 'product_variation_sizes.id_product_item')
            ->join('product_option_sizes', 'product_variation_sizes.id_size', '=', 'product_option_sizes.id')
            ->where('products.id', $id)
            ->get();
        return response()->json($products);
        }
        
    }

    public function product_color($id)
    {
        $products = ProductItem::where('id_product',$id)
        ->select('product_items.id','id_product','id_color','price','discount_price','color_name','image')
        ->join('product_colors','product_colors.id','=','product_items.id_color')
        ->join('product_galleries','product_galleries.product_item_id','=','product_items.id')
        ->get();
        return response()->json($products);
    }

    public function productItems_size($id)
    {
        $products = Product_Variation_Sizes::where('id_product_item',$id)
        ->select('product_variation_sizes.id','id_product_item', 'id_size', 'in_stock', 'size_name')
        ->join('product_option_sizes','product_variation_sizes.id_size','=','product_option_sizes.id')
        ->get();
        return response()->json($products);
    }

            
}
