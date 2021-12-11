@extends('layouts.dashboard')
@section('content')
@include('asset.modalregister')
@section('modal_import_excel'){{route('import_asset')}}@stop
@section('importExcel'){{'importAsset'}}@stop
<!-- Tittle -->
<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div style="height: 65px; border-radius: 15px;" class="card">
            <div class="card-body">
                <div style="display: flex; align-items: flex-start; justify-content: space-between; height: 40px;">
                    <h4 class="card-title" style="font-size: 2rem; font-weight: 300; margin-bottom: 0px;">Asset Register</h4>
                    {{-- <button type="button" class="btn btn-success btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" data-custom-class="tooltip-success" title="EDIT" data-target="#showModalUpdateAssetClass" style="margin-right:5px;"><i style="font-size:1.5rem; margin-left:-7px;" class="ti-pencil-alt"></i></button> --}}
                    <button style="margin: -0.2rem .05rem -1rem auto;" type="button" class="btn btn-primary btn-sm"
                        data-toggle="modal" data-target="#showModalInsertAssetRegister"><i
                            class="ti-plus menu-icon"></i>&ensp;
                        ADD</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Tittle End -->
<!-- Button Import -->
<button type="button" class="btn btn-primary m-2 btn-sm" data-toggle="modal" data-target="#importExcel">
    IMPORT excel
</button>
<!-- End Button -->
<!-- Table -->
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
                                <th style="padding-left: 10px;">Action</th>
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
{{-- Table End --}}
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
    var detail_location;
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
            ajax: "{{ route('asset_register.create')}}",
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
                        
                        let buttonQr   = '<button type="button" class="btn btn-info btn-rounded btn-icon" data-toggle="modal" data-placement="buttom" data-custom-class="tooltip-success" title="BARCODE" data-target="#showModalQR" style="margin-right:5px;" onclick="buttonQR(\''+ (_.isNull(row.tangnumber) == true ? null : row.tangnumber) +'\');"><i style="color:white; font-size:1.5rem; margin-left:-7px;" class="fa fa-qrcode"></i></button>'
                        let buttonEdit =
                            '<button type="button" class="btn btn-success btn-rounded btn-icon" data-toggle="modal" data-placement="buttom" data-custom-class="tooltip-success" title="EDIT" data-target="#showModalUpdateAssetRegister" style="margin-right:5px;" onclick="buttonEdit(\'' + data + '\');"><i style="font-size:1.5rem; margin-left:-7px;" class="ti-pencil-alt"></i></button>';
                        let buttonHapus =
                            '<button type="button" class="btn btn-danger btn-rounded btn-icon" data-toggle="tooltip" data-placement="bottom" data-custom-class="tooltip-success" title="DELETE" onclick="delete_data(\''+
                            data +'\',\'asset_register\');"><i style="font-size:1.5rem; margin-left:-8px;" class="ti-trash"></i></button>';
                        return buttonEdit + buttonHapus + buttonQr ;
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
</script>
@include('asset.registerjs')
@endsection
