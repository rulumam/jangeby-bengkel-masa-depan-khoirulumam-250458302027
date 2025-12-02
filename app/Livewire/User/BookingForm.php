<?php

namespace App\Livewire\User;

use App\Models\User;
use App\Models\Booking;
use App\Models\Vehicle;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class BookingForm extends Component
{
    public $brand;
    public $type;
    public $plate_number;
    public $description;

    protected $rules = [
        'brand' => 'required|string|min:2',
        'type' => 'required|string|min:2',
        'plate_number' => 'required|string|min:3|unique:vehicles,plate_number',
        'description' => 'required|string|min:10',
    ];

    public function submit()
    {
        $this->validate();

        // Pastikan user login
        if (!Auth::check()) {
            abort(403, 'Anda harus login terlebih dahulu.');
        }

        // Simpan kendaraan
        $vehicle = Vehicle::create([
            'user_id'      => Auth::id(),
            'brand'        => $this->brand,
            'type'         => $this->type,
            'plate_number' => $this->plate_number,
        ]);

        // Set admin default (atau bisa random nanti)
        $admin = User::find(1); // Masih manual, aman sementara

        Booking::create([
            'vehicle_id'  => $vehicle->id,
            'user_id'     => Auth::id(),
            'admin_id'    => $admin?->id, // Ini lebih clean
            'description' => $this->description,
            'status'      => 'pending',
        ]);

        session()->flash('success', 'Booking berhasil dibuat!');
        return redirect()->route('booking.list');
    }

    public function render()
    {
        return view('livewire.user.booking-form')
            ->layout('components.layouts.bengkel');
    }
}
