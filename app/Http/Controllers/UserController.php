<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Camp;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Checkout;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $camps = Camp::get();

        $data['camps'] = $camps;

        $data['checkoutted'] = Auth::user()->checkoutted;

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

        $user = User::firstOrCreate(['email' => $data['email']], $data); //cek di tabel user apakah ada email yang sama dengan $data['email'] jika ada maka tidak perlu buat data baru

        Auth::login($user, true);

        return redirect(url('/home'));
    }

    public function logout()
    {
        Auth::logout();

        return redirect(url('/home'));   
    }

    public function create()
    {
        //
    }

    public function checkout($slug)
    {
        $camp = Camp::where('slug', $slug)->first();

        $data['camp'] = $camp;

        return view('user.checkout', $data);
    }

    public function buy_camp(Request $request, $id)
    {
        $data = array(
            'camp_id' => $id,
            'user_id' => Auth::user()->id,
            'card_number'=> $request->card_number,
            'is_paid'=>1,
            'cvc'=>'tes',
            'expired'=>NULL

        );

        $checkout = Checkout::create($data);

        return redirect(url('/camps/success_checkout/'.$id));
    }

    public function success_checkout($id)
    {
        $camp = Camp::find($id);

        $data['camp'] = $camp;

        return view('user.success_checkout', $data);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
