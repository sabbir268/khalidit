@extends('layouts.app')

@section('content')

<style>
    body {
        background-image: linear-gradient(#4d51ff, #e04b4b00) !important;
        background-repeat: no-repeat !important;
        ;
    }

</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('member.register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name" class=" text-md-right">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                    placeholder="Jhon Doe">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                            <div class="form-group col-md-6">
                                <label for="email" class=" text-md-right">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email"
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
                                    name="phone" value="{{ old('phone') }}" required autocomplete="phone"
                                    placeholder="+88017xxxxxxxx">

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="gd_phone" class=" text-md-right">{{ __('Guardian Phone Number') }}</label>


                                <input id="gd_phone" type="text"
                                    class="form-control @error('gd_phone') is-invalid @enderror" name="gd_phone"
                                    value="{{ old('gd_phone') }}" required autocomplete="gd_phone"
                                    placeholder="+88017xxxxxxxx">

                                @error('gd_phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="fb_link" class="text-md-right">{{ __('Facebook Id Link') }}</label>


                                <input id="fb_link" type="fb_link"
                                    class="form-control @error('fb_link') is-invalid @enderror" name="fb_link"
                                    value="{{ old('fb_link') }}" required autocomplete="fb_link"
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
                                    value="{{ old('pr_address') }}" required autocomplete="pr_address"
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
                                    value="{{ old('cr_address') }}" required autocomplete="cr_address"
                                    placeholder="Village: xxx , Union: xxx, Post-code: 0000 , Thana: XXX XX , District: xxx ">

                                @error('cr_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="study" class="text-md-right">{{ __('Current Study') }}</label>
                                <select id="study" class="form-control @error('study') is-invalid @enderror"
                                    name="study" value="{{ old('study') }}">
                                    <option value="SSC">SSC</option>
                                    <option value="HSC">HSC</option>
                                    <option value="Degree">Degree</option>
                                    <option value="Diploma">Diploma</option>
                                    <option value="Honors">Honors</option>
                                </select>

                                @error('study')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="ssc_batch" class="text-md-right">{{ __('SSC Batch') }}</label>
                                {{-- <input id="ssc_batch" type="number" value="{{ old('ssc_batch') }}" required
                                autocomplete="ssc_batch" placeholder="2000"> --}}
                                <select name="ssc_batch" id="ssc_batch"
                                    class="form-control @error('ssc_batch') is-invalid @enderror" name="ssc_batch">
                                    @for ($i = date("Y") - 1; $i >= 2008; $i--)
                                    <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>

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
                                    value="{{ old('registration') }}" required autocomplete="registration"
                                    placeholder="0000000000000">

                                @error('registration')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="roll" class="text-md-right">{{ __('SSC Roll') }}</label>
                                <input id="roll" type="number" class="form-control @error('roll') is-invalid @enderror"
                                    name="roll" value="{{ old('roll') }}" required autocomplete="roll"
                                    placeholder="0000000000000">

                                @error('roll')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="board" class="text-md-right">{{ __('SSC Board') }}</label>
                                <input id="board" type="text" class="form-control @error('board') is-invalid @enderror"
                                    name="board" value="{{ old('board') }}" required autocomplete="board"
                                    placeholder="Jashore">

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
                                    <input class="form-check-input" type="radio" name="online_experience"
                                        id="inlineRadio1" value="1">
                                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                                </div>
                                <div class="form-check form-check-inline pt-2">
                                    <input class="form-check-input" type="radio" name="online_experience"
                                        id="inlineRadio2" value="0">
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
                                <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror"
                                    name="dob" value="{{ old('dob') }}" required autocomplete="dob">

                                @error('dob')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="doc" class="text-md-right">Upload Curriculum Vitae <small>(PDF
                                        only)</small></label>
                                <input id="doc" type="file" class="form-control @error('doc') is-invalid @enderror"
                                    name="doc" value="{{ old('doc') }}">
                                @error('doc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="photo" class="text-md-right">Your Photo</label>
                                <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror"
                                    name="photo" value="{{ old('photo') }}" required autocomplete="doc">

                                @error('photo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-12">
                                <label for="misc" class="text-md-right">Tell Me About Yourself, Mainly English
                                    Proficiency and Educational Life. *</label>
                                <textarea name="misc" id="misc" class="form-control @error('misc') is-invalid @enderror"
                                    cols="30" rows="5">
                                {{ old('misc') }}
                                </textarea>
                                @error('misc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            <div class="form-group col-md-6">
                                <label for="password" class=" text-md-right">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                            <div class="form-group col-md-6">
                                <label for="password-confirm" class="text-md-right">{{ __('Confirm Password') }}</label>

                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">

                            </div>

                            <div class="form-group mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary col-md-12">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection