<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use Carbon\Carbon;
use App\Produk;
use App\Kategori;
use App\Ukiran;
use App\Picture;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Intervention\Image\Facades\Image as Image;

class UserController extends Controller
{
    public function validator($data, $rules, $message){
        return Validator::make($data, $rules, $message);
    }
    public function login()
    {
      return view('admin.login');
    }
    public function loginProcess(Request $request)
    {
        $message = [
            'email.required'    => 'email harus diisi',
            'email.email'   => 'format email tidak benar (example@example.com)',
            'password.required' => 'password harus diisi',
        ];
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];
        $validator = $this->validator($request->all(), $rules, $message);
        if ($validator->fails()){
            return Redirect::back()->withInput()->withErrors($validator);
        }
        $user = User::where('email', $request->email)->first();
        if (!empty($user)){
            if (Hash::check($request->password, $user->password)){
              Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->has('remember'));
              return redirect()->route('admin.dashboard');
            } else {
                $errors = [
                    'password' => 'Email atau password yang anda masukan salah'
                ];
                return Redirect::back()->withInput()->withErrors($errors);
            }
        }else {
            $errors = 'Email atau password yang anda masukan salah';
            return Redirect::back()->withInput()->with(['error'=>$errors]);
        }
    }
    public function logout(){
      Auth::guard('admin')->logout();
      return redirect()->route('login');
    }
}
