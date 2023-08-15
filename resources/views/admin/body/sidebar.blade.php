@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();

@endphp
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="logo">
                <a href="index.html">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{asset('backend/images/logo-dark.png')}}" alt="">
                        <h3><b>Sunny</b> Admin</h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            <li  class="{{ ($route == 'dashboard')?'active':'' }}" >
                <a href="{{ route('dashboard') }}">
                    <i data-feather="pie-chart"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            {{--            @if(Auth::user() && Auth::user()->role == 'Admin')--}}

            <li class="treeview {{ ($prefix == '/users')?'active':'' }} ">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Manege User</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('user.view')}}"><i class="ti-more"></i>View User</a></li>
                    <li><a href="{{route('users.add')}}"><i class="ti-more"></i>Add User</a></li>
                </ul>
            </li>
            {{--            @endif--}}

            <li class="treeview  {{ ($prefix == '/profile')?'active':'' }}">
                <a href="#">
                    <i data-feather="mail"></i> <span>Manage Profile</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('profile.view')}}"><i class="ti-more"></i>Your Profile</a></li>

                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i data-feather="mail"></i> <span>Setup Management</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class=" {{ ($prefix == '/setups/student/class')?'active':'' }}" ><a href="{{route('student.class.view')}}"><i class="ti-more"></i>Student Class</a></li>
                    <li class=" {{ ($prefix == '/setups/student/year')?'active':'' }}"><a href="{{route('student.year.view')}}"><i class="ti-more"></i>Student Year</a></li>
                    <li class=" {{ ($prefix == '/setups/student/group')?'active':'' }}"><a href="{{route('student.group.view')}}"><i class="ti-more"></i>Student group</a></li>
                    <li class=" {{ ($prefix == '/setups/fee/category')?'active':'' }}"><a href="{{route('fee.category.view')}}"><i class="ti-more"></i>Fee Category </a></li>
                    <li class=" {{ ($prefix == '/setups/fee/amount')?'active':'' }}"><a href="{{route('fee.amount.view')}}"><i class="ti-more"></i>Fee Category Amount</a></li>
                    <li class=" {{ ($prefix == '/setups/exam_type')?'active':'' }}"><a href="{{route('exam.type.view')}}"><i class="ti-more"></i>Exam Type</a></li>
                    <li class=" {{ ($prefix == '/setups/school_subject')?'active':'' }}"><a href="{{route('school.subject.view')}}"><i class="ti-more"></i>School Subject</a></li>
                    <li class=" {{ ($prefix == '/setups/assign_subject')?'active':'' }}"><a href="{{route('assign.subject.view')}}"><i class="ti-more"></i>Assign Subject</a></li>
                    <li class=" {{ ($prefix == '/setups/designation')?'active':'' }}"><a href="{{route('designation.view')}}"><i class="ti-more"></i>Designation</a></li>

                </ul>
            </li>
            <li class="treeview ">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>Student management</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($prefix == '/student/reg')?'active':''}}">
                        <a href="{{route('student.registration.view')}}"><i class="ti-more"></i>Student Registration</a>
                    <li class="{{ ($prefix == '/student/roll')?'active':''}}">
                        <a href="{{route('roll.generate.view')}}"><i class="ti-more"></i>Roll Generate </a>
                    <li class="{{ ($prefix == '/reg/fee')?'active':''}}">
                        <a href="{{route('registration.fee.view')}}"><i class="ti-more"></i>Registration Fee </a>
                    <li class="{{ ($prefix == '/monthly/fee')?'active':''}}">
                        <a href="{{route('monthly.fee.view')}}"><i class="ti-more"></i>Monthly Fee </a>
                    <li class="{{ ($prefix == '/exam/fee')?'active':''}}">
                        <a href="{{route('exam.fee.view')}}"><i class="ti-more"></i>Exam Fee </a>
                    </li>

                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>Employee management</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($prefix == '/employee')?'active':''}}">
                        <a href="{{route('employee.registration.view')}}"><i class="ti-more"></i>Employee
                            Registration</a>
                    <li class="{{ ($prefix == '/employee/salary')?'active':''}}">
                        <a href="{{route('employee.salary.view')}}"><i class="ti-more"></i>Employee Salary </a>
                    <li class="{{ ($prefix == '/employee/leave')?'active':''}}">
                        <a href="{{route('employee.leave.view')}}"><i class="ti-more"></i>Employee Leave </a>
                    <li class="{{ ($prefix == '/employee/attendance')?'active':''}}">
                        <a href="{{route('employee.attendance.view')}}"><i class="ti-more"></i>Employee Attendance</a>
                    <li class="{{ ($prefix == '/employee/monthly/salary')?'active':''}}">
                        <a href="{{route('employee.monthly.view')}}"><i class="ti-more"></i>Employee monthly Salary </a>
                    </li>

                </ul>
            </li>
            <li class="treeview {{ ($prefix == '/marks/entry')?'active':''}}">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>Employee Marks</span>
                    <span class="pull-right-container">
                 <i class="fa fa-angle-right pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('marks.entry.add')}}"><i class="ti-more"></i>Marks Entry</a></li>
                  <li><a href="{{route('marks.entry.edit')}}"><i class="ti-more"></i>Marks Edit </a></li>
             <li><a href="{{route('marks.entry.grade')}}"><i class="ti-more"></i>Marks Grade </a></li>

                </ul>
            </li>
            {{-- Acount student --}}
            
            <li class="treeview">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>Accounts Management</span>
                    <span class="pull-right-container">
                 <i class="fa fa-angle-right pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class=" {{ ($prefix == '/accounts/students/fee')?'active':''}}">
                        <a href="{{route('student.fee.view')}}"><i class="ti-more"></i>Student Fee</a></li>
                    <li class=" {{ ($prefix == '/accounts/salary')?'active':''}}">
                        <a href="{{route('account.salary.view')}}"><i class="ti-more"></i>Employee Salary</a></li>
                    <li class=" {{ ($prefix == '/other/cost')?'active':''}}">
                        <a href="{{route('other.costs.view')}}"><i class="ti-more"></i>Other Cost</a></li>
             

                </ul>
            </li>
            <li class="treeview  {{ ($prefix == '/report/monthly/profit')?'active':''}} ">
                <a href="#">
                    <i data-feather="file"></i>
                    <span>Reports Management</span>
                    <span class="pull-right-container">
                 <i class="fa fa-angle-right pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class=" {{ ($prefix == '/report/monthly/profit')?'active':''}}">
                        <a href="{{route('monthly.profite.view')}}"><i class="ti-more"></i>Monthly / Year Profit</a></li>
                    <li class=" {{ ($prefix == '/report/marksheet/generate')?'active':''}}">
                        <a href="{{route('marksheet.generate.view')}}"><i class="ti-more"></i>MarkSheet Generate</a></li>
                    <li class=" {{ ($prefix == '/report')?'active':''}}">
                        <a href="{{route('attendance.report.view')}}"><i class="ti-more"></i>Attendance Report</a></li>
                    <li class=" {{ ($prefix == '/report/student/result')?'active':''}}">
                        <a href="{{route('student.result.view')}}"><i class="ti-more"></i>Student Result</a></li>
                        <li class=" {{ ($prefix == '/report/student/card')?'active':''}}">
                            <a href="{{route('student.idcard.view')}}"><i class="ti-more"></i>Student ID Card</a></li>           
                </ul>
            </li>
            <li class="header nav-small-cap">User Interface</li>

           


            <li>
                <a href="{{route('admin.logout')}}">
                    <i data-feather="lock"></i>
                    <span>Log Out</span>
                </a>
            </li>

        </ul>
    </section>

    <div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings"
           aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i
                class="ti-email"></i></a>
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i
                class="ti-lock"></i></a>
    </div>
</aside>
