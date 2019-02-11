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
    <h1>Update Invoice</h1>
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal2"
                data-whatever="@mdo"><i class="fa fa-plus"></i> Select Job</button>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal3"
                data-whatever="@mdo"><i class="fa fa-plus"></i> Add custom</button>
            <br />
            <br />
            <div class="row">
                <div class="col-md-6">
                    <span>Client</span>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Client</span>
                        </div>
                    <input type="text" class="form-control" name="client_name" id="client_name" value="{{ $invoice->client_name }}" />
                    <input type="hidden" class="form-control" name="update_invoice_id" id="update_invoice_id" value="{{ $invoice->id }}" />
                    <input type="hidden" class="form-control" name="update_job_id" id="update_job_id" value="{{ $job_id }}" />
                    <input type="hidden" class="form-control" name="update_job_status" id="update_job_status" value="{{ $job_status }}" />
                    <input type="hidden" class="form-control" name="quote_id" id="quote_id" value="{{ $invoice->invoice_id }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <span>Service</span>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Service</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1"
                    name="service_name" id="service_name" value="{{ $invoice->service }}"/>
                    </div>
                </div>
            </div>
            <br>
            <span>Invoice language</span>
            <div class="row">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Language</span>
                    </div>
                    <select class="custom-select col-12 invoice_language" id="invoice_language" name="invoice_language">
                        
                        <option <?php echo $invoice->invoice_language == 'English' ? 'selected' : '';?> value="English">English</option>
                        <option <?php echo $invoice->invoice_language == 'Arabic' ? 'selected' : '';?> value="Arabic">Arabic</option>
                        
                    </select>
                </div>
            </div>
            <br>
            <span>Currency</span>
            <div class="row">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Currency</span>
                    </div>
                    <select class="custom-select col-12 currency" id="currency" name="currency">
                      
                            <option <?php echo $invoice->currency == 'INR' ? 'selected' : '';?> value="INR">INR</option>
                            <option <?php echo $invoice->currency == 'RO' ? 'selected' : '';?> value="RO">RO</option>
                            <option <?php echo $invoice->currency == 'Dhs' ? 'selected' : '';?> value="Dhs">Dhs</option>
                            <option <?php echo $invoice->currency == 'USD' ? 'selected' : '';?> value="USD">USD</option>
                            <option <?php echo $invoice->currency == 'EU' ? 'selected' : '';?> value="EU">EU</option> 
                    </select>
                </div>
            </div>
            <br />
            <span>Invoice items</span>

            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="invoice_item_mainTable" class="table editable-table table-bordered table-striped m-b-0">
                                        <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Capacity</th>
                                                <th>Price</th>
                                                <th>VAT(%)</th>
                                                <th>Discount(%)</th>
                                                <th>Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody id="invoie_items_table">
                                           
                                            <tr>
                                            <td id="item_type">{{ $invoice->item_type }}</td>
                                            <td id="item_capacity">{{ $invoice->item_capacity }}</td>
                                            <td id="item_price">{{ $invoice->item_price }}</td>
                                            <td id="item_vat">{{ $invoice->item_vat }}</td>
                                            <td id="item_disaccount">{{ $invoice->item_disaccount }}</td>
                                            <td id="item_total_price">{{ $invoice->item_total_price }}</td>
                                            </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <span>Back up Item</span>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="backupTable" class="table editable-table table-bordered table-striped m-b-0">
                                        <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Capacity</th>
                                                <th>Price</th>
                                                <th>VAT(%)</th>
                                                <th>Discount(%)</th>
                                                <th>Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <td id="backup_type">{{ $backupItem->type }}</td>
                                                <td id="backup_capacity">{{ $backupItem->capacity }}</td>
                                                <td id="backup_price">{{ $backupItem->price }}</td>
                                                <td id="backup_vat">{{ $backupItem->vat }}</td>
                                                <td id="backup_disaccount">{{ $backupItem->disaccount }}</td>
                                                <td id="backup_total_price">{{ $backupItem->total_price }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- <span>Footer text</span>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="summernote" name="footer_text" id="footer_text">

                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}



                <span>Note</span>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                        <textarea class="form-control invoice_note" rows="8" name="invoice_note" id="invoice_note">{{ $invoice->invoice_note }}</textarea>
                            <small class="form-control-feedback"><a href="javascript:void(0)"> </a></small></div>
                    </div>
                </div>

                <div class="form-actions">
                <button type="button" class="btn btn-success" id="jobPost"><i class="fa fa-check"></i>Update</button>

                    <a href="{{URL::to('invoice/resetAction')}}"><button type="button" class="btn btn-warning">Reset</button></a>
                </div>

                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel1">Add job</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">

                                <input type="hidden" name="invoice_id" value="{{ $invoice_id }}" id="invoice_id" />
                                <div class="form-group">
                                    <label for="message-text" class="control-label">Job ID:</label>
                                    <input type="text" class="form-control" id="itemJobID" name="job_id">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Type:</label>
                                    <input type="text" class="form-control" id="itemType" name="type">
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
                                    <button type="button" class="btn btn-primary" id="jobDetail">Save</button>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
 
                        <form>
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel2">Select JobID</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">                                                                                  
                                  <div class="card">
                                      <div class="card-body">   
                                          <div id="scrollable-dropdown-menu">
                                            <input class="typeahead form-control" type="text" placeholder="JobID" id="invoice_job_id" name="invoice_job_id" class="typeahead form-control">
                                          </div>
                                      </div>
                                  </div>                                                               
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id = "select_job_id" data-dismiss="modal">select</button>
                            </div>
                        </form>
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

<!-- editable table -->
<script src="{{ asset('js/jquery-datatables-editable/jquery.dataTables.js')}}"></script>
<script src="{{ asset('js/jquery-datatables-editable/dataTables.bootstrap.js')}}"></script>
<script src="{{ asset('js/jquery-datatables-editable/mindmup-editabletable.js')}}"></script>
<script src="{{ asset('js/jquery-datatables-editable/numeric-input-example.js')}}"></script>

<!-- Typehead Plugin JavaScript -->
<script src="{{ asset('js/typeahead.bundle.min.js')}}"></script>
{{-- <script src="{{ asset('js/typeahead-init.js')}}"></script> --}}


<!-- end - This is for export functionality only -->
<script>
    $(document).ready(function () {
        var substringMatcher = function(strs) {
        return function findMatches(q, cb) {
            var matches, substringRegex;

            // an array that will be populated with substring matches
            matches = [];

            // regex used to determine if a string contains the substring `q`
            substrRegex = new RegExp(q, 'i');

            // iterate through the pool of strings and for any string that
            // contains the substring `q`, add it to the `matches` array
            $.each(strs, function(i, str) {
            if (substrRegex.test(str)) {
                matches.push(str);
            }
            });

            cb(matches);
        };
        };

        var states = [];
        

        $('#the-basics .typeahead').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
        },
        {
        name: 'states',
        source: substringMatcher(states)
        });

        // ---------- Bloodhound ----------

        // constructs the suggestion engine
        var states = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        // `states` is an array of state names defined in "The Basics"
        local: states
        });

        $('#bloodhound .typeahead').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
        },
        {
        name: 'states',
        source: states
        });


        // -------- Prefatch --------

        var countries = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        // url points to a json file that contains an array of country names, see
        // https://github.com/twitter/typeahead.js/blob/gh-pages/data/countries.json
        prefetch: '../plugins/bower_components/typeahead.js-master/countries.json'
        });

        // passing in `null` for the `options` arguments will result in the default
        // options being used
        $('#prefetch .typeahead').typeahead(null, {
        name: 'countries',
        source: countries
        });

        // -------- Custom --------

        var nflTeams = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('team'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        identify: function(obj) { return obj.team; },
        prefetch: '../plugins/bower_components/typeahead.js-master/nfl.json'
        });

        function nflTeamsWithDefaults(q, sync) {
        if (q === '') {
            sync(nflTeams.get('Detroit Lions', 'Green Bay Packers', 'Chicago Bears'));
        }

        else {
            nflTeams.search(q, sync);
        }
        }

        $('#default-suggestions .typeahead').typeahead({
        minLength: 0,
        highlight: true
        },
        {
        name: 'nfl-teams',
        display: 'team',
        source: nflTeamsWithDefaults
        });

        // -------- Multiple --------

        var nbaTeams = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('team'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: '../plugins/bower_components/typeahead.js-master/nba.json'
        });

        var nhlTeams = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('team'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: '../plugins/bower_components/typeahead.js-master/nhl.json'
        });

        $('#multiple-datasets .typeahead').typeahead({
        highlight: true
        },
        {
        name: 'nba-teams',
        display: 'team',
        source: nbaTeams,
        templates: {
            header: '<h3 class="league-name">NBA Teams</h3>'
        }
        },
        {
        name: 'nhl-teams',
        display: 'team',
        source: nhlTeams,
        templates: {
            header: '<h3 class="league-name">NHL Teams</h3>'
        }
        });
            
        // -------- Scrollable --------



        $('#scrollable-dropdown-menu .typeahead').typeahead(null, {
        name: 'states',
        limit: 10,
        source: states
        });


        var invoice_language, currency;


        
        $("select.invoice_language").change(function () {
            var data = $(this).children("option:selected").val();
            invoice_language = data;

        });
        $("select.currency").change(function () {
            var data = $(this).children("option:selected").val();
            currency = data;
        });

        //jobpost with datatable.
        $('#jobPost').on('click', function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            e.preventDefault(e);
            var quote_id = $("#quote_id").val();
            var update_job_status = $("#update_job_status").val();
            var update_job_id = $("#update_job_id").val();
            var update_invoice_id = $("#update_invoice_id").val();
            var invoice_id = $("#invoice_id").val();
            var client_name = $("#client_name").val();
            var job_status = $("#job_status").val();
            var service_name = $("#service_name").val();
            var invoice_note = $("textarea#invoice_note").val();

            var item_type = $("#item_type").text();
            var item_capacity = $("#item_capacity").text();
            var item_price = $("#item_price").text();
            var item_vat = $("#item_vat").text();
            var item_disaccount = $("#item_disaccount").text();
            var item_total_price = $("#item_total_price").text();


            var backup_type = $("#backup_type").text();
            var backup_capacity = $("#backup_capacity").text();
            var backup_price = $("#backup_price").text();
            var backup_vat = $("#backup_vat").text();
            var backup_disaccount = $("#backup_disaccount").text();
            var backup_total_price = $("#backup_total_price").text();

            var invoice_job_id = $("#invoice_job_id").val();
      
            console.log('sdfasdf', update_job_status);

            $.ajax({
                url: '/invoice/updateAction',
                type: 'POST',
                dataType: 'json',
                data: {
                    update_job_status: update_job_status,
                    update_job_id: update_job_id,
                    update_invoice_id: update_invoice_id,
                    invoice_id: invoice_id,
                    client_name: client_name,
                    job_status: job_status,
                    service_name: service_name,
                    invoice_note: invoice_note,
                    invoice_language: invoice_language,
                    currency: currency,
                    item_type: item_type,
                    item_capacity: item_capacity,
                    item_price: item_price,
                    item_vat: item_vat,
                    item_disaccount: item_disaccount,
                    item_total_price: item_total_price,
                    backup_type: backup_type,
                    backup_capacity: backup_capacity,
                    backup_price: backup_price,
                    backup_vat: backup_vat,
                    backup_disaccount: backup_disaccount,
                    backup_total_price: backup_total_price,
                    invoice_job_id: invoice_job_id                                     
                },
                success: function(data) {
                    console.log(data);
                    window.location = "/quote/allview";
                }
            });
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


        var table = $('#invoiceItemList').DataTable({
            "displayLength": 25,
            "columnDefs": [{
                "targets": -1,
                "data": null,
                "defaultContent": "<button class='btn btn-youtube waves-effect btn-circle waves-light' type='button'> <i class='fa fa-trash' aria-hidden='true'></i> </button>"
            }],
            "drawCallback": function (settings) {
            }
        });
        // Order by the grouping
        $('#example tbody').on('click', 'tr.group', function () {
            var currentOrder = table.order()[0];
            if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                table.order([2, 'desc']).draw();
            } else {
                table.order([2, 'asc']).draw();
            }
        });

        $('#invoiceItemList tbody').on('click', 'button', function () {
            var table = $('#invoiceItemList').DataTable();
            var rowToDel = table.row($(this).parents('tr'));
            rowToDel.remove();
            table.draw();
        });


        $('#example23').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

        window.edit = function () {
            $(".click2edit").summernote()
        },
            window.save = function () {
                $(".click2edit").summernote('destroy');
            }

        //editable table
        $('#invoice_item_mainTable').editableTableWidget().find('td:first').focus();
        $('#backupTable').editableTableWidget().find('td:first').focus();
        $('#editable-datatable').editableTableWidget().find('td:first').focus();
        $(document).ready(function () {
            $('#editable-datatable').DataTable();
        });

        // //post with selected job_id
        $("#select_job_id").on('click', function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            e.preventDefault(e);
            var invoice_job_id = $("#invoice_job_id").val();
            $.ajax({
                type: 'POST',
                url: '/invoice/getdetailjob',
                data: {
                    invoice_job_id: invoice_job_id
                },
                success: function(data) {   
                    console.log(data);               
                    var invoiceJobDetails = data.invoiceJobDetail;
                    var invoiceItems = data.invoiceitems;
                    var client_name = invoiceJobDetails.client_name;
                    var job_status = invoiceJobDetails.status;
                    var services = invoiceJobDetails.services;
                    var invoice_items_type = invoiceItems.type;
                    var invoice_items_capacity = invoiceItems.capacity;

                    $("#client_name").val(client_name);
                    $("#job_status").val(job_status);
                    $("#service_name").val(services);
                    $('#item_type').html(invoice_items_type);
                    $('#item_capacity').html(invoice_items_capacity);

                }
            }); 
        });
        

        $("#baup_modal_save").on('click', function(){
            var backup_type = $("#modal_type").val();
            var backup_capacity = $("#modal_capacity").val();
            var backup_price = $("#modal_price").val();
            var backup_vat = $("#modal_vat").val();
            var backup_disaccount = $("#modal_disaccount").val();
            var backup_total_price = $("#modal_total_price").val();

            $("#backup_type").html(backup_type);
            $("#backup_capacity").html(backup_capacity);
            $("#backup_price").html(backup_price);
            $("#backup_vat").html(backup_vat);
            $("#backup_disaccount").html(backup_disaccount);
            $("#backup_total_price").html(backup_total_price);
        });

        $("#item_total_price").on('click', function() {
            var item_price = $("#item_price").text();
         
            var item_disaccount = $("#item_disaccount").text();
            var item_total_price = Number(item_price)-Number(item_disaccount);
            $("#item_total_price").html(item_total_price);


        });

        $("#backup_total_price").on('click', function() {
            var backup_price = $("#backup_price").text();
         
            var backup_disaccount = $("#backup_disaccount").text();
            var backup_total_price = Number(backup_price)-Number(backup_disaccount);
            $("#backup_total_price").html(backup_total_price);


        });



  
    });        
</script>

<script src="{{ asset('js/jQuery.style.switcher.js')}}"></script>

@endpush