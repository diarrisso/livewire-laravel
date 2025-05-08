<?php

use App\Livewire\TodoList;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


Route::get('/todos', TodoList::class);
