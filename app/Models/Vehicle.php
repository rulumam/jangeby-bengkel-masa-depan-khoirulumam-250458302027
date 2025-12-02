<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plate_number',
        'brand',
        'type',           
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }

}
