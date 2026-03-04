<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::livewire('/counter', 'post.create')->name('counter.create');
