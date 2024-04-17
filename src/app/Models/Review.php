<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['stars', 'comment', 'user_id', 'shop_id'];

    public function shop()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->select('id', 'shop_name');
    }
}
