<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CampBenefit;
use App\Models\Camp;
use Yajra\Datatables\Datatables;

class CampBenefitController extends Controller
{
    public function index()
    {
        $data['PARENTTAG'] = "camp_benefits";
        $data['TITLETAG'] = "Camp's Benefit";
        return view('admin.camp_benefits.index', $data);
    }

    public function gridview()
    {
        $camp_benefits = CampBenefit::get();

        return Datatables::of($camp_benefits)
            ->addColumn('camp_name', function ($camp_benefit) {
                return $camp_benefit->camp->title;
            })->addColumn('benefit_action', function ($camp_benefit) {
                return '<button  data-id="'.$camp_benefit->id.'" id="tombol_edit" class="btn btn-xs btn-primary">Edit</button> <button  data-id="'.$camp_benefit->id.'" id="tombol_hapus" class="btn btn-xs btn-danger"> Delete</button>';
            })->addIndexColumn()->rawColumns(['camp_name','benefit_action'])->make();
    }

    public function form($id = '')
    {
        if($id != ''){
            $camp_benefits = CampBenefit::select('camps_id', 'name','id')->find($id);  
            $data['title'] = "Edit Camp's Benefit";
        }else{
            $camp_benefits = '';
            $data['title'] = "Create Camp's Benefit";
        }
        $data['id'] = $id;
        $camps = Camp::select('title','id')->get();
        $data['camps'] = $camps;
        $data['benefits'] = $camp_benefits;
        return view('admin.camp_benefits.form', $data);
    }

    public function store(Request $request, $id = '')
    {
        if($id == ''){
            CampBenefit::create($request->all());    
        }else{
            $benefit = CampBenefit::find($id);
            $benefit->camps_id = $request->camps_id;
            $benefit->name = $request->name;
            $benefit->save();
        }
        echo "<script>window.opener.reloadDatatable();</script>";
        echo "<script>window.opener.run_alert('success', 'Proses Sukses');</script>";
        echo "<script>window.close();</script>";
    }
}
