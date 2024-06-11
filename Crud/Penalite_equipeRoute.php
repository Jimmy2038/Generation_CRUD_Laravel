Route::prefix('penalite_equipe')->name('penalite_equipe.')->group(function (){
    Route::get('ressource',[\App\Http\Controllers\Penalite_equipeController::class,'insert'])->name('ressource');
    Route::post('insert',[\App\Http\Controllers\Penalite_equipeController::class,'create'])->name('insert');
    Route::post('modifier',[\App\Http\Controllers\Penalite_equipeController::class,'modifier'])->name('modifier');
    Route::get('delete/{id}', [\App\Http\Controllers\Penalite_equipeController::class, 'destroy'])->name('destroy');
});
