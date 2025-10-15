<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::latest()->paginate(setting('default_pagination'));
        return view('backend.admin.role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::get();
        return view('backend.admin.role.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permission' => 'required|array',
        ]);

        $roleName = $request->name;
        $permissions = $request->permission;

        $role = Role::create(['name' => $roleName]);

        $role->syncPermissions($permissions);

        return back()->with('success','Role Created Successfully');
    }

    /**
     * Display the specified resource.
     */

    public function show(string $id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        return view('backend.admin.role.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $permissions = Permission::get();
        return view('backend.admin.role.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name,'.$id,
            'permission' => 'required|array',
        ]);

        $role = Role::findOrFail($id);

        $role->update([
            'name'=>$request->name
        ]);

        $permissions = $request->permission;

        $role->syncPermissions($permissions);

        return back()->with('success','Role Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        try {
            $role->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Role deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong: '.$e->getMessage()
            ], 500);
        }
    }
}
