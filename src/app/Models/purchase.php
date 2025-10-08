<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;

class Purchase extends Model
{
    protected $table = 'purchase';
    protected $fillable = [
        'product_id', 'buyer_id', 'payment_method', 'name',
        'postcode', 'address', 'building',
    ];

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    // カラム名に合わせて第二引数を 'item_id' or 'product_id' に
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
