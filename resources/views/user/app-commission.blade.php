@extends('layouts.app')

@section('content')
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Commission Deal</h4>
              </div>
              <div class="card-body">
                <div class="toolbar">
                  <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                
                {{Form::open(['route' => ['ApproveSP','id'=>$data->id],'method'=>'POST'])}}
                  @csrf
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Company Name</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        {{Form ::label('company_name',$data->company_name,['class'=>'form-control','rows'=>'6' , 'required'])}}
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Email Address</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        {{Form ::label('email',$data->email,['class'=>'form-control','rows'=>'6', 'required'])}}
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Type of Service</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        {{Form ::label('service',$data->service,['class'=>'form-control','rows'=>'6', 'required'])}}
                         
                      </div>
                    </div>
                  </div>
                   <div class="row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        {!! Form::select("approval_status",['Pending Approved'=>'Pending Approved','Approved'=>'Approved','Reject'=>'Reject'],null,["class"=>"form-control", 'required']) !!}
                         
                      </div>
                    </div>
                  </div>
                   <div class="row">
                    <label class="col-sm-2 col-form-label">Commisson (%)</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        {{Form ::text('commission',null,['class'=>'form-control','rows'=>'6' , 'required'])}}
                      </div>
                    </div>
                  </div>
                 
                      <br>
                      <br>
                      <div class="form-group">
                        <a href="{{route('viewUser')}}"<button class="btn btn-sm btn-danger" type="submit">Back</button></a>
                        <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                      </div>
                     
                    </div>
                  </div>
                 
                    </div>
                  </div>
                {{Form::close()}}
              
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