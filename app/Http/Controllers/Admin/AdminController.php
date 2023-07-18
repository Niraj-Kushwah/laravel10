<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use DB;
use Illuminate\Validation\Validator;
use Symfony\Component\Mime\Email;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required|max:30',
            ];
            $customeMsg = [

                'email.required' => 'Email is Required',
                'email.email' => 'Valid Email is Required',
                'password.required' => 'Password is Must Required'
            ];
            // $users = DB::table('admins')->where([
            //     ['email', '=', $data['email']],
            //     ['password', '=', Hash::check('plain-text', $data['password'])],
            // ])->get();
            // print_r($users[0]->name);
            // die;
            $this->validate($request, $rules, $customeMsg);
            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect('admin/dashboard');
            } else {
                return redirect()->back()->with('error_message', 'Invalid Email or Password');
            }
        }

        return view('admin.login');
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function updatePassword()
    {
        return view('admin.update_password');
    }
    public function checkCurrentPassword(Request $request)
    {
        $data = $request->all();
        // print_r($data);
        // die;
        if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {
            return "true";
        } else {
            return "false";
        }

    }
}