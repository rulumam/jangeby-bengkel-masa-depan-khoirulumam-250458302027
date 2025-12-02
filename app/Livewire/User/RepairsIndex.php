<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Repair;

class RepairsIndex extends Component
{
    public $repairs;

    public function mount()
    {
        $this->loadRepairs();
    }

    

    public function loadRepairs()
    {
        $this->repairs = Repair::with(['vehicle', 'admin']) // ⬅ tambah ini
            ->whereHas('vehicle', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->latest()
            ->get();
    }

    public function cancelRepair($id)
    {
        $repair = Repair::where('id', $id)
            ->whereHas('vehicle', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->first();

        if (!$repair) {
            session()->flash('error', 'Laporan tidak ditemukan.');
            return;
        }

        if (!in_array($repair->status, ['pending'])) {
            session()->flash('error', 'Laporan tidak bisa dibatalkan karena sudah diproses.');
            return;
        }

        $repair->update(['status' => 'cancelled']);
        session()->flash('success', 'Laporan perbaikan berhasil dibatalkan.');
        $this->loadRepairs();
    }


    public function deleteRepair($id)
    {
        $repair = Repair::where('id', $id)
            ->whereHas('vehicle', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->first();
        
        if (!$repair) {
            session()->flash('error', 'Laporan tidak ditemukan atau bukan milik Anda.');
            return;
        }
    
        $repair->delete();
    
        session()->flash('success', 'Laporan perbaikan berhasil dihapus dari riwayat.');
        $this->loadRepairs();
    }

    public function render()
    {
        return view('livewire.user.repairs-index', [
        'repairs' => $this->repairs
    ])
    ->layout('components.layouts.bengkel');
    }

}
