<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $fillable = [

        'voucher_name', 'voucher_code', 'voucher_type', 'value', 'start_date', 'start_time' ,'end_date'
        ,'end_time', 'voucher_min_spend', 'voucher_max_spend', 'voucher_use_per_user', 'quantity', 'image', 'status'
    ];
    protected $table = 'vouchers';
    protected $primarykey = 'id';

    public $timestamps = true;
}
