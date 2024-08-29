<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    public function index(Request $request)
    {
        if (Auth::user()) {
            return redirect()->route('dashboard');
        }
    	return view('login');
    }

    public function checkLogin(Request $request)
    {
        $username = $request->input("username");
        $password = $request->input("password");
        $akunuser = User::whereRaw("BINARY username='".$username."'")->first();
        if($akunuser) {
            if(Hash::check($password,$akunuser->password))  {
                Auth::login($akunuser);
                return redirect()->route('dashboard');
            } else {
                $desc = 'Login failed. Check your username and password again.';
                return redirect()->route('login')->with('message', ['status'=>'danger','desc'=>$desc]);
            }
        }else{
            $desc = 'Login failed. Account not found !';
            return redirect()->route('login')->with('message', ['status'=>'danger','desc'=>$desc]);
        }

    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }

}

