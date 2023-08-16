<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\Account\AccountSalaryController;
use App\Http\Controllers\Backend\Account\OtherCostController;
use App\Http\Controllers\Backend\Account\StudentFeeController;
use App\Http\Controllers\Backend\Employee\EmployeeAttendanceController;
use App\Http\Controllers\Backend\Employee\EmployeeLeaveController;
use App\Http\Controllers\Backend\Employee\EmployeeRegController;
use App\Http\Controllers\Backend\Employee\EmployeeSalaryController;
use App\Http\Controllers\Backend\Employee\MonthlySalaryController;
use App\Http\Controllers\Backend\Marks\DefaultController;
use App\Http\Controllers\Backend\Marks\GradeController;
use App\Http\Controllers\Backend\Marks\MarksController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Report\AttenReportController;
use App\Http\Controllers\Backend\Report\MarkSheetController;
use App\Http\Controllers\Backend\Report\ProfiteController;
use App\Http\Controllers\Backend\Report\ResultReportController;
use App\Http\Controllers\Backend\setup\AssignSubjectController;
use App\Http\Controllers\Backend\setup\DesignationController;
use App\Http\Controllers\Backend\setup\ExamTypeController;
use App\Http\Controllers\Backend\setup\FeeAmountController;
use App\Http\Controllers\Backend\setup\FeeCategoryController;
use App\Http\Controllers\Backend\setup\SchoolSubjectController;
use App\Http\Controllers\Backend\setup\StudentClassController;
use App\Http\Controllers\Backend\setup\StudentGroupController;
use App\Http\Controllers\Backend\setup\StudentYearController;
use App\Http\Controllers\Backend\Student\ExamFeeController;
use App\Http\Controllers\backend\Student\MonthlyFeeController;
use App\Http\Controllers\backend\Student\RegistrationFeeController;
use App\Http\Controllers\Backend\Student\StudentRegController;
use App\Http\Controllers\Backend\Student\StudentRollController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\LanguageController;
use App\Models\AccountEmployeeSalary;
use App\Models\StudentGroup;
use Illuminate\Support\Facades\Route;
use LDAP\Result;

Route::group(['middleware' => 'prevent-back-history'],function(){
    Route::get('/', function () {
        return view('auth.login');
    });
    
    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
    
    Route::get('/admin/logout', [AdminController::class, 'Logout'])->name('admin.logout');
     
     
    Route::group(['middleware' => 'auth'],function(){

        
    Route::prefix('users')->group(function () {
        Route::get('/view', [UserController::class, 'UserView'])->name('user.view');
        Route::get('/add', [UserController::class, 'UserAdd'])->name('users.add');
        Route::post('/store', [UserController::class, 'UserStore'])->name('users.store');
        Route::get('/edit/{id}', [UserController::class, 'UserEdit'])->name('users.edit');
        Route::post('/update/{id}', [UserController::class, 'UserUpdate'])->name('users.update');
        Route::get('/delete/{id}', [UserController::class, 'UserDelete'])->name('users.delete');


});
// language 
Route::get('language/{lang}',[LanguageController::class, 'ChangeLanguage'])->name('locale');
// User profile and change Password

Route::prefix('profile')->group(function () {
  
Route::get('/view', [ProfileController::class, 'ProfileView'])->name('profile.view');

Route::get('/edit', [ProfileController::class, 'ProfileEdit'])->name('profile.edit');

Route::post('/store', [ProfileController::class, 'ProfileStore'])->name('profile.store');

Route::get('/password/view', [ProfileController::class, 'PasswordView'])->name('password.view');

Route::post('/password/update', [ProfileController::class, 'PasswordUpdate'])->name('password.update');

}); 

///// User student class managarment and change Password
Route::prefix('setups/student/class')->group(function () {
    Route::get('view', [StudentClassController::class, 'ViewStudent'])->name('student.class.view');
    Route::get('add', [StudentClassController::class, 'AddStudent'])->name('student.class.add');
    Route::post('store', [StudentClassController::class, 'StudentClassStore'])->name('store.student.class');
    Route::get('edit/{id}', [StudentClassController::class, 'StudentClassEdit'])->name('student.class.edit');
    Route::post('update/{id}', [StudentClassController::class, 'StudentClassUpdate'])->name('student.class.update');
    Route::get('delete/{id}', [StudentClassController::class, 'StudentClassDelete'])->name('student.class.delete');


});
// student year
Route::prefix('setups/student/year')->group(function () {
    Route::get('view', [StudentYearController::class, 'ViewYear'])->name('student.year.view');
    Route::get('add', [StudentYearController::class, 'AddYear'])->name('student.year.add');
    Route::post('store', [StudentYearController::class, 'StudentYearStore'])->name('store.student.year');
    Route::get('edit/{id}', [StudentYearController::class, 'StudentYearEdit'])->name('student.year.edit');
    Route::post('update/{id}', [StudentYearController::class, 'StudentYearUpdate'])->name('student.year.update');
    Route::get('delete/{id}', [StudentYearController::class, 'StudentYearDelete'])->name('student.year.delete');
});
// sudents group
Route::prefix('setups/student/group')->group(function () {
    Route::get('view', [StudentGroupController::class, 'ViewGroup'])->name('student.group.view');
    Route::get('add', [StudentGroupController::class, 'AddGroup'])->name('student.group.add');
    Route::post('store', [StudentGroupController::class, 'StudentGroupStore'])->name('store.student.group');
    Route::get('edit/{id}', [StudentGroupController::class, 'StudentGroupEdit'])->name('student.group.edit');
    Route::post('update/{id}', [StudentGroupController::class, 'StudentGroupUpdate'])->name('student.group.update');
    Route::get('delete/{id}', [StudentGroupController::class, 'StudentGroupDelete'])->name('student.group.delete');
});
//fee category
Route::prefix('setups/fee/category')->group(function () {
    Route::get('view', [FeeCategoryController::class, 'ViewFeeCat'])->name('fee.category.view');
    Route::get('add', [FeeCategoryController::class, 'AddFeeCat'])->name('fee.category.add');
    Route::post('store', [FeeCategoryController::class, 'FeeCatStore'])->name('store.fee.category');
    Route::get('edit/{id}', [FeeCategoryController::class, 'FeeCatEdit'])->name('fee.category.edit');
    Route::post('update/{id}', [FeeCategoryController::class, 'FeeCatUpdate'])->name('fee.category.update');
    Route::get('delete/{id}', [FeeCategoryController::class, 'FeeCatDelete'])->name('fee.category.delete');
});
// fee category amount
Route::prefix('setups/fee/amount')->group(function () {
    Route::get('view', [FeeAmountController::class, 'ViewFeeAmount'])->name('fee.amount.view');
    Route::get('add', [FeeAmountController::class, 'AddFeeAmount'])->name('fee.amount.add');
    Route::post('store', [FeeAmountController::class, 'FeeAmountStore'])->name('store.fee.amount');
    Route::get('edit/{fee_category_id}', [FeeAmountController::class, 'FeeAmountEdit'])->name('fee.amount.edit');
    Route::post('update/{fee_category_id}', [FeeAmountController::class, 'FeeAmountUpdate'])->name('fee.amount.update');
    Route::get('details/{fee_category_id}', [FeeAmountController::class, 'FeeAmountDetails'])->name('fee.amount.details');
});
//exam type
Route::prefix('setups/exam_type')->group(function () {
    Route::get('view', [ExamTypeController::class, 'ViewExamType'])->name('exam.type.view');
    Route::get('add', [ExamTypeController::class, 'AddExamType'])->name('exam.type.add');
    Route::post('store', [ExamTypeController::class, 'ExamTypeStore'])->name('store.exam.type');
    Route::get('edit/{id}', [ExamTypeController::class, 'ExamTypeEdit'])->name('exam.type.edit');
    Route::post('update/{id}', [ExamTypeController::class, 'ExamTypeUpdate'])->name('exam.type.update');
    Route::get('delete/{id}', [ExamTypeController::class, 'ExamTypeDelete'])->name('exam.type.delete');
});
//school Subject
Route::prefix('setups/school_subject/')->group(function () {
    Route::get('view', [SchoolSubjectController::class, 'ViewSchoolSubject'])->name('school.subject.view');
    Route::get('add', [SchoolSubjectController::class, 'AddSchoolSubject'])->name('school.subject.add');
    Route::post('store', [SchoolSubjectController::class, 'SchoolSubjectStore'])->name('school.subject.type');
    Route::get('edit/{id}', [SchoolSubjectController::class, 'SchoolSubjectEdit'])->name('school.subject.edit');
    Route::post('update/{id}', [SchoolSubjectController::class, 'SchoolSubjectUpdate'])->name('school.subject.update');
    Route::get('delete/{id}', [SchoolSubjectController::class, 'SchoolSubjectDelete'])->name('school.subject.delete');
});
// assign SUBJECT
Route::prefix('setups/assign_subject/')->group(function () {
    Route::get('view', [AssignSubjectController::class, 'ViewAssignSubject'])->name('assign.subject.view');
    Route::get('add', [AssignSubjectController::class, 'AddAssignSubject'])->name('assign.subject.add');
    Route::post('store', [AssignSubjectController::class, 'AssignSubjectStore'])->name('store.assign.subject');
    Route::get('edit/{class_id}', [AssignSubjectController::class, 'AssignSubjectEdit'])->name('assign.subject.edit');
    Route::post('update/{class_id}', [AssignSubjectController::class, 'AssignSubjectUpdate'])->name('assign.subject.update');
    Route::get('details/{class_id}', [AssignSubjectController::class, 'AssignSubjectDetails'])->name('assign.subject.details');
});
//designation
Route::prefix('setups/designation')->group(function () {
    Route::get('view', [DesignationController::class, 'ViewDesignation'])->name('designation.view');
    Route::get('add', [DesignationController::class, 'AddDesignation'])->name('designation.add');
    Route::post('store', [DesignationController::class, 'StoreDesignation'])->name('designation.type');
    Route::get('edit/{id}', [DesignationController::class, 'DesignationEdit'])->name('designation.edit');
    Route::post('update/{id}', [DesignationController::class, 'DesignationUpdate'])->name('designation.update');
    Route::get('delete/{id}', [DesignationController::class, 'DesignationDelete'])->name('designation.delete');
});

// sutudent registration
Route::prefix('student/reg/')->group(function () {
    Route::get('view', [StudentRegController::class, 'StudentRegView'])->name('student.registration.view');
    Route::get('add', [StudentRegController::class, 'StudentRegAdd'])->name('student.registration.add');
    Route::post('store', [StudentRegController::class, 'StudentRegStore'])->name('store.student.registration');
    Route::get('class/wise', [StudentRegController::class, 'StudentClassYearWise'])->name('student.year.class.wise');
    Route::get('edit/{student_id}', [StudentRegController::class, 'StudentRegEdit'])->name('student.registration.edit');
    Route::post('update/{student_id}', [StudentRegController::class, 'StudentRegUpdate'])->name('update.student.registration');
    Route::get('promotion/{student_id}', [StudentRegController::class, 'StudentRegPromotion'])->name('student.registration.promotion');
    Route::post('update/promotion/{student_id}', [StudentRegController::class, 'StudentRegUpdatePromotion'])->name('promotion.student.registration');
    Route::get('update/details/{student_id}', [StudentRegController::class, 'StudentRegDetails'])->name('details.student.registration');


});
//roll generate
Route::prefix('student/roll/')->group(function () {
    Route::get('view', [StudentRollController::class, 'StudentRollView'])->name('roll.generate.view');
    Route::get('getstudents', [StudentRollController::class, 'StudentGenerateRollView'])->name('student.registration.getstudents');
    Route::post('generate/store', [StudentRollController::class, 'StudentGenerateRollStore'])->name('roll.generate.store');
});
//Registration Fee Router
Route::prefix('reg/fee/')->group(function () {
    Route::get('view', [RegistrationFeeController::class, 'StudentRegistrationView'])->name('registration.fee.view');
    Route::get('class/classwise', [RegistrationFeeController::class, 'RegClassData'])->name('student.registration.fee.classwise.get');
    Route::get('payslip', [RegistrationFeeController::class, 'RegFeePayslips'])->name('student.registration.fee.payslip');

});
//Monthly Fee Router
Route::prefix('monthly/fee/')->group(function () {
    Route::get('view', [MonthlyFeeController::class, 'StudentMonthlyView'])->name('monthly.fee.view');
    Route::get('class/classwise', [MonthlyFeeController::class, 'MonthlyClassData'])->name('student.monthly.fee.classwise.get');
    Route::get('payslip', [MonthlyFeeController::class, 'MonthlyFeePayslips'])->name('student.monthly.fee.payslip');

});
//Exam Fee Router
Route::prefix('exam/fee/')->group(function () {
    Route::get('view', [ExamFeeController::class, 'StudentExamView'])->name('exam.fee.view');
    Route::get('class/classwise', [ExamFeeController::class, 'ExamClassData'])->name('student.exam.fee.classwise.get');
    Route::get('payslip', [ExamFeeController::class, 'ExamFeePayslips'])->name('student.exam.fee.payslip');

});
// Employee Registration
Route::prefix('employee/')->group(function () {
    Route::get('view', [EmployeeRegController::class, 'EmployeeRegView'])->name('employee.registration.view');
    Route::get('add', [EmployeeRegController::class, 'EmployeeAdd'])->name('employee.add');
    Route::post('store', [EmployeeRegController::class, 'EmployeeStore'])->name('store.employee.registration');
    Route::get('edit/{id}', [EmployeeRegController::class, 'EmployeeEdit'])->name('employee.edit');
    Route::post('update/{id}', [EmployeeRegController::class, 'EmployeeUpdate'])->name('employee.update');
    Route::get('details/{id}', [EmployeeRegController::class, 'EmployeeDetails'])->name('employee.details');

});
// Employee Registration
Route::prefix('employee/salary/')->group(function () {
    Route::get('view', [EmployeeSalaryController::class, 'EmployeeSalaryView'])->name('employee.salary.view');
    Route::get('increment/{id}', [EmployeeSalaryController::class, 'EmployeeIncrement'])->name('employee.salary.increment.edit');
    Route::post('increment/store/{id}', [EmployeeSalaryController::class, 'EmployeeSalaryStore'])->name('update.increment.store');
    Route::get('details/{id}', [EmployeeSalaryController::class, 'EmployeeSalaryDetails'])->name('employee.salary.details');

});
// Employee Leave Registration
Route::prefix('employee/leave/')->group(function () {
    Route::get('view', [EmployeeLeaveController::class, 'EmployeeLeaveView'])->name('employee.leave.view');
    Route::get('add', [EmployeeLeaveController::class, 'EmployeeLeaveAdd'])->name('employee.leave.add');
    Route::post('store', [EmployeeLeaveController::class, 'EmployeeLeaveStore'])->name('employee.leave.store');
    Route::get('edit/{id}', [EmployeeLeaveController::class, 'EmployeeLeaveEdit'])->name('employee.leave.edit');
    Route::post('update/{id}', [EmployeeLeaveController::class, 'EmployeeLeaveUpdate'])->name('employee.leave.update');
    Route::get('delete/{id}', [EmployeeLeaveController::class, 'EmployeeLeaveEDelete'])->name('employee.leave.delete');
});
// Employee Leave Registration
Route::prefix('employee/attendance')->group(function () {
    Route::get('/view', [EmployeeAttendanceController::class, 'EmployeeAttendanceView'])->name('employee.attendance.view');
   Route::get('/add', [EmployeeAttendanceController::class, 'EmployeeAttendanceAdd'])->name('employee.attendance.add');
   Route::post('/store', [EmployeeAttendanceController::class, 'EmployeeAttendanceStore'])->name('employee_attendance_store');
    Route::get('/edit/{date}', [EmployeeAttendanceController::class, 'EmployeeAttendanceEdit'])->name('employee.attendance.edit');
    Route::get('/Details/{date}', [EmployeeAttendanceController::class, 'EmployeeAttendanceDetails'])->name('employee.attendance.details');
});
// Employee Monthly Salary
Route::prefix('employee/monthly/salary')->group(function () {
    Route::get('/view', [MonthlySalaryController::class, 'EmployeeMonthlySalaryView'])->name('employee.monthly.view');
    Route::get('/get', [MonthlySalaryController::class, 'EmployeeMonthlySalaryGet'])->name('employee.monthly.salary.get');
    Route::get('/payslip/{employee_id}', [MonthlySalaryController::class, 'EmployeeMonthlySalaryPayslip'])->name('employee.monthly.salary.payslip');
});
// Marks
Route::prefix('marks/entry')->group(function () {
    Route::get('/add', [MarksController::class, 'MarksAdd'])->name('marks.entry.add');
    Route::post('/store', [MarksController::class, 'MarksStore'])->name('marks.entry.store');
    Route::get('/edit', [MarksController::class, 'MarksEdit'])->name('marks.entry.edit');
    Route::post('/update', [MarksController::class, 'MarksUpdate'])->name('marks.entry.update');
// marks entry Grad
Route::get('/grade/view', [GradeController::class, 'MarkGradeView'])->name('marks.entry.grade');
Route::get('/grade/add', [GradeController::class, 'MarkGradeAdd'])->name('marks.grade.add');
Route::post('/grade/store', [GradeController::class, 'MarkGradeStore'])->name('marks.grade.store');
Route::get('/grade/edit/{id}', [GradeController::class, 'MarkGradeEdit'])->name('marks.grade.edit');
Route::post('/grade/update/{id}', [GradeController::class, 'MarkGradeUpdate'])->name('marks.grade.update');
//end entry grads



    Route::get('/getsubjects/edit', [MarksController::class, 'MarksEditGetStudents'])->name('student.edit.getstudents');
    Route::get('/getsubjects', [DefaultController::class, 'MarksGetSubject'])->name('marks.getsubject');
    Route::get('/marksubjects', [DefaultController::class, 'MarksGetStudent'])->name('student.marks.getstudents');

});
// student Fee
Route::prefix('accounts/students/fee/')->group(function () {
    Route::get('view', [StudentFeeController::class, 'StudentFeeView'])->name('student.fee.view');
    Route::get('add', [StudentFeeController::class, 'StudentFeeAdd'])->name('student.fee.add');  
    Route::post('store', [StudentFeeController::class, 'StudentFeeStore'])->name('student.fee.store'); 
      Route::get('getstudent', [StudentFeeController::class, 'StudentFeeGetStudent'])->name('account.fee.getstudent');
});
// employee Salary
Route::prefix('accounts/salary/')->group(function () {
    Route::get('view', [AccountSalaryController::class, 'EmployeeSalaryView'])->name('account.salary.view');
    Route::get('add', [AccountSalaryController::class, 'EmployeeSalaryAdd'])->name('employee.salary.add');  
    Route::get('getemployee', [AccountSalaryController::class, 'EmployeeSalaryGetEmployee'])->name('account.salary.getemployes'); 
    Route::post('store', [AccountSalaryController::class, 'EmployeeSalaryStore'])->name('employee.salary.store');  
});
// other cost
Route::prefix('other/cost/')->group(function () {
    Route::get('view', [OtherCostController::class, 'OtherCostView'])->name('other.costs.view');
    Route::get('add', [OtherCostController::class, 'OtherCostAdd'])->name('other.costs.add');
    Route::post('store', [OtherCostController::class, 'OtherCostStore'])->name('other.costs.store');
    Route::get('edit/{id}', [OtherCostController::class, 'OtherCostEdit'])->name('other.costs.edit');
    Route::post('update/{id}', [OtherCostController::class, 'OtherCostUpdate'])->name('other.costs.update');
    
});
// reports management->monthly

Route::prefix('report/monthly/profit/')->group(function () {
    Route::get('view',[ProfiteController::class, 'MonthlyProfitView'])->name('monthly.profite.view');
    Route::get('datewais', [ProfiteController::class, 'MonthlyProfitDatewais'])->name('report.profit.datewais.get');
    Route::get('pdf', [ProfiteController::class, 'MonthlyProfitPdf'])->name('report.profit.pdt');   


});
// marksheet genarate
Route::prefix('report/marksheet/generate/')->group(function () {
    Route::get('view',[MarkSheetController::class, 'MarkSheetView'])->name('marksheet.generate.view');
    Route::get('marksheet',[MarkSheetController::class, 'MarkSheetGet'])->name('report.marksheet.get');
});

// Attendance Report
Route::prefix('report/')->group(function () {
    Route::get('view',[AttenReportController::class, 'AttendanceReportView'])->name('attendance.report.view');
    Route::get('attendance',[AttenReportController::class, 'AttendanceReportGet'])->name('report.attendance.get');

});
Route::prefix('report/student/result/')->group(function () {
    Route::get('view',[ResultReportController::class, 'StudentResultView'])->name('student.result.view');
    Route::get('report',[ResultReportController::class, 'StudentResultGet'])->name('report.student.result.get');

});
Route::prefix('report/student/card/')->group(function () {

    Route::get('view',[ResultReportController::class, 'StudentCardView'])->name('student.idcard.view');
    Route::get('getidcard',[ResultReportController::class, 'StudentCardGet'])->name('report.student.idcard.get');

});
});
});
