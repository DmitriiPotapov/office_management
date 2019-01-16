@extends('layouts.layout')

@push('header-style')

@endpush

@section('content')
<!-- Container fluid  -->
<div class="container-fluid">
<h1>Add new client</h1>
<div class="row">
        <div class="col-sm-12 col-xs-12">
        <form action="{{ URL::to('clients/createAction') }}" method="post" id = "form">
          @csrf
          <input type="hidden" name="submitType" id="submitType"/>
                <span>Client name</span>
                <div class = "row">
                    <div class = "col-md-8" style = "margin: 0px; padding: 0px;">
                      <div class="input-group">                         
                          <input type="text" class="form-control" aria-describedby="basic-addon1" name = "client_name">  
                      </div>
                    </div>
                    <div class = "col-md-4" style = "display: flex; margin:0px; padding: 0px;">                      
                        <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">PIB/JMBG</span>
                          </div>
                          <input type="text" class="form-control" aria-describedby="basic-addon1" name = "pib_jmbg">  
                        </div>                                             
                    </div>
                </div>                
                <br>
                <span>Address</span>
                <div class = "row">
                    <div class = "col-md-7" style = "margin: 0px; padding: 0px;">
                      <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Street</span>
                        </div>
                        <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" name = "street">  
                      </div>
                    </div>
                  <div class = "col-md-5" style = "display: flex; margin: 0px; padding: 0px;">
                    <div class="col-md-6" style = "margin: 0px; padding: 0px;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Number</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name = "number">  
                        </div>
                    </div>
                    <div class="col-md-6" style = "margin: 0px; padding: 0px;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Apt</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name = "apt">  
                        </div>
                    </div>
                </div>                   
                </div>              
                <br>               
                <div class = "row">
                    <div class="col-md-4" style = "margin: 0px; padding: 0px;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Postal code</span>
                            </div>
                            <input type="text" class="form-control" aria-describedby="basic-addon1" name = "postal_code">  
                        </div>
                    </div>
                    <div class="col-md-8" style = "display: flex; margin: 0px; padding: 0px;">
                        <div class="col-md-6" style = "margin: 0px; padding: 0px;">
                            <div class="input-group" style = "margin: 0px; padding: 0px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">PAK</span>
                                </div>
                                <input type="text" class="form-control" aria-describedby="basic-addon1" name = "pak">  
                            </div>
                        </div>
                        <div class="col-md-6" style = "margin: 0px; padding: 0px;">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">City name</span>
                                </div>
                                <input type="text" class="form-control" aria-describedby="basic-addon1" name = "city_name">  
                            </div>
                        </div>
                    </div>
                </div>                
               <br /> 
               <div class = "row">
                 <div class="input-group">
                     <div class="input-group-prepend">
                         <span class="input-group-text">Country</span>
                     </div>
                     <input type="text" class="form-control" aria-describedby="basic-addon1" name = "country">  
                 </div>
               </div>
               <br />
               <div class = "row">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Company</span>
                        </div>
                        <input type="text" class="form-control" aria-describedby="basic-addon1" name = "company">  
                    </div>
                  </div>
               <br />
               <div class = "row">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Group</span>
                        </div>
                        <select class="custom-select col-12" id="inlineFormCustomSelect" name = "client_group">
                          <option selected="">Choose...</option>
                          <option value="End User">End User</option>
                          <option value="Dealer">Dealer</option>
                          <option value="Company">Company</option>                          
                      </select>
                    </div>
                  </div>
                  <br />
                <span>Client portal UI language</span>
                <div class = "row">
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text">UI language</span>
                      </div>
                      <select class="custom-select col-12" id="inlineFormCustomSelect" name = "ui_language">
                        <option selected="">Choose...</option>
                        <option value="1">English</option>
                        <option value="2">Russian</option>
                        <option value="3">Bengali</option>
                        <option value="4">Portuguese</option>
                        <option value="5">Japan</option>
                        <option value="6">Arabic</option>
                        <option value="7">Hindi</option>
                        <option value="8">Spanish</option>
                    </select>
                  </div>
                </div>
                <br />
                
                <div class="row">                                       
                        <div class="input-group" style="margin: 0px; padding: 0px;">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Client Email</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name = "email_value">  
                        </div>                                       
                    
                </div>
                <br />
                <div class="row">
                                              
                            <div class="input-group" style="margin: 0px; padding: 0px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Clent Phone</span>
                                </div>
                                <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name = "phone_value">  
                            </div>                                               
                        
                    </div>
                <br />
                <span>Note</span>
                <div class="row">
                    <div class="col-md-12"> 
                        <div class="form-group">
                          <textarea class="form-control" rows="8" name = "client_note"></textarea>
                          <small class="form-control-feedback"><a href="javascript:void(0)"> </a></small></div>
                    </div>
                </div>
                <div class="form-actions">
                    <button onclick="submitForm(0)" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                    <button onclick="submitForm(1)" class="btn btn-success"><i class="fa fa-check"></i> Save and create job</button>
                    <a href = "{{URL::to('clients/resetAction')}}"><button type="button" class="btn btn-warning">Reset</button></a>
                </div>              
          </form>
        </div>
    </div>    
</div>
<!-- End Container fluid  -->
@endsection

@push('footer-script')

<script src="{{ asset('js/dashboard.js')}}"></script>
<script>
    function submitForm(submitType) {
        $("#submitType").val(submitType);
        $("#form").submit();
    }
</script>

@endpush