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
              <div class="row">
                <div class="col-md-6">
                  <div class="row">
                    <div class="input-group mb-3 col-md-6">
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
                    </div>
                    <div class="input-group mb-3 col-md-6">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Date</span>
                      </div>
                      <input type="text" class="form-control" id="mydate">
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="d-flex justify-content-end w-100">
                    {{$workers->links()}}
                  </div>
                </div>

              </div>

              <table id="workerTablesss" class="table table-bordered table-striped table-hover table-sm"
                style="width:100%">
                <thead>
                  <tr>
                    <th class="text-center">Sl.</th>
                    <th>Name</th>
                    <th class="text-center">Code</th>
                    <th class="text-center">Sheet Works</th>
                    <th class="text-center">Generet Lead</th>
                    <th class="text-center">Total Earned</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                  $i = ($workers->currentpage()-1)*$workers->perpage() +1;
                  @endphp
                  @foreach ($workers as $worker)
                  @if ($worker->hasRole(2))
                  <tr>
                    <td class="text-center">{{$i}}</td>
                    <td>{{$worker->name}}</td>
                    <td class="text-center">{{$worker->code}}</td>
                    <td class="text-center">{{worksOnSheetByDate($worker->id , $month[0] , $month[1])}}</td>
                    <td class="text-center">{{leadByDatehUser($worker->id , $month[0] , $month[1])}}</td>
                    <td class="text-center">{{earnByDateUser($worker->id , $month[0] , $month[1])}}</td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-sm btn-success"
                          href="{{route('lead.report.user', [$worker->id , $month[0].",".$month[1]])}}">
                          <i class="fa fa-eye"></i> Details</a>
                      </div>
                    </td>
                  </tr>
                  @endif
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
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


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

<script type="text/javascript">
  $(function() {

  $('#mydate').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
  });

  $('#mydate').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM-DD-YYYY') + ',' + picker.endDate.format('MM-DD-YYYY'));
      window.location.href = '{{url('/')}}/leads-report/'+$(this).val();
  });

  $('#mydate').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

});
</script>

@endpush