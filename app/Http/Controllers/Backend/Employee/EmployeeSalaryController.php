<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeSallarylog;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeSalaryController extends Controller
{
  public function EmployeeSalaryView(){
      $data['allData']= User::where('usertype','employee')->get();
      return view('backend.employee.employee_salary.employee_salary_view',$data);

  }
  public function EmployeeIncrement($id){
      $data['editData']= User::find($id);
      return view('backend.employee.employee_salary.employee_salary_increment',$data);

  }
  public function EmployeeSalaryStore(Request $request,$id){
      $user = User::find($id);
      $previous_salary = $user->salary;
      $present_salary = (float)$previous_salary+(float)$request->increment_salary;
      $user->salary = $present_salary;
      $user->save();
      $salaryData = new EmployeeSallarylog();
      $salaryData->employee_id = $id;
      $salaryData->previous_salary = $previous_salary;
      $salaryData->present_salary = $present_salary;
      $salaryData->increment_salary = $request->increment_salary;
      $salaryData->effected_salary = date('Y-m-d',strtotime($request-> effected_salary));
      $salaryData->save();
      $notification = array(
          'message' => 'Employee  Salary Increment ',
          'alert-type' => 'success'
      );
      return redirect()->route('employee.salary.view')->with($notification);
  }
 public function EmployeeSalaryDetails($id){
      $data['details'] = User::find($id);
      $data['salary_log'] = EmployeeSallarylog::where('employee_id',$data['details']->id)->get();
//      dd($data['salary_log']->toArray()); lay du lieu bang table
     return view('backend.employee.employee_salary.employee_salary_details',$data);

 }

}
