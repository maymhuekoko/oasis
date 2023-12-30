<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuisineType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',  
        'meal_id',
    ];

    public function meal() {
        return $this->belongsTo(Meal::class);
    }

    public function items() {
        return $this->hasMany(MenuItem::class);
    }
}
