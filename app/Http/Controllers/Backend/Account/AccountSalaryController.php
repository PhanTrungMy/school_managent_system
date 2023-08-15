<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use App\Models\AccountEmployeeSalary;
use App\Models\EmployeeAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AccountSalaryController extends Controller
{
    public function EmployeeSalaryView(){
        $data['allData']=AccountEmployeeSalary::all();
        return view('backend.account.employee_salary.employee_salary_view',$data);
    }
    public function EmployeeSalaryAdd(){

        return view('backend.account.employee_salary.employee_salary_add');
    }
    public function EmployeeSalaryGetEmployee(Request $request){
  
        $date = date('Y-m',strtotime($request->date));
        if ($date !='') {
            $where[] = ['date','like',$date.'%'];
        }
        $data =EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();
        // dd($allStudent);
        $html['thsource']  = '<th>SL</th>';
        $html['thsource'] .= '<th>ID No </th>';

        $html['thsource'] .= '<th>Employee Name </th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary This Monthly</th>';
        $html['thsource'] .= '<th>Action</th>';


        foreach ($data as $key => $attend) {
            
            $account_salary = EmployeeAttendance::where('employee_id', $attend->employee_id)->where('date')->first();
            if ($account_salary != null) {
                $checked = 'checked';
            } else {
                $checked = '';
            }
            $totalattend = EmployeeAttendance::with(['user'])->where($where)->where('employee_id',$attend->employee_id)->get();
            $absentcount = count($totalattend->where('attend_status','Absent'));
       

            $html[$key]['tdsource']  = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['id_no'].'<input type="hidden" name="date" value="'.$date.'" > '. '</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['salary'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['salary'].'</td>';

            $salary = (float)$attend['user']['salary'];
            $salaryperday = (float)$salary/30;
           $totalsalaryminus  = (float)$absentcount*$salaryperday;
           $totalsalary = (float)$salary- (float)$totalsalaryminus;

            $html[$key]['tdsource'] .='<td>'.$totalsalary.'<input type= "hidden" name="amount[]" value= "'.$totalsalary.'" >'.'</td>';

            $html[$key]['tdsource'] .= '<td>' . '<input type="hidden" name="employee_id[]" value="'.$attend->employee_id . '">' . '<input type="checkbox" name="checkmanage[]" id="'.$key.'" value="' . $key . '" ' . $checked . ' style="transform: scale(1.5);margin-left: 10px;"> <label for="'.$key.'"> </label> ' . '</td>';
      

        }
        return response()->json(@$html);
    }
    public function EmployeeSalaryStore(Request $request){
        $date= date('Y-m',strtotime($request->date));
        AccountEmployeeSalary::where('date',$request->date)->delete();
        $checkedata = $request->checkmanage;
        if($checkedata != null){
          for ($i = 0; $i < count($checkedata); $i++){
              $data = new AccountEmployeeSalary();
   
              $data->date = $date;
              $data->fee_category_id = $request->fee_category_id;
              $data->employee_id = $request->employee_id[$checkedata[$i]];
              $data->amount = $request->amount[$checkedata[$i]];
              $data->save();
          }
  
        }
        if(!empty($data) || empty($checkedata)){
          $notification = array(
              'message' => ' Well done Data  Successfully',
              'alert-type' => 'success',
          );
          return redirect()->route('account.salary.view')->with($notification);
        }else{
          $notification = array(
              'message' => 'Sorry Data not found',
              'alert-type' => 'error'
          );
          return redirect()->route('account.salary.view')->with($notification);
        }
  
    }
}
