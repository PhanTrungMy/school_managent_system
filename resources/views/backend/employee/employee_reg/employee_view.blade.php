@php use Illuminate\Support\Facades\Auth; @endphp
@extends('admin.admin_master')
@section('admin')

    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->


            <!-- Main content -->
            <section class="content">
                <div class="row">


                    <div class="col-12">

                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Employee List</h3>
                                <a href="{{route('employee.add')}}" style="float: right"
                                   class="btn btn-rounded btn-success mb-5">Add Employee</a>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="5%">Sl</th>
                                            <th>Name</th>
                                            <th>ID No</th>
                                            <th>Mobile</th>
                                            <th>Gender</th>
                                            <th>Join Date</th>
                                            <th>Salary</th>
{{--                                            @if(Auth::user()-> role == "Admin")--}}
                                                <th>Code</th>
{{--                                            @endif--}}

                                            <th width="25%">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($allData as $key => $employee)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{ $employee->name }}</td>
                                                <td>{{ $employee->id_no }}</td>
                                                <td>{{ $employee->mobile }}</td>
                                                <td>{{ $employee->gender }}</td>
                                                <td>{{ $employee->join_date }}</td>
                                                <td>{{ $employee->salary }}</td>
{{--                                                @if(Auth::user()-> role == "Admin")--}}
                                                <td>{{ $employee->code }}</td>
{{--                                                @endif--}}
                                                <td>
                                                    {{--                                          {{route('school.subject.delete',$subject->id)}}--}}
                                                    <a title="Increment" href="  {{route('employee.edit',$employee->id)}}  "
                                                       class="btn btn-info"><i class="fa fa-plus-circle"></i></a>
                                                    <a title="Details" target="_blank" href="{{route('employee.details',$employee->id)}}   "
                                                       class="btn btn-primary" ><i class="fa fa-eye"></i></a>
                                                </td>
                                            </tr>s
                                        @endforeach

                                        </tbody>
                                        <tfoot>

                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->


                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->

        </div>
    </div>

@endsection
