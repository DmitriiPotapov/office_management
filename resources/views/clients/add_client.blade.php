@extends('layouts.layout')

@push('header-style')

@endpush

@section('content')
<!-- Container fluid  -->
<div class="container-fluid">
        <div class="row page-titles">
                <div class="col-md-6 col-8 align-self-center">
                    <h3 class="text-themecolor m-b-0 m-t-0">Add new client</h3>
                </div>
            </div>
<div class="row">
        <div class="col-sm-12 col-xs-12">
        <form action="{{ URL::to('clients/createAction') }}" method="post" id = "form">
          @csrf
          <input type="hidden" name="submitType" id="submitType"/>
                <div class = "row">
                    <div class = "col-md-8" style = "margin: 0px; padding: 0px;">
                      <div class="input-group">    
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Client name</span>
                            </div>                     
                          <input type="text" class="form-control" aria-describedby="basic-addon1" name = "client_name">  
                      </div>
                    </div>
                </div>                
                <br>
                <span>Address</span>
                <div class = "row">
                    <div class = "col-md-7" style = "margin: 0px; padding: 0px;">
                      <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">City</span>
                        </div>
                        <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" name = "street">  
                      </div>
                    </div> 
                    <div class="col-md-5" style = "margin: 0px; padding: 0px;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Postal code</span>
                            </div>
                            <input type="text" class="form-control" aria-describedby="basic-addon1" name = "postal_code">  
                        </div>
                    </div>                
                </div>              
                <br> 
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
                        <option value="English">English</option>
                        <option value="Arabic">Arabic</option>
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
                                    <span class="input-group-text" id="basic-addon1">Client Phone</span>
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