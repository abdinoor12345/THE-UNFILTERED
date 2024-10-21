<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {$permissions=Permission::all();
 return view('Roles_Permission.Permission.Index',compact('permissions')) ;
   }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
 return view('Roles_Permission.Permission.Create') ;
   }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {$validatedData=$request->validate([
        'name'=>'required|string|unique:permissions',
    ]);
    Permission::create($validatedData);
    return redirect()->back();
         
    }

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
    {$permissions=Permission::findOrFail($id);
        return view('Roles_Permission.Permission.Edit',compact('permissions'));
     }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {$validatedData=$request->validate([
        'name'=>'required|string|unique:permissions,name,'.$id,
    ]);
    $permissions=Permission::findOrFail($id);
    $permissions->update($validatedData);
    return redirect()->route('permissions.index')->with('success','Permissions updated succefully');
     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {$permission=Permission::find($id);
        $permission->delete();
        return redirect()->route('permissions.index')->with('success','Permissions updated succefully');


     }
}
