@extends('layouts.app')

@section('content')
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Edit Type Event</h4>
              </div>
              <div class="card-body">
                <div class="toolbar">
                </div>
                
                {{Form::open(['route' => ['editTypeEvent','id'=>$data->id],'method'=>'POST'])}}
                @csrf
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        {{Form ::text('name',$data->name,['placeholder'=>'Name','class'=>'form-control','rows'=>'6' , 'required'])}}
                      </div>
                    </div>
                  </div>
                      <div class="row">
                        <a href="{{route('TypeEvent')}}"<button class="btn btn-sm btn-danger" type="submit">Back</button></a>
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