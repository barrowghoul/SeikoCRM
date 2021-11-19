<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(){
        
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function create(){
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'email:rfc,dns|unique:App\Models\User,email',
            'password' => 'required|confirmed'
            
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole($request->role_id);

        return redirect()->route('users.index');
    }

    public function edit(User $user){
        $roles = Role::all();
        return view('users.edit', compact('user','roles'));
    }

    public function update(Request $request, User $user){
        $request->validate([
            'name' => 'required',
            'email' => 'email:rfc,dns|unique:App\Models\User,email,'.$user->id,
            'password' => 'required|confirmed'
            
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->update();
        $user->assignRole($request->role_id);
        return redirect()->route('users.index');
    }
}
