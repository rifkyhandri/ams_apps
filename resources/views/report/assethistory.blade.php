@extends('layouts.dashboard')
@section('content')
@include('asset.modalregister')
<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div style="height: 65px; border-radius: 15px;" class="card">
            <div class="card-body">
                <div style="display: flex; align-items: flex-start; justify-content: space-between; height: 40px;">
                    <h4 class="card-title" style="font-size: 2rem; font-weight: 300; margin-bottom: 0px;">Asset History</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div style="border-radius: 15px;" class="card">
            <div class="card-body">
                <form action="#" class="display: flex; align-items: flex-start; justify-content: space-between;" id="searchasset">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Tag Number</label>
                                <select name="filtertagnumber" id="filtertagnumber" class="form-control form-control-sm" onchange="table_reload()">
                                <option value="" selected></option>
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
                    <div class="table-responsive">
                        <table id="assetTable" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th style="width: 100px;">Asset Code</th>
                                <th style="width: 500px;">Time Stamp</th>
                                <th style="width: 500px;">User</th>
                                <th style="width: 500px;">Transaction</th>
                                <th></th>
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
            ajax: "{{ route('get.history')}}",
            columns: [
                {  
                    data: 'id',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'NewValue_Remark',
                    render: function (data, type, row, meta) {
                        if(_.isNull(data)){
                            return null;
                        }else{
                            return data.tangnumber;
                        }
                    }
                },
                {
                    data: 'ChangedDateandTime',
                    name: 'ChangedDateandTime'
                },
                {
                    data: 'UserID',
                    name: 'UserID'
                },
                {
                    data: 'Action_Activity',
                    name: 'Action_Activity'
                },
                {
                    "className":     'details-control ti-split-v',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ''
                },
            ]
        });

        // Array to track the ids of the details displayed rows
        var detailRows = [];
        
        $('#assetTable tbody').on('click', 'tr td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = mTable.row( tr );
                var idx = $.inArray( tr.attr('id'), detailRows );
        
                if ( row.child.isShown() ) {
                    tr.removeClass( 'details' );
                    row.child.hide();
        
                    // Remove from the 'open' array
                    detailRows.splice( idx, 1 );
                }
                else{
                    tr.addClass( 'details' );
                    row.child( format( row.data() ) ).show();
        
                    // Add to the 'open' array
                    if ( idx === -1 ) {
                        detailRows.push( tr.attr('id') );
                    }
                }
            });
            console.log(detailRows);
            // On each draw, loop over the `detailRows` array and show any child rows
            mTable.on( 'draw', function () {
                $.each( detailRows, function ( i, id ) {
                    $('#'+id+' td.details-control').trigger( 'click' );
                });
            });


     });

    function format ( d ) {
        console.log(d)
        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                '<tr>'+
                    '<td>FieldName:</td>'+
                    '<td>Before</td>'+
                    '<td>After</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Asset Code:</td>'+
                    '<td>'+d.OldValue_Remark.tangnumber+'</td>'+
                    '<td>'+d.NewValue_Remark.tangnumber+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Asset Name:</td>'+
                    '<td>'+d.OldValue_Remark.assetname+'</td>'+
                    '<td>'+d.NewValue_Remark.assetname+'</td>'+
                '</tr>'+
                // '<tr>'+
                //     '<td>Model:</td>'+
                //     '<td>'+d.OldValue_Remark.models+'</td>'+
                //     '<td>'+d.NewValue_Remark.models+'</td>'+
                // '</tr>'+
                // '<tr>'+
                //     '<td>PO Number:</td>'+
                //     '<td>'+d.OldValue_Remark.payment+'</td>'+
                //     '<td>'+d.NewValue_Remark.payment+'</td>'+
                // '</tr>'+
                '<tr>'+
                    '<td>Departement:</td>'+
                    '<td>'+d.OldValue_Remark.departement+'</td>'+
                    '<td>'+d.NewValue_Remark.departement+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Asset Group:</td>'+
                    '<td>'+d.OldValue_Remark.assetgroup+'</td>'+
                    '<td>'+d.NewValue_Remark.assetgroup+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Location:</td>'+
                    '<td>'+d.OldValue_Remark.location+'</td>'+
                    '<td>'+d.NewValue_Remark.location+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Cost Center:</td>'+
                    '<td>'+d.OldValue_Remark.costcenter+'</td>'+
                    '<td>'+d.NewValue_Remark.costcenter+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Custodian:</td>'+
                    '<td>'+d.OldValue_Remark.custodian+'</td>'+
                    '<td>'+d.NewValue_Remark.custodian+'</td>'+
                '</tr>'+
            '</table>';
    }

    function buildSelect() {
        get_data('asset_list').then(function(result) {
            result = result.data;
            for (let index = 0; index < result.length; index++) {

                let value = _.values(result[index])
               
                $('#filtertagnumber').append('<option id=\''+ (index + 1) +'\' value=\''+ value[0]+ '\'>' + value[2] + '</option>')  
                        
            }

            $('#filtertagnumber').select2({
                tags: true,
                wimTableh: '19rem',
            });
                
        })
        .catch(function(err) {
            console.log(err);
        });
      
    }
    
    function table_reload(){
       
        var filter_asset = $('#searchasset').serialize();
        mTable.ajax.url("{{ url('/') }}/get_history?"+filter_asset).load();
        
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

</script>
@endsection
@include('servicetools.servicemodal')