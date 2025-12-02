<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingListUser extends Component
{
    public $bookings = [];

    public function mount()
    {
        $this->loadBookings();
    }

    public function loadBookings()
    {
        $this->bookings = Booking::with('vehicle')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
    }

    /** Batalkan booking — ubah status menjadi cancelled **/
    public function cancelBooking($id)
    {
        $booking = Booking::where('user_id', Auth::id())->find($id);

        // Cegah 404 kalau booking sudah tidak ada
        if (!$booking) {
            return;
        }

        $booking->update(['status' => 'cancelled']);

        session()->flash('success', 'Booking berhasil dibatalkan!');
        $this->loadBookings();
    }

    /** Hapus booking secara permanen **/
    public function deleteBooking($id)
    {
        $booking = Booking::where('user_id', Auth::id())->find($id);

        // Jika data sudah hilang, jangan throw 404
        if (!$booking) {
            return;
        }

        $booking->delete();

        session()->flash('success', 'Booking berhasil dihapus!');
        $this->loadBookings();
    }

    public function render()
    {
        return view('livewire.user.booking-list')
            ->layout('components.layouts.bengkel');
    }
}
