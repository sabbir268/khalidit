@extends('layouts.backend.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Work Sheet Edit</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Sheet</li>
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
                            <h3 class="card-title">Edit Sheet</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{route('sheet.update' , $sheet->id)}}">
                            @method('patch')
                            @csrf
                            <div class="card-body">
                                <div class="form-group fli col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="exampleInputEmail1">Sheet Name</label>
                                    <input type="text" class="form-control" id="name" value="{{$sheet->name}}"
                                        name="name" placeholder="Sheet Name">
                                </div>
                                <div class="form-group fli col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="">Sheet URL</label>
                                    <textarea class="form-control" id="link" name="link" cols="30" rows="2"
                                        placeholder="Sheet url">
                                    {{$sheet->link}}
                                    </textarea>
                                </div>
                                <div class="form-group fli col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="exampleInputPassword1">Lead Rate</label>
                                    <input type="number" value="{{$sheet->rate}}" class="form-control" id="rate"
                                        name="rate" placeholder="Per lead rate">
                                </div>
                                <div class="form-group fli col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="exampleInputPassword1">Total Lead Target</label>
                                    <input type="number" class="form-control" value="{{$sheet->target}}" id="target"
                                        name="target" placeholder="Total lead target">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary col-md-4 float-right">Submit</button>
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