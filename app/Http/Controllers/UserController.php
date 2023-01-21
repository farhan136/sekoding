<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Camp;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Checkout;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Mail;
Use App\Mail\GeneralMail;

class UserController extends Controller
{
    public function index()
    {
        $camps = Camp::get();

        $data['camps'] = $camps;

        if (Auth::check()) {
            $data['checkoutted'] = Auth::user()->checkoutted;
        }

        return view('user.home', $data);
    }

    public function login()
    {
        return view('user.userform');
    }

    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function google_callback()
    {
        $callback = Socialite::driver('google')->user();

        $data = array(
            'name' => $callback->getName(),
            'photo' => $callback->getAvatar(),
            'email'=> $callback->getEmail(),
            'email_verified_at'=>date('Y-m-d H:i:s'),
            'is_admin'=>0
        );

        // $user = User::firstOrCreate(['email' => $data['email']], $data); //cek di tabel user apakah ada email yang sama dengan $data['email'] jika ada maka tidak perlu buat data baru

        $user = User::where('email', '=', $data['email'])->first(); //cek apakah ada user yang memakai email itu atau engga
        if(!$user){
            $user = User::create($data);
            Mail::to($user->email)->send(new GeneralMail($user, 'register'));
        }

        Auth::login($user, true);

        return redirect()->intended('/');
    }

    public function logout($is_admin = "")
    {
        Auth::logout();

        if($is_admin != ''){
            return redirect(url('/loginadmin'));
        }else{
            return redirect(url('/'));    
        }
    }

    public function dashboard()
    {
        $checkoutted = Checkout::where('user_id', Auth::user()->id)->get();

        $data['checkoutted'] = $checkoutted;

        return view('user.my_dashboard', $data);

    }

    public function destroy($id)
    {
        //
    }
}
