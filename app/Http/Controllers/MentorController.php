<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mentor;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

class MentorController extends Controller
{
    public function index()
    { 
        $data['PARENTTAG'] = "mentor";
        $data['TITLETAG'] = "Master Mentor";
        return view('admin.mentor.index', $data);
    }

    public function form($id = '')
    {
        if($id != ''){
            $mentors = Mentor::select('id', 'name','email')->find($id);  
            $data['title'] = "Edit Mentor";
        }else{
            $mentors = '';
            $data['title'] = "Create Mentor";
        }
        $data['id'] = $id;
        $data['mentors'] = $mentors;
        return view('admin.mentor.form', $data);
    }

    public function store(Request $request, $id = '')
    {
        if($id == ''){
            $mentor = new Mentor; 
        }else{
            $mentor = Mentor::find($id);
        }

        $uploadedFile = $request->file('photo'); 

        if(!empty($uploadedFile)){
            if($request->file_existing != ''){
                Storage::delete($request->file_existing);    
            }
            $path = $uploadedFile->store('public/files/mentors');
            $mentor->photo = $path;
        }else{
            $mentor->photo = $request->file_existing;
        }

        $mentor->name = $request->name;
        $mentor->email = $request->email;
        $mentor->save();

        echo "<script>window.opener.reloadDatatable();</script>";
        echo "<script>window.close();</script>";
    }

    public function gridview()
    {
        $mentor = Mentor::get();

        return Datatables::of($mentor)
            ->addColumn('mentor_action', function ($mentor) {
                return '<button  data-id="'.$mentor->id.'" id="tombol_edit" class="btn btn-xs btn-primary edit_btn">Edit</button>';
            })->addColumn('mentor_photo', function ($mentor) {
                if($mentor->photo == ''){
                    return '';
                }else{
                    return '<img width="150px" src="'.Storage::url($mentor->photo).'" title="'.$mentor->name.'">';
                }
            })
            ->addIndexColumn()->rawColumns(['mentor_action', 'mentor_photo'])->make();
    }
}
