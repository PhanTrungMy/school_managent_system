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
                                <h3 class="box-title">Employee Salary List</h3>
                                <a href="{{route('employee.add')}}" style="float: right"
                                   class="btn btn-rounded btn-success mb-5">Add Salary</a>
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
                                            {{--                                            @endif--}}

                                            <th width="25%">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($allData as $key => $salary)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{ $salary->name }}</td>
                                                <td>{{ $salary->id_no }}</td>
                                                <td>{{ $salary->mobile }}</td>
                                                <td>{{ $salary->gender }}</td>
                                                <td>{{$salary ->join_date }}</td>
                                                <td>{{ $salary->salary }}</td>
                                                {{--                                                @if(Auth::user()-> role == "Admin")--}}
                                                {{--                                                @endif--}}
                                                <td>
                                                    {{--                                          {{route('school.subject.delete',$subject->id)}}--}}
                                                    <a href="  {{route('employee.salary.increment.edit',$salary->id)}}  "
                                                       class="btn btn-info"><i class="fa fa-plus-circle"></i></a>
                                                    <a target="_blank" href="{{route('employee.salary.details',$salary->id)}}   "
                                                       class="btn btn-success" ><i class="fa fa-eye"></i></a>
                                                </td>
                                            </tr>
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
