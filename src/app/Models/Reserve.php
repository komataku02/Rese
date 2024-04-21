<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'time', 'number', 'shop_id'];

    protected $table = 'reserves';

    public function users()
    {
        return $this->belongsToMany(User::class, 'reserve_users', 'reserve_id', 'user_id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class,);
    }
}
