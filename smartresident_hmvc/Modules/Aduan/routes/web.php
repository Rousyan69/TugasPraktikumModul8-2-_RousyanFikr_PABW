<?php

use Illuminate\Support\Facades\Route;
use Modules\Aduan\Http\Controllers\AduanController;

Route::middleware(['auth', 'role:admin,warga'])->group(function () {
    Route::get('aduan', [AduanController::class, 'index'])->name('aduan.index');
    Route::get('aduan/data', [AduanController::class, 'getData'])->name('aduan.data');
    Route::post('aduan', [AduanController::class, 'store'])->name('aduan.store');
    Route::get('aduan/{aduan}/edit', [AduanController::class, 'edit'])->name('aduan.edit');
    Route::put('aduan/{aduan}', [AduanController::class, 'update'])->name('aduan.update');
    Route::delete('aduan/{aduan}', [AduanController::class, 'destroy'])->name('aduan.destroy');
});