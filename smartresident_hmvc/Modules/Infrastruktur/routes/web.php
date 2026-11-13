<?php

use Illuminate\Support\Facades\Route;
use Modules\Infrastruktur\Http\Controllers\InfrastrukturController;

Route::middleware(['auth', 'role:admin,warga'])->group(function () {
    Route::get('infrastruktur', [InfrastrukturController::class, 'index'])->name('infrastruktur.index');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('infrastruktur/create', [InfrastrukturController::class, 'create'])->name('infrastruktur.create');
    Route::post('infrastruktur', [InfrastrukturController::class, 'store'])->name('infrastruktur.store');
    Route::get('infrastruktur/{infrastruktur}/edit', [InfrastrukturController::class, 'edit'])->name('infrastruktur.edit');
    Route::put('infrastruktur/{infrastruktur}', [InfrastrukturController::class, 'update'])->name('infrastruktur.update');
    Route::delete('infrastruktur/{infrastruktur}', [InfrastrukturController::class, 'destroy'])->name('infrastruktur.destroy');
});