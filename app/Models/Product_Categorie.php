<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Categorie extends Model
{
    use HasFactory;
    protected $table = 'product_categories';
    protected $primarykey = 'id';

    public $timestamps = true;
    protected $fillable = [

        'category_name', 'description', 'image', 'status'

    ];

}
