@extends('layouts.layout')

@push('header-style')


@endpush

@section('content')
<!-- Container fluid  -->
<form action="{{ route('createstock') }}" method="post">
  @csrf
<div class="container-fluid">
  <div class="row page-titles">
    <div class="col-md-6 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Bulk add to stock</h3>
    </div>
</div>
<div class="row">
        <div class="col-sm-12 col-xs-12">
            <span>Device type</span>
                <div class = "row">
                    <div class = "col-md-6" style = "margin: 0px; padding: 0px;">
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">Storage Type</span>
                          </div>
                          <select class="custom-select col-12" id="inlineFormCustomSelect" name = "device_type">
                              <option selected="">Choose...</option>
                              <option value="Laptop Drive">Laptop Drive</option>
                              <option value="External Drive">External Drive</option>
                              <option value="Desktop Drive">Desktop Drive</option>
                              <option value="SSD">SSD</option>
                              <option value="Flash Drive">Flash Drive</option>
                              <option value="Memory card">Memory card</option>
                              <option value="Server HDD">Server HDD</option>
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
                              <option selected="">Choose...</option>
                              <option value="M.2">M.2</option>
                              <option value="mSATA">mSATA</option>
                              <option value="Other">Other</option>
                              <option value="PATA">PATA</option>
                              <option value="PCI-Express">PCI-Express</option>
                              <option value="SAS">SAS</option>
                              <option value="SATA">SATA</option>
                              <option value="SATA Express">SATA Express</option>
                              <option value="USB 2.0">USB 2.0</option>
                              <option value="USB 3.0">USB 3.0</option>
                              <option value="USB 3.1">USB 3.1</option>
                          </select>
                        </div>  
                      </div>
                      <div class = "col-md-6" style = "margin: 0px; padding: 0px;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Form factor</span>
                            </div>
                            <select class="custom-select col-12" id="inlineFormCustomSelect" name = "form_factor">
                                <option selected="">Choose...</option>
                                <option value='1.0"'>1.0"</option>
                                <option value='1.3"'>1.3"</option>
                                <option value='1.8"'>1.8"</option>
                                <option value='2.5"'>2.5"</option>
                                <option value='3.5"'>3.5"</option>
                                <option value='5.25"'>5.25"</option>
                                <option value='Other'>Other</option>
                            </select>
                        </div>
                      </div>
                    </div>
                </div>
                
                <br>
                <span>Acquired from</span>
                <div class="row">
                    <div class="col-md-8" style = "margin: 0px; padding: 0px;">
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">
                                  Acquired from
                              </span>
                          </div>
                          <input type="text" id="acquired_from" name="acquired_from" class="form-control" placeholder="" required>
                      </div>
                  </div>
                </div><br>
                <span>Basic info</span>
                <div class = "row">
                    <div class = "col-md-6" style = "margin: 0px; padding: 0px;">
                      <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Brand</span>
                        </div>
                        <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" name = "manufacturer">  
                      </div>
                    </div>
                  <div class = "col-md-6" style = "margin: 0px; padding: 0px;">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Model</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name = "model">  
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
                      <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" name = "location">  
                    </div>
                  </div>
                 </div> 
               </div>
               <br /> 
                <span>Serials</span>              
                <div class="row">
                  <div class="col-md-2">
                      <div class="form-group">
                          <a class="btn btn-circle btn-sm btn-success" onclick="onSerialAdd()"><i class="fa fa-plus"></i></a>
                          <a class="btn btn-circle btn-sm btn-danger" onclick="removeSerial()"><i class="fa fa-times"></i></a>
                      </div>
                  </div>
                </div>
                <input type="hidden" name="serial_count" id="serial_count" value="1">
                <div id="adult">
                  <div class="row">
                      <div class="input-group" style="margin: 5px; padding: 5px;">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Serial Number1</span>
                        </div>
                        <input type="text" class="form-control" id="serial" name="serial1">  
                      </div>
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
                            <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name = "input_price"> 
                        </div>
                      </div>
                      <div class = "col-md-6" style = "margin: 0px; padding: 0px;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">VAT(%) </span>
                            </div>
                            <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name = "vat_value"> 
                        </div>
                      </div>
                      
                    </div>
                    <div class = "col-md-6" style = "display: flex; margin:0px; padding: 0px;">
                      <div class = "col-md-6" style = "margin: 0px; padding: 0px;">
                        <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">Interest</span>
                          </div>
                          <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name = "interest"> 
                        </div>  
                      </div>
                      <div class = "col-md-6" style = "margin: 0px; padding: 0px;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Final price</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name = "final_price"> 
                        </div>
                      </div>
                    </div>
                </div>
                <br />
                <span>Note</span>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                          <textarea class="form-control" rows="8" name = "stock_note"></textarea>
                          <small class="form-control-feedback"><a href="javascript:void(0)"> </a></small> </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                    <a href = "{{URL::to('stock/resetAction')}}"><button type="button" class="btn btn-warning">Reset</button></a>
                </div>              
        </div>
    </div>    
</div>
</form>

<!-- End Container fluid  -->
@endsection

@push('footer-script')

<script src="{{ asset('js/dashboard.js')}}"></script>

<script>

  var room = 1;
  function onSerialAdd()
  {
    room ++;
    $("#serial_count").val(room);
    var objTo = document.getElementById("adult");
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "row removeclass" + room);
    divtest.innerHTML = '<div class="input-group" style="margin:5px;padding:5px;"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Serial Number'+room+'</span></div><input type="text" class="form-control" id="serial" name="serial'+room+'"></div>';

    console.log(divtest);

    objTo.appendChild(divtest);
  }
  function removeSerial()
  {
    $('.removeclass' + room).remove();
    room --;
    if (room < 1) {
      room = 1;
    }
    $('#serial_count').val(room);
  }

</script>

@endpush