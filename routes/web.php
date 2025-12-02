<?php

use App\Livewire\Auth\Login;
use Illuminate\Http\Request;
use App\Livewire\LandingPage;

// AUTH
use App\Livewire\Auth\Register;
use App\Livewire\Admin\Dashboard;

// USER PAGES
use App\Livewire\User\PaymentPage;
use App\Livewire\User\RepairsForm;
use App\Livewire\User\BookingForm;

// ADMIN PAGES
use App\Livewire\Admin\RepairAdmin;
use App\Livewire\User\RepairsIndex;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\User\BookingListUser;
use App\Livewire\Admin\BookingListAdmin;
use App\Livewire\Admin\PaymentManagement;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTE
|--------------------------------------------------------------------------
*/

// Landing di navbar = homepage & landing
Route::get('/', LandingPage::class)->name('homepage');
Route::get('/landing', LandingPage::class)->name('landing');

// Auth
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');


/*
|--------------------------------------------------------------------------
| USER ROUTE
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])->group(function () {

    // Repairs (User booking)
    Route::get('/repairs', RepairsIndex::class)->name('repairs.index');

    // Navbar mobile pakai route('repairs.form'), jadi samakan:
    Route::get('/repairs/create', RepairsForm::class)->name('repairs.form');

    Route::get('/booking', BookingListUser::class)->name('booking.list');
    Route::get('/booking/create', BookingForm::class)->name('booking.form');
    Route::get('/payment/{id}', PaymentPage::class)->name('payment.page');


    
});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTE
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('/admin/booking', BookingListAdmin::class)->name('admin.booking');
    Route::get('/admin/repair', RepairAdmin::class)->name('admin.repair');
    Route::get('/admin/payment', PaymentManagement::class)->name('admin.payment');
});


/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');
