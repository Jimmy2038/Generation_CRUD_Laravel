Route::prefix('essai')->name('essai.')->group(function (){
    Route::get('ressource',[\App\Http\Controllers\EssaiController::class,'insert'])->name('ressource');
    Route::post('insert',[\App\Http\Controllers\EssaiController::class,'create'])->name('insert');
    Route::post('modifier',[\App\Http\Controllers\EssaiController::class,'modifier'])->name('modifier');
    Route::get('delete/{id}', [\App\Http\Controllers\EssaiController::class, 'destroy'])->name('destroy');
});
