<?php

namespace App\Http\Controllers;

// use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ManageRoleController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['tambah','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['delete']]);
    }
    public function index() {

        $roles = Role::with('permissions:name')->first()->paginate(10)->fragment('role');
        return view('manage_role', [
            'title' => 'Data Role',
            'roles' => $roles,
            // 'permission' => $permission
        ]);
    }

    public function tambah() {
        $permission = Permission::get();
        return view ('data_pengguna/add_role', [
            'title' => 'Add Role',
            'permission' => $permission
        ]);
    }

    public function store (Request $request) {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required',

        ], [
            'name.required' => 'nama role tidak boleh kosong'
        ]);

     
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
    
  
        return redirect('role')->with('success', 'role berhasil ditambahkan');
    }

    public function edit($id) {
        $roles = Role::findOrFail($id);
        $rolePermissions = $roles->permissions->pluck('name')->toArray();
        $permission = Permission::get();
        return view ('data_pengguna/edit_role', compact('roles','permission','rolePermissions'),([
            'title' => 'Edit Role'
        ]));
    }

    public function update(Request $request, Role $roles, $id) {
        $request->validate([
            'name' => 'required',
            'permission' => 'required',
        ], [
            'name.required' => 'nama role tidak boleh kosong'
        ]);
        $roles = Role::findOrFail($id);
        $roles->name = $request->input('name');
        $roles->save();
    
        $roles->syncPermissions($request->input('permission'));
    

        return redirect('role')->with('success', 'Role berhasil di update');
    }
    
    public function delete($id) {
        $roles = Role::findOrFail($id);
        $roles->delete();

        return redirect('role')->with('success', 'Role berhasil di hapus');


    }
    
}
