 
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        {{Form ::text('name',null,['placeholder'=>'Name','class'=>'form-control','rows'=>'6' , 'required'])}}
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Phone Number</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        {{Form ::text('u_phone',null,['placeholder'=>'Phone Number','class'=>'form-control','rows'=>'6', 'required'])}}
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Email Address</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        {{Form ::text('email',null,['placeholder'=>'abc@gmail.com','class'=>'form-control','rows'=>'6', 'required'])}}
                         <span class="form-text">Example: admin@gmail.com</span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        {{ Form::password('password', array('placeholder'=>'Password', 'class'=>'form-control' , 'required') ) }}
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        {!!Form::select("role",['Admin'=>'Admin','Customer'=>'Customer'],null,["class"=>"form-control", 'required']) !!}
                      </div>
                    </div>
                  </div>
                 
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Active</label>
                    <div class="col-sm-10 checkbox-radios">
                      <div class="form-check">
                        <label class="form-check-label">
                           {!! Form::checkbox("status",1,null,["style"=>"width:25px;height:25px", 'required']) !!}
                          <span class="form-check-sign"></span>
                        </label>
                      </div>
                    </div>
                  

   