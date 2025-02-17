<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/email', function () {
    Mail::raw('Test Message', function ($message) {
        $message->to('teste@example.com');
    });

    echo 'Email sent';
});
