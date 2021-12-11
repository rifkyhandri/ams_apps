@extends('layouts.dashboard')
@section('content')
@include('asset.modalregister')
<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div style="height: 65px; border-radius: 15px;" class="card">
            <div class="card-body">
                <div style="display: flex; align-items: flex-start; justify-content: space-between; height: 40px;">
                    <h4 class="card-title" style="font-size: 2rem; font-weight: 300; margin-bottom: 0px;">Asset Data</h4>
                    {{-- <button type="button" class="btn btn-success btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" data-custom-class="tooltip-success" title="EDIT" data-target="#showModalUpdateAssetClass" style="margin-right:5px;"><i style="font-size:1.5rem; margin-left:-7px;" class="ti-pencil-alt"></i></button> --}}
                    {{-- <button style="margin: -0.2rem .05rem -1rem auto;" type="button" class="btn btn-primary btn-sm"
                        data-toggle="modal" data-target="#showModalInsertAccountChart"><i
                            class="ti-plus menu-icon"></i>&ensp;
                        ADD</button> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div style="border-radius: 15px;" class="card">
            <div class="card-body">
                <div style="display: flex; align-items: flex-start; justify-content: space-between;">
                    {{-- <h4 class="card-title" style="font-size: 2rem; font-weight: 300; margin-bottom: 0px;">Filter</h4> --}}
                    <form action="#" id="filterasset">
                        <div class="row col-12">
                            <div class="form-group col-4">
                                <label>Location</label>
                                <select name="filterlocation" id="filterlocation" class="form-control form-control-sm" onchange="change_location(this.value)"></select>
                            </div>

                            <div class="form-group col-4">
                                <label>Sub Location</label>
                                <select name="filtersublocation" id="filtersublocation" class="form-control form-control-sm" onchange="change_sublocation(this.value)" disabled></select>
                            </div>
                            
                            <div class="form-group col-4">
                                <label>Child Location</label>
                                <select name="filtersmlocation" id="filtersmlocation" class="form-control form-control-sm" onchange="change_smlocation()" disabled></select>
                            </div>
                            
                            <div class="form-group col-4">
                                <label>Departement</label>
                                <select name="filterdepartement" id="filterdepartement" class="form-control form-control-sm" onchange="table_reload()"></select>
                            </div>
                            
                            <div class="form-group col-4">
                                <label>Asset Group</label>
                                <select name="filterassetgroup" id="filtercostgroup" class="form-control form-control-sm" onchange="table_reload()"></select>
                            </div>
                            
                            <div class="form-group col-4">
                                <label>Vendor</label>
                                <select name="filtervendor" id="filtervendor" class="form-control form-control-sm" onchange="table_reload()"></select>
                            </div>
                            
                            <div class="form-group col-4">
                                <label>Class</label>
                                <select name="filterassetclass" id="filterassetclass" class="form-control form-control-sm" onchange="table_reload()"></select>
                            </div>
                            
                            <div class="form-group col-4">
                                <label>Cost Center</label>
                                <select name="filtercostcenter" id="filtercostcenter" class="form-control form-control-sm" onchange="table_reload()"></select>
                            </div>

                            <div class="form-group col-4">
                                <label>Asset Type</label>
                                <select name="filterassettype" id="filterassettype" class="form-control form-control-sm" onchange="table_reload()"></select>
                            </div>

                            <div class="form-group col-4">
                                <label>Upload Date</label>
                                <input type="date" class="form-control form-control-sm" name="filter_uploaddate" onchange="table_reload()">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Button QR -->
<a href="#" onclick="export_asset()" class="btn btn-primary btn-sm btn-rounded-sm mb-3 mt-3">Export Excel</a>
<a href="#" onclick="cetak_qr()" class="btn btn-primary btn-sm btn-rounded-sm mb-3 mt-3">Print QR</a>
<!-- End Button -->
<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div class="card" style="border-radius: 15px;">
                <div class="card-body">
                <div class="row">
                    <div class="col-12">
                    <div class="table-responsive">
                        <table id="assetTable" class="table">
                        <thead>
                           
                            <tr>
                                <th>No</th>
                                <th style="width: 100px;">Asset Code</th>
                                <th style="width: 500px;">Serial</th>
                                <th style="width: 500px;">Description</th>
                                <th style="width: 500px;">Model</th>
                                <th style="width: 500px;">PO Number</th>
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
        var url = "{{url('/')}}";
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
                    data: 'serial',
                    name: 'serial'
                },
                {
                    data: 'assetname',
                    name: 'assetname'
                },
                {
                    data: 'models',
                    name: 'models'
                },
                {
                    data: 'payment',
                    name: 'payment'
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
                            return data.locationname_sm;
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
                        let buttonEdit =
                            '<button type="button" class="btn btn-success btn-rounded btn-icon" data-toggle="modal" data-placement="buttom" data-custom-class="tooltip-success" title="EDIT" data-target="#showModalUpdateAssetRegister" style="margin-right:5px;" onclick="buttonEdit(\'' + data + '\');"><i style="font-size:1.5rem; margin-left:-7px;" class="ti-pencil-alt"></i></button>';
                        let buttonHapus =
                            '<button type="button" class="btn btn-danger btn-rounded btn-icon" data-toggle="tooltip" data-placement="bottom" data-custom-class="tooltip-success" title="DELETE" onclick="delete_data(\''+
                            data +'\',\'asset_register\');"><i style="font-size:1.5rem; margin-left:-8px;" class="ti-trash"></i></button>';
                        let buttonMaps =
                        '<button class="btn btn-warning btn-rounded btn-icon" data-placement="buttom" data-custom-class="tooltip-success" title="Show sub location" style="margin-right:5px;" onclick="buttonViewMap(\''+data+'\');"><i style="color:white; font-size:1.5rem; margin-left:-7px;margin-top:5px" class="ti-map-alt"></i></button>';
                        return buttonMaps + buttonEdit + buttonHapus;
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

    function buildSelect() {
        let select = ['location','departement','costgroup','vendor','assetclass','costcenter','assettype'];

        for (let i = 0; i < select.length; i++) {
            // console.log(select[i]);
            get_data(select[i]).
            then(function(result) {
                result = result.data;
                $('#filter'+select[i]).append('<option value=""></option>') 
                for (let index = 0; index < result.length; index++) {

                    let value = _.values(result[index])
                        if(select[i]=='location'){
                            $('#filter'+select[i]).append('<option id=' + value[0] + ' value=' + value[0]
                            + '>' + value[2] + '</option>')  
                        }else{
                            $('#filter'+select[i]).append('<option id=' + value[1] + ' value=' + value[1]
                            + '>' + value[2] + '</option>')  
                        }
                         
                }

                $('#filter'+select[i]).select2({
                    tags: true,
                    width: '19rem',
                });
                   
            })
            .catch(function(err) {
                console.log(err);
            });
        }
      
    }

    function table_reload(){
        // console.log('here');
        var filter_asset = $('#filterasset').serialize();
        mTable.ajax.url("{{ url('/') }}/asset_filter?"+filter_asset).load();
        // console.log(filter_asset);
    }

    function change_location(value){
        $.ajax({
            type: "GET",
            url:  "{{ url('/') }}/get_sublocation?filterlocation="+$('#filterlocation').val(),
            success: function (result) {
                let sublocation = $('#filtersublocation');
                let smlocation  = $('#filtersmlocation');
                result = result.data;
                if(result.length > 0){
                    
                    sublocation.prop('disabled',false);
                    sublocation.html('')

                    $('#filtersublocation').append('<option value=""></option>')
                    
                    for (let index = 0; index < result.length; index++) {

                        let value = _.values(result[index])
                           
                            $('#filtersublocation').append('<option id=' + value[0] + ' value=' + value[0]
                            + '>' + value[2] + '</option>')  
                    }
                    $('#filtersublocation').select2({
                        tags: true,
                        width: '19rem',
                    });

                }else{
                    sublocation.prop('disabled',true);
                    sublocation.html('');
                    smlocation.prop('disabled',true);
                    smlocation.html('');
                }
            },
            error: function(response) {

                var errors = response.responseJSON.errors;

                try {
                    error_handler(errors,'u');
                } catch (err) {

                }

                $.toast({
                    heading: 'Danger',
                    text: response.responseJSON.message,
                    showHideTransition: 'slide',
                    icon: 'error',
                    loaderBg: '#f2a654',
                    position: 'top-right'
                })
            }
        });
    }

    function change_sublocation(value){
        $.ajax({
            type: "GET",
            url:  "{{ url('/') }}/get_smlocation?filterlocation="+$('#filterlocation').val()+"&filtersublocation="+$('#filtersublocation').val(),
            success: function (result) {
                let smlocation = $('#filtersmlocation');
                result = result.data;
                if(result.length > 0){
                    
                    smlocation.prop('disabled',false);
                    smlocation.html('')

                    $('#filtersmlocation').append('<option value=""></option>')
                    
                    for (let index = 0; index < result.length; index++) {

                        let value = _.values(result[index])
                           
                            $('#filtersmlocation').append('<option id=' + value[1] + ' value=' + value[1]
                            + '>' + value[2] + '</option>')  
                    }

                    $('#filtersmlocation').select2({
                        tags: true,
                        width: '19rem',
                    });

                }else{
                    smlocation.prop('disabled',true);
                    smlocation.html('');
                }
            },
            error: function(response) {

                var errors = response.responseJSON.errors;

                try {
                    error_handler(errors,'u');
                } catch (err) {

                }

                $.toast({
                    heading: 'Danger',
                    text: response.responseJSON.message,
                    showHideTransition: 'slide',
                    icon: 'error',
                    loaderBg: '#f2a654',
                    position: 'top-right'
                })
            }
        });
    }

    function change_smlocation(value){
        if(_.isNull(value)){
            
        }else{
            table_reload();
        }
    }

    function get_data(route){
        return $.ajax({
                    type: "GET",
                    url:  "{{ url('/') }}/"+route+'/create',
                });
    }

    function cetak_qr(){
        let filter_asset = $('#filterasset').serialize();
        let url = "{{ url('/') }}/print_qr?"+filter_asset;
        var win = window.open(url, '_blank');
        win.focus();
    }

    function export_asset(){
        let filter_asset = $('#filterasset').serialize();
        let url = "{{ url('/') }}/export_asset?"+filter_asset;
        var win = window.open(url, '_blank');
        win.focus();
    }

    function buttonViewMap(id){
        let url = "{{ url('/') }}/location_assets/"+id;
        var win = window.open(url, '_blank');
        win.focus();
    }

</script>
@include('asset.registerjs')
@endsection