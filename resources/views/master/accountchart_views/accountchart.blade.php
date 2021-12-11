@extends('layouts.dashboard')
@section('content')
@section('account_group_select')   
@foreach ($account_group as $agroup)
<option value="{{$agroup->account_group_name}}">{{$agroup->account_group_name}}</option>                                             
@endforeach 
@stop
@section('account_group_sub')   
@foreach ($account_sub as $asub)
<option value="{{$asub->account_sub_name}}">{{$asub->account_sub_name}}</option>                                             
@endforeach 
@stop
<!-- Tittle -->
@section('modal_import_excel'){{route('accountchart.import')}}@stop
@section('importExcel'){{'importAccountChart'}}@stop
<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div style="height: 65px; border-radius: 15px;" class="card">
            <div class="card-body">
                <div style="display: flex; align-items: flex-start; justify-content: space-between; height: 40px;">
                    <h4 class="card-title" style="font-size: 2rem; font-weight: 300; margin-bottom: 0px;">Account Chart</h4>
                    {{-- <button type="button" class="btn btn-success btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" data-custom-class="tooltip-success" title="EDIT" data-target="#showModalUpdateAssetClass" style="margin-right:5px;"><i style="font-size:1.5rem; margin-left:-7px;" class="ti-pencil-alt"></i></button> --}}
                    <button style="margin: -0.2rem .05rem -1rem auto;" type="button" class="btn btn-primary btn-sm"
                        data-toggle="modal" data-target="#showModalInsertAccountChart"><i
                            class="ti-plus menu-icon"></i>&ensp;
                        ADD</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Tittle End -->
<a href="{{route('accountchart_export')}}" class="btn btn-primary btn-sm btn-rounded-sm mb-3 mt-3">Export Excel</a>
<a href="#" onclick="print_asset()" class="btn btn-primary btn-sm btn-rounded-sm mb-3 mt-3">Print</a>
<button type="button" class="btn btn-primary mr-5 btn-sm" data-toggle="modal" data-target="#importExcel">
    IMPORT EXCEL
</button>

<!-- Table -->
<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div class="card" style="border-radius: 15px;">
                <div class="card-body">
                {{-- <h4 class="card-title">Data table</h4> --}}
                <div class="row">
                    <div class="col-12">
                    <div class="table-responsive">
                        <table id="accountchartTable" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th style="width: 100px;">Account No</th>
                                <th style="width: 500px;">Account Name</th>
                                <th style="width: 500px;">Account Group</th>
                                <th style="width: 500px;">Sub Group</th>
                                <th style="width: 500px;">Sort Name</th>
                                <th style="width: 500px;">Old Account Name</th>
                                <th style="width: 500px;">Status</th>
                                <th style="width: 500px;">Level</th>
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
<script>

    var mTable;

    $(document).ready(function () {
        //RENDER DATA TABLES
        mTable = $('#accountchartTable').DataTable({
            responsive: true,
            processing: true,
            "language": {
                "processing": "<div class='dot-opacity-loader'></div>"
            },
            "order": [[ 0, "desc" ]],
            serverSide: true,
            ajax: "{{ route('account.create')}}",
            dom: 'Bfrtip',
            buttons: [
               
            ],
            columns: [
                {  data: 'id',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'accountno',
                    name: 'accountno'
                },
                {
                    data: 'accountname',
                    name: 'accountname'
                },
                {
                    data: 'accountgroup',
                    name: 'accountgroup'
                },
                {
                    data: 'subgroup',
                    name: 'subgroup'
                },
                {
                    data: 'accountshortname',
                    name: 'accountshortname'
                },
                {
                    data: 'oldaccount',
                    name: 'oldaccount'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'level',
                    name: 'level'
                },
                {
                    data: 'id',
                    render: function (data, type, row) {
                        let buttonEdit =
                            '<button type="button" class="btn btn-success btn-rounded btn-icon" data-toggle="modal" data-placement="buttom" data-custom-class="tooltip-success" title="EDIT" data-target="#showModalUpdateAccountChart" style="margin-right:5px;" onclick="buttonEdit(\'' + data + '\');"><i style="font-size:1.5rem; margin-left:-7px;" class="ti-pencil-alt"></i></button>';
                        let buttonHapus =
                            '<button type="button" class="btn btn-danger btn-rounded btn-icon" data-toggle="tooltip" data-placement="bottom" data-custom-class="tooltip-success" title="DELETE" onclick="delete_data(\''+
                            data +'\',\'account\');"><i style="font-size:1.5rem; margin-left:-8px;" class="ti-trash"></i></button>';
                        return buttonEdit + buttonHapus;
                    }
                }
            ]
        });

        //INSERT Departement
        $('#formInputAccountChart').on('submit', function (e) {
            e.preventDefault();

            var url,data,form;

            url = 'account';           //For routing
            data = $(this).serialize();    // Data Form
            form = 'AccountChart';          //Reset Trigger and Close Modal

            // General form insert_data(url,data,form)
            insert_data(url,data,form);

        });

            $("#hide").click(function(){
            $("p").hide();
            });

        //UPDATE Departement
        $('#formUpdateAccountChart').on('submit', function (e) {

            e.preventDefault();
            var url,data,form;

            url = 'account';           //For routing
            data = $(this).serialize(); // Data Form
            form = 'AccountChart';          // Reset Trigger and Close Modal

            // General form update_data(url,data,form)
            update_data(url,data,form);
        });

    });
    function print_asset(){
        let url = "{{ url('/') }}/accountchart_print?";
        var win = window.open(url, '_blank');
        win.focus();
    }
    //EDIT BUTTON VIEW
    function buttonEdit(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("input[name='_token']").val()
            }
        });
        $.ajax({
            type: "GET",
            url: "{{ route('account.edit',['account'=>1]) }}",
            data: {
                id: id
            },
            success: function (data) {
                if (data) {
                    clear_error();
                    console.log(data);
                    $("#idAccountChart").val(data.id);
                    $("#Updateaccountno").val(data.accountno);
                    $("#Updateaccountname").val(data.accountname);
                    $("#Updateaccountshortname").val(data.accountshortname);
                    $("#Updateaccountgroup").val(data.accountgroup);
                    $("#Updateoldaccount").val(data.oldaccount);
                    $("#Updatesubgroup").val(data.subgroup);
                    $("#Updatelevel").val(data.level);
                    (data.status == "Actived" ? $("#UpdatestatusAccountA").val(data.status).prop('checked',true) : $("#UpdatestatusAccountS").val(data.status).prop('checked',true));
                } else {

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
