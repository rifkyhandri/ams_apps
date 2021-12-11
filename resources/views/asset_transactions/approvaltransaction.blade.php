@extends('layouts.dashboard')
@section('content')
@include('layouts.css_custom')
@section('link')
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@600&display=swap" rel="stylesheet">
@stop
@include('asset_transactions.approve_transaksi_modal')
{{-- <form id="search_button_custom" class="m-3">
    <input type="search" placeholder="Search">
</form> --}}
<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div class="card" style="border-radius: 15px;">
            <div class="card-body">
                <div class="text-dark h3 mb-5 " style="font-family: 'Oswald', serif;border-radius: 9px">Transaksi Approve</div>
                <div style="display: flex; align-items: flex-start; justify-content: space-between;">
                        {{-- <h4 class="card-title" style="font-size: 2rem; font-weight: 300; margin-bottom: 0px;">Filter</h4> --}}
                        {{-- <form action="#" id="searchasset">
                            <div class="row col-12">
                                <div class="form-group col-4">
                                    <label>Tag Number</label>
                                    <select name="filtertagnumber" id="filtertagnumber" class="form-control form-control-sm" onchange="table_reload()">
                                    <option value="" selected>Select tag number</option>
                                    </select>
                                </div>
                            </div>
                        </form> --}}
                    </div>
                <div class="row">
                    <div class="col-12">
                    <div class="table-responsive">
                        <table id="assetTable" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th style="width: 100px;">Transaction</th>
                                <th style="width: 500px;">Asset Code</th>
                                <th style="width: 500px;">Status</th>
                                <th style="width: 500px;">Date</th>
                                <th style="width: 500px;">Requester</th>
                                <th style="width: 500px;">Action</th>
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

     
        //RENDER DATA TABLES
        mTable = $('#assetTable').DataTable({
            responsive: true,
            processing: true,
            "language": {
                "processing": "<div class='dot-opacity-loader'></div>"
            },
            "order": [[ 0, "desc" ]],
            serverSide: true,
            ajax: "{{ route('approvaltransaction.create')}}",
            // data: filter_asset,
            columns: [
                {  data: 'asset_id',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'transaction_name',
                    name: 'transaction_name'
                },
                {
                    data: 'tangnumber',
                    name: 'tangnumber'
                },
                {
                    data: 'approval',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else if(data <= 0){
                            return '<div class="text-warning font-weight-bold">Request <span><i class="fa fa-clock-o"></i></span></div>';
                        }else{
                            return '<div class="text-primary font-weight-bold">Approved <span><i class="fa fa-check-circle"></i></span></div>';
                        }
                    }
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'requester',
                    name: 'requester'
                },
                {
                    data: 'id_asset_transaction',
                    render: function (data, type, row) {
                        
                        let buttonAction   = '<div class="dropdown">'+
                          '<button type="button" class="btn btn-info dropdown-toggle" style="color:white; font-size:1.5rem; margin-left:-7px;margin-top:5px" id="dropdownMenuIconButton8" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
                            '<i class="ti-settings" style="color:white; font-size:1.3rem; margin-left:-7px;margin-top:5px"></i>'+
                          '</button>'+
                          '<div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton8">'+
                            '<h6 class="dropdown-header">Action</h6>';
                            
                            if(row.transaction_name == 'Relocation Request'){
                                buttonAction += '<a class="dropdown-item text-primary" href="#" data-toggle="modal" data-target="#showModalViewApprovalRelocation" onclick="buttonEdit(\'' + data + '\')";>View <span><i class="fa fa-eye"></i></span></a>';
                            }else if(row.transaction_name == 'Write Off'){
                                buttonAction += '<a class="dropdown-item text-primary" href="#" data-toggle="modal" data-target="#showModalViewApprovalWriteoff" onclick="buttonEditWriteoff(\'' + data + '\')";>View <span><i class="fa fa-eye"></i></span></a>';
                            }else if (row.transaction_name == 'Disposal'){
                                buttonAction += '<a class="dropdown-item text-primary" href="#" data-toggle="modal" data-target="#showModalViewApprovalDisposal" onclick="buttonEditDisposal(\'' + data + '\')";>View <span><i class="fa fa-eye"></i></span></a>';
                            }else if (row.transaction_name == 'Revalue'){
                                buttonAction += '<a class="dropdown-item text-primary" href="#" data-toggle="modal" data-target="#showModalViewApprovalRevalue" onclick="buttonEditRevalue(\'' + data + '\')";>View <span><i class="fa fa-eye"></i></span></a>';
                            }else if (row.transaction_name == 'Stock Take'){
                                buttonAction += '<a class="dropdown-item text-primary" href="#" data-toggle="modal" data-target="#showModalViewApprovalStockTake" onclick="buttonEditStockTake(\'' + data + '\')";>View <span><i class="fa fa-eye"></i></span></a>';
                            }
                            if(row.approval == 0){
                              buttonAction += '<a class="dropdown-item text-danger" href="#" onclick="delete_data(\''+data +'\',\'approvaltransactionrelocation\');">Delete <span><i class="fa fa-trash"></i></span></a></div></div>';
                            }

                        return buttonAction;
                    }
                }
            ]
        });

        $('#formUpdateRelocation').on('submit', function (e) {

                e.preventDefault();
                var url,data,form;

                url = 'approvaltransactionrelocation';           //For routing
                data = $(this).serialize(); // Data Form
                form = 'Relocation';          // Reset Trigger and Close Modal

                // General form update_data(url,data,form)
                update_data(url,data,form);
        });

        $('#formUpdateWriteoff').on('submit', function (e) {

            e.preventDefault();
            var url,data,form;
      
            var myform = $('#formUpdateWriteoff');
      
            //turn off disabled
            var disabled = myform.find(':input:disabled').removeAttr('disabled');

            url = 'writeoff';           //For routing
            data = $(this).serialize(); // Data Form
            form = 'Writeoff';          // Reset Trigger and Close Modal
            //turn on disabled
            disabled.attr('disabled','disabled');
            // General form update_data(url,data,form)
            update_data(url,data,form);

        });

         $('#formUpdateDisposal').on('submit', function (e) {

            e.preventDefault();
            var url,data,form;
      
            var myform = $('#formUpdateDisposal');
      
            //turn off disabled
            var disabled = myform.find(':input:disabled').removeAttr('disabled');

            url = 'disposal';           //For routing
            data = $(this).serialize(); // Data Form
            form = 'Disposal';          // Reset Trigger and Close Modal
            //turn on disabled
            disabled.attr('disabled','disabled');
            // General form update_data(url,data,form)
            update_data(url,data,form);
            
        });

        $('#formUpdateRevalue').on('submit', function (e) {

            e.preventDefault();
            var url,data,form;
      
            var myform = $('#formUpdateRevalue');
      
            //turn off disabled
            var disabled = myform.find(':input:disabled').removeAttr('disabled');

            url = 'revalue';           //For routing
            data = $(this).serialize(); // Data Form
            form = 'Revalue';          // Reset Trigger and Close Modal
            //turn on disabled
            disabled.attr('disabled','disabled');
            // General form update_data(url,data,form)
            update_data(url,data,form);
            
        });

        
        $('#formUpdateStockTake').on('submit', function (e) {

            e.preventDefault();
            var url,data,form;
      
            var myform = $('#formUpdateStockTake');
      
            //turn off disabled
            var disabled = myform.find(':input:disabled').removeAttr('disabled');

            url = 'stocktake';           //For routing
            data = $(this).serialize(); // Data Form
            form = 'StockTake';          // Reset Trigger and Close Modal
            //turn on disabled
            disabled.attr('disabled','disabled');
            // General form update_data(url,data,form)
            update_data(url,data,form);

        });
           
     });
     function buttonAdd(result,flag){
        console.log(result,flag)
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

    function detail_depreciation(tagnumber){
        let url = "{{ url('/') }}/depreciation/"+tagnumber;
        var win = window.open(url, '_blank');
        win.focus();
    }

    function buttonEditStockTake(id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("input[name='_token']").val()
            }
        });
        $.ajax({
            type: "GET",
            url: "{{ route('approvaltransactionrelocation.edit',['approvaltransactionrelocation'=>1]) }}",
            data: {
                id: id
            },
            
            success: function (data) {
                if (data) {
                   
                    clear_error();

                    $("#idStockTake").val(data.id_asset_transaction);
                    $("#stock_asset_id").val(data.asset_id)
                    $("#tangnumber_stock").val(data.tangnumber);
                    $("#stock_transactions_date").val(data.transaction_date);
                    $("#stock_assetclass").children("option:selected").val((_.isNull(data.approveassetclass) ? null : data.approveassetclass.classcode)).html((_.isNull(data.approveassetclass) ? null : data.approveassetclass.classdesc));
                    $("#stock_status").children("option:selected").val((_.isNull(data.change_stock_opname) ? null : data.change_stock_opname)).html((_.isNull(data.change_stock_opname) ? '' : data.change_stock_opname));
                    $('#stock_condition').children("option:selected").val((_.isNull(data.approvecondition) ? null : data.approvecondition.conditioncode)).html((_.isNull(data.approvecondition) ? null : data.approvecondition.conditiondesc));  
                    $("#stock_tagging").children("option:selected").val((_.isNull(data.change_tagged) ? null : data.change_tagged)).html((_.isNull(data.change_tagged) ? null : data.change_tagged));
                    
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

    function buttonEditRevalue(id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("input[name='_token']").val()
            }
        });
        $.ajax({
            type: "GET",
            url: "{{ route('approvaltransactionrelocation.edit',['approvaltransactionrelocation'=>1]) }}",
            data: {
                id: id
            },
            
            success: function (data) {
                if (data) {
                   
                    clear_error();

                    $("#idRevalue").val(data.id_asset_transaction);
                    $("#revalue_asset_id").val(data.asset_id)
                    $("#tangnumber_revalue").val(data.tangnumber);
                    $("#revalue_new_tagnumber").val(data.new_tangnumber);
                    $("#revalue_transactions_date").val(data.transaction_date);
                    $("#revalue_wd_value").val(data.wd_value);
                    $('#revalue_purchasecost').val(data.approveasset.purchaseacq);  
                    $("#revalue_year").val(data.extend_year);
                    $("#revalue_month").val(data.extend_month);
                    $("#revalue_salvage").val(data.revaluation_salvage);
                    $("#revalue_after").val(data.revaluation_value);
                    
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

    function buttonEditDisposal(id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("input[name='_token']").val()
            }
        });
        $.ajax({
            type: "GET",
            url: "{{ route('approvaltransactionrelocation.edit',['approvaltransactionrelocation'=>1]) }}",
            data: {
                id: id
            },
            
            success: function (data) {
                if (data) {
                  
                    clear_error();

                    $("#idDisposal").val(data.id_asset_transaction);
                    $("#disposal_asset_id").val(data.asset_id)
                    $("#tangnumber_disposal").val(data.tangnumber);
                    $("#disposal_transactions_date").val(data.transaction_date);
                    $("#disposal_wd_value").val(data.wd_value);
                    $("#disposal_saleammount").val(data.sale_ammount);   
                    $("#disposal_diff").val(data.diff_total);   
                    $("#disposal_accountdis").children("option:selected").val((_.isNull(data.approveaccount) ? null : data.approveaccount.accountno)).html((_.isNull(data.approveaccount) ? null : data.approveaccount.accountname));
                    
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

    function buttonEditWriteoff(id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("input[name='_token']").val()
            }
        });
        $.ajax({
            type: "GET",
            url: "{{ route('approvaltransactionrelocation.edit',['approvaltransactionrelocation'=>1]) }}",
            data: {
                id: id
            },
            
            success: function (data) {
                if (data) {
                   
                    clear_error();

                    $("#idWriteoff").val(data.id_asset_transaction)
                    $("#Update_transactions_date_writeoff").val(data.transaction_date);
                    $("#Update_wdv_writeoff").val(data.wd_value);
                    $("#Update_tangnumber_writeoff").val(data.tangnumber);
                    $("#Update_writeasset_id").val(data.asset_id);                 
                    
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

    function buttonEdit(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("input[name='_token']").val()
            }
        });
        $.ajax({
            type: "GET",
            url: "{{ route('approvaltransactionrelocation.edit',['approvaltransactionrelocation'=>1]) }}",
            data: {
                id: id
            },
            
            success: function (data) {
                if (data) {
                    console.log(data);
                    clear_error();

                    $("#Updateregapproveasset").val(data.asset_id);
                    $("#Updateregapproveid").val(data.id_asset_transaction);
                    $("#relocation_transactions_date").val(data.transaction_date);
                    $("#Updateregapprovecustodian").children("option:selected").val((_.isNull(data.approvecustodian) ? null : data.approvecustodian.custodiancode)).html((_.isNull(data.approvecustodian) ? null :data.approvecustodian.custodianname));
                    $("#Updateregapprovecostcenter").children("option:selected").val((_.isNull(data.approvecostcenter) ? null : data.approvecostcenter.costcentercode)).html((_.isNull(data.approvecostcenter) ? null : data.approvecostcenter.costcenterdesc));
                    $("#Updateregapprovelocation").children("option:selected").val((_.isNull(data.approvelocation) ? null : data.approvelocation.locationcode_sm)).html((_.isNull(data.approvelocation) ? null : data.approvelocation.locationname_sm));
                    
                    
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
   
     </script>
     @endsection