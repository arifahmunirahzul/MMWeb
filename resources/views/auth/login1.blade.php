@extends('layouts.base')

@section('basecontent')
<div class="wrapper wrapper-full-page ">
    <div class="full-page section-image" filter-color="black" data-image="assets/img/bg/clean.jpg">
      <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
      <div class="content">
        <div class="container">
          <div class="col-lg-4 col-md-6 ml-auto mr-auto">
            <form method="POST" action="{{ route('login') }}">
             @csrf
              <div class="card card-login">
                <div class="card-header ">
                  <div class="card-header ">
                    <h3 class="header text-center">Login</h3>
                  </div>
                </div>
                <div class="card-body ">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="nc-icon nc-single-02"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control" placeholder="Username">
                  </div>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="nc-icon nc-key-25"></i>
                      </span>
                    </div>
                    <input type="password" placeholder="Password" class="form-control">
                  </div>
                  <br/>
                  <div class="form-group">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="" checked="">
                        <span class="form-check-sign"></span>
                        Remember me
                      </label>
                    </div>
                  </div>
                </div>
                <div class="card-footer ">
                  <a href="#pablo" class="btn btn-primary btn-round btn-block mb-3">Login</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
@endsection