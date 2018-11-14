@extends('layouts.app')

@section('content')
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card"> 
              <div class="card-header">
                <h4 class="card-title">User Management</h4>
                <div class="text-right"><button class="btn btn-success" data-toggle="modal" data-target="#myModal">Add User</button></div>
              </div>
              <div class="card-body">
                <div class="toolbar">
                  <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="text-center">Bil</th>
                      <th class="text-center">Name</th>
                      <th class="text-center">Email</th>
                      <th class="text-center">Role</th>
                      <th class="disabled-sorting text-center">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php $i = 1;?>
                      @foreach($users as $key=>$data)
                    <tr>
                      <td class="text-center">{{$i++}}</td>
                      <td class="text-center">{{$data->name}}</td>
                      <td class="text-center">{{$data->email}}</td>
                      @if($data->role == 'Service Provider')
                      <td class="text-center">{{$data->role}} <br>({{$data->approval_status}}) </td>
                      @endif
                       @if($data->role == 'Admin' or $data->role == 'Customer')
                      <td class="text-center">{{$data->role}}</td>
                      @endif
                      <td class="text-center">
                        <form name ="frmdelete" action="{{route('delete',['id'=>$data->id])}}" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{route('viewEdit',['id'=>$data->id])}}" class="btn btn-warning btn-link btn-icon btn-m edit"><i class="fa fa-edit"></i></a>
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
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class ="modal-content">
          <div class="modal-header">
            <button type ="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times</span></button>
            <h4 class="modal-title" id="myModalLabel">Add New User</h4>
          </div>
         {{Form::open(array('route' => 'addUser','method'=>'POST'))}}
          @csrf
          <div class="modal-body">
            @include('user.add')
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