
                   <div class="row">
                    <label class="col-sm-2 col-form-label">Customer Name</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <input type="text" class="form-control"  name="name" id="name" value="" disabled="">
                      </div>
                   </div>
                   </div>
                    <div class="row">
                    <label class="col-sm-2 col-form-label">Phone Number</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <input type="text" class="form-control"  name="u_phone" id="u_phone" value="" disabled="">
                      </div>
                    </div>
                   </div>
                    <div class="row">
                    <label class="col-sm-2 col-form-label">Date Booking</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <input type="date" class="form-control"  name="date_booking" id="date_booking" value="" >
                      </div>
                    </div>
                   </div>
                    <div class="row">
                    <label class="col-sm-2 col-form-label">Duration (Hours)</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                              <select name="duration" id="duration" class="form-control" placeholder="Please Select Property" >
                                 <option value="4">4 Hours</option>
                                 <option value="5">5 Hours</option>
                                 <option value="6">6 Hours</option>
                                 <option value="7">7 Hours</option>
                                 <option value="8">8 Hours</option> 
                              </select>   
                       </div>
                            
                    </div>
                  </div>
                   <div class="row">
                    <label class="col-sm-2 col-form-label">Type Property</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                             <select name="type_property" id="type_property" class="form-control" placeholder="Please Select Property" >
                                @foreach ($typeproperty_array as $data)                                       
                                <option value="{{ $data->name }}">{{ $data->name }}</option>                                                      
                                 @endforeach
                             </select>
                       </div>
                            
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                                <textarea class="form-control"  name="address" id="address" value=""> </textarea>
                       </div>
                     </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">City</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                            <input type="text" class="form-control"  name="city" id="city" value="">
                      </div>
                     </div>
                   </div>
                   
                   <div class="row">
                    <label class="col-sm-2 col-form-label">Postcode</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                            <input type="text" class="form-control"  name="postcode" id="postcode" value="">
                      </div>
                    </div>
                   </div>
                            
                  <div class="row">
                    <label class="col-sm-2 col-form-label">State</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                              <select name="state" id="state" class="form-control" placeholder="Please Select Property" >
                                 <option value="Perlis">Perlis</option>
                                 <option value="Kedah">Kedah</option>
                                 <option value="Perak">Perak</option>
                                 <option value="Selangor">Selangor</option>
                                 <option value="Negeri_Sembilan">Negeri Sembilan</option>
                                 <option value="Melaka">Melaka</option>
                                 <option value="Johor">Johor</option>
                                 <option value="Pahang">Pahang</option>
                                 <option value="Terengganu">Terengganu</option>
                                 <option value="Kelantan">Kelantan</option>
                                 <option value="W.P.Kuala_Lumpur">W.P.Kuala_Lumpur</option>
                                 <option value="W.P.Labuan">W.P.Labuan</option>
                                 <option value="Sabah">Sabah</option>
                                 <option value="Sarawak">Sarawak</option>  
                                </select>
                       </div>
                            
                    </div>
                  </div>

                   <div class="row">
                    <label class="col-sm-2 col-form-label">Clean Area</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                             <textarea class="form-control"  name="clean_area" id="clean_area" value=""> </textarea>
                      </div>
                    </div>
                   </div>

                    <div class="row">
                    <label class="col-sm-2 col-form-label">Message</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                            <textarea class="form-control"  name="message" id="message" value=""> </textarea>
                      </div>
                    </div>
                   </div>


                 