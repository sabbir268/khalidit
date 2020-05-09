@extends('layouts.backend.app')
@push('css')
<link rel="stylesheet" href="{{asset('asset/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
<style>
  .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
  }

  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked+.slider {
    background-color: #2196F3;
  }

  input:focus+.slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked+.slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }

</style>
@endpush

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Worker List</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Worker</li>
            <li class="breadcrumb-item active">index</li>
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
            <a class="btn btn-primary btn-sm float-right" href="{{route('user.create')}}">Create</a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="workerTablesss" class="table table-bordered table-striped table-hover" style="width:100%">
              <thead>
                <tr>
                  <th>Sl.</th>
                  <th>Code</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Created at</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @php
                $i = 1;
                @endphp
                @foreach ($workers as $worker)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{$worker->code}}</td>
                  <td>{{$worker->name}}</td>
                  <td>{{$worker->email}}</td>
                  <td>{{$worker->created_at}}</td>
                  <th>
                    <label class="switch">
                      <input type="checkbox" class="statusControl" data-code="{{$worker->code}}"
                        data-id="{{$worker->id}}" value="{{$worker->status}}" {{$worker->status == 0 ? '' : 'checked'}}>
                      <span class="slider round"></span>
                    </label>
                  </th>
                  <td>
                    <div class="btn-group">
                      <a href="#" class="btn btn-sm btn-success">View</a>
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
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="addUserCodeModal" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add workers to sheet</h5>
        <button type="button" class="close worker-modal-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" id="addWorkerToSheetForm">
          <div class="row">
            <div class="form-group col-md-12">
              <input type="number" class="form-control form-control-sm" value="" id="code" name="code"
                placeholder="Enter worker code..">
            </div>
            <input type="text" name="user_id" id="user_id" value="" hidden>
            <div class="form-group col-md-12">
              <button class="btn btn-sm btn-success col-12 addCode" type="button"> <i
                  class="fa fa-plus"></i>Save</button>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
@endsection

@push('js')
<script>
  $(document).ready(function(){
        $('.statusControl').click(function(){
          if ($(this).val() == 0){
            $userId = $(this).data('id');
            if($(this).data('code') == ''){
              $('#user_id').val($userId);
              $('#addUserCodeModal').modal('show');
            }else{
              $.ajax({
                url: "{{route('status.change')}}",
                type: 'POST',
                data: {status: 1 , user_id: $(this).data('id')},
                success: function(result){
                    if(result.status == "error"){
                      alert(result.message)
                    }else{
                      alert("Worker Activated again");
                      location.reload();
                    }
                  }
              });
            }
          }else{
            $.ajax({
            url: "{{route('status.change')}}",
            type: 'POST',
            data: {status: 0 , user_id: $(this).data('id')},
            success: function(result){
                if(result.status == "error"){
                  alert(result.message)
                }else{
                  alert("Worker dectivated");
                  location.reload();
                }
              }
          });
          }
        });

        $('.addCode').click(function(){
          $.ajax({
            url: "{{route('status.change')}}",
            type: 'POST',
            data: {status: 1 , code: $('#code').val() , user_id: $('#user_id').val()},
            success: function(result){
                if(result.status == "error"){
                  alert(result.message)
                }else{
                  alert("Worker Activated");
                  location.reload();
                }
              }
          });
        });

        $('.worker-modal-close').click(function(){
          location.reload();
        });

      });
</script>
@endpush