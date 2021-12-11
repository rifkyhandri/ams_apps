@extends('layouts.dashboard')
@section('content')
<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div style="height: 65px; border-radius: 15px;" class="card">
            <div class="card-body">
                <div style="display: flex; align-items: flex-start; justify-content: space-between; height: 40px;">
                    <h4 class="card-title" style="font-size: 2rem; font-weight: 300; margin-bottom: 0px;">Stock Take</h4>
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
                                <label>Tag Number</label>
                            </div>
                            <div class="col-8">
                                <label>Service</label>
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
                                    <select name="filtertagnumber" id="filtertagnumber" class="form-control " onchange="table_reload()">
                                        <option value="" selected></option>
                                    </select>
                                </div>
                            </div>                      
                            <div class="col-4">
                                <div class="form-group">
                                    <input type="date" class="form-control" id="filterstartstock" name="filterstartstock" onchange="table_reload()">
                                </div>
                            </div>                      
                            <div class="col-4">
                                <div class="form-group">
                                    <input type="date" class="form-control" id="filterstartstock" name="filterendstock" onchange="table_reload()">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <select name="filterstatus" id="filterstatus" class="form-control " onchange="table_reload()">
                                        <option value="" selected></option>
                                        <option value="Asset not found/Not Checked">Asset not found/Not Checked</option>
                                        <option value="Asset found">Asset found</option>
                                        <option value="Asset not booked/New">Asset not booked/New</option>
                                    </select>
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
                        <div class="row">
                            <a href="#" onclick="export_asset()" class="btn btn-primary btn-sm ml-3 mb-3">Export Excel <i class="fa fa-file-excel-o text-white"></i></a>
                            <a href="#" onclick="print_asset()" target="_blank" class="btn btn-primary btn-sm ml-3 mb-3">Print <i class="fa fa-print text-white"></i></a>
                        </div>
                    <div class="table-responsive">
                        <table id="assetTable" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Asset Code</th>
                                <th>Serial</th>
                                <th>Description</th>
                                <th>Departement</th>
                                <th>Location</th>
                                <th>Date SO</th>
                                <th>Admin SO</th>
                                <th>Status SO</th>
                                <th>Condition</th>
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
            ajax: "{{ route('get.stocktake')}}",
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
                            return data.assetname;
                        }
                    }
                },
                {
                    data: 'approveasset',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return (_.isNull(data.objdepartement) ? null : data.objdepartement.departementdesc);
                        }
                    }
                },
                {
                    data: 'approveasset',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return (_.isNull(data.objlocation) ? null : data.objlocation.locationname_sm);
                        }
                    }
                },
                {
                    data: 'transaction_date',
                    name: 'transaction_date'
                },
                {
                    data: 'approver',
                    name: 'approver'
                },
                {
                    data: 'change_stock_opname',
                    name: 'change_stock_opname'
                },
                {
                    data: 'approvecondition',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return data.conditiondesc;
                        }
                    }
                },
            ]
        });
           
     });

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
        mTable.ajax.url("{{ url('/') }}/get_stocktake?"+filter_asset).load();
        
    }

    function get_data(route){
        return $.ajax({
                    type: "GET",
                    url:  "{{ url('/') }}/"+route,
                });
    }
    function export_asset(){
        let filter_asset = $('#searchasset').serialize();
        let url = "{{ url('/') }}/report_stocktake?"+filter_asset;
        var win = window.open(url, '_blank');
        win.focus();
    }
    function print_asset(){
        let filter_asset = $('#searchasset').serialize();
        let url = "{{ url('/') }}/print_stocktake?"+filter_asset;
        var win = window.open(url, '_blank');
        win.focus();
    }

</script>
@endsection