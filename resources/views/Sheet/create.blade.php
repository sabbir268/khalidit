@extends('layouts.backend.app')

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Work List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sheet</li>
              <li class="breadcrumb-item active">Add Work Sheet</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card card-primary">
                        <div class="card-header">
                        <h3 class="card-title">Add Sheet</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{route('sheet.store')}}">
                            @csrf
                            <div class="card-body">
                                    <div class="form-group fli col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label for="exampleInputEmail1">Sheet Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Sheet Name">
                                    </div>
                                    <div class="form-group fli col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label for="exampleInputPassword1">Sheet URL</label>
                                        <input type="text" class="form-control" id="url" name="col1" placeholder="Sheet URL">
                                    </div>
                                    <div class="form-group fli col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label for="exampleInputPassword1">Sheet URL</label>
                                        <input type="text" class="form-control" id="url" name="col2" placeholder="col2">
                                    </div>
                                    <div class="form-group fli col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label for="exampleInputPassword1">Sheet URL</label>
                                        <input type="text" class="form-control" id="url" name="col3" placeholder="col3">
                                    </div>
                                    <div class="form-group fli col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label for="exampleInputPassword1">Sheet URL</label>
                                        <input type="text" class="form-control" id="url" name="col4" placeholder="col4">
                                    </div>
                                    <div class="form-group fli col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label for="exampleInputPassword1">Sheet URL</label>
                                        <input type="text" class="form-control" id="url" name="col5" placeholder="col5">
                                    </div>
                                    <div class="form-group fli col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label for="exampleInputPassword1">Sheet URL</label>
                                        <input type="text" class="form-control" id="url" name="col6" placeholder="col6">
                                    </div>
                                    <div class="form-group fli col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label for="exampleInputPassword1">Sheet URL</label>
                                        <input type="text" class="form-control" id="url" name="col7" placeholder="col7">
                                    </div>
                                    <div class="form-group fli col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label for="exampleInputPassword1">Sheet URL</label>
                                        <input type="text" class="form-control" id="url" name="col8" placeholder="col8">
                                    </div>
                                    <div class="form-group fli col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label for="exampleInputPassword1">Sheet URL</label>
                                        <input type="text" class="form-control" id="url" name="col9" placeholder="col9">
                                    </div>
                                    <div class="form-group fli col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label for="exampleInputPassword1">Sheet URL</label>
                                        <input type="text" class="form-control" id="url" name="status" placeholder="status">
                                    </div>
                                    {{-- <div class="form-group fli col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label for="exampleInputPassword1">Sheet URL</label>
                                        <input type="text" class="form-control" id="url" name="user_modified" placeholder="user_modified">
                                    </div> --}}

                                    {{-- <div class="form-group">
                                    <label>Date range:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                        </div>
                                        <input type="text" class="form-control float-right" name="date" id="reservation">
                                    </div>
                                    <!-- /.input group -->
                                    </div> --}}
                            </div>
                            
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        </form>          
                        <!-- right col -->
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 
  <!-- /.content-wrapper -->
@endsection
