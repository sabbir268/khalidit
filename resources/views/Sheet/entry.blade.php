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
                    <h1 class="m-0 text-dark">Lead collect report </h1>
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
                        <h1 class="m-0 text-dark">Lead collect report for <b>{{$sheetWorker->sheet->name}}</b> by
                            <b>{{$sheetWorker->user->name}}</b></h1>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{route('lead-track.store')}}" id="addWorkerToSheetForm" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-5 ">
                                    <input type="number" class="form-control form-control-sm" value="" id="lead_count"
                                        name="lead_count" placeholder="Enter todays total collected lead by you.">
                                </div>
                                <div class="form-group col-md-5">
                                    <input type="date" class="form-control form-control-sm" value="{{date('m-d-Y')}}"
                                        id="date" name="date">
                                </div>
                                <input type="text" name="sheet_worker_id" id="sheet_worker_id"
                                    value="{{$sheetWorker->id}}" hidden>
                                <div class="form-group col-md-2">
                                    <button class="btn btn-sm btn-success col-12 addCode" type="submit"> <i
                                            class="fa fa-plus"></i>
                                        Save</button>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table id="workerTablesss" class="table table-bordered table-striped table-hover table-sm"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sl.</th>
                                        <th>Date</th>
                                        <th>Collected</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach ($sheetWorker->leadTrakers as $leadtrack)
                                    <tr>
                                        <td class="text-center">{{$i}}</td>
                                        <td>
                                            {{$leadtrack->date}}
                                        </td>
                                        <td>
                                            <input type="text" id="lead_count{{$leadtrack->id}}" class="form-control"
                                                value="{{$leadtrack->lead_count}}" autofocus>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-warning update-lead"
                                                    data-id="{{$leadtrack->id}}"> <i class="fa fa-check"></i>
                                                    Update
                                                </button>
                                                <a class="btn btn-sm btn-danger"
                                                    href="{{route('lead.entrydelete', $leadtrack->id)}}">
                                                    <i class="fa fa-trash"></i> Delete
                                                </a>
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
        $('.update-lead').click(function(){
            $id = $(this).data('id');
            $lead = $('#lead_count'+$id).val();

            window.location.href = `{{url('/')}}/lead-details/update/${$id}/${$lead}`;
        })
    })
</script>

@endpush