@extends('layouts.layout')

@push('header-style')

@endpush

@section('content')
<!-- Container fluid  -->
<div class="container-fluid">
<h1>Add new client</h1>
<div class="row">
        <div class="col-sm-12 col-xs-12">
        <form action="{{ URL::to('clients/updateClient') }}" method="post" id = "form">
          @csrf
          <input type="hidden" name="submitType" id="submitType"/>
        <input type="hidden" name = "client_id" id="client_id" value="{{ $client->id }}" />
                <span>Client name</span>
                <div class = "row">
                    <div class = "col-md-8" style = "margin: 0px; padding: 0px;">
                      <div class="input-group">                         
                      <input type="text" class="form-control" aria-describedby="basic-addon1" name = "client_name" value="{{ $client->client_name }}">  
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
                        <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" name = "street" value="{{ $client->street }}">  
                      </div>
                    </div> 
                    <div class="col-md-5" style = "margin: 0px; padding: 0px;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Postal code</span>
                            </div>
                            <input type="text" class="form-control" aria-describedby="basic-addon1" name = "postal_code" value="{{ $client->postal_code }}">  
                        </div>
                    </div>                
                </div>              
                <br> 
               <div class = "row">
                 <div class="input-group">
                     <div class="input-group-prepend">
                         <span class="input-group-text">Country</span>
                     </div>
                     <input type="text" class="form-control" aria-describedby="basic-addon1" name = "country" value="{{ $client->country }}">  
                 </div>
               </div>
               <br />
               <div class = "row">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Company</span>
                        </div>
                        <input type="text" class="form-control" aria-describedby="basic-addon1" name = "company" value="{{ $client->company }}">  
                    </div>
                  </div>
               <br />
               <div class = "row">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Group</span>
                        </div>
                        <select class="custom-select col-12" id="inlineFormCustomSelect" name = "client_group" >
                          <option selected="">Choose...</option>
                          <option <?php echo $client->client_group == 'End User' ? 'selected' : '';?> value="End User">End User</option>
                          <option <?php echo $client->client_group == 'Dealer' ? 'selected' : '';?> value="Dealer">Dealer</option>
                          <option <?php echo $client->client_group == 'Company' ? 'selected' : '';?> value="Company">Company</option>                          
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
                        <option>Choose...</option>
                        <option <?php echo $client->ui_language == 'English' ? 'selected' : '';?> value="English">English</option>
                        <option <?php echo $client->ui_language == 'Arabic' ? 'selected' : '';?> value="Arabic">Arabic</option>
                    </select>
                  </div>
                </div>
                <br />
                
                <div class="row">                                       
                        <div class="input-group" style="margin: 0px; padding: 0px;">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Client Email</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name = "email_value" value="{{ $client->email_value }}">  
                        </div>                                       
                    
                </div>
                <br />
                <div class="row">
                                              
                            <div class="input-group" style="margin: 0px; padding: 0px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Clent Phone</span>
                                </div>
                                <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name = "phone_value" value="{{ $client->phone_value }}">  
                            </div>                                               
                        
                    </div>
                <br />
                <span>Note</span>
                <div class="row">
                    <div class="col-md-12"> 
                        <div class="form-group">
                          <textarea class="form-control" rows="8" name = "client_note" value="{{ $client->client_note }}"></textarea>
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