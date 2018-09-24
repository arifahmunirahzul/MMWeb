@extends('layouts.app')

@section('content')
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Submit Quotation</h4>
              </div>
              <div class="card-body">
                <div class="toolbar">
                  <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                
                {{Form::open(['route' => ['SubmitQuotation','job_id'=>$data->job_id],'method'=>'POST'])}}
                  @csrf

                  {{Form ::hidden('job_id',$data->job_id,['class'=>'form-control','rows'=>'6'])}}
                  {{Form ::hidden('provider_id',Auth::user()->id,['class'=>'form-control','rows'=>'6'])}}
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        {{Form ::text('price',null,['class'=>'form-control','rows'=>'6' , 'required'])}}
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Message</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        {{Form ::text('message',null,['class'=>'form-control','rows'=>'6', 'required'])}}
                      </div>
                    </div>
                  </div>
                 
                      <br>
                      <br>
                      <div class="form-group">
                        <a href="{{route('viewPendingJob')}}"<button class="btn btn-sm btn-danger" type="submit">Back</button></a>
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