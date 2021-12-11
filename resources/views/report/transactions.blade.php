@extends('layouts.dashboard')
@section('content')
@include('asset.modalregister')
<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div style="height: 65px; border-radius: 15px;" class="card">
            <div class="card-body">
                <div style="display: flex; align-items: flex-start; justify-content: space-between; height: 40px;">
                    <h4 class="card-title" style="font-size: 2rem; font-weight: 300; margin-bottom: 0px;">Transactions</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div style="border-radius: 15px;" class="card">
            <div class="card-body">
                    <form style="display: flex; align-items: flex-start; justify-content: space-between;" action="#" id="filterasset">
                        <div class="row">
                            <div class="col-12">
                                <label class="text-dark font-weight-bold">Date</label>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label>From</label>
                                            <input type="date" class="form-control" id="filterstartdate" name="filterstartdate" onchange="table_date_reload()">
                                        </div>
                                        <div class="col-6">
                                            <label>To</label>
                                            <input type="date" class="form-control" id="filterenddate" name="filterenddate" onchange="table_date_reload()">
                                        </div>
                                    </div>
                                </div>
                                <a href="/report_t" class="btn btn-primary btn-sm">reload</a>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>

<!-- Tittle End -->

<button class="button-data btn btn-primary btn-sm btn-rounded-sm mb-3 mt-3 active" onclick="open_table('purchased','Purchased')">Purchased</button>
<button class="button-data btn btn-primary btn-sm btn-rounded-sm mb-3 mt-3"  onclick="open_table('disposal','Disposal')">Disposal</button>
<button class="button-data btn btn-primary btn-sm btn-rounded-sm mb-3 mt-3"  onclick="open_table('writeoff','Writeoff')">Write-off</button>
<button class="button-data btn btn-primary btn-sm btn-rounded-sm mb-3 mt-3"  onclick="open_table('revaluation','Revaluation')">Revaluation</button>
<button class="button-data btn btn-primary btn-sm btn-rounded-sm mb-3 mt-3"  onclick="open_table('transfer','Transfer')">Transfer</button>

<div class="row tabel" id="purchased">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div class="card" style="border-radius: 15px;">
                <div class="card-body">
                    <div style="margin-left: 83%">
                    <a href="#" class="btn btn-sm btn-primary mb-3" onclick="export_asset('report_purchase')">Export Excel</a>
                    <a href="#" class="btn btn-sm btn-primary mb-3" onclick="print_asset('print_purchase')" >Print</a>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="table-responsive">
                        <table id="PurchasedTable" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th style="width: 100px;">Asset Code</th>
                                <th style="width: 500px;">Serial</th>
                                <th style="width: 500px;">Description</th>
                                <th style="width: 500px;">Model</th>
                                <th style="width: 500px;">Date Purchase</th>
                                <th style="width: 500px;">Cost</th>
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

<div class="row tabel" id="disposal" style="display:none;">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div class="card" style="border-radius: 15px;">
                <div class="card-body">
                    <div style="margin-left: 83%">
                        <a href="#" onclick="export_asset('report_disposal')" class="btn btn-sm btn-primary mb-3">Export Excel</a>
                        <a href="#" onclick="print_asset('print_disposal')" class="btn btn-sm btn-primary mb-3">Print</a>
                    </div>
                <div class="row">  
                    <div class="col-12">
                    <div class="table-responsive">
                        <table id="disposalTable" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th style="width: 100px;">Asset Code</th>
                                <th style="width: 500px;">Serial</th>
                                <th style="width: 500px;">Description</th>
                                <th style="width: 500px;">Model</th>
                                <th style="width: 500px;">Account</th>
                                <th style="width: 500px;">Disposal Date</th>
                                <th style="width: 500px;">Sale Ammount</th>
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

<div class="row tabel" id="writeoff" style="display:none;">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div class="card" style="border-radius: 15px;">
                <div class="card-body">
                    <div style="margin-left: 83%">
                        <a href="#" onclick="export_asset('report_writeoff')" class="btn btn-sm btn-primary mb-3">Export Excel</a>
                        <a href="#" onclick="print_asset('print_writeoff')" class="btn btn-sm btn-primary mb-3">Print</a>
                    </div>
                <div class="row">
                    <div class="col-12">
                    <div class="table-responsive">
                        <table id="writeoffTable" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th style="width: 100px;">Asset Code</th>
                                <th style="width: 500px;">Serial</th>
                                <th style="width: 500px;">Description</th>
                                <th style="width: 500px;">Model</th>
                                <th style="width: 500px;">Account</th>
                                <th style="width: 500px;">Write-off Date</th>
                                <th style="width: 500px;">Write-off Value</th>
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

<div class="row tabel" id="revaluation" style="display:none;">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div class="card" style="border-radius: 15px;">
                <div class="card-body">
                    <div style="margin-left: 83%">
                        <a href="#" onclick="export_asset('report_revaluation')" class="btn btn-sm btn-primary mb-3">Export Excel</a>
                        <a href="#" onclick="print_asset('print_revaluation')" class="btn btn-sm btn-primary mb-3">Print</a>
                    </div>
                <div class="row">
                    <div class="col-12">
                    <div class="table-responsive">
                        <table id="revaluationTable" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th style="width: 100px;">Asset Code</th>
                                <th style="width: 500px;">Serial</th>
                                <th style="width: 500px;">Description</th>
                                <th style="width: 500px;">Model</th>
                                <th style="width: 500px;">New Asset Code</th>
                                <th style="width: 500px;">Revalue Date</th>
                                <th style="width: 500px;">New Value</th>
                                <th style="width: 500px;">Extend Life</th>
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

<div class="row tabel" id="transfer" style="display:none;">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div class="card" style="border-radius: 15px;">
                <div class="card-body">
                    <div style="margin-left: 83%">
                        <a href="#" onclick="export_asset('report_relocation')" class="btn btn-sm btn-primary mb-3">Export Excel</a>
                        <a href="#" onclick="print_asset('print_relocation')" class="btn btn-sm btn-primary mb-3">Print</a>
                    </div>
                <div class="row">
                    <div class="col-12">
                    <div class="table-responsive">
                        <table id="transferTable" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th style="width: 100px;">Asset Code</th>
                                <th style="width: 500px;">Serial</th>
                                <th style="width: 500px;">Description</th>
                                <th style="width: 500px;">Model</th>
                                <th style="width: 500px;">New Location</th>
                                <th style="width: 500px;">New Cost Center</th>
                                <th style="width: 500px;">New Custodian</th>
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

$('.button-data').on('click',function(){
    $('.button-data').removeClass('active');
    $(this).addClass('active');
    
})
    
     var detail;
     var mTable,disposalTable,transferTable,writeoffTable,revaluationTable;
    

     $(document).ready(function () {

        // buildSelect();

        //RENDER DATA TABLES
        mTable = $('#PurchasedTable').DataTable({
            responsive: true,
            processing: true,
            "language": {
                "processing": "<div class='dot-opacity-loader'></div>"
            },
            "order": [[ 0, "desc" ]],
            serverSide: true,
            ajax: "{{ route('get.purchase')}}",
            columns: [
                {  
                    data: 'asset_id',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'tangnumber',
                    name: 'tangnumber'
                },
                {
                    data: 'serial',
                    name: 'serial'
                },
                {
                    data: 'notes',
                    name: 'notes'
                },
                {
                    data: 'models',
                    name: 'models' 
                },
                {
                    data: 'datepurchase',
                    name: 'datepurchase'
                },
                {
                    data: 'purchasecost',
                    name: 'purchasecost'
                },
                
            ]
        });
        
        transferTable = $('#transferTable').DataTable({
            // responsive: true,
            processing: true,
            "language": {
                "processing": "<div class='dot-opacity-loader'></div>"
            },
            "order": [[ 0, "desc" ]],
            serverSide: true,
            ajax: "{{ url('get_transfer?filterTransfer=Relocation Request')}}",
            columns: [
                {  
                    data: 'id_asset_transaction',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'tangnumber',
                    name: 'tangnumber'
                },
                {
                    data: 'approveasset',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return data.serial;
                        }
                    }
                },
                {
                    data: 'approveasset',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return data.notes;
                        }
                    }
                },
                {
                    data: 'approveasset',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return data.models;
                        }
                    }
                },
                {
                    data: 'approvelocation',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return data.location_sub.locationname_sub+' | '+data.locationname_sm;
                        }
                    }
                },
                {
                    data: 'approvecostcenter',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return data.costcenterdesc;
                        }
                    }
                },
                {
                    data: 'approvecustodian',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return data.custodianname;
                        }
                    }
                },
            ]
        });
        
        disposalTable = $('#disposalTable').DataTable({
            // responsive: true,
            processing: true,
            "language": {
                "processing": "<div class='dot-opacity-loader'></div>"
            },
            "order": [[ 0, "desc" ]],
            serverSide: true,
            ajax: "{{ url('get_disposal?filterDisposal=Disposal')}}",
            columns: [
                {  
                    data: 'id_asset_transaction',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'tangnumber',
                    name: 'tangnumber'
                },
                {
                    data: 'approveasset',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return data.serial;
                        }
                    }
                },
                {
                    data: 'approveasset',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return data.notes;
                        }
                    }
                },
                {
                    data: 'approveasset',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return data.models;
                        }
                    }
                },
                {
                    data: 'approveasset',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return data.account;
                        }
                    }
                },
                {
                    data: 'transaction_date',
                    name: 'transaction_date'
                },
                {
                    data: 'sale_ammount',
                    name: 'sale_ammount'
                },
               
            ]
            
        });
        writeoffTable = $('#writeoffTable').DataTable({
            // responsive: true,
            processing: true,
            "language": {
                "processing": "<div class='dot-opacity-loader'></div>"
            },
            "order": [[ 0, "desc" ]],
            serverSide: true,
            ajax: "{{ url('get_writeoff?filterWriteoff=Write off')}}",
            columns: [
                {  
                    data: 'id_asset_transaction',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'tangnumber',
                    name: 'tangnumber'
                },
                {
                    data: 'approveasset',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return data.serial;
                        }
                    }
                },
                {
                    data: 'approveasset',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return data.notes;
                        }
                    }
                },
                {
                    data: 'approveasset',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return data.models;
                        }
                    }
                },
                {
                    data: 'approveasset',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return data.account;
                        }
                    }
                },
                {
                    data: 'transaction_date',
                    name: 'transaction_date'
                },
                {
                    data: 'wd_value',
                    name: 'wd_value'
                },
               
            ]
        });
        revaluationTable = $('#revaluationTable').DataTable({
            // responsive: true,
            processing: true,
            "language": {
                "processing": "<div class='dot-opacity-loader'></div>"
            },
            "order": [[ 0, "desc" ]],
            serverSide: true,
            ajax: "{{ url('get_revaluation?filterRevalue=Revalue')}}",
            
            columns: [
                {  
                    data: 'id_asset_transaction',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'tangnumber',
                    name: 'tangnumber'
                },
                {
                    data: 'approveasset',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return data.serial;
                        }
                    }
                },
                {
                    data: 'approveasset',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return data.notes;
                        }
                    }
                },
                {
                    data: 'approveasset',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return data.models;
                        }
                    }
                },
                {
                    data: 'approveasset',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return data.account;
                        }
                    }
                },
                {
                    data: 'transaction_date',
                    name: 'transaction_date'
                },
                {
                    data: 'wd_value',
                    name: 'wd_value'
                },
                {
                    data: 'extend_year',
                    render: function (data, type, row, meta) {
                        return data+'Years';
                    }
                    
                },
               
            ]
        });
        
     });

    function open_table(id,table){

        let hide = $('.tabel');
        let show = $('#'+id);
        let tabel = $('#'+id+"Table").DataTable();
        let url = "{{ url('/') }}";
    
        hide.hide();
        show.show();
        // var filter_asset = $('#filter-button').serialize();
        // tabel.ajax.url(url+"/get_"+id+'?'+filter_asset).load();


    }
    function export_asset(id){
        let filter_asset = $('#filterasset').serialize();
        let url = "{{ url('/') }}/"+id+'?'+filter_asset;
        var win = window.open(url, '_blank');
        // http://127.0.0.1:8000/report_purchase?filterstartdate=2021-03-12&filterenddate=2021-03-16
        win.focus();
    }
    function print_asset(id){
        let filter_asset = $('#filterasset').serialize();
        let url = "{{ url('/') }}/"+id+'?'+filter_asset;
        var win = window.open(url, '_blank');
        win.focus();
    }
    // function buildSelect() {
    //     get_data('asset_list').then(function(result) {
    //         result = result.data;
    //         for (let index = 0; index < result.length; index++) {

    //             let value = _.values(result[index])
               
    //             $('#filtertagnumber').append('<option id=\''+ (index + 1) +'\' value=\''+ value[2]+ '\'>' + value[2] + '</option>')  
                        
    //         }

    //         $('#filtertagnumber').select2({
    //             tags: true,
    //             width: '19rem',
    //         });
                
    //     })
    //     .catch(function(err) {
    //         console.log(err);
    //     });
      
    // }
    
    function table_date_reload(){ 
    var filter_asset = $('#filterasset').serialize();
    mTable.ajax.url("{{ url('/') }}/get_purchase?"+filter_asset).load();  
    disposalTable.ajax.url("{{ url('/') }}/get_disposal?filterDisposal=Disposal&"+filter_asset).load();  
    transferTable.ajax.url("{{ url('/') }}/get_transfer?filterTransfer=Relocation Request&"+filter_asset).load(); 
    writeoffTable.ajax.url("{{ url('/') }}/get_writeoff?filterWriteoff=Write off&"+filter_asset).load(); 
    revaluationTable.ajax.url("{{ url('/') }}/get_revaluation?filterRevalue=Revalue&"+filter_asset).load(); 

    }

    function get_data(route){
        return $.ajax({
                    type: "GET",
                    url:  "{{ url('/') }}/"+route,
                });
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

    function buttonAdd(result,flag){
        console.log(result)
        var result = result.split('-');
        $('#serviceprovider').children("option:selected").html(result[1]).val(result[0]);
        $('#closeModalDetailValue').click();
        $('#closeModalDetailLocation').click();
    }

    //EDIT BUTTON VIEW
    function buttonEdit(id) {
        // console.log(id)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("input[name='_token']").val()
            }
        });
        $.ajax({
            type: "GET",
            url: "{{ route('asset_register.edit',['asset_register'=>1]) }}",
            data: {
                id: id
            },
            success: function (data) {
                if (data) {
                    clear_form();
                    clear_error();

                     /* END GET VALUE */
                    $("#tangnumber").val(data.tangnumber);
                    $("#servicedate").val(data.nextservice);
                    $("#servicecontract").val(data.servicecontract);
                    $("#serviceprovider").children("option:selected").val((_.isNull(data.objprovider) ? '' : data.objprovider.providercode));
                    $("#serviceprovider").children("option:selected").html((_.isNull(data.objprovider) ? '' : data.objprovider.providername));
                    $("#warranty").val(data.warranty);
                    $("#notes").val(data.notes);
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
@include('servicetools.servicemodal')