<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Variation_Sizes extends Model
{
    use HasFactory;
    protected $table = 'product_variation_sizes';
    protected $primarykey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'id_product_item', // Thêm cột id_product vào mảng fillable
        'id_size',
        'in_stock'
    ];

}
