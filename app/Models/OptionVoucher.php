<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionVoucher extends Model
{
    use HasFactory;

    protected $fillable = ['voucher_id','item_name','option_name','order_qty','selling_price'];
}
