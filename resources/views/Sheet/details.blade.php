@extends('layouts.backend.app')
@push('css')
<link rel="stylesheet" href="{{asset('asset/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endpush

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">All Work Reports details</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{url('/leads-report')}}">Month Report</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="text-center">{{$user->name}}</h4>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive">
              <table id="workerTablesss" class="table table-bordered table-striped table-hover table-sm"
                style="width:100%">
                <thead>
                  <tr>
                    <th class="text-center">Sl.</th>
                    <th>Sheet Name</th>
                    <th>Sheet Link</th>
                    <th class="text-center">Lead Count</th>
                    <th class="text-center">Rate</th>
                    <th class="text-center">Total Bill</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                  $i = 1;
                  @endphp
                  @foreach ($sheets as $sheet)
                  <tr>
                    <td class="text-center">{{$i}}</td>
                    <td>{{$sheet->name}}</td>
                    <td>
                      <a href="{{$sheet->link}}" target="_blank" class="btn btn-link btn-sm">Open google sheet</a>
                    </td>
                    <td class="text-center">{{totalLeadBySheetUser($sheet->id , $user->id)}}</td>
                    <td class="text-center">{{getUserRate($sheet->id , $user->id)}}</td>
                    <td class="text-center">{{totalEarnBySheetUser($sheet->id , $user->id)}}</td>
                  </tr>
                  @php
                  $i++;
                  @endphp
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Modal -->
@endsection

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" />

<style>
  .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 17px;
  }

  .select2-container {
    width: 100% !important;
  }

</style>
@endpush

@push('js')
<script>
  $(document).ready(function(){
        $('#month').change(function(){
             console.log(this.value);
             if(!this.value == ''){
                window.location.href = '{{url('/')}}/leads-report/'+this.value
             }
        });
    })
</script>

@endpush