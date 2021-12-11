@extends('layouts.dashboard')
@section('content')
@include('asset.modalregister')

<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div style="height: 65px; border-radius: 15px;" class="card">
            <div class="card-body">
                <div style="display: flex; align-items: flex-start; justify-content: space-between; height: 40px;">
                    <h4 class="card-title" style="font-size: 2rem; font-weight: 300; margin-bottom: 0px;">Asset Detail Depreciation</h4>
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
                <form action="#">
                <div class="row col-12">
                    <div class="col-3 m-2">
                        <label>Current Date Book Value</label>
                        <input type="text" class="form-control form-control-sm" id="currbookval" name="currbookval">
                    </div>
                    <div class="col-4 m-2">
                        <label>Depreciation Value this Period </label>
                        <div class="row">
                            <select name="date" id="date" class="form-control form-control-sm ml-2 col-5">
                                <option value="{{ NOW()->format('Y-m-d') }}">{{ NOW()->format('Y-m-d') }}</option>
                            </select>
                            <input type="text" class="form-control form-control-sm ml-2 col-6" id="currdepr" name="currdepr">
                        </div>
                    </div>
                    <div class="col-4 m-2">
                        <label>Depreciation Value Previous month </label>
                        <input type="text" class="form-control form-control-sm" id="prevdepr" name="prevdepr">
                    </div>
                    <div class="col-3 m-2">
                        <label>Book Value</label>
                        <input type="text" class="form-control form-control-sm" id="bookval" name="bookval">
                    </div>
                    <div class="col-3 m-2">
                        <label>Prev Book Value</label>
                        <input type="text" class="form-control form-control-sm" id="prevbookval" name="prevbookval">
                    </div>
                    <div class="col-4 m-2">
                        <label>Accum Deprec</label>
                        <input type="text" class="form-control form-control-sm" id="accumdepr" name="accumdepr">
                    </div>
                    <div class="col-3 m-2">
                        <label>Prev Accum Deprec</label>
                        <input type="text" class="form-control form-control-sm" id="prevaccumdepr" name="prevaccumdepr">
                    </div>
                    
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div style="border-radius: 15px;" class="card">
            <div class="card-body">
                <form action="#" id="depreciationheader">
                <div style="display: flex; align-items: flex-start; justify-content: space-between;">
                    {{-- <h4 class="card-title" style="font-size: 2rem; font-weight: 300; margin-bottom: 0px;">Filter</h4> --}}
                        <div class="row col-12">
                            <div class="form-group col-4">
                                <label>Asset Code</label>
                                <input type="text" class="form-control form-control-sm" id="tangnumber" name="tangnumber">
                            </div>
                            <div class="form-group col-4">
                                <label>Purchase Date</label>
                                <input type="text" class="form-control form-control-sm" id="datepurchase" name="datepurchase">
                            </div>
                            <div class="form-group col-4">
                                <label>Acq Date </label>
                                <input type="text" class="form-control form-control-sm" id="dateacq" name="dateacq">
                            </div>
                            <div class="form-group col-4">
                                <label>Active Date</label>
                                <input type="text" class="form-control form-control-sm" id="activedate" name="activedate">
                            </div> 
                            <div class="form-group col-4">
                                <label>Description</label>
                                <input type="text" class="form-control form-control-sm" id="assetname" name="assetname">
                            </div>
                            <div class="form-group col-4">
                                <label>Lifetime:</label>
                                <div class="row">
                                    <input type="text" class="form-control form-control-sm ml-3 mr-3 col-2" id="lifetimeyear" name="lifetimeyear">
                                    Year(s)
                                    <input type="text" class="form-control form-control-sm ml-3 mr-3 col-2" id="livetimemonth" name="livetimemonth">
                                    Month (s)
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label>Model</label>
                                <input type="text" class="form-control form-control-sm" id="models" name="models">
                            </div>
                            <div class="form-group col-4">
                                <label>Depreciation</label>
                                <input type="text" class="form-control form-control-sm" id="comdepreciation" name="comdepreciation">
                            </div>
                            <div class="form-group col-2">
                                <label>Rate:</label>
                                <input type="text" class="form-control form-control-sm" id="bookrate" name="bookrate">
                            </div>
                            <div class="form-group col-2">
                                <label>Salvage</label>
                                <input type="text" class="form-control form-control-sm" id="salvage1" name="salvage1">
                            </div>
                            <div class="form-group col-4">
                                <label>Notes</label>
                                <input type="text" class="form-control form-control-sm" id="notes" name="notes">
                            </div>
                            <div class="form-group col-4">
                                <label>Journal Desc</label>
                                <input type="text" class="form-control form-control-sm" id="journaldesc" name="journaldesc">
                            </div>
                            <div class="form-group col-4">
                                <label>Status</label>
                                <input type="text" class="form-control form-control-sm" id="status" name="status">
                            </div>
                        </div>
                    </div>
                </form>
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
                                <th style="width: 100px;">Year/Month</th>
                                <th style="width: 500px;">Fiscal Y/M</th>
                                <th style="width: 500px;">Aged (Month)</th>
                                <th style="width: 500px;">Book Value</th>
                                <th style="width: 500px;">Depreciation This Month</th>
                                <th style="width: 500px;">Accumulated Depreciation</th>
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
        set_header();
        //RENDER DATA TABLES
        mTable = $('#assetTable').DataTable({
            responsive: true,
            processing: true,
            "language": {
                "processing": "<div class='dot-opacity-loader'></div>"
            },
            "order": [[ 1, "asc" ]],
            serverSide: true,
            ajax: "{{ route('get_depreciation',['tag'=>request()->route('tag')])}}",
            // data: filter_asset,
            columns: [
                {  data: 'asset_id',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'fiscal',
                    name: 'fiscal'
                },
                {
                    data: 'age',
                    name: 'age'
                },
                {
                    data: 'bookvalue',
                    render: function (data, type, row) {
                        book_value = new Intl.NumberFormat(['ban', 'id']).format(row.book_value);
                        return book_value;
                    }
                },
                {
                    data: 'depr_value',
                    render: function (data, type, row) {
                        depr_value = new Intl.NumberFormat(['ban', 'id']).format(row.depr_value);
                        return depr_value;
                    }
                },
                {
                    data: 'depr_accu',
                    render: function (data, type, row) {
                        depr_accu = new Intl.NumberFormat(['ban', 'id']).format(row.depr_accu);
                        return depr_accu;
                    }
                },
               
            ]
        });
        //

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

    function set_header(){
        let asset_header;
        let currentdata = false;
        let bookval;
        let currbookval;
        let prevbookval;
        let currdepr;
        let prevdepr;
        let accumdepr;
        let prevaccumdepr;

        get_data_asset("{{ route('get_depreciation',['tag'=>request()->route('tag')])}}")
        .then(function(result) {
            
            asset_header = result.data[0].asset;
            isi = result.data[0];

            _.forEach(asset_header, function(value, key) {
              
                $('#'+key).val(value);
            });

            _.forEach(result.data, function(value, key) {    
               
                if(value.date == "{{ NOW()->format('Y-m') }}"){
                    currentdata = true;
                    bookval = Number(value.book_value) + (Number(value.depr_value) * Number(value.age));
                    currbookval = bookval - (value.depr_value * value.age.toString());
                    prevbookval = bookval - (value.depr_value * (value.age.toString() - "1"));
                    currdepr = value.depr_value;
                    prevdepr = value.depr_value;
                    accumdepr = value.depr_accu;
                    prevaccumdepr = value.depr_accu - value.depr_value;
                    console.log(value.age.toString());
                    $('#bookval').val(new Intl.NumberFormat(['ban', 'id']).format(currbookval));
                    $('#currbookval').val(new Intl.NumberFormat(['ban', 'id']).format(currbookval));
                    $('#prevbookval').val(new Intl.NumberFormat(['ban', 'id']).format(prevbookval));
                    $('#currdepr').val(new Intl.NumberFormat(['ban', 'id']).format(currdepr));
                    $('#prevdepr').val(new Intl.NumberFormat(['ban', 'id']).format(prevdepr));
                    $('#accumdepr').val(new Intl.NumberFormat(['ban', 'id']).format(accumdepr));
                    $('#prevaccumdepr').val(new Intl.NumberFormat(['ban', 'id']).format(prevaccumdepr));
                }

            });

            if(currentdata == false){
                $('#bookval').val(new Intl.NumberFormat(['ban', 'id']).format(asset_header.purchaseacq));
                $('#currbookval').val(new Intl.NumberFormat(['ban', 'id']).format(asset_header.purchaseacq));
                $('#prevbookval').val(new Intl.NumberFormat(['ban', 'id']).format(asset_header.purchaseacq));
                $('#currdepr').val(0);
                $('#prevdepr').val(0);
                $('#accumdepr').val(0);
                $('#prevaccumdepr').val(0);
            }
            
        })
        .catch(function(err) {
            console.log(err);
        });
     
    }
    
    function table_reload(){
        // console.log('here');
        var filter_asset = $('#searchasset').serialize();
        mTable.ajax.url("{{ url('/') }}/asset_filter?"+filter_asset).load();
        // console.log(filter_asset);
    }

    function get_data_asset(route){
        return $.ajax({
                    type: "GET",
                    url:  route,
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