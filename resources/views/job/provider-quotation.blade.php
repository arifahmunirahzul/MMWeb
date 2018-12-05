@extends('layouts.app')

@section('content')
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Provider Quotation</h4>
              </div>
              <div class="card-body">
                <div class="toolbar">
                </div>
                <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="text-center">Bil</th>
                      <th class="text-center">Booking Number</th>
                      <th class="text-center">Provider Name</th>
                      <th class="text-center">Service</th>
                      <th class="text-center">Price (RM)</th>
                      <th class="text-center">Current Status</th>
                      <th class="text-center">Action</th>
                     
                    </tr>
                  </thead> 
                  <tbody>
                     <?php $i = 1;?>
                      @foreach($jobstatus as $key=>$data)
                    <tr>
                      <td class="text-center">{{$i++}}</td>
                      <td class="text-center">{{$data->booking_id}}</td>
                      <td class="text-center">{{$data->name}}</td>
                      <td class="text-center">{{$data->service}}</td>
                       <td class="text-center">RM {{$data->price}}</td>
                      <td class="text-center">{{$data->status}}</td>
                      <td class="text-center"><button class="btn btn-success btn-link btn-icon btn-m" type="button" data-mybooking="{{$data->booking_id}}" data-myname="{{$data->name}}" data-myservice="{{$data->service}}" data-myprice="{{$data->price}}" data-mymessage="{{$data->message}}" data-mystatus="{{$data->status}}" data-toggle="modal" data-target="#edit"><i class="fa fa-eye"></i></button></td>
                      
                    
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
  <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class ="modal-content">
          <div class="modal-header">
            <button type ="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times</span></button>
            <h4 class="modal-title" id="myModalLabel">Details Quotation</h4>
          </div>
          
          <div class="modal-body">
            @include('job.view-quotation')
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn default" data-dismiss="modal">Close</button>
          </div>
        
      </div>
    </div>
  </div> 
      
      <script>
        function myFunction() {
        var r = confirm('Are you sure want to delete record ?');
        
        if (r == true){
            document.frmdelete.submit();
            return true;
        }
        
        else
            return false;
         }
        </script>
@endsection