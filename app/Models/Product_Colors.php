<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Colors extends Model
{
    use HasFactory;
    protected $table = 'product_colors';
    protected $primarykey = 'id';

    public $timestamps = true;

}
