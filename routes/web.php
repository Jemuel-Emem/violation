<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware([

    ])->group(function () {
         Route::get('/dashboard', function () {
           if (auth()->user()->is_admin == 1) {
            return redirect()->route('Admindashboard');
           }else{
            return redirect()->route('user-dashboard');
           }
         })->name('userdashboard');

    });

    Route::prefix('admin')->middleware('admin')->group(function(){
        Route::get('/Admindashboard', function(){
            return view('admin.index');
        })->name('Admindashboard');

        Route::get('/Student', function(){
            return view('admin.student');
        })->name('student');

        Route::get('/Violation', function(){
            return view('admin.violation');
        })->name('violation');

        Route::get('/Users', function(){
            return view('admin.adduser');
        })->name('AddUser');

     });

     Route::prefix('user')->middleware('user')->group(function(){
        Route::get('/dashboard', function(){
               return view('user.index');
           })->name('user-dashboard');

        });
// Route::get('/dashboard', function () {
//     if (auth()->user()->is_admin == true) {
//         return redirect()->route('admin.dashboard');

//     } else {
//         dd('user');
//     }
// })->middleware(['auth', 'verified'])->name('dashboard');


// //ADMIN
// Route::prefix('administrator')->middleware(['auth', 'verified'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('admin.index');
//     })->name('admin.dashboard');
// });


//     Route::get('/dashboard', function () {
//         return view('admin.violations');
//     })->name('student');


//USER


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
