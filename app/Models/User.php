<?php

namespace App\Models;

// Laravel sudah punya User bawaan, pastikan kamu pakai model ini sebagai extend default user

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    // Relasi ke Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Relasi ke Vehicle
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    // Relasi ke Repair (sebagai admin)
    public function repairsHandled()
    {
        return $this->hasMany(Repair::class, 'admin_id');
    }
}
