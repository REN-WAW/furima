<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['product_id','user_id','comment'];

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
