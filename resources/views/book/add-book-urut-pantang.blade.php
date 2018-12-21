@extends('layouts.app')

@section('content')
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Add New Booking - Urut Pantang</h4>
              </div>
              <div class="card-body">
              	@if(Session::has('flash_message_error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                                <strong>{!! session('flash_message_error') !!}</strong>
                        </div>
                @endif
                  @if(Session::has('flash_message_success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                                <strong>{!! session('flash_message_success') !!}</strong>
                        </div>
                @endif
              	<p class = "text-left">
	              Check user record first before proceed booking.
	             </p>
                <div class="toolbar">
                </div>
                 {{Form::open(array('route' => 'BookUrutPantang','method'=>'POST'))}}
                @csrf
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Customer Name</label>
                    <div class="col-md-7">
                      <div class="form-group">
                      	
                        {{Form ::select('customer_id', $select_name_user, null,['class'=>'js-select2 form-control','rows'=>'6', 'placeholder' => 'Please Choose'])}}
                        
                      </div>
                    </div>
                     <div class="col-md-3"><button class="btn btn-success" data-toggle="modal" data-target="#myModal">Add User</button></div>
                   </div>
                    <div class="row">
                    <label class="col-sm-2 col-form-label">Expected delivery date</label>
                    <div class="col-md-7">
                      <div class="form-group">
                        {{Form ::date('date_booking',null,['class'=>'form-control','rows'=>'6' , 'required'])}}
                      </div>
                    </div>
                   </div>
                    <div class="row">
                    <label class="col-sm-2 col-form-label">Package</label>
                    <div class="col-md-7">
                      <div class="form-group">
                                {!! Form::select("package",['14'=>'14 Days','21'=>'21 Days','28'=>'28 Days'],null,["class"=>"form-control","placeholder"=>"Please Select Package"]) !!}   
                       </div>
                            
                    </div>
                  </div>
                 
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Address</label>
                    <div class="col-md-7">
                      <div class="form-group">
                                {{Form ::textarea('address',null,[ 'placeholder'=>'Address','class'=>'form-control','rows'=>'6'])}}
                       </div>
                     </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">City</label>
                    <div class="col-md-7">
                      <div class="form-group">
                            {{Form ::text('city',null,[ 'placeholder'=>'City','class'=>'form-control','rows'=>'6'])}}
                      </div>
                     </div>
                   </div>
                   
                   <div class="row">
                    <label class="col-sm-2 col-form-label">Postcode</label>
                    <div class="col-md-7">
                      <div class="form-group">
                            {{Form ::text('postcode',null,[ 'placeholder'=>'Postcode','class'=>'form-control','rows'=>'6'])}}
                      </div>
                    </div>
                   </div>
                            
                  <div class="row">
                    <label class="col-sm-2 col-form-label">State</label>
                    <div class="col-md-7">
                      <div class="form-group">
                                {!! Form::select("state",['Perlis'=>'Perlis','Kedah'=>'Kedah','Perak'=>'Perak','Selangor'=>'Selangor','Negeri_Sembilan'=>'Negeri_Sembilan','Melaka'=>'Melaka','Johor'=>'Johor','Pahang'=>'Pahang','Terengganu'=>'Terengganu','Kelantan'=>'Kelantan','W.P.Kuala_Lumpur'=>'W.P.Kuala_Lumpur','W.P.Labuan'=>'W.P.Labuan','Sabah'=>'Sabah','Sarawak'=>'Sarawak'],null,["class"=>"form-control","placeholder"=>"Please Select state"]) !!}   
                       </div>
                            
                    </div>
                  </div>

                     <div class="row">
                    <label class="col-sm-2 col-form-label">Message</label>
                    <div class="col-md-7">
                      <div class="form-group">
                            {{Form ::textarea('message',null,[ 'placeholder'=>'Message','class'=>'form-control','rows'=>'6'])}}
                      </div>
                    </div>
                   </div>
                   <button type="submit" class="btn btn-primary">Save</button>
                  {{Form::close()}}
              
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
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class ="modal-content">
          <div class="modal-header">
            <button type ="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times</span></button>
            <h4 class="modal-title" id="myModalLabel">Add New User</h4>
          </div>
         {{Form::open(array('route' => 'addUserNewUP','method'=>'POST'))}}
          @csrf
          <div class="modal-body">
            @include('user.add-user')
          </div>
          <div class="modal-footer">
            
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn default" data-dismiss="modal">Close</button>
          </div>
        {{Form::close()}}
      </div>
    </div>
  </div>
@endsection


                 