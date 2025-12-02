<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\ServiceQueue; 
use App\Models\Vehicle;    

class LandingPage extends Component
{

    public function render()
    {
        return view('livewire.landing-page')->layout('components.layouts.landing'); ;
    }
}