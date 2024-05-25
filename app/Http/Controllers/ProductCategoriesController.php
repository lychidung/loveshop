<?php

namespace App\Http\Controllers;
use App\Models\Product_Categorie;

use Illuminate\Http\Request;

class ProductCategoriesController extends Controller
{
    public function index($id = null)
    {
        if ($id == null)
        {
            return Product_Categorie::orderby('id', 'ASC')->get();
        } else {
            return Product_Categorie::find($id);
        }
    }
}
