@extends('layouts.app')

@section('content')
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Type Event Records</h4>
              </div>
              <div class="card-body">
                <div class="toolbar">
                  <div class="text-right"><button class="btn btn-success" data-toggle="modal" data-target="#myTypeEvent">ADD NEW</button></div>
                </div>
                <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="text-center">Bil</th>
                      <th class="text-center">Event Name</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php $i = 1;?>
                      @foreach($table as $key=>$data)
                    <tr>
                      <td class="text-center">{{$i++}}</td>
                      <td class="text-center">{{$data->name}}</td>
                      <td class="text-center">
                         <form name ="frmdelete" action="{{route('deleteTypeEvent',['id'=>$data->id])}}" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{route('viewEditTypeEvent',['id'=>$data->id])}}" class="btn btn-warning btn-link btn-icon btn-m edit"><i class="fa fa-edit"></i></a>
                        <button class="btn btn-danger btn-link btn-icon btn-m remove" type="submit" onclick="return myFunction()"><i class="fa fa-times"></i></button>
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
      <div class="modal fade" id="myTypeEvent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class ="modal-content">
              <div class="modal-header">
                <button type ="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Type Event</h4>
              </div>
              {{Form::open(array('route' => 'addTypeEvent','method'=>'POST'))}}
                @csrf
              <div class="modal-body">
                @include('table.add-type-event')
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            {{Form::close()}}
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