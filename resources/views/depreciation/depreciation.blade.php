@extends('layouts.dashboard')
@section('content')
@include('asset.modalregister')
<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div style="height: 65px; border-radius: 15px;" class="card">
            <div class="card-body">
                <div style="display: flex; align-items: flex-start; justify-content: space-between; height: 40px;">
                    <h4 class="card-title" style="font-size: 2rem; font-weight: 300; margin-bottom: 0px;">Asset Depreciation</h4>
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
                    <form action="#" id="searchasset">
                        <div class="row col-12">
                            <div class="form-group col-4">
                                <label>Depreciation</label>
                                <select name="filterdepreciation" id="filterdepreciation" class="form-control form-control-sm" onchange="table_reload()">
                                <option value="" selected></option>
                                <option value="Non depreciable">Non depreciable</option>
                                <option value="Straight Line">Straight Line</option>
                                <option value="Decline">Decline</option>
                                <option value="Double Decline">Double Decline</option>
                                <option value="Sum of year digits">Sum of year digits</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
                                <th style="width: 500px;">Description</th>
                                <th style="width: 500px;">Depreciation</th>
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
                    data: 'comdepreciation',
                    name: 'comdepreciation'
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
                        
                        let buttonDetail   = '<button type="button" class="btn btn-info btn-rounded btn-icon m-2" data-toggle="modal" data-placement="buttom" data-custom-class="tooltip-success" title="DETAIL style="margin-right:5px;" onclick="detail_depreciation(\''+ (_.isNull(row.tangnumber) == true ? null : row.tangnumber) +'\');"><i style="color:white; font-size:1.5rem; margin-left:-11px;" class="fa fa-balance-scale"></i></button>'
                        let buttonEdit =
                            '<button type="button" class="btn btn-success btn-rounded btn-icon m-2" data-toggle="modal" data-placement="buttom" data-custom-class="tooltip-success" title="EDIT" data-target="#showModalUpdateAssetRegister" style="margin-right:5px;" onclick="buttonEdit(\'' + data + '\');"><i style="font-size:1.5rem; margin-left:-7px;" class="ti-pencil-alt"></i></button>';
                        return buttonDetail + buttonEdit;
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
 
        $('#filterdepreciation').select2({
            tags: true,
            width: '19rem',
        });
      
    }
    
    function table_reload(){
        // console.log('here');
        var filter_asset = $('#searchasset').serialize();
        mTable.ajax.url("{{ url('/') }}/asset_filter?"+filter_asset).load();
        // console.log(filter_asset);
    }

    function get_data(route){
        return $.ajax({
                    type: "GET",
                    url:  "{{ url('/') }}/"+route+'/create',
                });
    }

    function detail_depreciation(tagnumber){
        let url = "{{ url('/') }}/depreciation/"+tagnumber;
        var win = window.open(url, '_blank');
        win.focus();
    }

</script>
@include('asset.registerjs')
@endsection