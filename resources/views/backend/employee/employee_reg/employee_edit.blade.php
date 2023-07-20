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
                        <h4 class="box-title">Edit Employee</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form method="post" action="{{ route('employee.update',$editData->id)}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                {{--                                                1st row--}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Employee Name <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="name" class="form-control" required="" value="{{$editData->name}}"  >
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                end col_md-4--}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Father's  Name <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="fname" class="form-control" required="" value="{{$editData->fname}}"  >
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                end col_md-4--}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Mother's Name <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="mname" class="form-control" required="" value="{{$editData->mname}}"  >
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
                                                            <input type="text" name="mobile" class="form-control" required="" value="{{$editData->mobile}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                end col_md-4--}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Address <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="address" class="form-control" required="" value="{{$editData->address}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                end col_md-4--}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Gender <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="gender" id="gender" required=""
                                                                    class="form-control">
                                                                <option value="" selected="" disabled="">Select gender
                                                                </option>
                                                                <option value="Male" {{($editData->gender == 'Male')? "selected":"" }}>Male</option>
                                                                <option value="Female" {{($editData->gender == 'Female')? "selected":"" }}>Female</option>
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
                                                            <select name="religion"  id="religion" required=""
                                                                    class="form-control">
                                                                <option value="" selected="" disabled="">Select religion
                                                                </option>
                                                                <option value="IsLam"  {{($editData->religion == 'IsLam')? "selected":"" }}>IsLam</option>
                                                                <option value="Hindu"  {{($editData->religion== 'hindu')? "selected":"" }}>Hindu</option>
                                                                <option value="Christan"  {{($editData->reigion == 'Christan')? "selected":"" }}>Christan</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                end col_md-4--}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Date of Brith <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="date" name="dob" class="form-control" required="" value="{{$editData->dob}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                end col_md-4--}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Designation <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="designation_id"  required=""
                                                                    class="form-control">
                                                                <option value="" selected="" disabled="">Select year
                                                                </option>
                                                                @foreach($designation as $desi)
                                                                    <option value="{{$desi->id}}"{{($editData->designation_id == $desi->id )? "selected":"" }} >{{$desi->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                end col_md-4--}}
                                            </div>
                                            {{--                                            end 3row--}}
                                            <div class="row">
                                                {{--                                                4st row--}}
                                                @if(!@$editData)
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <h5>Salary <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="salary" class="form-control" required="" value="{{$editData->salary}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                @if(!@$editData)

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <h5>Joining Date <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="date" name="join_date" class="form-control" required="" value="{{$editData->join_date}}" >
                                                        </div>
                                                    </div>

                                                    @endif
                                                <div class="col-md-3">

                                                    <div class="form-group">
                                                        <h5>Profile Image <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="file" name="image" id="image" class="form-control" placeholder="" value="{{$editData->image}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">

                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <img id="showImage" src="{{(!empty($editData->image)) ? url('upload/employee_images/'.$editData->image) : url('upload/no_image.jpg')}}"style="width: 100px;
                                                            width: 100px; border: 1px solid #000000;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
