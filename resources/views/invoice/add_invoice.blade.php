@extends('layouts.layout')

@push('header-style')
<style>
.table-responsive {
    overflow-x: hidden;
}
</style>
@endpush

@section('content')
<!-- Container fluid  -->
<div class="container-fluid">
<h1>New Invoice</h1>
<div class="row">
        <div class="col-sm-12 col-xs-12">
          <form action="{{ route('createInvoice') }}" method="post">
          @csrf
            <button type="button" class="btn btn-info"><i class="fa  fa-pencil"></i>Change Client</button>
            <br />
            <br />
            <span>Client</span>
                <div class = "row">                   
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">Client</span>
                          </div>
                          <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" name = "client_name">  
                      </div>                                       
                </div>
                
                <br>
                <span>Invoice language</span>
                <div class = "row">
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text">Language</span>
                      </div>
                      <select class="custom-select col-12" id="inlineFormCustomSelect" name = "invoice_language">
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
                <br>
                <span>Currency</span>
                <div class = "row">
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text">Currency</span>
                      </div>
                      <select class="custom-select col-12" id="inlineFormCustomSelect" name = "currency">
                        <option selected="">Choose...</option>
                        <option value="1">Peso</option>
                        <option value="2">Australia Dollar</option>
                        <option value="3">Bahamas Dollar</option>
                        <option value="4">Belize Dollar</option>
                        <option value="5">Brazil Dollar</option>
                        <option value="6">Pound</option>
                        <option value="7">Canada Dollar</option>
                        <option value="8">Cayman Dollar</option>

                        <option value="9">China Yuan</option>
                        <option value="10">Euro</option>
                        <option value="11"> Rupee</option>
                        <option value="12">Rupiah</option>
                        <option value="13">Yen</option>                    
                    </select>
                  </div>
                </div>     
               <br /> 
               <span>Invoice items</span>

               <div class="card-body">                   
                    <!-- sample modal content -->
                    <div class="button-box">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal1" data-whatever="@mdo"><i class="fa fa-plus"></i> Add job</button>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal2" data-whatever="@mdo"><i class="fa fa-plus"></i> Add from stock</button>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal3" data-whatever="@mdo"><i class="fa fa-plus"></i> Add custom</button>
                        <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Delete selected</button>                       
                    </div>                    
                <div class="row">
                        <div class="col-12">
                            <div class="card">
                            <div class="card-body">
                            
                                <div class="table-responsive">
                                    <table id="invoiceItemList" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>                                
                                                <th>Type</th>
                                                <th>Text</th>
                                                <th>Price</th>
                                                <th>VAT(%)</th>
                                                <th>Discount(%)</th>
                                                <th>Total price</th>
                                                <th>Action</th>                                 
                                            </tr>
                                        </thead>
                                        <tbody id="invoiceItems"> 
                                            {{-- <tr id="blankItem">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>                              
                                                <td>
                                                <button class="btn btn-youtube waves-effect btn-circle waves-light" type="button"> <i class="fa fa-trash" aria-hidden="true"></i> </button>
                                                </td>
                                            </tr>
                                                                            --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>
                 
                    <span>Footer text</span>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="summernote" name = "footer_text">
                                       
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>

                    <span>Note</span>
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="form-group">
                            <textarea class="form-control" rows="8" name = "invoice_note"></textarea>
                            <small class="form-control-feedback"><a href="javascript:void(0)"> </a></small></div>
                        </div>
                    </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-success" id = "jobPost"><i class="fa fa-check"></i> Save</button>
                    <a href = "{{URL::to('stock/resetAction')}}"><button type="button" class="btn btn-warning">Reset</button></a>
                </div>              
          </form>
          <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel1">Add job</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            
                            <input type="hidden" name="invoice_id" value="{{ $unique_id }}" id = "invoice_id" />
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Type:</label>
                                <input type="text" class="form-control" id="itemType" name = "type">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Text:</label>
                                <input type="text" class="form-control" id="itemText" name="text">
                            </div>
                            <div class="form-group">
                                    <label for="message-text" class="control-label">Price:</label>
                                    <input type="text" class="form-control" id="itemPrice" name="price">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">VAT(%):</label>
                                <input type="text" class="form-control" id="itemVat" name="VAT">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Discount(%):</label>
                                <input type="text" class="form-control" id="itemDisaccount" name="disaccount">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Total price:</label>
                                <input type="text" class="form-control" id="itemTotalPrice" name="total_price">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id = "jobDetail">Save</button>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel2">New message</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="recipient-name" class="control-label">Recipient:</label>
                                        <input type="text" class="form-control" id="recipient-name1">
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
           
            </div>
            <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel3">New message</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="recipient-name" class="control-label">Recipient:</label>
                                        <input type="text" class="form-control" id="recipient-name1">
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="control-label">Message:</label>
                                        <textarea class="form-control" id="message-text1"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>    
</div>
<!-- End Container fluid  -->
@endsection

@push('footer-script')

<script src="{{ asset('js/jobstatues.js')}}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js')}}"></script>
 <!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<!-- end - This is for export functionality only -->
<script>
    $(document).ready(function() {
        jQuery('#jobDetail').click(function(e){
            
            var list = $("#invoiceItemList").DataTable();
            list.row.add([
                $("#itemType").val(),
                $("#itemText").val(),
                $("#itemPrice").val(),
                $("#itemVat").val(),
                $("#itemDisaccount").val(),
                $("#itemTotalPrice").val(),
                " "
            ]).draw(true);
                        

        });

        $('.summernote').summernote({
                    height: 350, // set editor height
                    minHeight: null, // set minimum height of editor
                    maxHeight: null, // set maximum height of editor
                    focus: false // set focus to editable area after initializing summernote
                });
        
                $('.inline-editor').summernote({
                    airMode: true
                });
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#invoiceItemList').DataTable({
                "displayLength": 25,
                "columnDefs": [ {
                    "targets": -1,
                    "data": null,
                    "defaultContent": "<button class='btn btn-youtube waves-effect btn-circle waves-light' type='button'> <i class='fa fa-trash' aria-hidden='true'></i> </button>"
                } ],
                "drawCallback": function(settings) {
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
        $('#invoiceItemList tbody').on( 'click', 'button', function () {
            var table = $('#invoiceItemList').DataTable();
            var rowToDel = table.row( $(this).parents('tr') );
            rowToDel.remove();
            table.draw();                   
        } );
        
      
    });

        //jobpost with datatable.
        $('#jobPost').on('click', function() {
                       
            var table = $('#invoiceItemList').DataTable();
            var jobFormData = table.rows().data();
            $.each( jobFormData, function( key, value ) {
              console.log(JSON.stringify(jobFormData));
            });
                     
        });
    
        $('#example23').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

        window.edit = function() {
            $(".click2edit").summernote()
        },
        window.save = function() {
            $(".click2edit").summernote('destroy');
        }


             
    </script>
  
    <script src="{{ asset('js/jQuery.style.switcher.js')}}"></script>

@endpush