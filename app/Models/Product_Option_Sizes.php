<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Option_Sizes extends Model
{
    use HasFactory;
    protected $table = 'product_option_sizes';
    protected $primarykey = 'id';

    public $timestamps = true;

}
