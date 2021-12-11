@extends('layouts.dashboard')
@section('content')
@include('asset.modalregister')
<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div style="height: 65px; border-radius: 15px;" class="card">
            <div class="card-body">
                <div style="display: flex; align-items: flex-start; justify-content: space-between; height: 40px;">
                    <h4 class="card-title" style="font-size: 2rem; font-weight: 300; margin-bottom: 0px;">Service Tools</h4>
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
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Tag Number</label>
                                    <select name="filtertagnumber" id="filtertagnumber" class="form-control form-control-sm" onchange="table_reload()">
                                    <option value="" selected></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <label>Service</label>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label>From</label>
                                            <input type="date" class="form-control" id="filterstartservice" name="filterstartservice" onchange="table_reload()">
                                        </div>
                                        <div class="col-6">
                                            <label>To</label>
                                            <input type="date" class="form-control" id="filterendservice" name="filterendservice" onchange="table_reload()">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <label>Warranty</label>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label>From</label>
                                            <input type="date" class="form-control" id="filterstartwarranty" name="filterstartwarranty" onchange="table_reload()">
                                        </div>
                                        <div class="col-6">
                                            <label>To</label>
                                            <input type="date" class="form-control" id="filterendwarranty" name="filterendwarranty" onchange="table_reload()">
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
                                <th style="width: 500px;">Asset Group</th>
                                <th style="width: 500px;">Location</th>
                                <th style="width: 500px;">Service Provider</th>
                                <th style="width: 500px;">Next Service</th>
                                <th style="width: 500px;">End of Warranty</th>
                                <th style="width: 500px;">Service Contract</th>
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
                    data: 'objprovider',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return data.providername;
                        }
                    }
                },
                {
                    data: 'nextservice',
                    name: 'nextservice'
                },
                {
                    data: 'warranty',
                    name: 'warranty'
                },
                {
                    data: 'servicecontract',
                    name: 'servicecontract'
                },
                {
                    data: 'asset_id',
                    render: function (data, type, row) {
                        
                        let buttonAction = '<button type="button" class="btn btn-primary btn-rounded btn-icon" data-toggle="modal" data-placement="buttom" data-custom-class="tooltip-success" title="SERVICE" data-target="#showModalInsertService" style="margin-right:5px;" onclick="buttonEdit(\'' + data + '\');"><i style="font-size:1.5rem; margin-left:-7px;" class="fa fa-plus"></i></button>';

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

          //INSERT Departement
          $('#formInputService').on('submit', function (e) {
            e.preventDefault();

            var url,data,form;

            var myform = $('#formInputService');
      
            //turn off disabled
            var disabled = myform.find(':input:disabled').removeAttr('disabled');
            
            url = 'service';                               //For routing
            data = $('#formInputService').serialize();    // Data Form
            form = 'Service';                            //Reset Trigger and Close Modal
            
            //turn on disabled
            disabled.attr('disabled','disabled');
            
            // General form insert_data(url,data,form)
            insert_data(url,data,form);

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
        mTable.ajax.url("{{ url('/') }}/asset_filter?"+filter_asset).load();
        
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