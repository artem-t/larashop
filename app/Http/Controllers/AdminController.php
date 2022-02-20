<?php

namespace App\Http\Controllers;

use App\Jobs\ExportCategories;
use App\Jobs\ImportCategories;
use App\Models\Role;
use App\Models\User;
use Faker\Guesser\Name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    public function admin ()
    {
        return view('admin.admin');
    }

    public function users ()
    {

        $users = User::paginate(3);
        $roles = Role::get();

        $data = [
            'title' => 'Список пользователей',
            'users' => $users,
            'roles' => $roles,
        ];
        return view('admin.users', $data);
    }


    public function enterAsUser ($id)
    {
        Auth::loginUsingId($id);
        return redirect()->route('adminUsers');
    }

    public function exportCategories()
    {
        ExportCategories::dispatch();

        return back()->with('success', 'Экспорт категорий запущен');
    }

    public function importCategories()
    {
        request()->validate([
            'import-file'   =>  ':mimes:csv,txt',
        ]);

        request()->file('import-file')->storeAs('public/import/', 'categories.csv');
        ImportCategories::dispatch();
        return back()->with('success', 'Импорт запущен');
    }

    public function addRole ()
    {
        request()->validate([
            'name' => 'required|min:3',
        ]);

        Role::create([
            'name' => request('name')
        ]);
        return back();
    }

    public function rmRole($id)
    {
       $role = Role::find($id);
       if ($role->users->count()){
           return back()->with('error', 'У роли есть пользователь');
       }
        $role->delete();

        return back()->with('success', 'Роль удалена');
    }

    public function addRoleToUser ()
    {
        request()->validate([
            'user_id' => 'required',
            'role_id' => 'required',
        ]);

        $user = User::find(request('user_id'));
        $user->roles()->attach(Role::find(request('role_id')));
        return back()->with('success', 'Роль добавлена');
    }

    public function rmRoleToUser()
    {
        request()->validate([
            'user_id' => 'required',
            'role_id' => 'required',
        ]);

        $user = User::find(request('user_id'));
        $user->roles()->detach(Role::find(request('role_id')));
        return back()->with('success', 'Роль удалена');

    }
}


