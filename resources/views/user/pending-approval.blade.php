@extends('layouts.app')

@section('content')
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card"> 
              <div class="card-header">
                <h4 class="card-title">Pending Approval</h4>
               
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
                      @foreach($pendinguser as $key=>$data)
                    <tr>
                      <td class="text-center">{{$i++}}</td>
                      <td class="text-center">{{$data->name}}</td>
                      <td class="text-center">{{$data->email}}</td>
                      <td class="text-center">{{$data->role}}</td>
                      
                      <td class="text-center">
                        <a href="{{route('viewEditPA',['id'=>$data->id])}}" class="btn btn-warning btn-link btn-icon btn-m edit"><i class="fa fa-edit"></i></a>  
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
@endsection