<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Repair;
use Illuminate\Support\Facades\Auth;

class BookingListAdmin extends Component
{
    public $bookings;
    public $search = ''; // 🔍 Search

    protected $listeners = ['bookingCreated' => 'mount']; 

    public function mount()
    {
        $this->loadBookings();
    }

    /** LOAD DATA + SEARCH */
    public function loadBookings()
    {
        $this->bookings = Booking::with(['vehicle', 'user', 'admin'])
            ->when($this->search, function ($query) {
                $query->whereHas('vehicle', function ($q) {
                    $q->where('brand', 'like', '%' . $this->search . '%')
                      ->orWhere('type', 'like', '%' . $this->search . '%')
                      ->orWhere('plate_number', 'like', '%' . $this->search . '%');
                })
                ->orWhere('description', 'like', '%' . $this->search . '%')
                ->orWhere('status', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->get();
    }

    /** Update status booking */
    public function updateStatus($id, $status)
    {
        $booking = Booking::findOrFail($id);

        // Jika admin klik TERIMA (approved)
        if ($status === 'approved') {

            // Pindahkan data ke tabel repairs
            Repair::create([
                'vehicle_id'   => $booking->vehicle_id,
                'admin_id'     => Auth::id(),
                'user_id'      => $booking->user_id,
                'description'  => $booking->description,
                'status'       => 'process',
            ]);

            // Hapus bookingnya supaya bener-bener pindah
            $booking->delete();

            session()->flash('success', 'Booking berhasil dipindahkan ke Repair!');
            $this->loadBookings();
            return;
        }

        // Jika status selain terima
        $booking->update(['status' => $status]);

        session()->flash('success', 'Status booking diperbarui!');
        $this->loadBookings();
    }

    /** Hapus booking */
    public function deleteBooking($id)
    {
        Booking::findOrFail($id)->delete();

        session()->flash('success', 'Booking berhasil dihapus!');
        $this->loadBookings();
    }

    public function updatedSearch()
    {
        $this->loadBookings(); 
    }

    public function render()
    {
        return view('livewire.admin.booking-list', [
            'bookings' => $this->bookings
        ])->layout('components.layouts.admin');
    }
}
