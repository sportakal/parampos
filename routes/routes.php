<?php

use Illuminate\Support\Facades\Route;
use Simpliers\Tracker\Http\Controllers\TestController;


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
    Route::any('/closePreAuth', [\Simpliers\Parampos\Http\Controllers\ParamposController::class, 'closePreAuth'])->name('parampos.closePreAuth');
    Route::any('/cancelPreAuth', [\Simpliers\Parampos\Http\Controllers\ParamposController::class, 'cancelPreAuth'])->name('parampos.cancelPreAuth');
    Route::any('/secureTest', [\Simpliers\Parampos\Http\Controllers\ParamposController::class, 'secureTest'])->name('parampos.secureTest');
    Route::any('/nonSecureTest', [\Simpliers\Parampos\Http\Controllers\ParamposController::class, 'nonSecureTest'])->name('parampos.nonSecureTest');
    Route::any('/secureCallback', [\Simpliers\Parampos\Http\Controllers\ParamposController::class, 'secureCallback'])->name('parampos.secureCallback');
});