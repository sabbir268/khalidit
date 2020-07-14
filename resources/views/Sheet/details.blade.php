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
          <h1 class="m-0 text-dark">All Work Reports details</h1>
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
            <div class="row">
              <div class="col-md-3 pt-5 text-left">
                <h4 class="text-left"><b>Date:</b> {{date('d/m/Y',time())}}</h4>
              </div>
              <div class="col-md-6 d-flex justify-content-center">
                <img src="https://khalidit.com/wp-content/uploads/2020/05/khalidit.png" alt="" style="
                  width: 50%;
                  height: 77%;
              ">
              </div>
              <div class="col-md-3 pt-5 text-left">
                <h4 class="text-right"><b>Billing Month:</b>{{checkBill(url()->current())->month}}</h4>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive">
              <table id="workerTablesss" class="table table-bordered table-striped table-hover table-sm"
                style="width:100%">
                <thead>
                  <tr>
                    <th class="text-center">Sl.</th>
                    <th>Sheet Name</th>
                    <th>Sheet Link</th>
                    <th class="text-center">Lead Count</th>
                    <th class="text-center">Rate</th>
                    <th class="text-right">Total Bill</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                  $i = 1;
                  @endphp
                  @foreach ($sheets as $sheet)
                  <tr>
                    <td class="text-center">{{$i}}</td>
                    <td>{{$sheet->name}}</td>
                    <td>
                      <a href="{{$sheet->link}}" target="_blank" class="btn btn-link btn-sm">Open google sheet</a>
                    </td>
                    <td class="text-center">{{totalLeadBySheetUser($sheet->id , $user->id)}}</td>
                    <td class="text-center">{{getUserRate($sheet->id , $user->id)}}</td>
                    <td class="text-right pr-2">{{totalEarnBySheetUser($sheet->id , $user->id)}}</td>
                  </tr>
                  @php
                  $i++;
                  @endphp
                  @endforeach
                  <tr class="text-bold">
                    <td colspan="3" class="text-right">Total:</td>
                    <td class="text-center">
                      {{leadByDateUserSheet($user->id, $sheets->pluck('id')->toArray(), $dates[0] , $dates[1])}}</td>
                    <td class="text-center">-</td>
                    <td class="text-right pr-2">
                      {{earnByDateUserSheets($user->id,$sheets->pluck('id')->toArray(), $dates[0] , $dates[1])}}</td>
                  </tr>

                  @if(checkBill(url()->current()))
                  <tr class="text-bold">
                    <td colspan="3" class="text-right">Extra Addition Bonus (+):</td>
                    <td colspan="2"> <span class="font-weight-normal">
                        {{checkBill(url()->current())->extra_addition_comment}}</span></td>
                    <td class="text-right pr-2" colspan="3"> {{checkBill(url()->current())->extra_addition}} </td>
                  </tr>
                  <tr class="text-bold">
                    <td colspan="3" class="text-right">Deduction (-):</td>
                    <td colspan="2" class="text-normal"><span
                        class="font-weight-normal">{{checkBill(url()->current())->deduction_comment}}</span></td>
                    <td class="text-right pr-2"> {{checkBill(url()->current())->deduction}} </td>
                  </tr>
                  <tr class="text-bold">
                    <td colspan="3" class="text-right">Grand Total:</td>
                    <td colspan="2" class="text-normal"><span class="font-weight-normal">-</span></td>
                    <td class="text-right pr-2">
                      {{(checkBill(url()->current())->total + checkBill(url()->current())->extra_addition) - checkBill(url()->current())->deduction}}
                    </td>
                  </tr>
                  @endif
                </tbody>
              </table>

              @if(!checkBill(url()->current()))
              <button class="btn btn-success" data-toggle="modal" data-target="#geneRateBillModal">Generate
                Bill</button>
              @else
              <div class="w-100 mb-5 pb-5"></div>
              <div class="col-md-6 float-left">
                <div class="col-md-8 text-center" style="border-top: 1px solid #343a40;">
                  <p>{{$user->name}}</p>
                </div>
              </div>
              <div class="col-md-6 float-right text-right">
                <div class="col-md-8 float-right text-center" style="border-top: 1px solid #343a40;">
                  <p>Khalid Hasan</p>
                </div>
              </div>

              @endif
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

<div class="modal fade" id="geneRateBillModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bill Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('bill.store')}}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Additional Amount (<i class="fa fa-plus"></i>)</label>
                <input type="number" step="0.01" class="form-control" value="0.00" name="extra_addition">
              </div>
              <div class="form-group">
                <label for="">Comment for additional amount</label>
                <input type="text" class="form-control" name="extra_addition_comment">
              </div>
              <div class="form-group">
                <label for="">Deduction (<i class="fa fa-minus"></i>)</label>
                <input type="number" step="0.01" value="0.00" class="form-control" name="deduction">
              </div>
              <div class="form-group">
                <label for="">Deduction Comment</label>
                <input type="text" class="form-control" name="deduction_comment">
              </div>


              <div class="form-group">
                <label for="">Select Month</label>
                <select name="month" class="form-control" required>
                  <option value="">Select..</option>
                  <option value="January">
                    January</option>
                  <option value="February">
                    February</option>
                  <option value="March">
                    March</option>
                  <option value="April">
                    April</option>
                  <option value="May">
                    May</option>
                  <option value="June">
                    June</option>
                  <option value="July">
                    July</option>
                  <option value="August">
                    August</option>
                  <option value="September">
                    September</option>
                  <option value="October">
                    October</option>
                  <option value="November">
                    November</option>
                  <option value="December">
                    December</option>
                </select>
              </div>

              <input type="text" class="form-control" name="total"
                value="{{earnByDateUserSheets($user->id,$sheets->pluck('id')->toArray(), $dates[0] , $dates[1])}}"
                hidden>
              <input type="text" class="form-control" name="total_lead"
                value="{{leadByDateUserSheet($user->id, $sheets->pluck('id')->toArray(), $dates[0] , $dates[1])}}"
                hidden>

              <input type="text" class="form-control" name="report_url"
                value="{{ str_replace(env('APP_URL') ,"", url()->full()) }}" hidden>

              <input type="text" class="form-control" name="user_id" value="{{$user->id}}" hidden>
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Generate</button>
        </form>
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