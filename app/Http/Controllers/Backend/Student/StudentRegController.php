<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentYear;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;


class StudentRegController extends Controller
{
    /** @noinspection UnknownColumnInspection */
    public function StudentRegView()
    {
        $data['years']= StudentYear::all();
        $data['classes']= StudentClass::all();
        $data['year_id']= StudentYear::orderby('id', 'desc')->first()->id;
        $data['class_id']= StudentClass::orderby('id', 'desc')->first()->id;
//        dd( $data['year_id']);
        /** @noinspection UnknownColumnInspection */
        $data['allData']= AssignStudent::where('year_id', $data['year_id'])->where('class_id', $data['class_id'])->get();
        return view('backend.student.student_reg.student_view',$data);
    }
    public function StudentClassYearWise(request $request){
        $data['years']= StudentYear::all();
        $data['classes']= StudentClass::all();
        $data['year_id']= $request->year_id;
        $data['class_id']=$request->class_id;
//        dd( $data['year_id']);
        $data['allData']= AssignStudent::where('year_id', $data['year_id'])->where('class_id', $data['class_id'])->get();
        return view('backend.student.student_reg.student_view',$data);
    }
    public function StudentRegAdd(){
        $data['years']= StudentYear::all();
        $data['classes']= StudentClass::all();
        $data['groups']= StudentGroup::all();

        return view('backend.student.student_reg.student_add',$data);
    }
    public function StudentRegStore(Request $request){
    DB::transaction(function() use ($request){
            $checkYear = StudentYear::find($request->year_id)->name;
            $student = User::where('usertype','student')->orderBy('id','DESC')->first();
            if($student == null){
                $fristReg = 0;
                $studentId = $fristReg +1;
                if ($studentId < 10){
                    $id_no = '000'.$studentId;
                }elseif($studentId < 100 ){
                    $id_no = '00'.$studentId;
                }elseif($studentId < 1000 ){
                    $id_no = '0'.$studentId;
                }
            }else{
                $student = User::where('usertype','Student')->orderBy('id','DESC')->first()->id;
                $studentId = $student + 1;
                if ($studentId < 10){
                    $id_no = '000'.$studentId;
                }elseif($studentId < 100 ){
                    $id_no = '00'.$studentId;
                }elseif($studentId < 1000 ){
                    $id_no = '0'.$studentId;
                }
            }//end else
          $final_id_no = $checkYear.$id_no;
            $user =  new User();
            $code = rand(0000,9999);
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->usertype = 'Student';
            $user->code = $code;
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d ',strtotime($request->dob));
            if($request->file('image')){
                $file = $request->file('image');
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/student_images'),$filename);
                $user['image'] = $filename;
            }
            $user->save();
            $assign_student = new AssignStudent();
            $assign_student->student_id = $user->id;
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->save();

             $discount_student = new DiscountStudent();
        $discount_student->assign_student_id= $assign_student->id;
        $discount_student->fee_category_id = '1';
        $discount_student->discount = $request->discount;
        $discount_student->save();
    });
    $notification =  array(
            'message' =>'Student Registration Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.registration.view')->with($notification);
    }
   public function StudentRegEdit($student_id){
       $data['years']= StudentYear::all();
       $data['classes']= StudentClass::all();
       $data['groups']= StudentGroup::all();

       $data['editData']= AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
//       dd($data['editData']->toArray());

      return view('backend.student.student_reg.student_edit',$data);
    }
    public  function StudentRegUpdate(Request $request,$student_id){
        DB::transaction(function() use ($request,$student_id){
            $user =   User::where('id',$student_id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d ',strtotime($request->dob));
            if($request->file('image')){
                $file = $request->file('image');
                @unlink(public_path('upload/student_images/'.$user->image));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/student_images'),$filename);
                $user['image'] = $filename;
            }
            $user->save();
            $assign_student =  AssignStudent::where('id',$request->id)->where('student_id',$student_id)->first();

            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->save();

            $discount_student = DiscountStudent::where('assign_student_id',$request->id)->first();

            $discount_student->discount = $request->discount;
            $discount_student->save();
        });
        $notification =  array(
            'message' =>'Student Registration Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.registration.view')->with($notification);
    }
    public function StudentRegPromotion($student_id){
        $data['years']= StudentYear::all();
        $data['classes']= StudentClass::all();
        $data['groups']= StudentGroup::all();

        $data['editData']= AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
//       dd($data['editData']->toArray());

        return view('backend.student.student_reg.student_promotion',$data);
    }
     public function StudentRegUpdatePromotion(Request $request,$student_id){

         DB::transaction(function() use ($request,$student_id){
             $user =   User::where('id',$student_id)->first();
             $user->name = $request->name;
             $user->fname = $request->fname;
             $user->mname = $request->mname;
             $user->mobile = $request->mobile;
             $user->address = $request->address;
             $user->gender = $request->gender;
             $user->religion = $request->religion;
             $user->dob = date('Y-m-d ',strtotime($request->dob));
             if($request->file('image')){
                 $file = $request->file('image');
                 @unlink(public_path('upload/student_images/'.$user->image));
                 $filename = date('YmdHi').$file->getClientOriginalName();
                 $file->move(public_path('upload/student_images'),$filename);
                 $user['image'] = $filename;
             }
             $user->save();
             $assign_student = new AssignStudent();
             $assign_student->student_id = $student_id;
             $assign_student->year_id = $request->year_id;
             $assign_student->class_id = $request->class_id;
             $assign_student->group_id = $request->group_id;
             $assign_student->save();

             $discount_student = new DiscountStudent();

             $discount_student->assign_student_id= $assign_student->id;
             $discount_student->fee_category_id = '1';
             $discount_student->discount = $request->discount;
             $discount_student->save();
         });
         $notification =  array(
             'message' =>'Student Promotion Updated Successfully',
             'alert-type' => 'success'
         );

         return redirect()->route('student.registration.view')->with($notification);
     }
     public function StudentRegDetails($student_id){
         $data['details']= AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();

         $pdf = PDF::loadView('backend.student.student_reg.student_details_pdf', $data);
         $pdf->SetProtection(['copy', 'print'], '', 'pass');
         return $pdf->stream('document.pdf');

    }

}


















































































































































































































































































































































































































































































































































































































































