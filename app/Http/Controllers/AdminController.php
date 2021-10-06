<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/Login');
    }

    public function auth(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ],
        [
            'email.required' => 'Please enter your Email !',
            'email.email' => 'Please enter a valid Email !',
            'password.required' => 'Please enter your password !'
        ]
        );

        $email= $request->post('email');
        $password= $request->post('password');

        $result = Admin::where(['email'=>$email,'password'=>$password])->get();
        if (isset($result[0]->id)) {
            $request->session()->put("ADMIN_LOGIN",true);
            $request->session()->put("ADMIN_id",$result[0]->id);
            return redirect('admin/dashboard');
        }else{
            $request->session()->flash('error',"Your email or password is incorrect !!");
            return redirect('admin')->withInput($request->only('email'));
        }
    }

    public function dashboard(){
        return view('admin.dashboard');
    }
}
