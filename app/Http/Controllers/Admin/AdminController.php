<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminsRequset;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $adminRole=Role::where('name','admin')->first();
        $superAdminRole=Role::where('name','super admin')->first();
        $admins=User::whereIn('role_id',[$adminRole->id,$superAdminRole->id])->orderBy('role_id','ASC')->get();
        $data['admins']=$admins->except(auth()->user()->role_id);
        return view('admin.admins.index')->with($data);
    }
    public function create(Request $request)
    {
        $data['adminRoles']=Role::whereIn('name',['admin','super admin'])->get(); 
        return view("admin.admins.craete-new-admin")->with($data);
    }
    public function store(AdminsRequset $request)
    {
        $user= User::create(['password'=>Hash::make($request->password)]+$request->validated());
        event(new Registered($user));
        return redirect(url('dashboard/admins'));
    }
    public function promote($id)
    {
        $user=User::findOrFail($id);
        $user->update([
            "role_id"=>Role::where('name','super admin')->first()->id,
        ]);
        return back();
    }

    public function demote($id)
    {
        $user=User::findOrFail($id);
        $user->update([
            "role_id"=>Role::where('name','admin')->first()->id,
        ]);
        return back();
    }

    public  function delete($id)
    {
        $user=User::findOrFail($id);
        $user->delete();
        return back();
    }

}
