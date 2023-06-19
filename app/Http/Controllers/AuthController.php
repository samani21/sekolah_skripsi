<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        if ($user = Auth::user()) {
            if ($user->level == 'Guru') {
                return redirect()->intended('Guru?tgl='.date('d-m-Y').'&tahun='.date('Y').'');
            }
             elseif ($user->level == 'Tata_usaha') {
                return redirect()->intended('Tata_usaha?tgl='.date('d-m-Y').'&tahun='.date('Y').'');
            }
            // elseif ($user->level == 'apotek') {
            //     return redirect()->intended('apotek?tgl='.date('d-m-Y').'&tahun='.date('Y').'');
            // }elseif ($user->level == 'kapus') {
            //     return redirect()->intended('kapus?tgl='.date('d-m-Y').'&tahun='.date('Y').'');
            // }elseif ($user->level == 'operator') {
            //     return redirect()->intended('operator?tgl='.date('d-m-Y').'&tahun='.date('Y').'');
            // }
        }
        return view('login');
    }

    public function proses_login(Request $request)
    {
        request()->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ]);

        $kredensil = $request->only('username','password');

            if (Auth::attempt($kredensil)) {
                $user = Auth::user();
                
                    if ($user->level == 'Guru') {
                        return redirect()->intended('Guru?tgl='.date('d-m-Y').'&tahun='.date('Y').'');
                    }
                     elseif ($user->level == 'Tata_usaha') {
                        return redirect()->intended('Tata_usaha?tgl='.date('d-m-Y').'&tahun='.date('Y').'');
                    }
                    // elseif ($user->level == 'apotek') {
                    //     return redirect()->intended('apotek?tgl='.date('d-m-Y').'&tahun='.date('Y').'');
                    // }elseif ($user->level == 'kapus') {
                    //     return redirect()->intended('kapus?tgl='.date('d-m-Y').'&tahun='.date('Y').'');
                    // }elseif ($user->level == 'operator') {
                    //     return redirect()->intended('operator?tgl='.date('d-m-Y').'&tahun='.date('Y').'');
                    // }
                
                return redirect()->intended('login');
            }

        return redirect('login')
                                ->withInput()
                                ->withErrors(['login_gagal' => 'PASSWORD SALAH']);
    }

    public function register()
    {
        return view('register');
    }

    public function register_action(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ]);

        $user = new User([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'password1' => $request->password,
            'level' =>$request->level,
            'status' =>$request->status,
        ]);
        $user->save();

        event(new Registered($user));
        auth()->login($user);

        return redirect('/')->with('success', 'Registration success.');
    }

    public function logout(Request $request)
    {
       $request->session()->flush();
       Auth::logout();
       return Redirect('/');
    }
    
}