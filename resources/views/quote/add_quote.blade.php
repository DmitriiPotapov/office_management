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
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">New Quote</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal2"
                data-whatever="@mdo"><i class="fa fa-plus"></i> Select Job</button>
            <br />
            <br />
            <div class="row">
                <div class="col-md-6">
                    <span>Client</span>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Client</span>
                        </div>
                        <input type="text" class="form-control" name="client_name" id="client_name" value="" />
                        <input type="hidden" class="form-control" name="job_status" id="job_status" value="" />
                    </div>
                </div>
                <div class="col-md-6">
                    <span>Service</span>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Service</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1"
                    name="service_name" id="service_name" value=""/>
                    </div>
                </div>
            </div>
            <br>
            <span>Quote language</span>
            <div class="row">
                <div class="col-md-12">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Language</span>
                    </div>
                    <select class="custom-select invoice_language" id="invoice_language" name="invoice_language">
                      
                        <option value="English">English</option>
                        <option value="Arabic">Arabic</option>                     
                    </select>
                </div>
                </div>
            </div>
            <br>
            <span>Currency</span>
            <div class="row">
                <div class="col-md-12">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Currency</span>
                    </div>
                    <select class="custom-select currency" id="currency" name="currency">                    
                        <option value="INR">INR </option>
                        <option value="RO">RO </option>
                        <option value="Dhs">Dhs </option>
                        <option value="USD">USD </option>
                        <option value="EU">EU   </option>          
                    </select>
                </div>
                </div>
            </div>
            <br />
            

            <div class="card-body">
                <span>Quote items</span>
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
                                                
                                                <th>Discount(%)</th>
                                                <th>Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody id="invoie_items_table">
                                           
                                            <tr>
                                            <td id="item_type"></td>
                                            <td id="item_capacity"></td>
                                            <td id="item_price"></td>
                                            
                                            <td id="item_disaccount"></td>
                                            <td id="item_total_price" value = "item_total_price"></td>
                                            </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                



                <span>Note</span>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea class="form-control quote_note" rows="8" name="quote_note" id="quote_note"></textarea>
                            <small class="form-control-feedback"><a href="javascript:void(0)"> </a></small></div>
                    </div>
                </div>

                <div class="form-actions">
                <button type="button" class="btn btn-success" id="jobPost"><i class="fa fa-check"></i> Save</button>

                    <a href="{{URL::to('quote/resetAction')}}"><button type="button" class="btn btn-warning">Reset</button></a>
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

                                <input type="hidden" name="quote_id" value="{{ $unique_id }}" id="quote_id" />
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
                                            <input class="typeahead form-control" type="text" placeholder="JobID" id="quote_job_id" name="quote_job_id" class="typeahead form-control">
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
            <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel3">Insert Quote Item</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="message-text" class="control-label">Type:</label>
                                <input type="text" class="form-control" id="modal_type" name="model_type">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Capacity:</label>
                                <input type="text" class="form-control" id="modal_capacity" name="modal_capacity">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Price:</label>
                                <input type="text" class="form-control" id="modal_price" name="modal_price">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">VAT(%):</label>
                                <input type="text" class="form-control" id="modal_vat" name="modal_vat">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Discount(%):</label>
                                <input type="text" class="form-control" id="modal_disaccount" name="modal_disaccount">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Total price:</label>
                                <input type="text" class="form-control" id="modal_total_price" name="modal_total_price">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal" id="baup_modal_save">Save</button>
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
        @foreach ($jobIds as $item)
            states.push("{{ $item }}");
        @endforeach

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


        var quote_language, currency;


        
        $("select.invoice_language").change(function () {
            var data = $(this).children("option:selected").val();
            quote_language = data;

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
            var client_name = $("#client_name").val();
            var job_status = $("#job_status").val();
            var service_name = $("#service_name").val();
            var quote_note = $("textarea#quote_note").val();

            var item_type = $("#item_type").text();
            var item_capacity = $("#item_capacity").text();
            var item_price = $("#item_price").text();
         
            var item_disaccount = $("#item_disaccount").text();
            var item_total_price = $("#item_total_price").text();


        
            var quote_job_id = $("#quote_job_id").val();
     
            $.ajax({
                url: '/quote/createAction',
                type: 'POST',
                dataType: 'json',
                data: {
                    quote_id: quote_id,
                    client_name: client_name,
                    job_status: job_status,
                    service_name: service_name,
                    quote_note: quote_note,
                    quote_language: quote_language,
                    currency: currency,
                    item_type: item_type,
                    item_capacity: item_capacity,
                    item_price: item_price,
        
                    item_disaccount: item_disaccount,
                    item_total_price: item_total_price,
                    quote_job_id: quote_job_id                                     
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
            var quote_job_id = $("#quote_job_id").val();
            $.ajax({
                type: 'POST',
                url: '/quote/getdetailjob',
                data: {
                    quote_job_id: quote_job_id
                },
                success: function(data) {   
                    console.log(data);               
                    var quoteJobDetails = data.quoteJobDetail;
                    var quoteItems = data.quoteitems;
                    var client_name = quoteJobDetails.client_name;
                    var job_status = quoteJobDetails.status;
                    var services = quoteJobDetails.services;
                    var quote_items_type = quoteItems.type;
                    var quote_items_capacity = quoteItems.capacity;

                    $("#client_name").val(client_name);
                    $("#job_status").val(job_status);
                    $("#service_name").val(services);
                    $('#item_type').html(quote_items_type);
                    $('#item_capacity').html(quote_items_capacity);

                }
            }); 
        });


        $("#item_total_price").on('click', function() {
            var item_price = $("#item_price").text();
         
            var item_disaccount = $("#item_disaccount").text();
            var item_total_price = Number(item_price)-Number(item_disaccount);
            $("#item_total_price").html(item_total_price);


        })
        

    
  
    });        
</script>

<script src="{{ asset('js/jQuery.style.switcher.js')}}"></script>

@endpush