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
          <h1 class="m-0 text-dark">All Work Reports by month</h1>
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
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            {{-- <h3 class="card-title">DataTable with default features</h3> --}}
            <a class="btn btn-primary btn-sm float-right" href="{{route('sheet.create')}}">Create</a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive">
              <div class="col-md-5">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Month</span>
                  </div>
                  <select name="month" class="form-control" id="month">
                    <option value="January" {{$month == 1 ? 'selected' : ''}}>
                      January</option>
                    <option value="February" {{$month== 2 ? 'selected' : ''}}>
                      February</option>
                    <option value="March" {{$month== 3 ? 'selected' : ''}}>
                      March</option>
                    <option value="April" {{$month== 4 ? 'selected' : ''}}>
                      April</option>
                    <option value="May" {{$month== 5 ? 'selected' : ''}}>
                      May</option>
                    <option value="June" {{$month== 6 ? 'selected' : ''}}>
                      June</option>
                    <option value="July" {{$month== 7 ? 'selected' : ''}}>
                      July</option>
                    <option value="August" {{$month== 8 ? 'selected' : ''}}>
                      August</option>
                    <option value="September" {{$month== 9 ? 'selected' : ''}}>
                      September</option>
                    <option value="October" {{$month== 10 ? 'selected' : ''}}>
                      October</option>
                    <option value="November" {{$month== 11 ? 'selected' : ''}}>
                      November</option>
                    <option value="December" {{$month== 12  ? 'selected' : ''}}>
                      December</option>
                  </select>

                  {{-- <div class="input-group-apend">
                    <span class="input-group-text" id="basic-addon1">Search</span>
                  </div> --}}
                </div>
              </div>

              <table id="workerTablesss" class="table table-bordered table-striped table-hover" style="width:100%">
                <thead>
                  <tr>
                    <th>Sl.</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Sheet Works</th>
                    <th>Generet Lead</th>
                    <th>Total Earned</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                  $i = 0;
                  @endphp
                  @foreach ($workers as $worker)
                  @if ($worker->hasRole(2))
                  <tr>
                    <td>{{$i}}</td>
                    <td>{{$worker->name}}</td>
                    <td>{{$worker->code}}</td>
                    <td>{{worksOnSheet($worker->id , $month)}}</td>
                    <td>{{leadByMonthUser($worker->id , $month)}}</td>
                    <td>{{earnByMonthUser($worker->id , $month)}}</td>
                  </tr>
                  @endif
                  @php
                  $i++;
                  @endphp
                  @endforeach
                </tbody>
              </table>
              {{$workers->links()}}
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