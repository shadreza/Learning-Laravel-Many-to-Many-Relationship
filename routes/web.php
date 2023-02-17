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



// read


// result -> read the role of a user by passed  user_id
Route::get('read-role/{user_id}', function ($user_id) {
    $user = User::findOrFail($user_id);
    foreach ($user->roles as $role) {
        echo $role->name . '<br>';
    }
});


// result -> read the user of a role by passed  role_id
Route::get('read-user/{role_id}', function ($role_id) {
    $role = Role::findOrFail($role_id);
    foreach ($role->users as $user) {
        echo $user->name . '<br>';
    }
});




// update


// result -> update the role of a user by passed user_id

Route::get('update-role/{user_id}', function ($user_id) {
    $user = User::findOrFail($user_id);
    if ($user->has('roles')) {
        foreach ($user->roles as $role) {
            if ($role->name == 'subscriber') {
                // $role->name = strtoupper($user->name);
                $role->name = 'user';
                $role->save();
            }
        }
    }
});




// delete


// result -> delete the roles table

Route::get('delete/{user_id}/{role_id}', function ($user_id, $role_id) {
    $user = User::findOrFail($user_id);

    // this will delete the entire database or roles;
    // $user->roles()->delete();

    foreach ($user->roles as $role) {
        $role->whereId($role_id)->delete();
    }
});
