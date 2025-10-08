<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
// App\Models\Product.php

use App\Models\User;
use App\Models\Purchase;

class Product extends Model
{
    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'product_id');
    }

    // まとめて代入する許可カラム（guardedでも可。どちらか一方に統一）
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

    // DB⇔アプリでの型を統一
    protected $casts = [
        'price'     => 'integer',
        'condition' => 'integer',
        'sold'      => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // 多対多（中間テーブル名が category_products の想定）
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
        return $this->hasMany(\App\MOdels\Comment::class);
    }

    /* ========= アクセサ ========= */

    // 画像URLをいい感じに返す（DBが 'storage/images/..' でも 'images/..' でもOK）
    public function getImageUrlAttribute(): string
    {
        $p = $this->image_path ?? '';
        if ($p === '') {
            return asset('images/placeholder.png'); // プレースホルダが無ければ適宜用意
        }
        if (Str::startsWith($p, ['http://', 'https://'])) {
            return $p; // 既にフルURL
        }
        if (Str::startsWith($p, 'storage/')) {
            return asset($p); // DBが 'storage/images/xxx.jpg'
        }
        return Storage::url($p); // DBが 'images/xxx.jpg' → '/storage/images/xxx.jpg'
    }

    // 状態ラベル（シンプル運用）
    public function getConditionLabelAttribute(): string
    {
        return [
            1 => '新品',
            2 => '目立った傷や汚れなし',
            3 => 'やや傷や汚れあり',
            4 => '状態が悪い',
        ][$this->condition] ?? '不明';
    }

    public function getSoldLabelAttribute(): string
    {
        return $this->sold ? 'SOLD OUT' : '販売中';
    }

    // 表示用
    public function getTitleLabelAttribute(): string
    {
        return 'ID'.$this->id.': '.$this->title;
    }

    // 部分一致検索スコープ
    public function scopeKeyword($query, ?string $keyword)
    {
        if (!empty($keyword)) {
            $query->where('title', 'like', "%{$keyword}%");
        }
        return $query;
    }
}

