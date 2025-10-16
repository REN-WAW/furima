<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Purchase;

class User extends Authenticatable implements MustVerifyEmail
{
    protected $fillable = [
        'icon_image',
        'name',
        'email',
        'password',
        'postcode',
        'address',
        'building',
    ];

    use HasApiTokens, HasFactory, Notifiable;

    public function getIconUrlAttributeU(): string
    {
        if (!empty($this->icon_image)) {
            if (str_starts_with($this->icon_image, 'storage/')) {
                return asset($this->icon_image);
            }
            return Storage::url($this->icon_image);
        }
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class);
    }

    public function items()
    {
        return $this->hasMany(Product::class, 'user_id');
    }

    public function purchases()
    {
        return $this->hasMany(\App\Models\Purchase::class, 'buyer_id');
    }

    public function purchasedProducts()
    {
        return $this->belongsToMany(\App\Models\Product::class, 'purchases', 'buyer_id', 'product_id')->withTimestamps();
    }
}

