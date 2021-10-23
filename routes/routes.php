<?php

use Illuminate\Support\Facades\Route;
use Simpli_hub\Tracker\Http\Controllers\TestController;


Route::group(['prefix' => 'parampos', 'middleware' => 'api'], function () {

    Route::any('/', function () {
        $url = \route('parampos.secureTest');
        echo "<a href='$url'>$url</a><hr>";

        $url = \route('parampos.closePreAuth');
        echo "<a href='$url'>$url</a><hr>";

        $url = \route('parampos.cancelPreAuth');
        echo "<a href='$url'>$url</a><hr>";

        $url = \route('parampos.nonSecureTest');
        echo "<a href='$url'>$url</a><hr>";
    });
    Route::any('/closePreAuth', [\Sportakal\Parampos\Http\Controllers\ParamposController::class, 'closePreAuth'])->name('parampos.closePreAuth');
    Route::any('/cancelPreAuth', [\Sportakal\Parampos\Http\Controllers\ParamposController::class, 'cancelPreAuth'])->name('parampos.cancelPreAuth');
    Route::any('/secureTest', [\Sportakal\Parampos\Http\Controllers\ParamposController::class, 'secureTest'])->name('parampos.secureTest');
    Route::any('/nonSecureTest', [\Sportakal\Parampos\Http\Controllers\ParamposController::class, 'nonSecureTest'])->name('parampos.nonSecureTest');
    Route::any('/secureCallback', [\Sportakal\Parampos\Http\Controllers\ParamposController::class, 'secureCallback'])->name('parampos.secureCallback');
});