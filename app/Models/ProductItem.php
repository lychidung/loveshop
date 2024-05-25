<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    use HasFactory;
    protected $table = 'product_items';
    protected $primarykey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'id_product', // Thêm cột id_product vào mảng fillable
        'id_color',
        'price',
        'discount_price',
    ];
}
