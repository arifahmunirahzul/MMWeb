@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Job Request</h4>
              </div>
              <div class="card-body">
                <div class="toolbar">
                <div class="row">
                <div class="col-md-4 pr-1">
                   <select name="status_job" id="status_job" class="form-control">
                                 <option value =""> Please Select Status</option>
                                 <option value="Pending">Pending</option>
                                 <option value="Active">Active</option>
                                 <option value="Completed">Completed</option>
                  </select>  
                </div>
                         <a class="btn btn-sm btn-primary" type="button" name="filter" id="filter"><i class="si si-magnifier"></i>Submit</a>
                </div>
                </div>
                <br>
                <br>
                <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="text-center">Bil</th>
                      <th class="text-center">Booking Number</th>
                      <th class="text-center">Customer Name</th>
                      <th class="text-center">Service</th>
                      <th class="text-center">Date Booking</th>
                      <th class="disabled-sorting text-center">Current Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php $i = 1;?>
                      @foreach($jobrequest as $key=>$data)
                    <tr>
                      <td class="text-center">{{$i++}}</td>
                      <td class="text-center">{{$data->booking_id}}</td>
                      <td class="text-center">{{$data->name}}</td>
                      <td class="text-center">{{$data->service}}</td>
                      <td class="text-center">{{date('d M Y', strtotime($data->date_booking))}}</td>
                      <td class="text-center">
                        {{$data->status_job}}
                      </td>
                      <td class="text-center">
                         <a href="{{route('detailJobView',['booking_id'=>$data->booking_id])}}" class="btn btn-sm btn-success">View</a>
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

      <script type="text/javascript">  
          $(document).ready(function(){     
              $('#filter').click(function(){  
                    var status_job = $('#status_job').val();  
                    if( status_job != '')  
                      {  
                          $.ajax({  
                                url:"{!! url('/list-job-filter') !!}",  
                                method:"GET",  
                                data:{status_job:status_job},  
                                success:function(data)  
                                {  
                                    $('#datatable').html(data);  
                                }  
                                });  
                      }  
                    else  
                      {  
                          alert("Please Select Status");  
                      }  
                });  

          }); 
        </script>
      
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