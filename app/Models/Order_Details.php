<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Details extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $primarykey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'id_order', 
        'id_product_variation_sizes',
        'price',
        'quantity'
    ];
}
