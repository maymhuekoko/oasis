<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name','sale_price','size','menu_item_id'];

    protected $with = ['menu_item'];

    public function menu_item() {
		return $this->belongsTo(MenuItem::class);
	}
}
