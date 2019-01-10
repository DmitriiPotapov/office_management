@extends('layouts.layout')

@push('header-style')


@endpush

@section('content')
<!-- Container fluid  -->
<div class="container-fluid">
<h1>Bulk add to stock</h1>
<div class="row">
        <div class="col-sm-12 col-xs-12">
            <form>
            <span>Device type</span>
                <div class = "row">
                    <div class = "col-md-6" style = "margin: 0px; padding: 0px;">
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">Storage Type</span>
                          </div>
                          <select class="custom-select col-12" id="inlineFormCustomSelect">
                              <option selected="">Choose...</option>
                              <option value="1">One</option>
                              <option value="2">Two</option>
                              <option value="3">Three</option>
                          </select>
                      </div>
                    </div>
                    <div class = "col-md-6" style = "display: flex; margin:0px; padding: 0px;">
                      <div class = "col-md-6" style = "margin: 0px; padding: 0px;">
                        <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">Connection</span>
                          </div>
                          <select class="custom-select col-12" id="inlineFormCustomSelect">
                              <option selected="">Choose...</option>
                              <option value="1">One</option>
                              <option value="2">Two</option>
                              <option value="3">Three</option>
                          </select>
                        </div>  
                      </div>
                      <div class = "col-md-6" style = "margin: 0px; padding: 0px;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Form factor</span>
                            </div>
                            <select class="custom-select col-12" id="inlineFormCustomSelect">
                                <option selected="">Choose...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                      </div>
                    </div>
                </div>
                
                <br>
                <span>Basic info</span>
                <div class = "row">
                    <div class = "col-md-6">
                      <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Manufacturer</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">  
                      </div>
                    </div>
                  <div class = "col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Model</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">  
                      </div>
                    </div>
                </div>
              
                <br>
                <span>Basic info</span>
                 <div class = "row">
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Location</span>
                      </div>
                      <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">  
                    </div>
                  </div>
                 </div> 
                <br>
                <span>Dilver info</span>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
                <br>
                
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <div class="input-group-prepend">
                        <span class="input-group-text">0.00</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                </div>
                <!-- form-group -->
            </form>
        </div>
    </div>    
</div>
<!-- End Container fluid  -->
@endsection

@push('footer-script')

<script src="{{ asset('js/dashboard.js')}}"></script>



@endpush