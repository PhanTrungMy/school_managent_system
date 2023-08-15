<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Models\AccountEmployeeSalary;
use App\Models\AccountOtherCost;
use App\Models\AccountStudent;
use Illuminate\Http\Request;

class ProfiteController extends Controller
{
    public function MonthlyProfitView()
    {
        return view('backend.report.profit.profit_view');
    }
    public function MonthlyProfitDatewais(Request $request)
    {
        $start_date = date('Y-m', strtotime($request->start_date));
        $end_date = date('Y-m', strtotime($request->end_date));
        $edate = date('Y-m-d', strtotime($request->start_date));
        $sdate = date('Y-m-d', strtotime($request->end_date));
        $student_fee = AccountStudent::whereBetween('date', [$start_date, $end_date])->sum('amount');
        $other_cost = AccountOtherCost::whereBetween('date', [$sdate, $edate])->sum('amount');
        $emp_salary = AccountEmployeeSalary::whereBetween('date', [$start_date, $end_date])->sum('amount');

        $total_cost = $other_cost + $emp_salary;
        $profit = $student_fee - $total_cost;
        $html['thsource']  = '<th>Student Fee</th>';
        $html['thsource'] .= '<th>Other Cost </th>';
        $html['thsource'] .= '<th>Employee Salary</th>';
        $html['thsource'] .= '<th>Total Cost</th>';
        $html['thsource'] .= '<th>Profit</th>';
        $html['thsource'] .= '<th>Action</th>';
        $color = 'success';
        $html['tdsource'] = '<td>' . $student_fee . '</td>';
        $html['tdsource'] .= '<td>' . $other_cost . '</td>';
        $html['tdsource'] .= '<td>' . $emp_salary . '</td>';
        $html['tdsource'] .= '<td>' . $total_cost . '</td>';
        $html['tdsource'] .= '<td>' . $profit . '</td>';


        $html['tdsource'] .= '<a class="btn btn-sm btn-' . $color . '" title="PDF" target="_blanks" href="' . route("report.profit.pdt") . '?start_date=' . $edate . '&end_date=' . $sdate . '">Pay Slip</a>';
        $html['tdsource'] .= '</td>';

        return response()->json(@$html);
    }
    public function MonthlyProfitPdf(Request $request)
    {
        $data['start_date'] = date('Y-m', strtotime($request->start_date));
        $data['end_date'] = date('Y-m', strtotime($request->end_date));
        $data['sdate'] = date('Y-m-d', strtotime($request->start_date));
        $data['edate'] = date('Y-m-d', strtotime($request->end_date));

        $pdf = PDF::loadView('backend.report.profit.profit_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
  
		$notification = array(
			'message' => 'Sorry These Criteria Does not match',
			'alert-type' => 'error'
		);

		return redirect()->back()->with($notification);
	  
    }
}
