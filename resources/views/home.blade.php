@extends('layouts.backend.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      @if (auth()->user()->hasRole('admin'))
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              @php
              $user = new \App\User();
              @endphp
              <h3>{{$user->assignRole('worker')->count()}}</h3>

              <p>Total Workers <br>-</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{url('/user')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          @php
          $sheet = new \App\Sheet();
          @endphp
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{$sheet->where('status',0)->count()}}<sup style="font-size: 20px"></sup></h3>

              <p>Project Runing (Sheet) <br>-</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{url('/sheet')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{totalLeadCM()}}</h3>

              <p>Current Month Lead Generated <br> {{date("d M'Y",strtotime(month(date('m'))[0]))}} - {{date("d M'Y",strtotime(month(date('m'))[1]))}}</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{url('/leads-report')}}" class="small-box-footer">More info <i
                class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>Tk {{totalEarnCM()}} <small style="font-size: 10px">(By Worker)</small></h3>
              <p>Current Month Total Earned <br> {{date("d M'Y",strtotime(month(date('m'))[0]))}} - {{date("d M'Y",strtotime(month(date('m'))[1]))}}</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{url('/leads-report')}}" class="small-box-footer">More info <i
                class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-6 col-6">
          <!-- small box -->
          <div class="small-box bg-secondary">
            <div class="inner">
              <h3>Tk {{totalEarn()}} <small style="font-size: 10px">(By Worker)</small></h3>
              <p>Total Lifetime Earned</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>

        <div class="col-lg-6 col-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>{{totalLead()}}</h3>
              <p>Total Lifetime Lead collect</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>
        <!-- ./col -->
      </div>
      @endif

      @if(auth()->user()->hasRole('worker'))
      @if (auth()->user()->status == 0)
      <div class="alert alert-warning text-center" role="alert">
        Your account is not approved yet. Please wait for approval and return back again! <br>
        <a href="{{route('worker.show', auth()->user()->worker->id)}}">View</a> or <a
          href="{{route('worker.edit', auth()->user()->worker->id)}}">Edit</a> your submission
      </div>
      @else
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>Tk {{earnByMonthUser(auth()->user()->id , date('m'))}}/-</h3>

              <p>Current Month Eearning <br> {{date("d M'Y",strtotime(month(date('m'))[0]))}} - {{date("d M'Y",strtotime(month(date('m'))[1]))}}</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{leadByMonthUser(auth()->user()->id , date('m'))}}<sup style="font-size: 20px"></sup></h3>
            <p>Current Month Lead Generated  <br> {{date("d M'Y",strtotime(month(date('m'))[0]))}} - {{date("d M'Y",strtotime(month(date('m'))[1]))}}</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>Tk {{totalEarnByUser(auth()->user()->id)}}/-</h3>

              <p>Life Time Total Eearning <br> -</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{totalLeadByUser(auth()->user()->id)}} </h3>
              <p>Life Time Total Lead Generated <br>-</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>
        <!-- ./col -->
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="text-center">Available Lead Sheets for you</h3>
            </div>
            <div class="body p-3">
              @if(auth()->user()->sheetWorkers->count() > 0)
              @foreach (auth()->user()->sheetWorkers as $sheet)
              @if ($sheet->sheet->status == 0)
              <div class="alert alert-info" role="alert">
                <div class="col-md-12">
                  <span class="badge badge-pill badge-light ">Name: {{$sheet->sheet->name}}</span> <span
                    class="badge badge-pill badge-dark">Rate: {{$sheet->rate}}</span>
                  <span class="badge badge-pill badge-secondary">Target: {{$sheet->sheet->target}} ld</span>

                  <span class="badge badge-pill badge-warning float-right">Collected(own):
                    {{$sheet->leadTrakers->sum('lead_count')}}
                    ld</span>
                </div>

                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <a href="{{$sheet->sheet->link}}" class="btn btn-sm btn-link" target="_blank">Click here to
                        open</a>
                    </div>
                    <div class="col-md-6 text-right">
                      <div class="btn-group">
                        <button class="btn btn-sm btn-success addLeadCount" data-id="{{$sheet->id}}"> <i
                            class="fa fa-plus"></i> Add Record</button>
                        {{-- <button class="btn btn-sm btn-danger">History</button> --}}
                      </div>
                    </div>
                  </div>
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
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="text-center">All Active Sheets</h3>
            </div>
            <div class="body p-3">
              @php
              $sheets = \App\Sheet::where('status',0)->paginate(10);
              @endphp
              @foreach ($sheets as $sheet)
              <div class="alert alert-success" role="alert">
                <span class="badge badge-pill badge-light">Name: {{$sheet->name}}</span>
                <span class="badge badge-pill badge-secondary">Target: {{$sheet->target}} ld</span>
                <br>
                <a href="{{$sheet->link}}" target="_blank">Click here to open the Google Sheet!</a>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
      @endif
      @endif
      <!-- /.row -->
      <!-- Main row -->

      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="addDayilyLeadCountModal" tabindex="-1"
  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Todays Total Lead</h5>
        <button type="button" class="close worker-modal-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" id="addWorkerToSheetForm">
          @csrf
          <div class="row">
            <div class="form-group col-md-12">
              <input type="number" class="form-control form-control-sm" value="" id="lead_count" name="lead_count"
                placeholder="Enter todays total collected lead by you.">
            </div>
            <div class="form-group col-md-12">
              <input type="date" class="form-control form-control-sm" value="{{date('m-d-Y')}}" id="date" name="date">
            </div>
            <input type="text" name="sheet_worker_id" id="sheet_worker_id" value="" hidden>
            <div class="form-group col-md-12">
              <button class="btn btn-sm btn-success col-12 addCode" type="submit"> <i class="fa fa-plus"></i>
                Save</button>
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

      $('.addLeadCount').click(function(){
        $sheetWorkerId = $(this).data('id');
        $('#sheet_worker_id').val($sheetWorkerId);
        $('#addDayilyLeadCountModal').modal('show');
      });

      $('#addWorkerToSheetForm').submit(function(e){
        e.preventDefault()
        if($('#date').val() != '' && $('#lead_count').val() != ''){
          $.ajax({
          url: "{{route('lead-track.store')}}",
          type: 'POST',
          data: $(this).serialize(),
          success: function(result){
              if(result.status == "success"){
                alert(result.message);
                location.reload();
              }else{
                alert(result.message)
              }
            }
          });
        }else{
          alert('Lead or data feild is blank!');
        }
      });
  })
</script>
@endpush