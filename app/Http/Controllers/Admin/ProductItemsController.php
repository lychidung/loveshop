<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductItem;
use App\Models\Product_Galleries;
use App\Models\Product_Variation_Sizes;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\File;


require_once("config.php");

class ProductItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request): RedirectResponse
    {
        Validator::make($request->all(), [
            'id_product' => ['required'],
            'id_color' => ['required'],
            'id_size' => ['required'],
            'price' => ['required'],
            'discount_price' => ['required'],
            'in_stock' => ['required'],
            'image' => ['required']
        ])->validate();

        ProductItem::create([
            'id_product' => $request->id_product,
            'id_color' => $request->id_color,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'status' => $request->status
        ]);

        $latestId = DB::table('product_items')->max('id');

        Product_Variation_Sizes::create([
            'id_product_item' => $latestId,
            'id_size' => $request->id_size,
            'in_stock' => $request->in_stock
        ]);

        $fileName = '1_' . time() . '.' . $request->image->extension();
        $request->image->move(public_path(path), $fileName);
        Product_Galleries::create([
            'product_item_id' => $latestId,
            'image' => $fileName
        ]);



        return Redirect::route('products.edit', $request->id_product);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $id_product)
    {
        $countItem = DB::table('product_items')
        ->where('id_product',$id_product)
        ->join('product_variation_sizes','product_variation_sizes.id_product_item','=','product_items.id')
        ->join('product_galleries','product_galleries.product_item_id','=','product_items.id')
        ->count();

       
        if ($countItem > 1) {
            DB::table('product_variation_sizes')
                ->where('id_product_item', $id)
                ->delete();

            $images = DB::table('product_galleries')
                ->where('product_item_id', $id)
                ->get();

            File::delete(public_path(path_delete . $images));

            DB::table('product_galleries')
                ->where('product_item_id', $id)
                ->delete();

            DB::table('product_items')
                ->where('id_product', $id)
                ->delete();
            return Redirect::route('products.edit', $id_product);
        }
        else{
            
            return Redirect::route('products.edit', $id_product);
        }

    }
}
