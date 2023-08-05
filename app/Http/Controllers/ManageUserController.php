<?php

namespace App\Http\Controllers;

use Rules\Password;
// use App\Models\Role;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ManageUserController extends Controller
{
    public function index()
    {

        $users = User::all();
        // if(isset($request->name) && ($request->name != null)) {
        //     $query->where('name', $request->name);
        // }
        // // $query->when($request->name, function($query) use ($request){
        // //     return $query->where('name', 'like', '%'.$request->name.'%');
        // // });
        // if(isset($request->email) && ($request->email != null)) {
        //     $query->where('email', $request->email);
        // }
        // if(isset($request->role) && ($request->role != null)) {
        //     $query->whereHas('role', function($q) use ($request) {
        //         $q->whereIn('id',$request->role);
        //     });
        // }

        // $data = $query->get();
        return view ('manageUser', compact('users'),[
            "title" => "Tambah User",
        ]);
    }

    public function search(Request $request){
        $search = $request->search;
        $users = User::where(function($query) use ($search){
            $query->where('name','like',"%$search%")
            ->orWhere('email','like',"%$search%");
        })
        ->orWhereHas('role', function($query) use ($search) {
            $query->where('name','like',"%$search%");
        })
        ->get();

        return view ('manageUser', compact('users','search'),[
            "title" => "Tambah User",
            
        ]
        );
        }

    //Function Tambah
    public function tambah()
    {
        $roles = Role::select('id', 'name')->get();
        return view('manage_user/add_user',
        [
            "title" => "Tambah User",
            "roles" => $roles
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            // 'role_id' => 'required',
            'password' => 'required',
            'roles' => 'required'
        ],[
            'nama.required' => 'nama tidak boleh kosong',
            'email.required' => 'email tidak boleh kosong',
            // 'role_id.required' => 'role tidak boleh kosong',
            'password.required' => 'password tidak boleh kosong',
            'roles.required' => 'roles tidak boleh kosong',
        ]);
       
    
            // $create_user = User::create([
            //     'name' => $request->name,
            //     'email' => $request->email,
            //     'role_id' => $request->role_id,
            //     'password' => Hash::make($request->password)
            // ]);
            
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
        
            $user = User::create($input);
            $user->assignRole($request->input('roles'));

            // $credentials = $request->only('email', 'password');
            // Auth::attempt($credentials);
            // $request->session()->regenerate();
            // if($request->role_id != 1){
            //     return redirect('/');
            // }
            // else {
                return redirect()->route('user.manage')->with('success', 'User berhasil di tambahkan');
            // }
    
            if(!$user){
                DB::rollBack();
    
                return back()->with('error', 'Something went wrong while saving user data');
            }
    
    
 

        // $user =User::create($request->all());
        //     return redirect('manageUser')->with('success', 'Data berhasil di tambahkan');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->toArray();

    // if(!$user){
    //     return back()->with('error', 'User Not Found');
    // }

    return view('manage_user.edit_user')->with([
        "title" => "Edit User",
        'user' => $user,
        'roles' => $roles,
        'userRole' => $userRole
    ]);
    }

    public function update ( Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            // 'role_id' => 'required',
            'password' => 'nullable',
            'roles' => 'required'
        ],[
            'nama.required' => 'nama tidak boleh kosong',
            'email.required' => 'email tidak boleh kosong',
            'roles.required' => 'role tidak boleh kosong',
        ]);
        
            $input = $request->only(['name', 'email', 'roles']);
            // if(!empty($input['password'])){ 
            //     $input['password'] = Hash::make($input['password']);
            // }else{
            //     $input = Arr::except($input,array('password'));    
            // }
            $user = User::find($id);
            $user->update($input);
            DB::table('model_has_roles')->where('model_id',$id)->delete();
        
            $user->assignRole($request->input('roles'));
            // $credentials = $request->only('email', 'password');
            // if($request->role_id != 1)
            return redirect()->route('user.manage')->with('success', 'User Updated Successfully.');
            // else {
            //     return redirect()->route('user.manage')->with('success', 'User Updated Successfully.');
            // }
    
            if(!$user){
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
