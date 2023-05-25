<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'status',
        'image',
        'created_by',
        'verified_by',
        'verified_at',
    ];
}
