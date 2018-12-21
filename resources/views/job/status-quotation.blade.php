@extends('layouts.app')

@section('content')
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Quotation Status</h4>
              </div>
              <div class="card-body">
                <div class="toolbar">
                </div>
                <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="text-center">Bil</th>
                      <th class="text-center">Booking Number</th>
                      <th class="text-center">Customer Name</th>
                      <th class="text-center">Service</th>
                      <th class="text-center">Price (RM)</th>
                      <th class="text-center" style="width: 25%;">Message</th>
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
                      @if($data->message != '')
                      <td class="text-center">{{$data->message}}</td>
                      @endif
                      @if($data->message == '')
                      <td class="text-center">No message left</td>
                      @endif
                      <td class="text-center">{{$data->status}}</td>
                       <td class="text-center">
                        <a href="{{route('detailQuotation',['booking_id'=>$data->booking_id])}}" class="btn btn-sm btn-success">View</a>
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