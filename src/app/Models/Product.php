<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


use App\Models\User;
use App\Models\Purchase;

class Product extends Model
{
    public const CONDITIONS = [
        1 => '良好',
        2 => '目立った傷や汚れなし',
        3 => 'やや傷や汚れあり',
        4 => '状態が悪い',
    ];
    
    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'product_id');
    }

    protected $fillable = [
        'user_id',
        'title',
        'brand',
        'description',
        'image_path',
        'price',
        'condition',
        'sold',
    ];

    protected $casts = [
        'price'     => 'integer',
        'condition' => 'integer',
        'sold'      => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product')->withTimestamps();
    }

    public function likes()
    {
        return $this->hasMany(\App\Models\Like::class);
    }

    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class);
    }

    public function getImageUrlAttribute(): string
    {
        $p = $this->image_path ?? '';
        if ($p === '') {
            return asset('images/placeholder.png');
        }
        if (Str::startsWith($p, ['http://', 'https://'])) {
            return $p;
        }
        if (Str::startsWith($p, 'storage/')) {
            return asset($p);
        }
        return Storage::url($p);
    }

    public function getConditionLabelAttribute(): string
    {
        return self::CONDITIONS[$this->condition] ?? '不明';
    }

    public function getSoldLabelAttribute(): string
    {
        return $this->sold ? 'SOLD OUT' : '販売中';
    }

    public function getTitleLabelAttribute(): string
    {
        return 'ID'.$this->id.': '.$this->title;
    }

    public function scopeKeyword($query, ?string $keyword)
    {
        if (!empty($keyword)) {
            $query->where('title', 'like', "%{$keyword}%");
        }
        return $query;
    }
}

