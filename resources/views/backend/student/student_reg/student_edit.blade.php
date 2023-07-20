@extends('admin.admin_master')
@section('admin')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->
            <section class="content">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Edit Student</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form method="post" action="{{ route('update.student.registration',$editData->student_id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$editData->id}}">
{{--                                    chu y phan student id  $assign_student =  AssignStudent::where('id',$request->id)->where('student_id',$student_id)->first();--}}
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                {{--                                                1st row--}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Student Name <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="name" class="form-control" required="" value="{{$editData['student']['name']}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                end col_md-4--}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Father's  Name <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="fname" class="form-control" required="" value="{{$editData['student']['fname']}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                end col_md-4--}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Mother's Name <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="mname" class="form-control" required="" value="{{$editData['student']['mname']}}"  >
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                end col_md-4--}}
                                            </div>
                                            {{--                                            end row--}}
                                            <div class="row">
                                                {{--                                                2st row--}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Mobile Name <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="mobile" class="form-control" required="" value="{{$editData['student']['mobile']}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                end col_md-4--}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Address <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="address" class="form-control" required="" value="{{$editData['student']['address']}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                end col_md-4--}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Gender <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="gender" id="gender" required=""
                                                                    class="form-control" >
                                                                <option selected="" disabled="" >Select gender
                                                                </option>
                                                                <option value="Male" {{($editData['student']['gender']== 'Male')? "selected":"" }}>Male</option>
                                                                <option value="Female" {{($editData['student']['gender']== 'Female')? "selected":"" }}>Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                end col_md-4--}}
                                            </div>
                                            {{--                                            end row--}}
                                            <div class="row">
                                                {{--                                                3st row--}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Religion <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="religion" id="gender" required=""
                                                                    class="form-control">
                                                                <option value="" selected="" disabled="">Select religion
                                                                </option>
                                                                <option value="IsLam"{{($editData['student']['religion']== 'IsLam')? "selected":"" }}>IsLam</option>
                                                                <option value="Hindu"{{($editData['student']['religion']== 'Hindu')? "selected":"" }}>Hindu</option>
                                                                <option value="Christan"{{($editData['student']['religion']== 'Christan')? "selected":"" }}>Christan</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                end col_md-4--}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Date of Brith <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="date" name="dob" class="form-control" required=""  value="{{$editData['student']['dob']}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                end col_md-4--}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Discount<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="discount" class="form-control" required=""  value="{{$editData['discount']['discount']}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                end col_md-4--}}
                                            </div>
                                            {{--                                            end 3row--}}
                                            <div class="row">
                                                {{--                                                4st row--}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Year <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="year_id"  required=""
                                                                    class="form-control">
                                                                <option value="" selected="" disabled="">Select year
                                                                </option>
                                                                @foreach($years as $year)
                                                                    <option value="{{$year->id}}" {{($editData->year_id == $year->id) ? "selected" : "" }}>{{$year->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                end col_md-4--}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Class <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="class_id" required=""
                                                                    class="form-control">
                                                                <option value="" selected="" disabled="">Select class
                                                                </option>
                                                                @foreach($classes as $class)
                                                                    <option value="{{$class->id}}" {{($editData->class_id ==$class->id) ? "selected" : "" }}>{{$class->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                end col_md-4--}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Group <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="group_id" required=""
                                                                    class="form-control">
                                                                <option value="" selected="" disabled="">Select group
                                                                </option>
                                                                @foreach($groups as $group)
                                                                    <option value="{{$group->id}}"{{($editData->group_id ==$group->id) ? "selected" : "" }} >{{$group->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                end col_md-4--}}
                                            </div>
                                            {{--                                            end 4row--}}
                                            <div class="row">
                                                {{--                                                5st row--}}
                                                {{--                                                end col_md-4--}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Profile Image <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="file" name="image" id="image" class="form-control" placeholder="" }>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                end col_md-4--}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <img id="showImage"  src="{{(!empty($editData['student']['image'])) ? url('upload/student_images/'.$editData['student']['image']) : url('upload/no_image.jpg')}}" style="width: 100px;
                                                            width: 100px; border: 1px solid #000000;">
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                end col_md-4--}}
                                            </div>
                                            {{--                                            end 5row--}}
                                            <div class="text-xs-right">
                                                <input type="submit" class="btn btn-rounded btn-info mb-5" value="update">
                                            </div>
                                </form>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </section>





        </div>
    </div>
    <script  type="text/javascript">
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new fileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>




@endsection
