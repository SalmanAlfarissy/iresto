<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }


    public function index()
    {
        $session = $this->auth::user();
        if ($session) {
            if ($session->status == 'admin') {
                return redirect(route('dashboard'));
            }else if($session->status == 'user'){
                return redirect(route('dashboard'));
            }else{
                return redirect(route('mywallet'));
            }
        }
        return view('login');
    }

    public function authUser(Request $request)
    {
        $validate = $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $checkuser = $this->auth::attempt($validate);
        if ($checkuser) {
            return $this->result('Login Success!!',null,true);
        }
        return $this->result('Incorrect email or password!!');

    }

    public function logout(Request $request)
    {
        $this->auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'));
    }

}
