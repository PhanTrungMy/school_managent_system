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
                        <h4 class="box-title">Add Grade</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form method="post" action="{{ route('marks.grade.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                {{--                                                1st row--}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Grade Name <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="grade_name" class="form-control" required=""  >
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                end col_md-4--}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Grade Point <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="grade_point" class="form-control" required=""  >
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                end col_md-4--}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Start Marks <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="start_marks" class="form-control" required=""   >
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
                                                        <h5> End Marks<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="end_marks" class="form-control" required=""  >
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                end col_md-4--}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Start Point <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="start_points" class="form-control" required=""  >
                                                        </div>
                                                    </div>
                                                </div>
                                             
                                      
                                       
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>End Point <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="end_points" class="form-control" required=""  >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Remarks <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="remarks" class="form-control" required=""  >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                </div>
                                            <div class="text-xs-right">
                                                <input type="submit" class="btn btn-rounded btn-info mb-5" value="Submit">
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
