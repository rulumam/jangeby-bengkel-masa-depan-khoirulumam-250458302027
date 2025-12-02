<?php

namespace App\Livewire\User;

use App\Models\Repair;
use App\Models\Payment;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class PaymentPage extends Component
{
    use WithFileUploads;
    
    public $repair;
    public $payment_proof;

    public function mount($id)
    {
        // Pastikan hanya user pemilik kendaraan yang bisa akses
        $this->repair = Repair::where('id', $id)
            ->whereHas('vehicle', function ($q) {
                $q->where('user_id', Auth::id());
            })
            ->firstOrFail();
    }

    public function uploadPayment()
    {
        $this->validate([
            'payment_proof' => 'required|image|max:2048',
        ]);

        // Simpan file ke storage
         

        // Simpan atau update data pembayaran
        Payment::updateOrCreate(
            ['repair_id' => $this->repair->id],
            [
                'proof' => $path,
                'status' => 'paid', // status menjadi paid
            ]
        );

        // Update status perbaikan menjadi paid juga
        $this->repair->update(['status' => 'paid']);

        session()->flash('success', 'Pembayaran berhasil dan bukti pembayaran telah diunggah.');
        return redirect()->route('repairs.index');
    }

    public function render()
    {
        return view('livewire.user.payment-page')
            ->layout('components.layouts.bengkel');
    }
}
