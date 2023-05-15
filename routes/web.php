<?php

use App\Http\Controllers\ACL\PlanProfileController;
use App\Http\Controllers\DetailPlanController;
use App\Http\Controllers\PlansController;
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
    return view('welcome');
});

Route::prefix('admin')
    // ->namespace('Admin')
    // ->middleware('auth')
    ->group(function () {
        Route::prefix('plans')->group(function () {

            /**
             * Routes Plans
             */

            Route::get('/', [PlansController::class, 'index'])->name('plans.index');
            Route::get('/create', [PlansController::class, 'create'])->name('plans.create');
            Route::post('/create', [PlansController::class, 'store'])->name('plans.store');
            Route::put('/{url}', [PlansController::class, 'update'])->name('plans.update');
            Route::get('/{url}/edit', [PlansController::class, 'edit'])->name('plans.edit');
            Route::any('/search', [PlansController::class, 'search'])->name('plans.search');
            Route::delete('/{url}', [PlansController::class, 'destroy'])->name('plans.destroy');
            Route::get('/{url}', [PlansController::class, 'show'])->name('plans.show');

            /**
             * Routes Details Plans
             */

            Route::delete('/{url}/details/{idDetail}', [DetailPlanController::class, 'destroy'])->name('details.plan.destroy');
            Route::get('/{url}/details/create', [DetailPlanController::class, 'create'])->name('details.plan.create');
            Route::get('/{url}/details/{idDetail}', [DetailPlanController::class, 'show'])->name('details.plan.show');
            Route::put('/{url}/details/{idDetail}', [DetailPlanController::class, 'update'])->name('details.plan.update');
            Route::get('/{url}/details/{idDetail}/edit', [DetailPlanController::class, 'edit'])->name('details.plan.edit');
            Route::post('/{url}/details', [DetailPlanController::class, 'store'])->name('details.plan.store');
            Route::get('/{url}/details', [DetailPlanController::class, 'index'])->name('details.plan.index');
        });

        /**
         * Plan x Profile
         */
        Route::get('/{id}/profile/{idProfile}/detach', [PlanProfileController::class, 'detachProfilePlan'])->name('plans.profile.detach');
        Route::post('/{id}/profiles', [PlanProfileController::class, 'attachProfilesPlan'])->name('plans.profiles.attach');
        Route::any('/{id}/profiles/create', [PlanProfileController::class, 'profilesAvailable'])->name('plans.profiles.available');
        Route::get('/{id}/profiles', [PlanProfileController::class, 'profiles'])->name('plans.profiles');
        // Route::get('profiles/{id}/plans', [PlanProfileController::class, 'plans'])->name('profiles.plans');
    });

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
