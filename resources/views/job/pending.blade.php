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
                      <th class="text-center">Service</th>
                      <th class="text-center">Date/Time</th>
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
                      <td class="text-center">{{$data->service}}</td>
                      <td class="text-center">{{$data->created_at}}</td>
                      <td class="text-center">
                        <a href="{{route('viewJob',['job_id'=>$data->job_id])}}" class="btn btn-success btn-link btn-icon btn-m edit"><i class="fa fa-eye"></i></a>
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