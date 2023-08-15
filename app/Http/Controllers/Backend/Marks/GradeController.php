<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Http\Controllers\Controller;
use App\Models\MarksGrade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function MarkGradeView(){
     $data['allData'] = MarksGrade::all();
     return view('backend.marks.grade_marks_view',$data);

    }
    public function MarkGradeAdd(){
     return view('backend.marks.grade_marks_add');

    }
    public function MarkGradeStore(Request  $request){
     $data = new MarksGrade();
     $data->grade_name = $request->grade_name;
     $data->grade_point = $request->grade_point;
     $data->start_marks = $request->start_marks;
     $data->end_marks = $request->end_marks;
     $data->start_points = $request->start_points;
     $data->end_points = $request->end_points;
     $data->remarks = $request->remarks;

     $data->save();
     $notification = array(
        'message' => 'Mark Grade Add  Successfully',
        'alert-type' => 'success',
    );

    return redirect()->route('marks.entry.grade')->with($notification);
    

    }
    public function MarkGradeEdit($id){
        $data['editData'] = MarksGrade::find($id);
        return view('backend.marks.grade_marks_edit',$data);


    }
    public function MarkGradeUpdate(Request $request,$id){
        $data = MarksGrade::find($id);
        $data->grade_name = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_marks = $request->start_marks;
        $data->end_marks = $request->end_marks;
        $data->start_points = $request->start_points;
        $data->end_points = $request->end_points;
        $data->remarks = $request->remarks;
   
        $data->save();
        $notification = array(
           'message' => 'Mark Grade Update  Successfully',
           'alert-type' => 'success',
       );
   
       return redirect()->route('marks.entry.grade')->with($notification);
    }
}
