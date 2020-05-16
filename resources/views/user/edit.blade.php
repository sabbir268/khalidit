@extends('layouts.backend.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit Profile</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Edit Profile</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Update Proflie</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body m-2">
              <form method="POST" action="{{ route('worker.update', $worker->id) }}" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="name" class=" text-md-right">{{ __('Name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                      value="{{ $worker->name }}" required autocomplete="name" autofocus placeholder="Jhon Doe">

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                  </div>

                  <div class="form-group col-md-6">
                    <label for="email" class=" text-md-right">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                      name="email" value="{{ $worker->email }}" required autocomplete="email"
                      placeholder="jhondoe@mail.com">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group col-md-6">
                    <label for="phone" class=" text-md-right">{{ __('Phone Number') }}</label>


                    <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror"
                      name="phone" value="{{ $worker->phone }}" required autocomplete="phone"
                      placeholder="+88017xxxxxxxx">

                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group col-md-6">
                    <label for="gd_phone" class=" text-md-right">{{ __('Guardian Phone Number') }}</label>


                    <input id="gd_phone" type="text" class="form-control @error('gd_phone') is-invalid @enderror"
                      name="gd_phone" value="{{ $worker->gd_phone }}" required autocomplete="gd_phone"
                      placeholder="+88017xxxxxxxx">

                    @error('gd_phone')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group col-md-6">
                    <label for="fb_link" class="text-md-right">{{ __('Facebook Id Link') }}</label>


                    <input id="fb_link" type="fb_link" class="form-control @error('fb_link') is-invalid @enderror"
                      name="fb_link" value="{{ $worker->fb_link }}" required autocomplete="fb_link"
                      placeholder="www.facebook.com/myprofile">

                    @error('fb_link')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group col-md-6">
                    <label for="pr_address" class="text-md-right">{{ __('Permanent Aaddress') }}</label>


                    <input id="pr_address" type="pr_address"
                      class="form-control @error('pr_address') is-invalid @enderror" name="pr_address"
                      value="{{ $worker->pr_address }}" required autocomplete="pr_address"
                      placeholder="Village: xxx , Union: xxx, Post-code: 0000 , Thana: XXX XX , District: xxx ">

                    @error('pr_address')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group col-md-6">
                    <label for="cr_address" class="text-md-right">{{ __('Current Aaddress') }}</label>


                    <input id="cr_address" type="cr_address"
                      class="form-control @error('cr_address') is-invalid @enderror" name="cr_address"
                      value="{{ $worker->cr_address }}" required autocomplete="cr_address"
                      placeholder="Village: xxx , Union: xxx, Post-code: 0000 , Thana: XXX XX , District: xxx ">

                    @error('cr_address')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group col-md-6">
                    <label for="study" class="text-md-right">{{ __('Current Study') }}</label>
                    <select id="study" class="form-control @error('study') is-invalid @enderror" name="study"
                      value="{{ old('study') }}">
                      <option value="SSC" {{$worker->study == "SSC" ? 'selected' : ''}}>SSC</option>
                      <option value="HSC" {{$worker->study == "HSC" ? 'selected' : ''}}>HSC</option>
                      <option value="Degree" {{$worker->study == "Degree" ? 'selected' : ''}}>Degree</option>
                      <option value="Diploma" {{$worker->study == "Diploma" ? 'selected' : ''}}>Diploma</option>
                      <option value="Honors" {{$worker->study == "Honors" ? 'selected' : ''}}>Honors</option>
                    </select>

                    @error('study')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group col-md-3">
                    <label for="ssc_batch" class="text-md-right">{{ __('SSC Batch') }}</label>
                    <input id="ssc_batch" type="number" class="form-control @error('ssc_batch') is-invalid @enderror"
                      name="ssc_batch" value="{{ $worker->ssc_batch }}" required autocomplete="ssc_batch"
                      placeholder="2000">

                    @error('ssc_batch')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group col-md-3">
                    <label for="registration" class="text-md-right">{{ __('SSC Registration') }}</label>
                    <input id="registration" type="number"
                      class="form-control @error('registration') is-invalid @enderror" name="registration"
                      value="{{ $worker->registration }}" required autocomplete="registration"
                      placeholder="0000000000000">

                    @error('registration')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group col-md-3">
                    <label for="roll" class="text-md-right">{{ __('SSC Roll') }}</label>
                    <input id="roll" type="number" class="form-control @error('roll') is-invalid @enderror" name="roll"
                      value="{{ $worker->roll }}" required autocomplete="roll" placeholder="0000000000000">

                    @error('roll')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group col-md-3">
                    <label for="board" class="text-md-right">{{ __('SSC Board') }}</label>
                    <input id="board" type="text" class="form-control @error('board') is-invalid @enderror" name="board"
                      value="{{ $worker->board }}" required autocomplete="board" placeholder="Jashore">

                    @error('board')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group col-md-6">
                    <label for="online_experience" class="text-md-right">Have Any Experience in Online
                      Working</label>
                    <br>
                    <div class="form-check form-check-inline pt-2">
                      <input class="form-check-input" type="radio" name="online_experience" id="inlineRadio1" value="1"
                        {{$worker->online_experience == 1 ? 'checked' : ''}}>
                      <label class="form-check-label" for="inlineRadio1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline pt-2">
                      <input class="form-check-input" type="radio" name="online_experience" id="inlineRadio2" value="0"
                        {{$worker->online_experience == 0 ? 'checked' : ''}}>
                      <label class="form-check-label" for="inlineRadio2">No</label>
                    </div>

                    @error('online_experience')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group col-md-6">
                    <label for="dob" class="text-md-right">Date of Birth</label>
                    <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob"
                      value="{{ $worker->dob }}" required autocomplete="dob">

                    @error('dob')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group col-md-6">
                    <label for="doc" class="text-md-right">Upload Curriculum Vitae <small>(PDF only)</small></label>
                    <input id="doc" type="file" class="form-control @error('doc') is-invalid @enderror" name="doc"
                      value="{{ $worker->doc }}"  autocomplete="doc">
                    @error('doc')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <a class="text-primary" href="{{asset('/storage/'.$worker->doc)}}" target="_blank">
                      Click to view CV</a>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="photo" class="text-md-right">Your Photo</label>
                    <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror" name="photo"
                      value="{{ old('photo') }}"  autocomplete="doc">

                    @error('photo')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div style="height: 250px">
                      <img src="{{asset('/storage/'.$worker->photo)}}" style="height: 250px" alt="Photo">
                    </div>
                  </div>

                  <div class="form-group col-md-12">
                    <label for="misc" class="text-md-right">Tell Me About Yourself, Mainly English
                      Proficiency and Educational Life. *</label>
                    <textarea name="misc" id="misc" class="form-control @error('misc') is-invalid @enderror" cols="30"
                      rows="5">{{$worker->misc}}</textarea>
                    @error('misc')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>


                  {{-- <div class="form-group col-md-6">
                    <label for="password" class=" text-md-right">{{ __('Password') }}</label>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password">

                  @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror

                </div>

                <div class="form-group col-md-6">
                  <label for="password-confirm" class="text-md-right">{{ __('Confirm Password') }}</label>

                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                    required autocomplete="new-password">

                </div> --}}

                <div class="form-group mb-0">
                  <div class="col-md-12 ">
                    <button type="submit" class="btn btn-primary float-right">
                      {{ __('Update Profile') }}
                    </button>
                  </div>
                </div>
            </div>
            </form>
          </div>
          <!-- right col -->
        </div>
      </div>
    </div>
    <!-- /.row (main row) -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>

<!-- /.content-wrapper -->
@endsection