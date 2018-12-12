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
              {{Form::open(['route' => ['editUser','id'=>$data->id],'method'=>'POST', 'enctype' => 'multipart/form-data'])}}
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
                @if($data->approval_status == 'Pending Approval')
                <center><a href="{{route('viewApprove',['id'=>$data->id])}}"<button class="btn  btn-success btn-sm btn-round"><i class="fa fa-check-square-o"></i> Approval Status</button></a></center>
                @endif
                @if($data->approval_status == 'Approved')
                 <div class="button-container"><i class="fa fa-credit-card"></i> CREDIT : RM {{$data->credit}}</div>
                 <div>
                   <center><a href=""<button class="btn  btn-success btn-sm btn-round" data-mycompany_name="{{$data->company_name}}" data-myservice="{{$data->service}}" data-myid="{{$data->id}}" data-toggle="modal" data-target="#myModalAddCredit"><i class="fa fa-plus-square"></i> ADD CREDIT</button></a></center>
                 </div>
                @endif
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
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Company Name</label>
                        {{Form ::text('company_name',$data->company_name,['class'=>'form-control','rows'=>'6'])}}
                      </div>
                    </div>
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Service</label>
                         <select name="service" class="form-control" >
                                <option value="{{ $data->service }}">{{ $data->service }}</optio>
                                @foreach ($typeservice_array as $input)                              
                                <option value="{{ $input->name }}">{{ $input->name }}</option>                                                      
                                 @endforeach
                        </select>
                      </div>
                    </div>
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
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Approval Status</label>
                        {{Form ::label('approval_status',$data->approval_status,['class'=>'form-control','rows'=>'6'])}}
                      </div>
                    </div>
                    @if($data->approval_status == 'Approved')
                   <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Commission (%)</label>
                        {{Form ::text('commission',$data->commission*100,['class'=>'form-control','rows'=>'6'])}}
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
                        {{Form ::text('u_address',$data->u_address,['class'=>'form-control','rows'=>'6'])}}
                      </div>
                    </div>
                  </div>
                   <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>City</label>
                        {{Form ::text('u_city',$data->u_city,['class'=>'form-control','rows'=>'6'])}}
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Postcode</label>
                        {{Form ::text('u_postcode',$data->u_postcode,['class'=>'form-control','rows'=>'6'])}}
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>State</label>
                         {!! Form::select("u_state",['Perlis'=>'Perlis','Kedah'=>'Kedah','Perak'=>'Perak','Selangor'=>'Selangor','Negeri_Sembilan'=>'Negeri_Sembilan','Melaka'=>'Melaka','Johor'=>'Johor','Pahang'=>'Pahang','Terengganu'=>'Terengganu','Kelantan'=>'Kelantan','W.P.Kuala_Lumpur'=>'W.P.Kuala_Lumpur','W.P.Labuan'=>'W.P.Labuan','Sabah'=>'Sabah','Sarawak'=>'Sarawak'],$data->u_state,["class"=>"form-control","placeholder"=>"Please Select state"]) !!}   
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
                        <a href="{{route('viewUser')}}"<button class="btn btn-sm btn-danger" type="submit">Back</button></a>
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


      <!--Modal -->
  <div class="modal fade" id="myModalAddCredit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class ="modal-content">
          <div class="modal-header">
            <button type ="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times</span></button>
            <h4 class="modal-title" id="myModalLabel">ADD CREDIT AMOUNT</h4>
          </div>
          <form action="{{route('addCredit')}}" method="POST">
          <input type="hidden" name="_method" value="POST">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="modal-body">
            <p class = "text-center">
              You can add credit amount for service provider here.
             </p>
             <input type="hidden" name="id" id="id" value="">
            @include('user.add-credit')
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
      
@endsection