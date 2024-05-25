<?php

namespace App\Http\Controllers\Admin;

use Inertia\Response;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Product_Categories;
use App\Models\Product_Galleries;
use App\Models\Product_Variation_Sizes;
use App\Models\ProductItem;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

require_once("config.php");

class ProductsController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($searchProduct = null): Response
    {
        if($searchProduct === null){
            $product = DB::table('products')
            ->select(
                'product_items.id as product_item_id',
                'product_variation_sizes.id as product_variation_sizes_id',
                DB::raw('SUM(in_stock) as total_in_stock',),
                'price',
                'id_product',
                'product_name',
                'image',
                'status'
            )
            ->join('product_items', 'products.id', '=', 'product_items.id_product')
            ->join('product_galleries', 'product_galleries.product_item_id', '=', 'product_items.id')
            ->join('product_variation_sizes', 'product_variation_sizes.id_product_item', '=', 'product_items.id')
            ->groupBy('product_items.id_product')
            ->latest('product_items.created_at')
            ->paginate(5);
        }
      
        else {
            $product = DB::table('products')
            ->where('product_name', 'like', '%' . $searchProduct . '%')
            ->select(
                'product_items.id as product_item_id',
                'product_variation_sizes.id as product_variation_sizes_id',
                DB::raw('SUM(in_stock) as total_in_stock',),
                'price',
                'id_product',
                'product_name',
                'image',
                'status'
            )
            ->join('product_items', 'products.id', '=', 'product_items.id_product')
            ->join('product_galleries', 'product_galleries.product_item_id', '=', 'product_items.id')
            ->join('product_variation_sizes', 'product_variation_sizes.id_product_item', '=', 'product_items.id')
            ->groupBy('product_items.id_product')
            ->latest('product_items.created_at')
            ->paginate(5);
        }
        return Inertia::render('Admin/Products/Index', ['product' => $product]);
    }

    
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $ProductCategories = DB::table('product_categories')->get();
        $ProductColor = DB::table('product_colors')->get();
        $ProductSize = DB::table('product_option_sizes')->get();

        return Inertia::render('Admin/Products/Create', ['ProductCategories' => $ProductCategories, 'ProductColor' => $ProductColor, 'ProductSize' => $ProductSize]);
    }

    /**
     * Store a newly created resource in storage.
     * @return Response
     */
    public function store(Request $request, int $index): RedirectResponse
    {
        $arr = 0;
        Validator::make($request->all(), [
            'product_name' => ['required'],
            'id_pro_category' => ['required'],
            'description' => ['required'],
            'status' => ['required'],
            'id_color' => ['required'],
            'id_size' => ['required'],
            'price' => ['required'],
            'discount_price' => ['required'],
            'image' => ['required'],
            'in_stock' => ['required']
        ])->validate();

        Product::create([
            'product_name' => $request->product_name,
            'id_pro_category' => $request->id_pro_category,
            'description' => $request->description,
            'status' => $request->status
        ]);

        $latestId = DB::table('products')->max('id');

        for ($i = 1; $i <= $index; $i++) {
            ProductItem::create([
                'id_product' => $latestId,
                'id_color' => $request->id_color[$i],
                'price' => $request->price[$i],
                'discount_price' => $request->discount_price[$i]
            ]);
        }

        $latestId2 = DB::table('product_items')
            ->select('id')
            ->where('id_product', $latestId)
            ->pluck('id')
            ->toArray();

        foreach ($latestId2 as $index) {
            $arr++;
            Product_Variation_Sizes::create([
                'id_product_item' => $index,
                'id_size' => $request->id_size[$arr],
                'in_stock' => $request->in_stock[$arr]
            ]);
        }
        $arr = 0;

        foreach ($latestId2 as $index) {
            $arr++;
            $fileName = $arr . '_' . time() . '.' . $request->image[$arr]->extension();
            $request->image[$arr]->move(public_path(path), $fileName);
            Product_Galleries::create([
                'product_item_id' => $index,
                'image' => $fileName
            ]);
        }
        
        return Redirect::route('products.index');
    }

    /**
     * Display the specified resource.
     * 
     */
    public function show(string $id)
    {
        //
    }

    public function view(Product $product)
    {
        return Inertia::render('Admin/Products/View', ['products' => $product]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $ProductColor = DB::table('product_colors')->get();
        $ProductSize = DB::table('product_option_sizes')->get();
        $ProductItem = ProductItem::select(
            'product_items.id as id_pro_item',

            'product_items.id_color',
            'product_items.price',
            'product_items.discount_price',

            'products.*',
            'product_colors.*',
            'product_categories.*',
            'product_variation_sizes.id_size',
            'product_variation_sizes.in_stock',

            'product_option_sizes.size_name',
            'product_categories.image as categories_image',
            'product_categories.category_name',
            'product_galleries.image'
        )
            ->join('products', 'product_items.id_product', '=', 'products.id')
            ->join('product_colors', 'product_items.id_color', '=', 'product_colors.id')
            ->join('product_categories', 'products.id_pro_category', '=', 'product_categories.id')
            ->join('product_variation_sizes', 'product_items.id', '=', 'product_variation_sizes.id_product_item')
            ->join('product_option_sizes', 'product_variation_sizes.id_size', '=', 'product_option_sizes.id')
            ->join('product_galleries', 'product_galleries.product_item_id', '=', 'product_items.id')
            ->where('products.id', $product->id)
            ->paginate(7);

        $ProductCategories = DB::table('product_categories')->get();

        return Inertia::render('Admin/Products/Edit', ['products' => $product, 'ProductItem' => $ProductItem, 'ProductCategories' => $ProductCategories, 'ProductColor' => $ProductColor, 'ProductSize' => $ProductSize]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id, Request $request): RedirectResponse
    {
        Validator::make($request->all(), [
            'product_name' => ['required'],
            'id_pro_category' => ['required'],
            'description' => ['required'],
            'status' => ['required'],
        ])->validate();

        Product::find($id)->update([
            'product_name' => $request->product_name,
            'id_pro_category' => $request->id_pro_category,
            'description' => $request->description,
            'status' => $request->status
        ]);

        return Redirect::route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $ProductItems = DB::table('product_items')
            ->where('id_product', $id)
            ->pluck('id')
            ->toArray();

        foreach ($ProductItems as $index) {
            DB::table('product_variation_sizes')
                ->where('id_product_item', $index)
                ->delete();

            $images = DB::table('product_galleries')
                ->where('product_item_id', $index)
                ->pluck('image')
                ->toArray();

            foreach ($images as $image) {
                File::delete(public_path(path_delete.$image));
            }

            DB::table('product_galleries')
                ->where('product_item_id', $index)
                ->delete();
        }

        DB::table('product_items')
            ->where('id_product', $id)
            ->delete();


        DB::table('products')
            ->where('id', $id)
            ->delete();
        }
        catch(\Exception $e){
            DB::rollBack();
        }
       
        return Redirect::route('products.index');
    }

    
}
