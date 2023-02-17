<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| CRUD
|--------------------------------------------------------------------------
*/

// create / insert


// result -> pivot table and the roles table gets updated
Route::get('insert-role/{user_id}', function ($user_id) {
    $user = User::findOrFail($user_id);
    $role = new Role(['name' => 'user']);
    $user->roles()->save($role);
});

// ^
// |
// reversely related
// |
// ⌄

// result -> pivot table and the roles table gets updated
Route::get('insert-user/{role_id}', function ($role_id) {
    $role = Role::findOrFail($role_id);
    $user = new User(['name' => 'New Name', 'email' => 'New Email', 'password' => 'New Password']);
    $role->users()->save($user);
});
