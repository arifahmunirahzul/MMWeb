@extends('layouts.app')

@section('content')
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Pending Job</h4>
              </div>
              <div class="card-body">
                <div class="toolbar">
                  <!--        Here you can write extra buttons/actions for the toolbar              -->
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
                </div>

                <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="text-center">Bil</th>
                      <th class="text-center">Booking Number</th>
                      <th class="text-center">Customer Name</th>
                      <th class="text-center">Date Booking</th>
                      <th class="disabled-sorting text-center">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                     
                      <?php $i = 1;?>
                      @foreach($jobrequest as $key=>$data) 
                    <tr>
                      <td class="text-center">{{$i++}}</td>
                      <td class="text-center">{{$data->booking_id}}</td>
                      <td class="text-center">{{$data->name}}</td>
                      <td class="text-center">{{date('d M Y', strtotime($data->date_booking))}}<br> Price (MYR): RM {{$data->duration*25}}</td>
                      <td class="text-center">
                        <a href="{{route('viewJob',['job_id'=>$data->job_id])}}" class="btn btn-sm edit">View</a>
                        @if($data->service != 'Pembantu Rumah')
                         <a href="{{route('viewQuotation',['job_id'=>$data->job_id])}}"<button class="btn btn-sm btn-primary" type="submit">Submit Quotation</button></a>
                         @endif
                        @if($data->service == 'Pembantu Rumah')
                         <a href=""<button class="btn btn-sm btn-primary" type="submit" data-job_id="{{$data->job_id}}" data-toggle="modal" data-target="#myModalGrabJB">GRAB JOB</button></a>
                        @endif
                      </form>
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
    <div class="modal fade" id="myModalGrabJB" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
          <div class ="modal-content">
            <div class="modal-header">
              <button type ="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times</span></button>
              <h4 class="modal-title" id="myModalLabel">Confirmation Message</h4>
            </div>
            <form action="{{route('grabjob')}}" method="POST">
            <input type="hidden" name="_method" value="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="modal-body">
             <p class = "text-center">
              Are you sure want to grab this job??
             </p>
             <input type="hidden" name="job_id" id="job_id" value="">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn default" data-dismiss="modal">No, Cancel</button>
              <button type="submit" class="btn btn-primary">Yes, Proceed</button>
            </div>
          </form>
      </div>
    </div>
@endsection