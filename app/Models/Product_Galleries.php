<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Galleries extends Model
{
    use HasFactory;
    protected $table = 'product_galleries';
    protected $primarykey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'product_item_id', // Thêm cột id_product vào mảng fillable
        'image'
    ];
}
