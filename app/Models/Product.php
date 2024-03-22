<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory , ImageTrait;

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'image',
    ];
    const IMAGE_PATH = 'uploads/products';
    protected $casts = [
        'price' => 'decimal:2',
    ];
    public static $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'quantity' => 'required|integer|min:0',
        'image' => 'nullable',
    ];

    public function getImageAttribute($value)
    {
        return $value ?  asset("storage/" .self::IMAGE_PATH . '/' . $value) : null;
    }



}
