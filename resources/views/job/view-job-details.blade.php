@extends('layouts.app')

@section('content')
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">View Job Request Details</h4>
              </div>
              <div class="card-body">
                <div class="toolbar">
                </div>
                @foreach($job as $key=>$data)
                  <div>
                    <strong>CUSTOMER BOOKING DETAILS</strong>
                  </div>
                  <br>

                   <div class="row">
                    <label class="col-sm-2 col-form-label">Customer Name</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        {{Form ::label('name',$data->name,['class'=>'form-control','rows'=>'6' , 'required'])}}
                      </div>
                    </div>
                  </div>

                   <div class="row">
                    <label class="col-sm-2 col-form-label">Customer Email</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        {{Form ::label('email',$data->email,['class'=>'form-control','rows'=>'6' , 'required'])}}
                      </div>
                    </div>
                  </div>
                   <div class="row">
                    <label class="col-sm-2 col-form-label">Customer Phone</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        {{Form ::label('u_phone',$data->u_phone,['class'=>'form-control','rows'=>'6' , 'required'])}}
                      </div>
                    </div>
                  </div>

                   <div class="row">
                    <label class="col-sm-2 col-form-label">Customer Address</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        {{Form ::label('address',$data->address,['class'=>'form-control','rows'=>'6' , 'required'])}}
                        {{Form ::label('postcode',$data->postcode,['class'=>'form-control','rows'=>'6' , 'required'])}}
                        {{Form ::label('city',$data->city,['class'=>'form-control','rows'=>'6' , 'required'])}}
                        {{Form ::label('state',$data->state,['class'=>'form-control','rows'=>'6' , 'required'])}}
                      </div>
                    </div>
                  </div>
                  <div>
                    <strong>BOOKING SERVICE DETAILS</strong>
                  </div>
                  <br>
                   <div class="row">
                    <label class="col-sm-2 col-form-label">Booking Number</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        {{Form ::label('booking_id',$data->booking_id,['class'=>'form-control','rows'=>'6' , 'required'])}}
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Date Booking</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        {{Form ::label('date_booking',$data->date_booking,['class'=>'form-control','rows'=>'6', 'required'])}}
                      </div>
                    </div>
                  </div>
                  @if($data->type_service == 'Pembantu Rumah')
                     <div class="row">
                    <label class="col-sm-2 col-form-label">Duration (Hours)</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        {{Form ::label('duration',$data->duration,['class'=>'form-control','rows'=>'6' , 'required'])}}
                         
                      </div>
                    </div>
                  </div>
                   <div class="row">
                    <label class="col-sm-2 col-form-label">Type Property</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        {{Form ::label('type_property',$data->type_property,['class'=>'form-control','rows'=>'6' , 'required'])}}
                         
                      </div>
                    </div>
                  </div>
                   <div class="row">
                    <label class="col-sm-2 col-form-label">Clean Area</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        {{Form ::label('clean_area',$data->clean_area,['class'=>'form-control','rows'=>'6' , 'required'])}}
                         
                      </div>
                    </div>
                  </div>
                  @endif
                   @if($data->type_service == 'Katering')
                   <div class="row">
                    <label class="col-sm-2 col-form-label">Total Visitor</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        {{Form ::label('total_visitor',$data->total_visitor,['class'=>'form-control','rows'=>'6' , 'required'])}}
                         
                      </div>
                    </div>
                  </div>
                   <div class="row">
                    <label class="col-sm-2 col-form-label">Type event</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        {{Form ::label('type_event',$data->type_event,['class'=>'form-control','rows'=>'6' , 'required'])}}
                         
                      </div>
                    </div>
                  </div>
                  @endif
                   @if($data->type_service == 'Urut Pantang')
                   <div class="row">
                    <label class="col-sm-2 col-form-label">Package (Day)</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        {{Form ::label('package',$data->package,['class'=>'form-control','rows'=>'6' , 'required'])}}
                         
                      </div>
                    </div>
                  </div>
                  @endif
                   <div class="row">
                    <label class="col-sm-2 col-form-label">Message</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        {{Form ::label('message',$data->message,['class'=>'form-control','rows'=>'6' , 'required'])}}
                      </div>
                    </div>
                  </div>
                 
                   <div class="row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        {{Form ::label('status_job',$data->status_job,['class'=>'form-control','rows'=>'6' , 'required'])}}
                      </div>
                    </div>
                  </div>
                @endforeach

                      <br>
                      <br>
                      <div class="form-group">
                        <a href="{{route('ListPendingJob')}}"<button class="btn btn-sm btn-danger" type="submit">Back</button></a>
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
@endsection