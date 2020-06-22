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
          <h1 class="m-0 text-dark">All Billing</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Bills</li>
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

          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Sl.</th>
                  <th>Employee Name</th>
                  <th>Month</th>
                  <th>Total Lead</th>
                  <th>Earn By Lead</th>
                  <th>Bonus</th>
                  <th>Deduction</th>
                  <th>Total Paid</th>
                  <th>Details</th>
                </tr>
              </thead>
              <tbody>
                @php
                $i = ($bills->currentpage()-1)*$bills->perpage() +1;
                @endphp
                @foreach ($bills as $bill)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{$bill->user->name}}</td>
                  <td>{{$bill->month}}</td>
                  <td>{{$bill->total_lead}}</td>
                  <td>{{$bill->total}}</td>
                  <td>{{$bill->extra_addition}}</td>
                  <td>{{$bill->deduction}}</td>
                  <td>{{($bill->extra_addition + $bill->total) - $bill->deduction}}</td>
                  <td>
                    <a class="btn btn-sm btn-info" target="_blank" href="{{$bill->report_url}}">Details</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
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

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

@endpush

{{-- /lead-details --}}