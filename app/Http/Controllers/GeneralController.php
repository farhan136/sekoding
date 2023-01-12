<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
