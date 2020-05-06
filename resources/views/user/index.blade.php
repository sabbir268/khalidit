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
                  <th>Updated at</th>
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
                  <td>{{$worker->updated_at}}</td>
                  <td>
                    <div class="btn-group">
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
@endsection

{{-- @push('js')
<!-- DataTables -->
<script src="{{asset('asset/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{asset('asset/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script>
  $(function() {
      $('#workerTablesss').DataTable({
          responsive:true,
          processing: true,
          serverSide: true,
          pagingType:'full_numbers',
          stateSave:false,
          scrollY:true,
          scrollX:true,
          ajax: '{!! route('worker/datatable') !!}',
          order:[0,'desc'],
          columnDefs: [{"className": "dt-center", "targets": "_all"}],
          columns: [
              { data: 'id', name: 'id' },
              { data: 'name', name: 'name' },
              { data: 'code', name: 'code' },
              { data: 'price', name: 'price' },
              { data: 'user_modified', name: 'user_modified' },
              { data: 'status', 
              render:function(data){
                if(data=='1'){
                  return '<span class="badge badge-success">Active</span>';
                }
                if(data=='2'){
                  return '<span class="badge badge-danger">Inactive</span>';
                }
              }},
              { data: 'action', name: 'action', searchable:false, sortable:false },
              // { data: 'created_at', name: 'created_at' },
              // { data: 'updated_at', name: 'updated_at' }
          ]
      });
  });

</script>
<script>
  function deleteData(dt){
      if(confirm("Are you sure to delete this data")){
        $.ajax({
          type:'DELETE',
          url:$(dt).data("url"),
          data:{
            "_token":"{{csrf_token()}}"
          },
          success:function(response){
            if(response.status){
              location.reload();
            }
          },
          error:function(response){
            console.log(response);
          }
        });
      }
      return false;
    }
</script>
@endpush --}}

{{-- render:function(data){
  if(data=='1'){
    return '<span class="badge badge-success">Active</span>';
  }
  if(data=="2"){
    return '<span class="badge badge-error">Inactive</span>';
  }
} --}}