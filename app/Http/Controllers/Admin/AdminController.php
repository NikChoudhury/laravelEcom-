<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session()->has('ADMIN_LOGIN') && session()->has('ADMIN_id')) {
            return redirect('admin/dashboard');
        }else{
            return view('admin/Login');
        }
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

        // $result = Admin::where(['email'=>$email,'password'=>$password])->get();
        $result = Admin::where(['email'=>$email])->first();
        if ($result) {
            if (Hash::check($password, $result->password)) {
                $request->session()->put("ADMIN_LOGIN",true);
                $request->session()->put("ADMIN_id",$result->id);
                return redirect('admin/dashboard');
            }else{
                $request->session()->flash('error',"Your email or password is incorrect !!");
                return redirect('admin')->withInput($request->only('email'));
            }         
        }else{
            $request->session()->flash('error',"Your email or password is incorrect !!");
            return redirect('admin')->withInput($request->only('email'));
        }
    }

    public function dashboard(){
        return view('admin.dashboard');
    }

    public function logout(){
        session()->forget('ADMIN_LOGIN');
        session()->forget('ADMIN_id');
        session()->flash('success',"Logout Successfull !!");
        return redirect('admin');
    }

    // public function getHashPassword()
    // {
    //     $result=Admin::find(1);
    //     $result->password=Hash::make("Nc7002593587#");
    //     $result->save();
    // }
}
