<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email, $password, $rememberMe = false;

    public function login()
{
    $this->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    if (Auth::attempt([
        'email' => $this->email,
        'password' => $this->password
    ], $this->rememberMe)) {

        session()->regenerate();

        $user = Auth::user();

        if (strtolower($user->role->name) === 'admin') {
    session()->flash('success', 'Selamat datang kembali, Admin!');
    return redirect()->route('admin.dashboard');
} else {
    session()->flash('success', 'Anda berhasil login!');
    return redirect()->route('landing');
}

    }

    session()->flash('error', 'Email atau password salah!');
}

    public function render()
    {
        return view('livewire.auth.login')->layout('components.layouts.auth');
           
    }
}
