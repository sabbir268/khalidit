@extends('layouts.backend.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Create Worker</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">User</li>
            <li class="breadcrumb-item active">Add New User (Worker)</li>
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
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Worker</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="row">
              <div class="col-md-6 offset-md-3">
                <form method="POST" action="{{route('user.store')}}">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    </div>
                    <div class="form-group ">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>

                    <div class="form-group ">
                      <label for="">Code</label>
                      <input type="text" class="form-control" id="code" name="code" placeholder="Code">
                    </div>

                    <div class="form-group ">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>

                    <div class="form-group ">
                      <button type="submit" class="btn btn-primary float-right col-md-12">Add Worker</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
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