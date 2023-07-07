<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class ManageRoleController extends Controller
{
    public function index() {

        $roles = Role::paginate(10)->fragment('role');
        return view('manage_role', [
            'title' => 'Data Role',
            'roles' => $roles
        ]);
    }

    public function tambah() {
        return view ('data_pengguna/add_role', [
            'title' => 'Add Role'
        ]);
    }

    public function store (Request $request) {
        $request->validate([
            'name' => 'required|unique:roles'
        ], [
            'name.required' => 'nama role tidak boleh kosong'
        ]);

        $role = $request->all();
        Role::create($role);
  
        return redirect('role')->with('success', 'role berhasil ditambahkan');
    }

    public function edit($id) {
        $roles = Role::findOrFail($id);
        return view ('data_pengguna/edit_role', compact('roles'),([
            'title' => 'Edit Role'
        ]));
    }

    public function update(Request $request, Role $roles, $id) {
        $request->validate([
            'name' => 'required|unique:roles'
        ], [
            'name.required' => 'nama role tidak boleh kosong'
        ]);
        $roles = Role::findOrFail($id);
        $roles->update($request->all());

        return redirect('role')->with('success', 'Role berhasil di update');
    }
    
    public function delete($id) {
        $roles = Role::findOrFail($id);
        $roles->delete();

        return redirect('role')->with('success', 'Role berhasil di hapus');


    }
    
}
