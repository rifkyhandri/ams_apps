@extends('layouts.dashboard')
@section('content')
@include('asset.modalregister')
<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div style="height: 65px; border-radius: 15px;" class="card">
            <div class="card-body">
                <div style="display: flex; align-items: flex-start; justify-content: space-between; height: 40px;">
                    <h4 class="card-title" style="font-size: 2rem; font-weight: 300; margin-bottom: 0px;">Journal Transaction</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div style="border-radius: 15px;" class="card">
            <div class="card-body">
                    <form style="display: flex; align-items: flex-start; justify-content: space-between;" action="#" id="searchasset">
                        <div class="row">
                            <div class="col-12">
                                <label class="text-dark font-weight-bold">Date</label>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label>From</label>
                                            <input type="date" class="form-control" id="filterstartdate" name="filterstartdate" onchange="table_reload()">
                                        </div>
                                        <div class="col-6">
                                            <label>To</label>
                                            <input type="date" class="form-control" id="filterenddate" name="filterenddate" onchange="table_reload()">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>

<!-- Tittle End -->
<button class="btn btn-primary btn-sm btn-rounded-sm mb-3 mt-3" onclick="open_table('depreciation','Depreciation')">Depreciation</button>
<button class="btn btn-primary btn-sm btn-rounded-sm mb-3 mt-3" onclick="open_table('disposal','Disposal')">Disposal Asset</button>
<button class="btn btn-primary btn-sm btn-rounded-sm mb-3 mt-3" onclick="open_table('revaluation','Revaluation')">Revaluation</button>
<button class="btn btn-primary btn-sm btn-rounded-sm mb-3 mt-3" onclick="open_table('writeoff','Writeoff')">Write-off</button>
<button class="btn btn-primary btn-sm btn-rounded-sm mb-3 mt-3" onclick="open_table('rental','Rental')">Rental Asset</button>

<div class="row tabel" id="depreciation">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div class="card" style="border-radius: 15px;">
                <div class="card-body">
                <div class="row">
                    <a href="" class="btn btn-sm btn-primary" style="margin: -0.2rem .05rem -1rem auto;margin-bottom:20px;margin-right: 13px ">Export Excel</a>
                    <div class="col-12">
                    <div class="table-responsive">
                        <table id="DepreciationTable" class="table" style="width:100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Asset Code</th>
                                <th>Asset Name</th>
                                <th>Start Date</th>
                                <th>Start Value</th>
                                <th>Book Value</th>
                                <th>Depreciation</th>
                                <th>Total Deprec</th>
                                <th>Lifetime</th>
                                <th>Group</th>
                                <th>Location</th>
                                <th>Departement</th>
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
                <div class="row">
                    <a href="" class="btn btn-sm btn-primary" style="margin: -0.2rem .05rem -1rem auto;margin-bottom:20px;margin-right: 13px ">Export Excel</a>
                    <div class="col-12">
                    <div class="table-responsive">
                        <table id="disposalTable" class="table" style="width:100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Account</th>
                                <th>Account Desc</th>
                                <th>Departement</th>
                                <th>Journal Description</th>
                                <th>Debit</th>
                                <th>Kredit</th>
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
                <div class="row">
                    <a href="" class="btn btn-sm btn-primary" style="margin: -0.2rem .05rem -1rem auto;margin-bottom:20px;margin-right: 13px ">Export Excel</a>
                    <div class="col-12">
                    <div class="table-responsive">
                        <table id="writeoffTable" class="table" style="width:100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Account</th>
                                <th>Account Desc</th>
                                <th>Departement</th>
                                <th>Journal Description</th>
                                <th>Debit</th>
                                <th>Kredit</th>
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
                <div class="row">
                    <a href="" class="btn btn-sm btn-primary" style="margin: -0.2rem .05rem -1rem auto;margin-bottom:20px;margin-right: 13px ">Export Excel</a>
                    <div class="col-12">
                    <div class="table-responsive">
                        <table id="revaluationTable" class="table" style="width:100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Account</th>
                                <th>Account Desc</th>
                                <th>Departement</th>
                                <th>Journal Description</th>
                                <th>Debit</th>
                                <th>Kredit</th>
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

<div class="row tabel" id="rental" style="display:none;">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div class="card" style="border-radius: 15px;">
                <div class="card-body">
                <div class="row">
                    <a href="{{route('report.transfer')}}" class="btn btn-sm btn-primary" style="margin: -0.2rem .05rem -1rem auto;margin-bottom:20px;margin-right: 13px ">Export Excel</a>
                    <div class="col-12">
                    <div class="table-responsive">
                        <table id="RentalTable" class="table" style="width:100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis</th>
                                <th>QTY</th>
                                <th>Contract</th>
                                <th>Police No</th>
                                <th>Rent Date</th>
                                <th>Period</th>
                                <th>End Date</th>
                                <th>Monthly</th>
                                <th>Location</th>
                                <th>Vendor</th>
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
     var mTable,disposalTable,transferTable,writeoffTable,revaluationTable;
    

     $(document).ready(function () {

        buildSelect();

        //RENDER DATA TABLES
        mTable = $('#DepreciationTable').DataTable({
            responsive: true,
            processing: true,
            "language": {
                "processing": "<div class='dot-opacity-loader'></div>"
            },
            "order": [[ 0, "desc" ]],
            serverSide: true,
            ajax: "{{ route('get.service')}}",
            columns: [
                {  
                    data: 'id',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'tangnumber',
                    name: 'tangnumber'
                },
                {
                    data: 'asset',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return data.assetname;
                        }
                    }
                },
                {
                    data: 'servicedate',
                    name: 'servicedate'
                },
                {
                    data: 'costservice',
                    name: 'costservice'
                },
                {
                    data: 'asset',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return (!_.isNull(data.objprovider) ? data.objprovider.providername : null );
                        }
                    }
                },
                {
                    data: 'nextservice',
                    name: 'nextservice'
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
            ajax: "{{ route('get.transfer')}}",
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
            ajax: "{{ route('get.transfer')}}",
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
            ajax: "{{ route('get.transfer')}}",
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
            ajax: "{{ route('get.transfer')}}",
            
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
        tabel.ajax.url(url+"/get_"+id).load();

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
        mTable.ajax.url("{{ url('/') }}/get_service?"+filter_asset).load();
        
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