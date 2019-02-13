@extends('layouts.layout')

@push('header-style')


@endpush

@section('content')
<!-- Container fluid  -->
<div class="container-fluid">
<h1>Bulk Update stock</h1>
<div class="row">
        <div class="col-sm-12 col-xs-12">
          <form action="{{ route('updateStock') }}" method="post">
          @csrf
          <input type="hidden" name="stock_id" id="stock_id" value="{{ $stockitem->id }}" />
            <span>Device type</span>
                <div class = "row">
                    <div class = "col-md-6" style = "margin: 0px; padding: 0px;">
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">Storage Type</span>
                          </div>
                          <select class="custom-select col-12" id="inlineFormCustomSelect" name = "device_type">
                             
                              <option <?php echo $stockitem->device_type == 'Laptop Drive' ? 'selected' : '';?> value="Laptop Drive">Laptop Drive</option>
                              <option <?php echo $stockitem->device_type == 'External Drive' ? 'selected' : '';?> value="External Drive">External Drive</option>
                              <option <?php echo $stockitem->device_type == 'Desktop Drive' ? 'selected' : '';?> value="Desktop Drive">Desktop Drive</option>
                              <option <?php echo $stockitem->device_type == 'SSD' ? 'selected' : '';?> value="SSD">SSD</option>
                              <option <?php echo $stockitem->device_type == 'Flash Drive' ? 'selected' : '';?> value="Flash Drive">Flash Drive</option>
                              <option <?php echo $stockitem->device_type == 'Memory card' ? 'selected' : '';?> value="Memory card">Memory card</option>
                              <option <?php echo $stockitem->device_type == 'Server HDD' ? 'selected' : '';?> value="Server HDD">Server HDD</option>

                          </select>
                      </div>
                    </div>
                    <div class = "col-md-6" style = "display: flex; margin:0px; padding: 0px;">
                      <div class = "col-md-6" style = "margin: 0px; padding: 0px;">
                        <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">Connection</span>
                          </div>
                          <select class="custom-select col-12" id="inlineFormCustomSelect" name = "connection">
                             
                                <option <?php echo $stockitem->connection == 'M.2' ? 'selected' : '';?> value="M.2">M.2</option>
                                <option <?php echo $stockitem->connection == 'mSATA' ? 'selected' : '';?> value="mSATA">mSATA</option>
                                <option <?php echo $stockitem->connection == 'Other' ? 'selected' : '';?> value="Other">Other</option>
                                <option <?php echo $stockitem->connection == 'PATA' ? 'selected' : '';?> value="PATA">PATA</option>
                                <option <?php echo $stockitem->connection == 'PCI-Express' ? 'selected' : '';?> value="PCI-Express">PCI-Express</option>
                                <option <?php echo $stockitem->connection == 'SAS' ? 'selected' : '';?> value="SAS">SAS</option>
                                <option <?php echo $stockitem->connection == 'SATA' ? 'selected' : '';?> value="SATA">SATA</option>
                                <option <?php echo $stockitem->connection == 'SATA Express' ? 'selected' : '';?> value="SATA Express">SATA Express</option>
                                <option <?php echo $stockitem->connection == 'USB 2.0' ? 'selected' : '';?> value="USB 2.0">USB 2.0</option>
                                <option <?php echo $stockitem->connection == 'USB 3.0' ? 'selected' : '';?> value="USB 3.0">USB 3.0</option>
                                <option <?php echo $stockitem->connection == 'USB 3.1' ? 'selected' : '';?> value="USB 3.1">USB 3.1</option>
                          </select>
                        </div>  
                      </div>
                      <div class = "col-md-6" style = "margin: 0px; padding: 0px;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Form factor</span>
                            </div>
                            <select class="custom-select col-12" id="inlineFormCustomSelect" name = "form_factor">
                        
                                    <option <?php echo $stockitem->form_factor == '1.0"' ? 'selected' : '';?> value='1.0"'>1.0"</option>
                                    <option <?php echo $stockitem->form_factor == '1.3"' ? 'selected' : '';?> value='1.3"'>1.3"</option>
                                    <option <?php echo $stockitem->form_factor == '1.8"' ? 'selected' : '';?> value='1.8"'>1.8"</option>
                                    <option <?php echo $stockitem->form_factor == '2.5"' ? 'selected' : '';?> value='2.5"'>2.5"</option>
                                    <option <?php echo $stockitem->form_factor == '3.5"' ? 'selected' : '';?> value='3.5"'>3.5"</option>
                                    <option <?php echo $stockitem->form_factor == '5.25"' ? 'selected' : '';?> value='5.25"'>5.25"</option>
                                    <option <?php echo $stockitem->form_factor == 'Other' ? 'selected' : '';?> value='Other'>Other</option>

                            </select>
                        </div>
                      </div>
                    </div>
                </div>
                
                <br>
                <span>Basic info</span>
                <div class = "row">
                    <div class = "col-md-6" style = "margin: 0px; padding: 0px;">
                      <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Brand</span>
                        </div>
                    <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" name = "manufacturer" value="{{ $stockitem->manufacturer }}">  
                      </div>
                    </div>
                  <div class = "col-md-6" style = "margin: 0px; padding: 0px;">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Model</span>
                        </div>
                    <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name = "model" value="{{ $stockitem->stock_model }}">  
                      </div>
                    </div>
                </div>              
                <br>
                <span>Basic info</span>
                 <div class = "row">
                    <div class="input-group" style = "margin: 0px; padding: 0px;">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Location</span>
                      </div>
                    <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" name = "location" value="{{ $stockitem->location }}">  
                    </div>
                  </div>
                 </div> 
               </div>
               <br />
                <span>Serials</span>              
                <div class="row">
                    <div class="input-group" style="margin: 0px; padding: 0px;">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Serial number</span>
                      </div>
                    <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name = "serial_number" value="{{ $stockitem->serial_number }}">  
                    </div>
                </div>
                <br />
                <span>Pricing</span>
                <div class = "row">
                    <div class = "col-md-6" style = "display: flex; margin: 0px; padding: 0px;">
                      <div class = "col-md-6" style = "margin: 0px; padding: 0px;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Input price</span>
                            </div>
                        <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name = "input_price" value="{{ $stockitem->input_price }}"> 
                        </div>
                      </div>
                      <div class = "col-md-6" style = "margin: 0px; padding: 0px;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">VAT(%) </span>
                            </div>
                        <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name = "vat_value" value="{{ $stockitem->vat_value }}"> 
                        </div>
                      </div>
                      
                    </div>
                    <div class = "col-md-6" style = "display: flex; margin:0px; padding: 0px;">
                      <div class = "col-md-6" style = "margin: 0px; padding: 0px;">
                        <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">Interest</span>
                          </div>
                        <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name = "interest" value="{{ $stockitem->interest }}"> 
                        </div>  
                      </div>
                      <div class = "col-md-6" style = "margin: 0px; padding: 0px;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Final price</span>
                            </div>
                        <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name = "final_price" value="{{ $stockitem->final_price }}"> 
                        </div>
                      </div>
                    </div>
                </div>
                <br />
                <span>Note</span>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                        <textarea class="form-control" rows="8" name = "stock_note">{{ $stockitem->stock_note }}</textarea>
                          <small class="form-control-feedback"><a href="javascript:void(0)"> </a></small> </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Update</button>
                    <a href = "{{URL::to('stock/resetAction')}}"><button type="button" class="btn btn-warning">Reset</button></a>
                </div>              
          </form>
        </div>
    </div>    
</div>
<!-- End Container fluid  -->
@endsection

@push('footer-script')

<script src="{{ asset('js/dashboard.js')}}"></script>

@endpush