<?php

use Illuminate\Support\Facades\Route;
use Tjphippen\Http\Controllers\Crud;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::apiResource('users', Crud::class)
    ->middleware('crud:User')
    ->except(['destroy']);

Route::apiResource('users.accounts', Crud::class)
    ->middleware('crud:User:accounts')
    ->shallow();

Route::apiResource('accounts', Crud::class)
    ->middleware('crud:Account')
    ->except(['destroy']);

Route::apiResource('accounts.user', Crud::class)
    ->middleware('crud:Account:user')
    ->shallow();

Route::apiResource('transactions', Crud::class)
    ->middleware('crud:Transaction')
    ->except(['update', 'destroy']);
