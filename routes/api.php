<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeceasedController;


Route::get('/allUsers', [UserController::class, 'allUsers']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::put('/update/{id}', [UserController::class, 'update']);
Route::delete('/delete/{id}', [UserController::class, 'delete']);

// Deceased
Route::get('/getAllDeceased', [DeceasedController::class, 'getAllDeceased']);
Route::get('/getPayments/{id}', [DeceasedController::class, 'getPayments']);
Route::post('/addDeceased', [DeceasedController::class, 'addDeceased']);
Route::post('/addPayment', [DeceasedController::class, 'addPayment']);
Route::post('/searchDeceased', [DeceasedController::class, 'searchDeceased']);
Route::put('/updateDeceased/{id}', [DeceasedController::class, 'updateDeceased']);
Route::put('/updatePayments/{id}', [DeceasedController::class, 'updatePayments']);
Route::delete('/deleteDeceased/{id}', [DeceasedController::class, 'deleteDeceased']);
Route::delete('/deletePayment/{id}', [DeceasedController::class, 'deletePayment']);


