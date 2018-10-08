@extends('layouts.base')

@section('basecontent')
<div class="content">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Service Provider Registration') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Identification Number') }}</label>

                            <div class="col-md-6">
                                {{Form ::text('icnumber',null,['class'=>'form-control','rows'=>'6'])}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Company Name') }}</label>

                            <div class="col-md-6">
                                {{Form ::text('company_name',null,['class'=>'form-control','rows'=>'6'])}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                {{Form ::textarea('u_address',null,['class'=>'form-control','rows'=>'6'])}}
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                            <div class="col-md-6">
                                {{Form ::text('u_city',null,['class'=>'form-control','rows'=>'6'])}}
                            </div>
                            
                        </div>
                         <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Postcode') }}</label>

                            <div class="col-md-6">
                                {{Form ::text('u_postcode',null,['class'=>'form-control','rows'=>'6'])}}
                            </div>
                            
                        </div>
                         <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>

                            <div class="col-md-6">
                                {!! Form::select("u_state",['Perlis'=>'Perlis','Kedah'=>'Kedah','Perak'=>'Perak','Selangor'=>'Selangor','Negeri_Sembilan'=>'Negeri_Sembilan','Melaka'=>'Melaka','Johor'=>'Johor','Pahang'=>'Pahang','Terengganu'=>'Terengganu','Kelantan'=>'Kelantan','W.P.Kuala_Lumpur'=>'W.P.Kuala_Lumpur','W.P.Labuan'=>'W.P.Labuan','Sabah'=>'Sabah','Sarawak'=>'Sarawak'],null,["class"=>"form-control","placeholder"=>"Please Select state"]) !!}   
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                {{Form ::text('u_phone',null,['class'=>'form-control','rows'=>'6'])}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Service') }}</label>
                                <div class="col-md-6">
                                <select name="service" class="form-control" >
                                @foreach ($typeservice_array as $data)                                       
                                <option value="{{ $data->name }}">{{ $data->name }}</option>                                                      
                                 @endforeach
                                 </select>
                                </div>
                        </div>

                         

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
