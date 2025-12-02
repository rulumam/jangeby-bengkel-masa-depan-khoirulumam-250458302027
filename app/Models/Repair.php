<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Repair extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'user_id',
        'admin_id',
        'mechanic_id',
        'description',
        'mechanic_report',
        'cost',
        'status',
        'payment_proof',  
    ];

    // Relasi ke kendaraan
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Relasi ke admin (user)
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }




}
