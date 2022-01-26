<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;

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
        $email = $request->email;
        $password = $request->password;
        $data = User::where('email', $request->email)->first();
        if($data){
            $pass = Crypt::decryptString($data->password);
            if($pass == $password){
                Session::put('login',TRUE);
                return redirect()->route('admin.dashboard');
            }else{
                return Redirect::back()->withInput()->with('alert','Password salah!');
            }
        }else{
            return Redirect::back()->withInput()->with('alert','Email salah!');
        }
    }

    public function logout(){
        Session::flush();
        return redirect()->route('login');
    }

    public function index(){
        $user = User::get();
        return view('admin.user.index',compact('user'));
    }

    public function store(Request $request){        
        $pass = Crypt::encryptString($request->password);
        User::create([
            'name'=>$request->nama,
            'email'=>$request->email,
            'password'=>$pass
        ]);
        return redirect()->route('admin.user');
    }

    public function update(Request $request){        
        $pass = Crypt::encryptString($request->password);
        User::where('id',$request->id)->update([
            'name'=>$request->nama,
            'email'=>$request->email,
            'password'=>$pass
        ]);
        return redirect()->route('admin.user');
    }
}
