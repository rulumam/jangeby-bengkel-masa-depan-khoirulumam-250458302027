<?php

namespace App\Livewire\Admin;

use App\Models\Repair;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class PaymentManagement extends Component
{
    use WithPagination;

    public $search = '';
    protected $paginationTheme = 'tailwind';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $repairs = Repair::with(['vehicle', 'user', 'payment'])
            ->whereHas('payment')
            ->where(function ($query) {
                $search = $this->search;
                $query->whereHas('vehicle', fn($v) => 
                    $v->where('brand', 'like', "%{$search}%")
                      ->orWhere('type', 'like', "%{$search}%")
                      ->orWhere('plate_number', 'like', "%{$search}%")
                )
                ->orWhereHas('user', fn($u) =>
                    $u->where('name', 'like', "%{$search}%")
                );
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.payment', ['repairs' => $repairs])
            ->layout('components.layouts.admin');
    }
}
