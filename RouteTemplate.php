Route::prefix('[#variable]')->name('[#variable].')->group(function (){
    Route::get('ressource',[\App\Http\Controllers\[#Classe]Controller::class,'insert'])->name('ressource');
    Route::post('insert',[\App\Http\Controllers\[#Classe]Controller::class,'create'])->name('insert');
    Route::post('modifier',[\App\Http\Controllers\[#Classe]Controller::class,'modifier'])->name('modifier');
    Route::get('delete/{id}', [\App\Http\Controllers\[#Classe]Controller::class, 'destroy'])->name('destroy');
});