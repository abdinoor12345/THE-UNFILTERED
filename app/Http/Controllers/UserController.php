<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=User::with('roles')->get();
            return view('Roles_Permission.Users.Index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Roles_Permission.Users.Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData=$request->validate([
            'name'=>'string|required|unique:roles',
            'email'=>'email|string|required|unique:users',
            'password' => 'required|string|min:8',
                ]);
                $validateData['password'] = bcrypt($request->password);
                User::create($validateData);
                return redirect()->back();    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    $users=User::findOrFail($id);
    return view('Roles_Permission.Users.Edit',compact('users'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:users,name,' . $id,
        ]);
    
        $users = User::findOrFail($id);
        $users->update($validatedData);
    
        return redirect()->route('users.index')->with('success', 'users updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    
        return redirect()->back()->with('success', 'user Deleted Successfully');
    }
    public function assignRoles($userId) {
        $user = User::findOrFail($userId);
        $roles = Role::all();
        $userRoles = $user->roles?$user->roles->pluck('id')->toArray():[]; // Get the assigned roles

        return view('Roles_Permission.AssignRoleToUser', compact('user', 'roles', 'userRoles'));
    }

    // Method to update user roles
    public function updateRoles(Request $request, $userId) {
        $user = User::findOrFail($userId);

         $user->syncRoles($request->roles);

        return redirect()->back()->with('success', 'Roles updated successfully.');
    }
}
