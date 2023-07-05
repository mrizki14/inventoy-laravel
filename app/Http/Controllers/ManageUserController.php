<?php

namespace App\Http\Controllers;

use Rules\Password;
use App\Models\Role;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ManageUserController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::all();
        $query = User::query();

 

        if(isset($request->name) && ($request->name != null)) {
            $query->where('name', $request->name);
        }
        // $query->when($request->name, function($query) use ($request){
        //     return $query->where('name', 'like', '%'.$request->name.'%');
        // });
        if(isset($request->email) && ($request->email != null)) {
            $query->where('email', $request->email);
        }
        if(isset($request->role) && ($request->role != null)) {
            $query->whereHas('role', function($q) use ($request) {
                $q->whereIn('id',$request->role);
            });
        }

        $data = $query->get();
        return view ('manageUser', compact('data','roles'),[
            "title" => "Tambah User",
        ]);
    }

    //Function Tambah
    public function tambah()
    {
        $user = Role::select('id', 'name')->get();
        return view('manage_user/add_user',
        [
            "title" => "Tambah User",
            "user" => $user
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role_id' => 'required',
            'password' => 'required'
        ],[
            'nama.required' => 'nama tidak boleh kosong',
            'email.required' => 'email tidak boleh kosong',
            'role_id.required' => 'role tidak boleh kosong',
            'password.required' => 'password tidak boleh kosong',
        ]);
       
    
            $create_user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role_id,
                'password' => Hash::make($request->password)
            ]);

            // $credentials = $request->only('email', 'password');
            // Auth::attempt($credentials);
            // $request->session()->regenerate();
            // if($request->role_id != 1){
            //     return redirect('/');
            // }
            // else {
                return redirect()->route('user.manage')->with('success', 'User berhasil di tambahkan');
            // }
    
            if(!$create_user){
                DB::rollBack();
    
                return back()->with('error', 'Something went wrong while saving user data');
            }
    
    
 

        // $user =User::create($request->all());
        //     return redirect('manageUser')->with('success', 'Data berhasil di tambahkan');
    }

    public function edit($id)
    {
    $role =  User::find($id);
    $user = Role::get();

    if(!$user){
        return back()->with('error', 'User Not Found');
    }

    return view('manage_user.edit_user')->with([
        "title" => "Edit User",
        'user' => $user,
        'role' => $role,
    ]);
    }

    public function update ( Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role_id' => 'required',
            'password' => 'nullable'
        ],[
            'nama.required' => 'nama tidak boleh kosong',
            'email.required' => 'email tidak boleh kosong',
            'role_id.required' => 'role tidak boleh kosong',
        ]);
    
            $update_user = User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role_id,
                'password' => Hash::make($request->password)
            ]);
            // $credentials = $request->only('email', 'password');
            // if($request->role_id != 1)
            return redirect()->route('user.manage')->with('success', 'User Updated Successfully.');
            // else {
            //     return redirect()->route('user.manage')->with('success', 'User Updated Successfully.');
            // }
    
            if(!$update_user){
                DB::rollBack();
    
                return back()->with('error', 'Something went wrong while update user data');
            }
    
         
            
    
    
      
}
    // Function Hapus
    public function hapus($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect('manage_user')->with('success', 'User berhasil di hapus');

    }

    // public function filter (Request $request) {
    //     $roles = Role::all();
    //     $query = User::query();

    //     if(isset($request->name) && ($request->name != null)) {
    //         $query->where('name', $request->name);
    //     }
    //     if(isset($request->email) && ($request->email != null)) {
    //         $query->where('email', $request->email);
    //     }
    //     if(isset($request->role) && ($request->role != null)) {
    //         $query->whereHas('role', function($q) use ($request) {
    //             $q->whereIn('id',$request->role);
    //         });
    //     }

    //     $data = $query->get();
    //     return view ('manageUser', compact('data', 'roles'));
    // }
}
