@extends('layouts.backend.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Profile</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
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
              <h3 class="card-title">View profile info</h3>
            </div>
            <!-- /.card-header -->
            <div class="row m-2">
              <div class="col-md-6">
                <div class="row mb-3">
                  <div class="col-md-12 d-flex justify-content-center">
                    <img src="{{asset('/storage/'.$worker->photo)}}" style="height: 250px" alt="Photo">
                  </div>
                </div>

                <div class="alert alert-light" role="alert">
                  <b>Code:</b> {{$worker->user->code == '' ? 'No Code added' : $worker->user->code}}
                </div>

                <div class="alert alert-light" role="alert">
                  <b>Name:</b> {{$worker->name}}
                </div>

                <div class="alert alert-light" role="alert">
                  <b>Date Of Birth:</b> {{$worker->dob}}
                </div>


                <div class="alert alert-light" role="alert">
                  <b>Phone:</b> {{$worker->phone}}
                </div>

                @if ($worker->doc)
                <div class="alert alert-light" role="alert">
                  <b>CV:</b> <a class="text-primary" href="{{asset('/storage/'.$worker->doc)}}" target="_blank">
                    Click to view CV</a>
                </div>
                @endif
              </div>
              <div class="col-md-6">
                <div class="alert alert-light" role="alert">
                  <b>Email:</b> {{$worker->email}}
                </div>
                <div class="alert alert-light" role="alert">
                  <b>FB Link Phone:</b> <a class="text-primary" href="{{$worker->fb_link}}" target="_blank">
                    {{$worker->fb_link}}</a>
                </div>

                <div class="alert alert-light" role="alert">
                  <b>Preasent Address:</b> {{$worker->cr_address}}
                </div>

                <div class="alert alert-light" role="alert">
                  <b>Permanent Address:</b> {{$worker->pr_address}}
                </div>
                <div class="alert alert-light" role="alert">
                  <b>Gd. Phone:</b> {{$worker->gd_phone}}
                </div>

                <div class="alert alert-light" role="alert">
                  <b>Current Study:</b> {{$worker->study}}
                </div>

                <div class="alert alert-light" role="alert">
                  <b>SSC Batch:</b> {{$worker->ssc_batch}}
                </div>

                <div class="alert alert-light" role="alert">
                  <b>SSC Roll:</b> {{$worker->roll}}
                </div>

                <div class="alert alert-light" role="alert">
                  <b>SSC Registration:</b> {{$worker->registration}}
                </div>

                <div class="alert alert-light" role="alert">
                  <b>SSC Board:</b> {{$worker->board}}
                </div>

                <div class="alert alert-light" role="alert">
                  <b>Have Online Experience:</b> {{$worker->online_experience == 1 ? 'Yes' : 'No'}}
                </div>

                <div class="alert alert-light" role="alert">
                  <b>Miscellaneous:</b> {{$worker->misc}}
                </div>
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