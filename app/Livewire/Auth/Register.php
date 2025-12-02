<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{
    public $name, $email, $password, $password_confirmation;

    public function register()
    {
        $this->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Simpan user baru
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => 'user', // role default
        ]);

        // Setelah daftar, arahkan ke login
        session()->flash('success', 'Registrasi berhasil! Silakan login untuk melanjutkan.');
        return redirect()->to('/login');
    }

    public function render()
    {
    return view('livewire.auth.register')->layout('components.layouts.auth');
       
    }

}
