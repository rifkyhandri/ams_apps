@extends('layouts.dashboard')
@section('content')
@include('asset_transactions.asset_transactions_modal')
@include('asset.modalregister')
@section('link')
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@600&display=swap" rel="stylesheet">
@stop
<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div style="height: 65px; " class="card">
            <div class="card-body">
                <div style="display: flex; align-items: flex-start; justify-content: space-between; height: 40px;">
                    <h1 class="card-title" style="font-size: 30px;"><span  style="font-size: 30px;font-family:'Oswald', sans-serif;color: black">Asset Transaction</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div class="card" style="border-radius: 15px;">
            <div class="card-body">
                    <div style="display: flex; align-items: flex-start; justify-content: space-between;">
                        {{-- <h4 class="card-title" style="font-size: 2rem; font-weight: 300; margin-bottom: 0px;">Filter</h4> --}}
                        <form action="#" id="searchasset">
                            <div class="row col-12">
                                <div class="form-group col-4">
                                    <label>Tag Number</label>
                                    <select name="filtertagnumber" id="filtertagnumber" class="form-control form-control-sm" onchange="table_reload()">
                                    <option value="" selected>Select tag number</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                <div class="row">
                    <div class="col-12">
                    <div class="table-responsive">
                        <table id="assetTable" class="table">
                        <thead>   
                            <tr>
                                <th>No</th>
                                <th style="width: 100px;">Asset Code</th>
                                <th style="width: 500px;">Description</th>
                                <th style="width: 500px;">Departement</th>
                                <th style="width: 500px;">Asset Group</th>
                                <th style="width: 500px;">Location</th>
                                <th style="width: 500px;">Cost Center</th>
                                <th style="width: 500px;">Custodian</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        </table>
                    </div>
                    </div>
                </div>
                </div>
            </div>
    </div>
</div>
@endsection
@section('jscustom')
<style>
.wizard>.content{
        display:block;
        min-height:35em;
        overflow-y: auto;
        position:relative;
    }
</style>
<script src="{{ asset('js/wizard.js') }}"></script>
<script src="{{ asset('js/file-upload.js') }}"></script>
<script src="{{ asset('js/typeahead.js') }}"></script>
<script src="{{ asset('js/select2.js') }}"></script>
<script>
     var detail;
     var mTable;
    

     $(document).ready(function () {

        buildSelect();

        //RENDER DATA TABLES
        mTable = $('#assetTable').DataTable({
            responsive: true,
            processing: true,
            "language": {
                "processing": "<div class='dot-opacity-loader'></div>"
            },
            "order": [[ 0, "desc" ]],
            serverSide: true,
            ajax: "{{ route('asset_list')}}",
            // data: filter_asset,
            columns: [
                {  data: 'asset_id',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'tangnumber',
                    name: 'tangnumber'
                },
                {
                    data: 'assetname',
                    name: 'assetname'
                },
                {
                    data: 'objdepartement',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return data.departementdesc;
                        }
                    }
                },
                {
                    data: 'objcostgroup',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return data.groupname;
                        }
                    }
                },
                {
                    data: 'objlocation',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return data.location_sub.locationname_sub+' | '+data.locationname_sm;
                        }
                    }
                },
                {
                    data: 'objcostcenter',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return data.costcenterdesc;
                        }
                    }
                },
                {
                    data: 'objcustodian',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return data.custodianname;
                        }
                    }
                },
                {
                    data: 'asset_id',
                    render: function (data, type, row) {
                        
                        let buttonAction   = '<div class="dropdown">'+
                          '<button type="button" class="btn btn-info dropdown-toggle" style="color:white; font-size:1.5rem; margin-left:-7px;margin-top:5px" id="dropdownMenuIconButton8" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
                            '<i class="ti-settings" style="color:white; font-size:1.3rem; margin-left:-7px;margin-top:5px"></i>'+
                          '</button>'+
                          '<div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton8">'+
                            '<h6 class="dropdown-header">Transactions</h6>'+
                            '<a class="dropdown-item" data-toggle="modal" data-target="#showModalInsertDisposal" onclick="set_modal_disposal(\''+row.tangnumber+'\',\''+data+'\')">Disposal</a>'+
                            '<a class="dropdown-item" data-toggle="modal" data-target="#showModalInsertWriteoff" onclick="set_modal_writeoff(\''+row.tangnumber+'\',\''+data+'\')">Write Off</a>'+
                            '<a class="dropdown-item" data-toggle="modal" data-target="#showModalInsertRevalue" onclick="set_modal_revalue(\''+row.tangnumber+'\',\''+data+'\')">Revalue</a>'+
                            '<a class="dropdown-item" data-toggle="modal" data-target="#showModalInsertRelocation" onclick="buttonEdit(\'' + data + '\')">Move</a>'+
                            '<div class="dropdown-divider"></div>'+
                            '<a class="dropdown-item"data-toggle="modal" data-target="#showModalInsertStockTake" onclick="set_modal_stock(\''+row.tangnumber+'\',\''+data+'\')">Stock Take</a>'+
                          '</div>'+
                        '</div>';

                        return buttonAction;
                    }
                }
               
            ]
        });

        detail = $('#detailValue').DataTable({
            responsive: true,
            processing: true,
            "language": {
                "processing": "<div class='dot-opacity-loader'></div>"
            },
            // "order": [[ 0, "asc" ]],
            serverSide: true,
            ajax: "{{ url('/') }}/"+"assetclass"+"/create",
            "columnDefs": [ 
                {
                    "render": function (data, type, row, meta ) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    "targets": 0
                },
                {
                    "render": function ( data, type, row ) {
                    var result = [];
                    for(var i in row)
                        result.push(row[i]);
                    return result[2];
                    },
                    "targets": 1
                },
                {
                    "render": function ( data, type, row,meta ) {
                    var flag = meta.settings.ajax.split("/");
                        flag = flag[3];

                    var result = [];

                    for(var i in row)
                        result.push(row[i]);
                    
                    let buttonAdd =
                        '<button type="button" class="btn btn-primary btn-rounded btn-icon" data-placement="button" data-custom-class="tooltip-success" title="ADD" style="margin-right:5px;" onclick="buttonAdd(\''+ result[1] +'-'+result[2]+'\',\''+ flag +'\');"><i style="font-size:1.5rem; margin-left:-7px;" class="fa fa-plus"></i></button>';
                    
                    return buttonAdd;
                    },
                    "targets": 2
                },
            ]
        });

        detail_location = $('#detailLocation').DataTable({
            responsive: true,
            processing: true,
            "language": {
                "processing": "<div class='dot-opacity-loader'></div>"
            },
            // "order": [[ 0, "asc" ]],
            serverSide: true,
            ajax: "{{ url('/') }}/"+"smlocation"+"/create",
            "columnDefs": [ 
                {
                    "render": function (data, type, row, meta ) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    "targets": 0
                },
                {
                    "render": function ( data, type, row ) {
                        if(_.isNull(row.location_big)){
                            return null;
                        }else{
                            return row.location_big.locationname;
                        }
                    },
                    "targets": 1
                },
                {
                    "render": function ( data, type, row ) {
                        if(_.isNull(row.location_sub)){
                            return null;
                        }else{
                            return row.location_sub.locationname_sub;
                        }
                    },
                    "targets": 2
                },
                {
                    "render": function ( data, type, row ) {
                        if(_.isNull(row)){
                            return null;
                        }else{
                            return row.locationname_sm;
                        }
                    },
                    "targets": 3
                },
                {
                    "render": function ( data, type, row,meta ) {
                    var flag = meta.settings.ajax.split("/");
                        flag = flag[3];

                    if(_.isNull(row.locationcode_sm)){
                        return null;
                    }else{
                        var code = row.locationcode_sm;
                        var name = row.locationname_sm;
                        var sub  = (_.isNull(row.location_sub.locationname_sub) ? null : row.location_sub.locationname_sub)
                        var big  = (_.isNull(row.location_big.locationname_big) ? null : row.location_big.locationname_big)
                    }
                    
                    let buttonAdd =
                        '<button type="button" class="btn btn-primary btn-rounded btn-icon" data-placement="button" data-custom-class="tooltip-success" title="ADD" style="margin-right:5px;" onclick="buttonAdd(\''+ code +'-'+sub+
                        ' | '+name+'\',\''+ flag +'\');"><i style="font-size:1.5rem; margin-left:-7px;" class="fa fa-plus"></i></button>';
                    
                    return buttonAdd;
                    },
                    "targets": 4
                },
            ]
        });
           
     });

     function buttonAdd(result,flag){
        
        var result = result.split('-');
        
        $('.'+flag).children("option:selected").html(result[1]).val(result[0]);
        $('#closeModalDetailValue').click();
        $('#closeModalDetailLocation').click();
    }
     function detail_value(route){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("input[name='_token']").val()
            }
        });
        $.ajax({
            type: "GET",
            url: "{{ url('/') }}/"+route+"/create",
            success: function (data) {
                $('#showModalDetailValue').modal();
                detail.ajax.url("{{ url('/') }}/"+route+"/create").load();
                // generate_table(route);
            },
            error: function(response) {
                try {
                    $.toast({
                        heading: 'Danger',
                        text: 'Gagal mendapatkan data terkait.',
                        showHideTransition: 'slide',
                        icon: 'error',
                        loaderBg: '#f2a654',
                        position: 'top-right'
                    })
                } catch (err) {

                }

            }
        });
    }

    function detail_viewlocation(route){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("input[name='_token']").val()
            }
        });

        $.ajax({
            type: "GET",
            url: "{{ url('/') }}/"+route+"/create",
            success: function (data) {
                $('#showModalDetailLocation').modal();
                detail.ajax.url("{{ url('/') }}/"+route+"/create").load();
                // generate_table(route);
            },
            error: function(response) {
                try {
                    $.toast({
                        heading: 'Danger',
                        text: 'Gagal mendapatkan data terkait.',
                        showHideTransition: 'slide',
                        icon: 'error',
                        loaderBg: '#f2a654',
                        position: 'top-right'
                    })
                } catch (err) {

                }

            }
        });
    }
  

    function buildSelect() {
        get_data('asset_list').then(function(result) {
            result = result.data;
            for (let index = 0; index < result.length; index++) {

                let value = _.values(result[index])
               
                $('#filtertagnumber').append('<option id=\''+ (index + 1) +'\' value=\''+ value[2]+ '\'>' + value[2] + '</option>')  
                        
            }

            $('#filtertagnumber').select2({
                tags: true,
                width: '19rem',
            });
                
        })
        .catch(function(err) {
            console.log(err);
        });
      
        $('#stock_tagging').select2({
                tags: true,
                width: '19rem',
        });
    }
    
    function table_reload(){
       
        var filter_asset = $('#searchasset').serialize();
        mTable.ajax.url("{{ url('/') }}/asset_filter?"+filter_asset).load();
        
    }

    function get_data(route){
        return $.ajax({
                    type: "GET",
                    url:  "{{ url('/') }}/"+route,
                });
    }

    //set tagnumber pada modal writeoff
    function set_modal_writeoff(tagnumber,id){
    
        clear_form();

        $('#tangnumber_writeoff').val(tagnumber);
        $('#writeasset_id').val(id)
    }

    function set_modal_disposal(tagnumber,id){
    
        clear_form();

        $('#tangnumber_disposal').val(tagnumber);
        $('#disposal_asset_id').val(id)

    }

    function set_modal_revalue(tagnumber,id){
    
        clear_form();

        $('#tangnumber_revalue').val(tagnumber);
        $('#revalue_asset_id').val(id)

    }

    function set_modal_stock(tagnumber,id){
    
        clear_form();

        $('#tangnumber_stock').val(tagnumber);
        $('#stock_asset_id').val(id);

    }


    //ubah nilai depresiasi ketika tanggal berganti
    $("#transactions_date_writeoff" ).change(function() {
        
        let tagnumber =  $('#tangnumber_writeoff').val();
        
        get_writeoff(tagnumber)
        
    });

    $("#disposal_transactions_date").change(function() {
        
        let tagnumber =  $('#tangnumber_disposal').val();
        
        get_disposal(tagnumber)
        
    });

    $("#revalue_transactions_date").change(function() {
        
        let tagnumber =  $('#tangnumber_revalue').val();
        
        get_revalue(tagnumber)
        
    });


    $("#disposal_saleammount").change(function() {
        
        let book_value,ammount,gain_loss;
        
        book_value =  $('#disposal_wd_value').val();

        ammount =  $("#disposal_saleammount").val();
        
        gain_loss = Math.abs(book_value - ammount);

        $('#disposal_diff').val(gain_loss);
    
    });

    //ambil nilai depresiasi
    function get_depreciation(tagnumber){
        
        let date;
        
        date = $('#transactions_date_writeoff').val();

        if(_.isEmpty(date)){
            date = $('#disposal_transactions_date').val();

            if(_.isEmpty(date)){
                date = $('#revalue_transactions_date').val();
            }
        }
      
        let url = "{{ url('/') }}/get_depreciation/"+tagnumber+"?filterdate="+date;
        
        return $.ajax({
                    type: "GET",
                    url:  url,
                });
    }

    //ambil nilai depresiasi berdasarkan asset dan tanggal dan ubah nilai pada modal
    function get_disposal(tagnumber){
        get_depreciation(tagnumber)
        .then(function(result) {
            
            result = result.data;
           
            if(_.isUndefined(result[0].purchaseacq)){
                $('#disposal_wd_value').val(result[0].book_value);
            }else{
                $('#disposal_wd_value').val(result[0].purchaseacq);
            }
    
        })
        .catch(function(err) {
           
        });  
    }

    //ambil nilai depresiasi berdasarkan asset dan tanggal dan ubah nilai pada modal
    function get_revalue(tagnumber){
        get_depreciation(tagnumber)
        .then(function(result) {
            
            result = result.data;
          
            if(_.isUndefined(result[0].purchaseacq)){
                $('#revalue_wd_value').val(result[0].book_value);
                $('#revalue_purchasecost').val(result[0].asset.purchaseacq);
            }else{
                $('#revalue_wd_value').val(result[0].purchaseacq)
                $('#revalue_purchasecost').val(result[0].asset.purchaseacq);
            }
    
        })
        .catch(function(err) {
            
        });  
    }
   
    //ambil nilai depresiasi berdasarkan asset dan tanggal dan ubah nilai pada modal
    function get_writeoff(tagnumber){
        get_depreciation(tagnumber)
        .then(function(result) {

            result = result.data;
            
            if(_.isUndefined(result[0].purchaseacq)){
                $('#wdv_writeoff').val(result[0].book_value);
            }else{
                $('#wdv_writeoff').val(result[0].purchaseacq)
            }
        })
        .catch(function(err) {
          console.log(err)
        });  
    }

     //input request Disposal
     $('#formInputDisposal').on('submit', function (e) {
        e.preventDefault();

        var url,data,form;

        var myform = $('#formInputDisposal');
      
        //turn off disabled
        var disabled = myform.find(':input:disabled').removeAttr('disabled');

        url = 'disposal';                //For routing
        data = $(this).serialize();     // Data Form
        form = 'Disposal';             //Reset Trigger and Close Modal
        
        //turn on disabled
        disabled.attr('disabled','disabled');
        
        // General form insert_data(url,data,form)
        insert_data(url,data,form);

    });

    //input request writeoff
    $('#formInputWriteoff').on('submit', function (e) {
        e.preventDefault();

        var url,data,form;

        var myform = $('#formInputWriteoff');
      
        //turn off disabled
        var disabled = myform.find(':input:disabled').removeAttr('disabled');

        url = 'writeoff';                //For routing
        data = $(this).serialize();     // Data Form
        form = 'Writeoff';             //Reset Trigger and Close Modal
        
        //turn on disabled
        disabled.attr('disabled','disabled');
        
        // General form insert_data(url,data,form)
        insert_data(url,data,form);

    });

    //input request Revalue
    $('#formInputRevalue').on('submit', function (e) {
        e.preventDefault();

        var url,data,form;

        var myform = $('#formInputRevalue');
      
        //turn off disabled
        var disabled = myform.find(':input:disabled').removeAttr('disabled');

        url = 'revalue';                //For routing
        data = $(this).serialize();     // Data Form
        form = 'Revalue';             //Reset Trigger and Close Modal
        
        //turn on disabled
        disabled.attr('disabled','disabled');
        
        // General form insert_data(url,data,form)
        insert_data(url,data,form);

    });

    //input request StockTake
    $('#formInputStockTake').on('submit', function (e) {
        e.preventDefault();

        var url,data,form;

        var myform = $('#formInputStockTake');
      
        //turn off disabled
        var disabled = myform.find(':input:disabled').removeAttr('disabled');

        url = 'stocktake';                //For routing
        data = $(this).serialize();     // Data Form
        form = 'StockTake';             //Reset Trigger and Close Modal
        
        //turn on disabled
        disabled.attr('disabled','disabled');
        
        // General form insert_data(url,data,form)
        insert_data(url,data,form);
        $('#stock_tagging').val('').html('').children("option:selected");
        $('#stock_condition').val('').html('').children("option:selected");
        $('#stock_assetclass').val('').html('').children("option:selected");
    });


    function buttonEdit(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("input[name='_token']").val()
            }
        });
        $.ajax({
            type: "GET",
            url: "{{ route('transactions.edit',['transaction'=>1]) }}",
            data: {
                id: id
            },
            
            success: function (data) {
                if (data) {
                    
                    var selectbox = [
                        'objassetclass','objcustodian','objcostgroup',
                        'objcostcenter','objcondition','objlocation',
                        'objdepartement','objvendor','objaccount',
                        'objprovider','objowner','objassetstatus',
                        'objassettype'
                    ];

                    clear_error();
                    
                    for (let i = 0; i < selectbox.length; i++) {
                        var retrieve = _.pick(data,selectbox[i])
                        _.forIn(retrieve, function(value, key) {
                            
                            var innerkey = _.keys(value)

                            if(value == null){
                                $("#Updatereg"+key).children("option:selected").html('').val('');
                            }else{
                                _.forIn(value,function(invalue, inner) {
                                    if(inner == innerkey[1]){

                                        if(key == "objlocation"){
                                            // console.log(key,invalue)
                                            $("#Updateregsm"+key).children("option:selected").val(invalue);
                                        }else{
                                            $("#Updatereg"+key).children("option:selected").val(invalue);
                                        }
                                    }
                                    if(inner == innerkey[2]){

                                        if(key == "objlocation"){
                                            $("#Updateregsm"+key).children("option:selected").html(value.location_sub.locationname_sub+' | '+invalue);
                                        }else{
                                            $("#Updatereg"+key).children("option:selected").html(invalue);
                                        }
                                    }
                                })
                            }

                        });
                        
                    }
                    console.log(data);
                    $("#gps_lat").val(data.gps_lat);
                    $("#reqasset_id").val(data.asset_id);
                    $("#gps_long").val(data.gps_long);
                    $("#tangnumber_reqloc").val(data.tangnumber);
                    
                    
                } else {

                }
            },
            error: function(response) {
                try {
                    $.toast({
                        heading: 'Danger',
                        text: 'Gagal mendapatkan data terkait.',
                        showHideTransition: 'slide',
                        icon: 'error',
                        loaderBg: '#f2a654',
                        position: 'top-right'
                    })
                } catch (err) {

                }

            }
        });
    }
    $('#formInputRelocation').on('submit', function (e) {
            e.preventDefault();

            var url,data,form;
            var myform = $('#formInputRelocation');
      
            //turn off disabled
            var disabled = myform.find(':input:disabled').removeAttr('disabled');

            url = 'relocation';           //For routing
            data = $(this).serialize();    // Data Form
            form = 'Relocation';          //Reset Trigger and Close Modal
            
            //turn on disabled
            disabled.attr('disabled','disabled');

            // General form insert_data(url,data,form)
            insert_data(url,data,form);

        });

    
</script>

@endsection