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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">{{$user->name}}</h3>
                            <h5 class="text-center">Total Runnig Sheet: {{sheetWorking($user->id)}}</h5>
                        </div>
                        <div class="body p-3">
                            @if($user->sheetWorkers->count() > 0)
                            @foreach ($user->sheetWorkers as $sheet)
                            @if ($sheet->sheet->status == 0)
                            <div class="alert alert-info" role="alert">
                                <div class="col-md-12">
                                    <span class="badge badge-pill badge-light ">Name: {{$sheet->sheet->name}}</span>
                                    <span class="badge badge-pill badge-dark">Rate: {{$sheet->rate}}</span>
                                    <span class="badge badge-pill badge-secondary">Total Target:
                                        {{$sheet->sheet->target}}
                                        ld</span>

                                    <span class="badge badge-pill badge-warning float-right">Collected(own):
                                        {{$sheet->leadTrakers->sum('lead_count')}}
                                        ld</span>
                                </div>
                            </div>
                            @endif
                            @endforeach
                            @else
                            <div class="alert alert-warning text-center" role="alert">
                                You have no sheets to work now!
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Modal -->
@endsection