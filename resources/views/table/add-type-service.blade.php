@extends('layouts.app')

@section('content')
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Add New Type Service</h4>
              </div>
              <div class="card-body">
                <div class="toolbar">
                </div>
                
                {{Form::open(array('route' => 'addTypeService','method'=>'POST'))}}
                @csrf
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        {{Form ::text('name',null,['placeholder'=>'Name','class'=>'form-control','rows'=>'6' , 'required'])}}
                      </div>
                    </div>
                  </div>
                      <div class="row">
                        <a href="{{route('TypeService')}}"<button class="btn btn-sm btn-danger" type="submit">Back</button></a>
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