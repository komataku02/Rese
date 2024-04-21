<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $table = 'shops';
    protected $fillable = [
        'shop_name',
        'area_id',
        'area',
        'genre_id',
        'genre',
        'overview',
        'image',
    ];

    public function reserves()
    {
        return $this->hasMany(Reserve::class, 'shop_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'shop_id');
    }
}
