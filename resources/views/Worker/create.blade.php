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
                        <form  method="POST" action="{{route('worker.store')}}">
                            {{ csrf_field() }}
                            <div class="card-body">
                                    <div class="form-group fli col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label for="exampleInputEmail1">Sheet Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Sheet Name">
                                    </div>
                                    <div class="form-group fli col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label for="exampleInputPassword1">code</label>
                                        <input type="text" class="form-control" id="code" name="code" placeholder="code">
                                    </div>
                                    <div class="form-group fli col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label for="exampleInputPassword1">price</label>
                                        <input type="text" class="form-control" id="price" name="price" placeholder="price">
                                    </div>
                                    <div class="form-group fli col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label for="exampleInputPassword1">user_modified</label>
                                        <input type="text" class="form-control" id="user_modified" name="user_modified" placeholder="user_modified">
                                    </div>
                                    <div class="form-group fli col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label for="exampleInputPassword1">status</label>
                                        <select class="form-control" id="status" name="status">
                                          <option value=1>Active</option>
                                          <option value=2>Inactive</option>
                                        </select>
                                        {{-- <input type="text" class="form-control" id="status" name="status" placeholder="status"> --}}
                                    </div>
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
