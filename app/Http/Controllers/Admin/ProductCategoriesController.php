<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product_Categorie;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

require_once("config.php");


class ProductCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = DB::table('product_categories')
            ->paginate(5);
        return Inertia::render('Admin/Categories/Index', ['ProductCategories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Categories/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'category_name' => ['required'],
            'description' => ['required'],
            'image' => ['required'],
            'status' => ['required'],
        ])->validate();

        $fileName = time() . '.' . $request->image->extension();
        $request->image->move(public_path(path), $fileName);

        Product_Categorie::create([
            'category_name' => $request->category_name,
            'description' => $request->description,
            'image' => $fileName,
            'status' => $request->status
        ]);
        return Redirect::route('categories.index');
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
    public function edit(Product_Categorie $category)
    {
        $Categories = Product_Categorie::select()
        ->where("id",$category->id)
        ->first();
        return Inertia::render('Admin/Categories/Edit', ['ProductCategories' => $Categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validator::make($request->all(), [
        //     'category_name' => ['required'],
        //     'description' => ['required'],
        //     'image' => ['required'],
        //     'status' => ['required'],
        // ])->validate();

        $image = DB::table('product_categories')
        ->select('image')
        ->where('id', $id)
        ->first();

        if ($request->image) {
            File::delete(public_path(path_delete . $image->image));

            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path(path), $fileName);

            Product_Categorie::find($id)->update([
                'category_name' => $request->category_name,
                'description' => $request->description,
                'image' => $fileName,
                'status' => $request->status
            ]);
        } else{
            Product_Categorie::find($id)->update([
                'category_name' => $request->category_name,
                'description' => $request->description,
                'status' => $request->status
            ]);
        }
        
        return Redirect::route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $images = DB::table('product_categories')
            ->select('image')
            ->where('id', $id)
            ->first();

        File::delete(public_path(path_delete.$images->image));

        DB::table('product_categories')
            ->where('id', $id)
            ->delete();

        return Redirect::route('categories.index');
    }
}
