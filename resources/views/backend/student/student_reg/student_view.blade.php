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

                        <div class="box bb-3 border-warning">
                            <div class="box-header">
                                <h4 class="box-title">Student <strong>Search</strong></h4>
                            </div>

                            <div class="box-body">
                                <form method="GET" action="{{route('student.year.class.wise')}}">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Year <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <select name="year_id" required=""
                                                            class="form-control">
                                                        <option value="" selected="" disabled="">Select year
                                                        </option>
                                                        @foreach($years as $year)
                                                            <option
                                                                value="{{$year->id}}"{{(@$year_id == $year_id) ? "selected" : ""}}>{{$year->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Class <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <select name="class_id" required=""
                                                            class="form-control">
                                                        <option value="" selected="" disabled="">Select class
                                                        </option>
                                                        @foreach($classes as $class)
                                                            <option
                                                                value="{{$class->id}}"{{(@$class_id == $class_id) ? "selected" : ""}}>{{$class->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4" style="padding-top: 25px;">
                                            <input type="submit" class="btn btn-rounded btn-secondary mb-5"
                                                   name="search" value="search ">
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>



                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Student Year list</h3>
                                <a href="{{route('student.registration.add')}}" style="float: right"
                                   class="btn btn-rounded btn-success mb-5">Add Student</a>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">

                                    @if(!@search)
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="5%">Sl</th>
                                            <th>Name</th>
                                            <th>Id No</th>
                                            <th>Roll</th>
                                            <th>Year</th>
                                            <th>Class</th>
                                            <th>Image</th>
{{--                                            @if(Auth::check() && Auth::user()->role == "Admin")--}}
                                                <th>Code</th>
{{--                                            @endif--}}
                                            <th width="25%">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($allData as $key => $value)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{ $value['Student']['name']}}</td>
                                                <td>{{ $value['Student']['id_no']}}</td>
                                                <td>{{$value->roll}}</td>
                                                <td>{{ $value['Student_class']['name']}}</td>
                                                <td>{{ $value['Student_year']['name']}}</td>
                                                <td>
                                                    <img  src="{{(!empty(($value['student']['image'])) ? url('upload/user_images/'.$value['student']['image']) : url('upload/no_image.jpg'))}}" style="width: 50px;
                                                            width: 50px; border: 1px solid #000000;">
                                                </td>
                                                <td>{{ $value->year_id }}</td>

                                                <td>
                                                    {{--                                                   {/{{route('student.year.delete',$year->id)}}--}}
                                                    <a title="Edit" href="{{route('student.registration.edit',$value->student_id)}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                                    <a title="Promotion" href="{{route('student.registration.promotion',$value->student_id)}}" class="btn btn-primary" ><i class="fa fa-check"></i></a>
                                                    <a target="_blank" title="Details" href="{{route('details.student.registration',$value->student_id)}}" class="btn btn-dangers" ><i class="fa fa-eye"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                    @else
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th width="5%">Sl</th>
                                                <th>Name</th>
                                                <th>Id No</th>
                                                <th>Roll</th>
                                                <th>Year</th>
                                                <th>Class</th>
                                                <th>Image</th>
                                                {{--                                            @if(Auth::check() && Auth::user()->role == "Admin")--}}
                                                <th>Code</th>
                                                {{--                                            @endif--}}
                                                <th width="25%">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($allData as $key => $value)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{ $value['Student']['name']}}</td>
                                                    <td>{{ $value['Student']['id_no']}}</td>
                                                    <td>{{$value->roll}}</td>
                                                    <td>{{ $value['Student_class']['name']}}</td>
                                                    <td>{{ $value['Student_year']['name']}}</td>
                                                    <td>
                                                        <img  src="{{(!empty(($value['Student']['image'])) ? url('upload/user_images'.$value['Student']['image']) : url('upload/no_image.jpg'))}}" style="width: 50px;
                                                            width: 50px; border: 1px solid #000000;">
                                                    </td>
                                                    <td>{{ $value->year_id }}</td>

                                                    <td>
                                                        {{--                                                   {{route('student.year.edit',$year->id)}}/{{route('student.year.delete',$year->id)}}--}}
                                                        <a title="Edit" href="{{route('student.registration.edit',$value->student_id)}}" class="btn btn-info"><i class="fa fa-edit"></i></a>

                                                        <a title="Promotion" href="{{route('student.registration.promotion',$value->student_id)}}" class="btn btn-primary" ><i class="fa fa-check"></i></a>
                                                        <a target="_blank" title="Details" href="{{route('details.student.registration',$value->student_id)}}" class="btn btn-danger" ><i class="fa fa-eye"></i></a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            </tfoot>
                                        </table>

                                    @endif



                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
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
