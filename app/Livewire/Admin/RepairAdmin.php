<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Repair;

class RepairAdmin extends Component
{
    public $repairs;
    public $search = '';

    public function mount()
    {
        $this->loadRepairs();
    }

    protected function loadRepairs()
    {
        $this->repairs = Repair::with(['vehicle', 'user']) // Tambahan relasi user
            ->where(function ($query) {
                $query->whereHas('vehicle', function ($q) {
                    $q->where('brand', 'like', "%{$this->search}%")
                      ->orWhere('type', 'like', "%{$this->search}%")
                      ->orWhere('plate_number', 'like', "%{$this->search}%");
                })
                ->orWhere('description', 'like', "%{$this->search}%")
                ->orWhereHas('user', function ($q) {
                    $q->where('name', 'like', "%{$this->search}%")
                      ->orWhere('name', 'like', "%{$this->search}%");
                });
            })
            ->latest()
            ->get();
    }

    // UPDATE STATUS REPAIR
    public function updateStatus($id, $status)
    {
        $repair = Repair::findOrFail($id);
        $repair->status = $status;
        $repair->save();

        session()->flash('success', 'Status updated successfully!');

        $this->loadRepairs();
        $this->dispatch('refreshDashboard'); // Livewire V3 event
    }

    // DELETE REPAIR
    public function deleteRepair($id)
    {
        Repair::findOrFail($id)->delete();

        session()->flash('success', 'Repair deleted successfully!');

        $this->loadRepairs();
        $this->dispatch('refreshDashboard');
    }

    public function updatedSearch()
    {
        $this->loadRepairs();
    }

    public function render()
    {
        return view('livewire.admin.repairadmin')
            ->layout('components.layouts.admin');
    }
}
