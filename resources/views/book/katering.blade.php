@extends('layouts.app')

@section('content')
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Booking Service - Katering</h4>
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
                <div class="toolbar">
                  <div class="text-right">
                  <a href="{{route('viewFormAddKatering')}}" <button class="btn btn-success">NEW BOOKING</button></a>
                </div>
                </div>
                <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="text-center">Bil</th>
                      <th class="text-center">Booking Number</th>
                      <th class="text-center">Customer Name</th>
                      <th class="text-center">Service</th>
                      <th class="text-center">Date/Time</th>
                      <th class="text-center">Current Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php $i = 1;?>
                      @foreach($pending_katering as $key=>$data)
                    <tr>
                      <td class="text-center">{{$i++}}</td>
                      <td class="text-center">{{$data->booking_id}}</td>
                      <td class="text-center">{{$data->name}}</td>
                      <td class="text-center">{{$data->service}}</td>
                      <td class="text-center">{{date('d M Y', strtotime($data->date_booking))}}</td>
                      <td class="text-center">{{$data->status_job}}</td>
                      <td class="text-center">
                        <button class="btn btn-warning btn-link btn-icon btn-m edit" data-booking_id="{{$data->booking_id}}" data-job_id = "{{$data->job_id}}" data-name="{{$data->name}}" data-u_phone="{{$data->u_phone}}" data-date_booking="{{$data->date_booking}}" data-total_visitor="{{$data->total_visitor}}" data-type_event="{{$data->type_event}}" data-address="{{$data->address}}" data-city="{{$data->city}}" data-postcode="{{$data->postcode}}" data-state="{{$data->state}}" data-message="{{$data->message}}" data-toggle="modal" data-target="#editKatering"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger btn-link btn-icon btn-m remove" type="submit"  data-booking_id="{{$data->booking_id}}" data-toggle="modal" data-target="#deleteKatering"><i class="fa fa-times"></i></button>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
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
    <div class="modal fade" id="editKatering" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
          <div class ="modal-content">
            <div class="modal-header">
              <button type ="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times</span></button>
              <h4 class="modal-title" id="myModalLabel">Edit Booking</h4>
            </div>
            <form action="{{route('EditKatering')}}" method="POST">
            <input type="hidden" name="_method" value="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="modal-body">
             <p class = "text-center">
              Edit Booking Records?
             </p>
             <input type="hidden" name="booking_id" id="booking_id" value="">
              @include('book.edit-book-katering')
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn default" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
      </div>
    </div>

     <!--Modal -->
    <div class="modal fade" id="deleteKatering" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
          <div class ="modal-content">
            <div class="modal-header">
              <button type ="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times</span></button>
              <h4 class="modal-title" id="myModalLabel">Confirmation Message</h4>
            </div>
            <form action="{{route('deleteKatering')}}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="modal-body">
             <p class = "text-center">
              Are you sure want to delete this record?
             </p>
             <input type="hidden" name="booking_id" id="booking_id" value="">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn default" data-dismiss="modal">No, Cancel</button>
              <button type="submit" class="btn btn-primary">Yes, Delete</button>
            </div>
          </form>
      </div>
    </div>
@endsection