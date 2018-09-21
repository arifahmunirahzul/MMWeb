@extends('layouts.app')

@section('content')
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Profile</h4>
                
              </div>
              <div class="card-body">
                <div class="toolbar">
                  <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <div class="content">
        <div class="row">
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
                <img src="{{ asset('assets/img/bg/damir-bosnjak.jpg') }}" alt="...">
              </div>
              {{Form::open(['route' => ['editUserProfile','id'=>$data->id],'method'=>'POST', 'enctype' => 'multipart/form-data'])}}
                @csrf
              <div class="card-body">
                <div class="author">
                  <a href="#">
                    @if($data->url_image == '')
                    <img class="avatar border-gray" src="{{ asset('assets/img/default-avatar.png') }}" alt="...">
                     {{Form ::file('url_image',null,['class'=>'form-control','rows'=>'6', 'required'])}}
                    @endif
                    @if($data->url_image != '')
                    <img class="avatar border-gray" src="{{ url('/') }}/upload/userpic/<?php echo $data->url_image; ?>" alt="...">
                    {{Form ::file('url_image',null,['class'=>'form-control','rows'=>'6', 'required'])}}
                    @endif
                    <h5 class="title">{{$data->name}}</h5>
                  </a>
                  <p class="description">
                    
                  </p>
                </div>
                <p class="description text-center">
                  {{$data->u_address}}
                </p>
              </div>
              @if($data->role == 'Service Provider')
              <div class="card-footer">
                <hr>
                <div class="button-container">
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-6 ml-auto">
                      <h5>RM1,200.00
                        <br>
                        <small>Sales</small>
                      </h5>
                    </div>
                    <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                      <h5>2
                        <br>
                        <small>Job</small>
                      </h5>
                    </div>
                    
                  </div>
                </div>

              </div>
              @endif
            </div>
           
          </div>
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Edit Profile</h5>
              </div>
              <div class="card-body">
                  <div class="row">
                    @if($data->role == 'Admin' or $data->role == 'Customer')
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Name</label>
                        {{Form ::text('name',$data->name,['class'=>'form-control','rows'=>'6'])}}
                      </div>
                    </div>
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        {{Form ::text('email',$data->email,['class'=>'form-control','rows'=>'6'])}}
                      </div>
                    </div>
                  </div>
                  @endif
                  @if($data->role == 'Service Provider')
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Company Name</label>
                        {{Form ::text('company_name',$data->company_name,['class'=>'form-control','rows'=>'6'])}}
                      </div>
                    </div>
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label>Name</label>
                        {{Form ::text('name',$data->name,['class'=>'form-control','rows'=>'6'])}}
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        {{Form ::text('email',$data->email,['class'=>'form-control','rows'=>'6'])}}
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Service</label>
                        {!! Form::select("service",['Urut Pantang'=>'Urut Pantang','Katering'=>'Katering','Pembantu Rumah'=>'Pembantu Rumah'],$data->service,["class"=>"form-control",'rows'=>'6']) !!}
                      </div>
                    </div>
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label>Approval Status</label>
                        {{Form ::label('approval_status',$data->approval_status,['class'=>'form-control','rows'=>'6'])}}
                      </div>
                    </div>
                    @if($data->approval_status == 'Approved')
                   <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Commission (%)</label>
                        {{Form ::label('commission',$data->commission*100,['class'=>'form-control','rows'=>'6'])}}
                      </div>
                    </div>
                    @endif
                  </div>

                  @endif
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Identification Number</label>
                        {{Form ::text('icnumber',$data->icnumber,['class'=>'form-control','rows'=>'6'])}}
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Phone Number</label>
                        {{Form ::text('u_phone',$data->u_phone,['class'=>'form-control','rows'=>'6'])}}
                      </div>
                    </div>
                  </div>
                   <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Password</label>
                        {{ Form::password('password', array('placeholder'=>'Password', 'class'=>'form-control' ) ) }}
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Confirm Password</label>
                        {{ Form::password('', array('placeholder'=>'Confirm Password', 'class'=>'form-control' ) ) }}
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Address</label>
                        {{Form ::textarea('u_address',$data->u_address,['class'=>'form-control','rows'=>'6'])}}
                      </div>
                    </div>
                  </div>
                 
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>About Me</label>
                        {{Form ::textarea('about_me',$data->about_me,['class'=>'form-control','rows'=>'6'])}}
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                      <div class="col-md-8 col-md-offset-4">
                        
                        <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                      </div>
                  </div>
                {{Form::close()}}
              </div>
            </div>
          </div>
        </div>
      </div>
              </div>
              <!-- end content-->
            </div>
            <!--  end card  -->
          </div>
          <!-- end col-md-12 -->
        </div>
        <!-- end row -->
      </div>
      <script>
      $(document).ready(function() {
        // initialise Datetimepicker and Sliders
        demo.initDateTimePicker();
        if ($('.slider').length != 0) {
          demo.initSliders();
        }
      });
    </script>
        
@endsection