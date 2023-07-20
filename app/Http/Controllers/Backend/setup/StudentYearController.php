<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class StudentYearController extends Controller
{
    public function ViewYear(){
      $data['allData'] = StudentYear::all();
      return view('backend.setup.year.view_year',$data);
       }
       public function AddYear(){
       return view('backend.setup.year.add_year');
    }
    public function StudentYearStore(Request $request){
    $validatedData = $request->validate([
        'name' =>'required|unique:student_years,name',

    ]);
    $data = new StudentYear();
    $data->name = $request->name;
    $data->save();
    $notification =  array(
        'message' =>'Student Years Inserted Successfully',
        'alert-type' => 'success'
    );

    return redirect()->route('student.year.view')->with($notification);
  }
    public function StudentYearEdit($id){
        $editData = StudentYear::find($id);
        return view('backend.setup.year.edit_year',compact('editData'));
    }
    public function StudentYearUpdate(Request $request,$id)
    {

        $data = StudentYear::find($id);
        $validatedData = $request->validate([
            'name' =>'required|unique:student_years,name',
        ]);

        $data->name = $request->name;
        $data->save();
        $notification =  array(
            'message' =>'User Update Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('student.year.view')->with($notification);
    }
    public function StudentYearDelete($id){
        $data = StudentYear::find($id);

        $data->delete();
        $notification =  array(
            'message' =>'User Update Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('student.year.view')->with($notification);

    }

}
