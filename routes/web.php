<?php
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
//All Listings
Route::get('/', [ListingController::class, 'index']);
//create show
Route::middleware(['auth'])->group(function () {
    Route::get('/listings/create', [ListingController::class, 'create']);
    //STORE LISTING DATA
    Route::post('/listings', [ListingController::class, 'store']);
    // Manage Listings
    Route::get('/listings/manage',[ListingController::class,'manage']);

    //EDIT FORM
    Route::get('/listings/{listing}/edit', [ListingController::class, 'edit']);
    //Delete the listing
    Route::delete('/listings/{listing}', [ListingController::class, 'destroy']);
    //Listing Logout
    Route::post('/logout', [UserController::class, 'logout']);
});
Route::middleware(['guest'])->group(function () {
    //Register form
    Route::get('/register', [UserController::class, 'create']);
    //listing login
    Route::get('/login', [UserController::class, 'login'])->name('login');
});
//edit form to update
Route::put('/listings/{listing}', [ListingController::class, 'update']);

//Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

//user created
Route::post('/users', [UserController::class, 'store']);

//login user
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
