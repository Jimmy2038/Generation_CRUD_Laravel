Route::prefix('maison_traveau')->name('maison_traveau.')->group(function (){
    Route::get('ressource',[\App\Http\Controllers\Maison_traveauController::class,'insert'])->name('ressource');
    Route::post('insert',[\App\Http\Controllers\Maison_traveauController::class,'create'])->name('insert');
    Route::post('modifier',[\App\Http\Controllers\Maison_traveauController::class,'modifier'])->name('modifier');
    Route::get('delete/{id}', [\App\Http\Controllers\Maison_traveauController::class, 'destroy'])->name('destroy');
});
