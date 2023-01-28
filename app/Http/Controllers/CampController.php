<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Camp;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

class CampController extends Controller
{
    public function index()
    {
        $data['PARENTTAG'] = "camps";
        $data['TITLETAG'] = "Master Camp";
        return view('admin.camps.index', $data);
    }

    public function gridview()
    {
        $camps = Camp::get();

        return Datatables::of($camps)
            ->addColumn('camp_action', function ($camp) {
                return '<button  data-id="'.$camp->id.'" id="tombol_edit" class="btn btn-xs btn-primary edit_btn">Edit</button> <button  data-id="'.$camp->id.'" id="tombol_hapus" class="btn btn-xs btn-danger delete_btn"> Delete</button>';
            })->addColumn('camp_banner', function ($camp) {
                if($camp->banner == ''){
                    return '';
                }else{
                    return '<img width="150px" src="'.Storage::url($camp->banner).'" title="'.$camp->title.'">';
                }
            })
            ->addIndexColumn()->rawColumns(['camp_action', 'camp_banner'])->make();
    }

    public function create()
    {
        return view('admin.camps.create');
    }

    public function store(Request $request)
    {
        // Camp::create($request->all());

        // tampung berkas yang sudah diunggah ke variabel baru
        // 'banner' merupakan nama input yang ada pada form
        $uploadedFile = $request->file('banner');  

        // simpan berkas yang diunggah ke sub-direktori 'public/files/camps'
        // direktori 'files' dan 'camps' otomatis akan dibuat jika belum ada
        $path = $uploadedFile->store('public/files/camps');

        Camp::create([
            'title'=> $request->title,
            'price'=> $request->price,
            'banner'=>$path
        ]);


        echo "<script>window.opener.reloadDatatable();</script>";
        echo "<script>window.close();</script>";
    }

    public function edit($id)
    {
        $camp = Camp::find($id);
        $data['camp'] = $camp;
        return view('admin.camps.edit', $data);   
    }

    public function update(Request $request, Camp $camp)
    {
        $uploadedFile = $request->file('banner'); 
    
        if(!empty($uploadedFile)){
            if($request->file_existing != ''){
                Storage::delete($request->file_existing);    
            }
            $path = $uploadedFile->store('public/files/camps');
            $camp->banner = $path;
        }else{
            $camp->banner = $request->file_existing;
        }

        $camp->title = $request->title;
        $camp->price = $request->price;
        
        $camp->save();

        echo "<script>window.opener.reloadDatatable();</script>";
        echo "<script>window.close();</script>";
    }

    public function delete($id)
    {
        $camp = Camp::find($id);
        $data['camp'] = $camp;
        return view('admin.camps.delete', $data);   
    }

    public function destroy(Camp $camp)
    {
        $camp->delete(); 

        echo "<script>window.opener.reloadDatatable();</script>";
        echo "<script>window.close();</script>";
    }
}
