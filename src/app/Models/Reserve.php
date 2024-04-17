<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'time', 'number'];

    protected $table = 'reserves';

    public function users()
    {
        return $this->belongsToMany(User::class, 'reserve_users');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class,);
    }
}
