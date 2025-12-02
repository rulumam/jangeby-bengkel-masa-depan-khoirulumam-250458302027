<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Repair;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;

class Dashboard extends Component
{
    // Statistik utama
    public $totalRepairs = 0;
    public $completed = 0;
    public $pending = 0;
    public $cancelled = 0;
    public $paid = 0;

    public $totalUsers = 0;
    public $totalVehicles = 0;

    // Data untuk chart harian
    public $dailyRepairs = []; // total semua status per hari (created_at)
    public $dailyPaid = [];    // paid per hari (dihitung dari payments.created_at atau repairs.updated_at)
    public $days = [];

    public function mount()
    {
        $this->loadDashboardStats();
        $this->loadChartData();
    }

    public function loadDashboardStats()
    {
        $this->totalRepairs  = Repair::count();
        $this->completed     = Repair::where('status', 'done')->count();
        $this->pending       = Repair::where('status', 'pending')->count();
        $this->cancelled     = Repair::where('status', 'cancelled')->count();

        // Untuk total 'paid' ringkasan, hitung dari payments jika ada, else dari repairs.status = paid
        if (class_exists(\App\Models\Payment::class)) {
            $this->paid = \App\Models\Payment::count();
        } else {
            $this->paid = Repair::where('status', 'paid')->count();
        }

        $this->totalUsers    = User::count();
        $this->totalVehicles = Vehicle::count();
    }

    public function loadChartData()
    {
        $this->dailyRepairs = [];
        $this->dailyPaid = [];
        $this->days = [];

        // pakai timezone Jakarta agar tanggal sesuai lokal
        $now = now()->setTimezone('Asia/Jakarta');
        $year = $now->year;
        $month = $now->month;
        $daysInMonth = $now->daysInMonth;

        // detect apakah ada model Payment, agar perhitungan paid akurat
        $usePaymentsTable = class_exists(\App\Models\Payment::class);

        for ($d = 1; $d <= $daysInMonth; $d++) {
            $date = Carbon::create($year, $month, $d)->startOfDay();

            // label "01 Nov"
            $this->days[] = $date->format('d M');

            // total perbaikan berdasarkan created_at (semua status)
            $this->dailyRepairs[] = Repair::whereDate('created_at', $date)->count();

            // perhitungan paid:
            if ($usePaymentsTable) {
                // hitung dari tabel payments (lebih akurat jika ada)
                $this->dailyPaid[] = \App\Models\Payment::whereDate('created_at', $date)->count();
            } else {
                // fallback: hitung repair yang statusnya 'paid' dan updated_at pada tanggal tersebut
                // (asumsi status diubah menjadi 'paid' ketika pembayaran terjadi)
                $this->dailyPaid[] = Repair::where('status', 'paid')
                    ->whereDate('updated_at', $date)
                    ->count();
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.dashboard')
            ->layout('components.layouts.admin');
    }
}
