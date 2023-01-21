<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function gridview()
    {
        $camps = DB::table('camps')
            ->select('title', 'price')
            ->get();

        $data['data'] = $camps;
        echo json_encode($data);exit;
    }

    public function login()
    {
        return view('admin.login');
    }

    public function do_login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/camps');
        }
        return back();
    }
}
