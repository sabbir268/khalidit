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
            <a class="btn btn-primary btn-sm float-right" href="{{route('sheet.create')}}"> <i class="fa fa-plus"></i>
              Create</a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" id="search_name">
                  <div class="input-group-apend">
                    <span class="input-group-text" id="searchByName" style="cursor: pointer"> <i
                        class="fa fa-search"></i> Search</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table id="workerTablesss" class="table table-bordered table-striped table-hover" style="width:100%">
                <thead>
                  <tr>
                    <th>Sl.</th>
                    <th>Name</th>
                    <th>Link</th>
                    <th>Rate</th>
                    <th>Target Lead</th>
                    <th>Collected Lead</th>
                    <th>Total Workers</th>
                    <th>Workers</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                  $i = ($sheets->currentpage()-1)*$sheets->perpage() +1;
                  @endphp
                  @foreach ($sheets as $sheet)
                  <tr>
                    <td>{{$i}}</td>
                    <td>{{$sheet->name}}</td>
                    <td> <a href="{{$sheet->link}}" target="_blank">Click to open</a></td>
                    <td>{{$sheet->rate}}</td>
                    <td>{{$sheet->target}}</td>
                    <td>{{$sheet->collected_lead}}</td>
                    <td>{{$sheet->sheetWorkers->count()}}</td>
                    <td class="text-center">
                      <button class="btn btn-sm btn-success addworker" data-name="{{$sheet->name}}"
                        data-id="{{$sheet->id}}" data-rate="{{$sheet->rate}}">Workers</button>
                    </td>
                    <td class="text-center">
                      @if ($sheet->status == 0)
                      <span>Runnig</span> <br>
                      <a href="{{route('sheet.done', $sheet->id)}}" class="btn btn-sm btn-info">Mark Done</a>
                      @else
                      <span>Closed</span> <br>
                      <a href="{{route('sheet.done', $sheet->id)}}" class="btn btn-sm btn-warning">Undo Done</a>
                      @endif
                    </td>
                    <td>{{$sheet->created_at}}</td>
                    <td>
                      <div class=" btn-group">
                        <a href="{{route('sheet.edit', $sheet->id)}}" class="btn btn-sm btn-info">Edit</a>
                        <a href="javascript:void(0)"
                          onclick="event.preventDefault();if(confirm('Are you sure you want to delete this item?')) document.getElementById('sheet-delete-{{$sheet->id}}').submit();"
                          class="btn btn-sm btn-danger">Delete</a>
                        <form id="sheet-delete-{{$sheet->id}}" action="{{ route('sheet.destroy', $sheet->id) }}"
                          method="POST" style="display: block;">
                          @method('delete')
                          @csrf
                        </form>
                      </div>
                    </td>
                  </tr>
                  @php
                  $i++;
                  @endphp
                  @endforeach
                </tbody>
              </table>
              {{$sheets->links()}}
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
        <h5 class="modal-title" id="exampleModalLongTitle">Add workers to <span id="sheet_name"
            class="text-danger font-weight-bold"></span> sheet</h5>
        <button type="button" class="close worker-modal-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row" id="workerShow">
          <table class="table table-sm table-stripped">
            <tr>
              <th>Sl.</th>
              <th>Code</th>
              <th>Name</th>
              <th class="text-center">Rate</th>
              <th class="text-center">Collcted Leads</th>
              <th>Action</th>
            </tr>
            <tbody id="workerDataView">

            </tbody>
          </table>
        </div>

        <form action="#" id="addWorkerToSheetForm">
          <div class="row">
            <div class="form-group col-md-4">
              <label for="">Name</label>
              <br>
              <select name="user_id" class="select-2 form-control" id="name">
                <option value="">Select Worker..</option>
                @foreach ($workers as $worker)
                <option value="{{$worker->id}}">{{$worker->name}}({{$worker->code}})</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="">Rate</label>
              <input type="number" step="0.01" class="form-control form-control-sm" value="" id="rate" name="rate"
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
        <button type="button" class="btn btn-secondary worker-modal-close" data-dismiss="modal">Close</button>
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
    $name = $(this).data('name');
    $('#sheet_id').val($sheetId);
    $('#rate').val($rate);
    $('#sheet_name').html($name);
    getWorker($sheetId);
    $('#addWorkersModal').modal('show');
  });

  $('#addWorkerToSheetForm').submit(function(e){
    e.preventDefault();
    $sheetId = $('#sheet_id').val();
    if($('#sheet_id').val() == '' || $('#rate').val() == ''){
      alert('Worker Name or Rate feild is blank!')
    }else{
      $.ajax({
        url: "{{route('add.worker')}}",
        type: 'POST',
        data: $(this).serialize(),
        success: function(result){
            if(result.status == "error"){
              alert(result.message)
            }else{
              getWorker($sheetId);
              alert(result.message)
            }
          }
      });
    }
  });
  

  $('.worker-modal-close').click(function(){
    location.reload();
  });

  $('.select-2').select2();

  

  $('#searchByName').click(function(){
      searchByName();
  });

  $('#search_name').keyup(function(e){
    console.log(e.keyCode)
    if(e.keyCode === 13){
      searchByName();
    }
  });
});

function searchByName(){
    $name = $('#search_name').val();
      if($name != ""){
        window.location.href = "{{route('sheet.index')}}/?name="+$name;
      }else{
        window.location.href = "{{route('sheet.index')}}";
      }
}

  function removeWorker(id ,sheetId){
      $.ajax({
        url: "{{url('/')}}/worker-to-sheet-remove/"+id,
        type: 'GET',
        success: function(result){
            if(result == 'success'){
              alert('Worker removed!');
              getWorker(sheetId);
            }else{
              alert('Something went wrong!');
            }
          }
      });
  }

    function getWorker(sheetId){
    $('#workerDataView').html('');
    $.ajax({
        url: "{{url('/')}}/worker-to-sheet/"+sheetId,
        type: 'GET',
        success: function(result){
            // console.log(result)
            $data = result;
            for(var i = 0; $data.length > i; i++){
              $html = `<tr>
                        <td>${i+1}</td>
                        <td>${$data[i].name}</td>
                        <td>${$data[i].code}</td>
                        <td class="text-center">${$data[i].rate}</td>
                        <td class="text-center">${$data[i].count}</td>
                        <td>
                        
                        <div class="btn-group">
                          <button class="btn btn-sm btn-danger" onclick="removeWorker(${$data[i].id} , ${sheetId})"><i
                              class="fa fa-times"></i></button>
                          <a class="btn btn-sm btn-info" target="_blank" href="{{url('/')}}/lead-details/${$data[i].id}"><i class="fa fa-eye"></i></a>
                        </div>
                        
                        </td>
                      </tr>`;
             $('#workerDataView').append($html);
            }
          }
      });
  }
</script>
@endpush

{{-- /lead-details --}}