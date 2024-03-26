<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['API' => 'API for CMS'];
});

require __DIR__.'/auth.php';
