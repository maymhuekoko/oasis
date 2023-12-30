<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
 
    protected $fillable = ['voucher_code','date','total_amount','voucher_date','pay','change'];
}
