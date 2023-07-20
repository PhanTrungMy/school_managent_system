<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use App\Models\SchoolSubject;
use Illuminate\Http\Request;

class SchoolSubjectController extends Controller
{
    public function ViewSchoolSubject(){
        $data['allData'] = SchoolSubject::all();
        return view('backend.setup.school_subject.view_school_subject',$data);
    }
    public function AddSchoolSubject(){
        return view('backend.setup.school_subject.add_school_subject');
    }
    public function SchoolSubjectStore(Request $request){
        $validatedData = $request->validate([
            'name' =>'required|unique:school_subjects,name',

        ]);
        $data = new SchoolSubject();
        $data->name = $request->name;
        $data->save();
        $notification =  array(
            'message' =>'Fee Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('school.subject.view')->with($notification);
    }
    public function SchoolSubjectEdit($id){
        $editData = SchoolSubject::find($id);
        return view('backend.setup.school_subject.edit_school_subject',compact('editData'));
    }
    public function SchoolSubjectUpdate(Request $request,$id)
    {

        $data = SchoolSubject::find($id);
        $validatedData = $request->validate([
            'name' =>'required|unique:school_subjects,name',
        ]);

        $data->name = $request->name;
        $data->save();
        $notification =  array(
            'message' =>'School Subject Update Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('school.subject.view')->with($notification);
    }
    public function SchoolSubjectDelete($id){
        $data = SchoolSubject::find($id);

        $data->delete();
        $notification =  array(
            'message' =>'School Subject Delete Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('school.subject.view')->with($notification);

    }
}
