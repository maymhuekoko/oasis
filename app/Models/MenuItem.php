<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['item_code','item_name','photo_path','cuisine_type_id'];
    
    public function cuisine_type() {
        return $this->belongsTo(CuisineType::class);
    }
}
