@extends('layouts.dashboard')
@section('content')
<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div style="height: 65px; border-radius: 15px;" class="card">
            <div class="card-body">
                <div style="display: flex; align-items: flex-start; justify-content: space-between; height: 40px;">
                    <h4 class="card-title" style="font-size: 2rem; font-weight: 300; margin-bottom: 0px;">Sumarry Asset</h4>
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
                    {{-- <h4 class="card-title" style="font-size: 2rem; font-weight: 300; margin-bottom: 0px;">Filter</h4> --}}
                    <form action="#" id="searchasset">
                        <div class="row">
                            <div class="col-4">
                                <label>Cost Group</label>
                            </div>
                            <div class="col-8">
                                <label>Date Acquisition </label>
                                <div class="row">
                                    <div class="col-6">
                                        <label>Start Date</label>
                                    </div>
                                    <div class="col-6">
                                        <label>End Date</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <select name="filtercostgroup[]" id="filtercostgroup" class="form-control" multiple="multiple" onchange="table_reload()">
                                        <option value="" selected></option>
                                    </select>
                                </div>
                            </div>                      
                            <div class="col-4">
                                <div class="form-group">
                                    <input type="date" class="form-control" id="filterstartdate" name="filterstartdate" onchange="table_reload()">
                                </div>
                            </div>                      
                            <div class="col-4">
                                <div class="form-group">
                                    <input type="date" class="form-control" id="filterenddate" name="filterenddate" onchange="table_reload()">
                                </div>
                            </div>                      
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>

<!-- Tittle End -->
<button class="btn btn-primary btn-sm btn-rounded-sm mb-3 mt-3" onclick="open_table('sumarry','detailCommercials')">Detail Commercials</button>
<button class="btn btn-primary btn-sm btn-rounded-sm mb-3 mt-3" onclick="open_table('fa','Commercials')">Commercials</button>

<div class="row tabel" id="detailCommercials">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div class="card" style="border-radius: 15px;">
                <div class="card-body">
                <div class="row">
                    <a href="#" id="summary" onclick="export_asset(this.id)" class="btn btn-sm btn-primary" style="margin: -0.2rem .05rem -1rem auto;margin-bottom:20px;margin-right: 13px ">Export Excel</a>
                    <div class="col-12">
                    <div class="table-responsive">
                        <table id="detailCommercialsTable" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Cost Group</th>
                                <th>Asset Code</th>
                                <th>Location</th>
                                <th>Description</th>
                                <th>Acq Date</th>
                                <th>Acq Cost</th>
                                <th>Total Cost</th>
                                <th>Month Deprec</th>
                                <th>Accum Deprec</th>
                                <th>Total Deprec</th>
                                <th>Book Value</th>
                                <th>Total Value</th>
                                <th>Due Date</th>
                                <th>Useful Life</th>
                                <th>Age of Asset</th>
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

<div class="row tabel" id="Commercials" style="display:none;">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div class="card" style="border-radius: 15px;">
                <div class="card-body">
                <div class="row">
                    <a href="#" id="fa" onclick="export_asset(this.id)" class="btn btn-sm btn-primary" style="margin: -0.2rem .05rem -1rem auto;margin-bottom:20px;margin-right: 13px ">Export Excel</a>
                    {{-- <div class="col-12"> --}}
                    <div class="table-responsive">
                        <table id="CommercialsTable" class="table" style="width:100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>CostGroup</th>
                                <th>FA Prev</th>
                                <th>FA Current</th>
                            </tr>
                        </thead>
                        </table>
                    </div>
                    {{-- </div> --}}
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
     var mTable,commercials;
    

     $(document).ready(function () {

        buildSelect();

        //RENDER DATA TABLES
        mTable = $('#detailCommercialsTable').DataTable({
            responsive: true,
            processing: true,
            "language": {
                "processing": "<div class='dot-opacity-loader'></div>"
            },
            "order": [[ 0, "desc" ]],
            serverSide: true,
            ajax: "{{ route('get.sumarry')}}",
            columns: [
                {  
                    data: 'id',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
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
                    data: 'tangnumber',
                    name: 'tangnumber'
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
                    data: 'assetname',
                    name: 'assetname'
                },
                {
                    data: 'dateacq',
                    name: 'dateacq'
                },
                {
                    data: 'purchaseacq',
                    name: 'purchaseacq'
                },
                {
                    data: 'purchasecost',
                    name: 'purchasecost'
                },
                {
                    data: 'asset_id',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return 0;
                        }
                    }
                },
                {
                    data: 'asset_id',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return 0;
                        }
                    }
                },
                {
                    data: 'asset_id',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return 0;
                        }
                    }
                },
                {
                    data: 'purchaseacq',
                    name: 'purchaseacq'
                },
                {
                    data: 'purchaseacq',
                    name: 'purchaseacq'
                },
                {
                    data: 'duedate',
                    name: 'duedate'
                },
                {
                    data: 'useful',
                    name: 'useful'
                },
                {
                    data: 'lifetimeyear',
                    name: 'lifetimeyear'
                },
            ]
        });
        
        commercials = $('#CommercialsTable').DataTable({
            // responsive: true,
            processing: true,
            "language": {
                "processing": "<div class='dot-opacity-loader'></div>"
            },
            "order": [[ 0, "desc" ]],
            serverSide: true,
            ajax: "{{ route('get.fa')}}",
            columns: [
                {  
                    data: 'assetgroup',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
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
                    data: 'FA',
                    name: 'FA'
                },
                {
                    data: 'FA',
                    name: 'FA'
                },
            ]
        });
        
        
     });

    function open_table(id,table){

        let hide = $('.tabel');
        let show = $('#'+table);
        let tabel = $('#'+table+"Table").DataTable();
        let url = "{{ url('/') }}";
        let filter_asset = $('#searchasset').serialize();
    
        hide.hide();
        show.show();
        tabel.ajax.url(url+"/get_"+id+"?"+filter_asset).load();

    }

    function buildSelect() {
        get_data('costgroup/create').then(function(result) {
            result = result.data;
            for (let index = 0; index < result.length; index++) {

                let value = _.values(result[index])
              
                $('#filtercostgroup').append('<option id=\''+ (index + 1) +'\' value=\''+ value[1]+ '\'>' + value[2] + '</option>')  
                        
            }

            $('#filtercostgroup').select2({
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
        mTable.ajax.url("{{ url('/') }}/get_sumarry?"+filter_asset).load();
        commercials.ajax.url("{{ url('/') }}/get_fa?"+filter_asset).load();
        
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

    function export_asset(id){
        let filter_asset = $('#searchasset').serialize();
        let url = "{{ url('/') }}/export_"+id+'?'+filter_asset;
        var win = window.open(url, '_blank');
        win.focus();
    }

    

</script>
@endsection