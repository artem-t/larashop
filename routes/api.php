<?php

use App\Http\Controllers\AdminController;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', function (){
    $id = \request('id');
    if (!$id){
        return User::with('roles')->get();
    }

    return User::findOrFail($id);
});

Route::get('/roles', function (){
        return Role::get();
});

Route::get('users', function (){
    $users = User::with('roles')->get();
    return $users;
});

Route::post('/rmRoleToUserJ/{id}', [AdminController::class, 'rmRoleToUserJ']);
Route::post('/rmRoleJ/{id}', [AdminController::class, 'rmRoleJ']);
Route::post('/addRoleJ', [AdminController::class, 'addRoleJ']);
Route::post('/addRoleToUserJ/{id}', [AdminController::class, 'addRoleToUserJ']);
Route::get('/enterAsUserJ/{id}', [AdminController::class, 'enterAsUserJ']);



