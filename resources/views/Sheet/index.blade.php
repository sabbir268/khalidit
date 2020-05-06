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
          <h1 class="m-0 text-dark">All Sheet List</h1>
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
              <table id="workerTablesss" class="table table-bordered table-striped table-hover" style="width:100%">
                <thead>
                  <tr>
                    <th>Sl.</th>
                    <th>Name</th>
                    <th>Link</th>
                    <th>Rate</th>
                    <th>Target Lead</th>
                    <th>Total Workers</th>
                    <th>Workers</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                  $i = 1;
                  @endphp
                  @foreach ($sheets as $sheet)
                  <tr>
                    <td>{{$i}}</td>
                    <td>{{$sheet->name}}</td>
                    <td>{{$sheet->link}}</td>
                    <td>{{$sheet->rate}}</td>
                    <td>{{$sheet->target}}</td>
                    <td>{{$sheet->sheetWorkers->count()}}</td>
                    <td class="text-center">
                      {{$sheet->sheetWorkers->count()}}
                      <br>
                      <button class="btn btn-sm btn-success addworker" data-id="{{$sheet->id}}"
                        data-rate="{{$sheet->rate}}">Add Workers</button>
                    </td>
                    <td>{{$sheet->status}}</td>
                    <td>{{$sheet->created_at}}</td>
                    <td>{{$sheet->updated_at}}</td>
                    <td>
                      <div class=" btn-group">
                        <a href="#" class="btn btn-sm btn-info">Edit</a>
                        <a href="#" class="btn btn-sm btn-danger">Delete</a>
                      </div>
                    </td>
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
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="addWorkersModal" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="#" id="addWorkerToSheetForm">
          <div class="row">
            <div class="form-group col-md-4">
              <label for="">Name</label>
              <br>
              <select name="name" class="select-2 form-control" id="name">
                <option value="">Select Worker..</option>
                @foreach ($workers as $worker)
                <option value="{{$worker->id}}">{{$worker->name}}({{$worker->code}})</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="">Rate</label>
              <input type="number" class="form-control form-control-sm" value="" id="rate" name="rate"
                placeholder="Rate">
            </div>
            <input type="text" name="sheet_id" id="sheet_id" value="" hidden>
            <div class="form-group col-md-4">
              <label for="" style="visibility: hidden">submit</label>
              <br>
              <button class="btn btn-sm btn-success col-12" type="submit"> <i class="fa fa-plus"></i> Add To
                Sheet</button>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
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
<script>
  $(document).ready(function(){
  // addWorkersModal
  $('.addworker').click(function(){
    $sheetId = $(this).data('id');
    $rate = $(this).data('rate');
    $('#sheet_id').val($sheetId);
    $('#rate').val($rate);
    $('#addWorkersModal').modal('show');
  });

  $('#addWorkerToSheetForm').submit(function(e){
    e.preventDefault();
    if($('#sheet_id').val() == '' || $('#rate').val() == ''){
      alert('Worker Name or Rate feild is blank!')
    }else{
      $.ajax({
        url: "demo_test.txt",
        type: 'POST', 
        success: function(result){
            $("#div1").html(result);
          }
      });
    }
  });

  $('.select-2').select2();
});
</script>
@endpush