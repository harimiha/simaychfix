<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $accounts = User::all();

        return view('account/index',compact('accounts'));
    }

    public function form()
    {
        $roles = Role::all();
        return view('account/form',compact('roles'));
    }

    public function save(Request $request)
    {
        
        try {
            $request->validate([
                'name'      => 'required|string|max:255',
                'email'     => 'required|string|email|max:255|unique:users',
                'username'  => 'required|string|max:255|unique:users',
                'password'  => 'required|string|min:6', // Password minimal 6 karakter
            ]);
            $account = new User;
            $account->name              = $request->name;
            $account->email             = $request->email;
            $account->username          = $request->username;
            $account->password          = Hash::make($request->password);
            $account->role_id           = $request->role_id;
            $account->save();
            if($account){
                $desc = "Data berhasil disimpan";
                return redirect()->route('account.index')->with('message', ['status'=>'success','desc'=>$desc]);
            }else{
                $desc= "Data gagal disimpan";
                return redirect()->route('account.add')->with('message', ['status'=>'danger','desc'=>$desc]);
            }
        }catch(\Throwable $th){
            $desc = $th->getMessage();
            return redirect()->route('account.add')->with('message', ['status'=>'danger','desc'=>$desc]);
        }

    }

    public function edit($id)
    {
        $account = User::find($id);
        $roles   = Role::all();
        return view('account/edit',compact('account','roles'));
    }

    public function update(Request $request,$id)
    {
        try {
            $account =  User::find($id);
            $account->name              = $request->name;
            $account->email             = $request->email;
            $account->username          = $request->username;
            if(isset($request->password)){
                $account->password          = Hash::make($request->password);
            }
            $account->role_id           = $request->role_id;
            $account->save();
            if($account){
                $desc = "Data berhasil diperbarui";
                return redirect()->route('account.index')->with('message', ['status'=>'success','desc'=>$desc]);
            }else{
                $desc= "Data gagal diperbarui";
                return redirect()->route('account.edit',$id)->with('message', ['status'=>'danger','desc'=>$desc]);
            }
        }catch(\Throwable $th){
            $desc = $th->getMessage();
            return redirect()->route('account.edit',$id)->with('message', ['status'=>'danger','desc'=>$desc]);
        }

    }

    public function delete(Request $request,$id)
    {
        try {
            $account =  User::find($id);
            if($account){
                $account->delete();
                $desc = "Data berhasil dihapus";
                return redirect()->route('account.index')->with('message', ['status'=>'success','desc'=>$desc]);
            }else{
               Abort('404');
            }
        }catch(\Throwable $th){
            $desc = $th->getMessage();
            return redirect()->route('account.index')->with('message', ['status'=>'danger','desc'=>$desc]);
        }

    }

}
