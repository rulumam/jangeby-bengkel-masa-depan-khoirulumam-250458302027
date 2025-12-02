<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\{Repair, Vehicle};

class RepairsForm extends Component
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

        // Simpan kendaraan user
        $vehicle = Vehicle::create([
            'user_id' => Auth::id(),
            'brand' => $this->brand,
            'plate_number' => $this->plate_number,
            'type' => $this->type,
        ]);

        // Simpan laporan perbaikan
        $admin = User::find(1);

        Repair::create([
            'vehicle_id'   => $vehicle->id,
            'admin_id'     => $admin->id,  
            'user_id'      => Auth::id(),
            'description'  => $this->description,
            'status'       => 'pending',
        ]);
        

        session()->flash('success', 'Laporan perbaikan berhasil dikirim!');
        return redirect()->route('repairs.index');
    }

    public function render()
    {
        return view('livewire.user.repairs-form')
            ->layout('components.layouts.bengkel');
    }
}
