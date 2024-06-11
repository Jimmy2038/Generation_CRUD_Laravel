Route::prefix('maison')->name('maison.')->group(function (){
    Route::get('ressource',[\App\Http\Controllers\MaisonController::class,'insert'])->name('ressource');
    Route::post('insert',[\App\Http\Controllers\MaisonController::class,'create'])->name('insert');
    Route::post('modifier',[\App\Http\Controllers\MaisonController::class,'modifier'])->name('modifier');
    Route::get('delete/{id}', [\App\Http\Controllers\MaisonController::class, 'destroy'])->name('destroy');
});
