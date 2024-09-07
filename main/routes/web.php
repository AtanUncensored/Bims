<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LguController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BarangayController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\AnnouncementController;

//home routing
Route::get('/', function () {
    return view('home.index');
});

//lgu login route
Route::get('/lgu-login', function () {
    return view('login.login-form');
});

Route::get('/barangay-login', function () {
    return view('login.barangay-login');
});

Route::get('/login/{barangay_name}', [BarangayController::class, 'showLoginPage'])->name('barangay.login');



//Dashboard access dere
Route::get('/dashboard', function () {
    return view('lgu.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {

    // LGU (superAdmin) Routes
    Route::middleware(['role:superAdmin'])->group(function () {

        //routes
        Route::get('/lgu', [LguController::class, 'index'])->name('lgu.dashboard');
        Route::put('/barangays/{barangay}', [LguController::class, 'update'])->name('lgu.barangays-update');//route to show edit
        Route::get('/barangays', [LguController::class, 'barangaysList'])->name('lgu.barangays-list');//route to show barangays
        Route::get('/barangays/{barangay}', [LguController::class, 'show'])->name('lgu.barangays-show');//route to show baranagay info
        Route::get('/admins', [LguController::class, 'admins'])->name('lgu.admins');//route to show admins of barangay
        Route::get('/barangay-admins/{adminUser}/edit', [LguController::class, 'editAdmin'])->name('lgu.admins-crud.edit-barangay-admin');
        Route::put('/barangay-admins/{adminUser}', [LguController::class, 'updateAdmin'])->name('lgu.admins-crud.update-barangay-admin');
        Route::delete('/barangay-admins/{admin}', [LguController::class, 'destroyAdmin'])->name('lgu.admins-crud.delete-barangay-admin');
        Route::get('/lgu/create-barangay', [LguController::class, 'createBarangayForm'])->name('lgu.create-barangay');//rotue to show /lgu/store-barangay 

        //crud
        Route::get('/barangays/{barangay}/edit', [LguController::class, 'edit'])->name('lgu.barangays-edit');//edit barangay information
        Route::post('/lgu/store-barangay-admin', [LguController::class, 'storeBarangayAdmin'])->name('lgu.store-barangay-admin');//create barangay admin
        Route::delete('/barangays/{barangay}', [LguController::class, 'destroy'])->name('lgu.barangays-delete');
    });

    // Barangay (admin) Routes
    Route::middleware(['role:admin'])->group(function () {

    //Dashboard
        Route::get('/barangay-dashboard', [BarangayController::class, 'index'])->name('barangay.dashboard');
        Route::get('/barangay', [BarangayController::class, 'index'])->name('barangay.index');
        Route::get('/barangay/create-user', [BarangayController::class, 'createUserForm'])->name('barangay.create-user');
        Route::post('/barangay/store-user', [BarangayController::class, 'storeUser'])->name('barangay.store-user');
    
    //Residents
        Route::get('/residents', [ResidentController::class, 'index'])->name('barangay.residents.index');

    //Budget Reports
        Route::get('/reports', [BudgetController::class, 'index'])->name('barangay.budget-report.index');
        Route::get('/barangay/create-budgetReport', [BudgetController::class, 'createBudgetReport'])->name('barangay.create-budgetReport');
        Route::post('/barangay/store-budgetReport', [BudgetController::class, 'storeBudgetReport'])->name('barangay.store-budgetReport');
    
    //Announcements
        Route::get('/announcements/show', [AnnouncementController::class, 'index'])->name('announcements.index');
        Route::get('/announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create');
        Route::post('/announcements/store', [AnnouncementController::class, 'store'])->name('announcements.store');

    //Complaints
        Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');

    //Logs
        Route::get('/logs', [LogController::class, 'index'])->name('logs.index');

    //Certificates
        Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates.index');
    });

    // User Routes
    Route::middleware(['role:user'])->group(function () {
        Route::get('/user', [UserController::class, 'showBudgetReports'])->name('user.index');
    });
});

require __DIR__.'/auth.php';
