@extends('layouts.dashboard')
@section('content')
<!-- Tittle -->


@section('vendor_user_id'){{Auth::user()->id}}@stop
@section('modal_import_excel'){{route('vendor.import')}}@stop
<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div style="height: 65px; border-radius: 15px;" class="card">
            <div class="card-body">
                <div style="display: flex; align-items: flex-start; justify-content: space-between; height: 40px;">
                    <h4 class="card-title" style="font-size: 2rem; font-weight: 300; margin-bottom: 0px;">Vendor</h4>
                    {{-- <button type="button" class="btn btn-success btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" data-custom-class="tooltip-success" title="EDIT" data-target="#showModalUpdateAssetClass" style="margin-right:5px;"><i style="font-size:1.5rem; margin-left:-7px;" class="ti-pencil-alt"></i></button> --}}
                    <button style="margin: -0.2rem .05rem -1rem auto;" id="add_data" type="button" class="btn btn-primary btn-sm"
                        data-toggle="modal" data-target="#showModalInsertVendor"><i
                            class="ti-plus menu-icon"></i>&ensp;
                        ADD</button>
                </div>
            </div>
        </div>
    </div>
</div>


<a href="{{route('vendor_export')}}" class="btn btn-primary btn-sm mb-3 mt-3">Export Excel</a>
<a href="#" onclick="print_asset()" class="btn btn-primary btn-sm mb-3 mt-3">Print</a>
<button type="button" class="btn btn-primary mr-5 btn-sm" data-toggle="modal" data-target="#importExcel">
    IMPORT EXCEL
</button>
<!-- Tittle End -->

<!-- Table -->
<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div class="card" style="border-radius: 15px;">
                <div class="card-body">
                {{-- <h4 class="card-title">Data table</h4> --}}
                <div class="row">
                    <div class="col-12">
                    <div class="table-responsive">
                        <table id="vendorTable" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th style="width: 100px;">Vendor Code</th>
                                <th style="width: 500px;">Name</th>
                                <th style="width: 500px;">Account</th>
                                <th style="width: 500px;">Status</th>
                                <th style="width: 500px;">Phone</th>
                                <th style="width: 500px;">PIC</th>
                                <th style="width: 500px;">PIC Phone</th>
                                <th style="width: 500px;">PIC Email</th>
                                <th style="width: 500px;">City</th>
                                <th style="width: 500px;">Postal Code</th>
                                <th style="width: 500px;">Address</th>
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
        mTable = $('#vendorTable').DataTable({
            responsive: true,
            processing: true,
            "language": {
                "processing": "<div class='dot-opacity-loader'></div>"
            },
            "order": [[ 0, "desc" ]],
            serverSide: true,
            ajax: "{{ route('vendor.create')}}",
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
                    data: 'vendorcode',
                    name: 'vendorcode'
                },
                {
                    data: 'vendorname',
                    name: 'vendorname'
                },
                {
                    data: 'account',
                    name: 'account'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'pic',
                    name: 'pic'
                },
                {
                    data: 'pic_phone',
                    name: 'pic_phone'
                },
                {
                    data: 'pic_email',
                    name: 'pic_email'
                },
                {
                    data: 'city',
                    name: 'city'
                },
                {
                    data: 'postal',
                    name: 'postal'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'id',
                    render: function (data, type, row) {
                        let buttonEdit =
                            '<button type="button" class="btn btn-success btn-rounded btn-icon" data-toggle="modal" data-placement="buttom" data-custom-class="tooltip-success" title="EDIT" data-target="#showModalUpdateVendor" style="margin-right:5px;" onclick="buttonEdit(\'' + data + '\');"><i style="font-size:1.5rem; margin-left:-7px;" class="ti-pencil-alt"></i></button>';
                        let buttonHapus =
                            '<button type="button" class="btn btn-danger btn-rounded btn-icon" data-toggle="tooltip" data-placement="bottom" data-custom-class="tooltip-success" title="DELETE" onclick="delete_data(\''+
                            data +'\',\'vendor\');"><i style="font-size:1.5rem; margin-left:-8px;" class="ti-trash"></i></button>';
                        return buttonEdit + buttonHapus;
                    }
                }
            ]
        });
        $('#add_data').on('click', function (e) {
           
            
        });
        //INSERT Departement
        $('#formInputVendor').on('submit', function (e) {
            e.preventDefault();

            var url,data,form;

            url = 'vendor';           //For routing
            data = $(this).serialize();    // Data Form
            form = 'Vendor';          //Reset Trigger and Close Modal

            // General form insert_data(url,data,form)
            insert_data(url,data,form);
            // window.location.reload();
        });
        
        //UPDATE Departement
        $('#formUpdateVendor').on('submit', function (e) {

            e.preventDefault();
            var url,data,form;

            url = 'vendor';           //For routing
            data = $(this).serialize(); // Data Form
            form = 'Vendor';          // Reset Trigger and Close Modal

            // General form update_data(url,data,form)
            update_data(url,data,form);
        });

    });
    function print_asset(){
        let url = "{{ url('/') }}/vendor_print?";
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
            url: "{{ route('vendor.edit',['vendor'=>1]) }}",
            data: {
                id: id
            },
            success: function (data) {
                if (data) {
                    clear_error();
                    $("#idVendor").val(data.id);
                    $("#Updatevendorcode").val(data.vendorcode);
                    $("#Updateaccount").val(data.account);
                    $("#Updatevendorname").val(data.vendorname);
                    $("#Updatevfax").val(data.fax);
                    $("#Updatevphone").val(data.phone);
                    $("#Updatevcity").val(data.city);
                    $("#Updatevpostal").val(data.postal);
                    $("#Updatevaddress").val(data.address);
                    (data.status == "Actived" ?  $("#UpdatevendorstatusA").val(data.status).prop('checked',true) :  $("#UpdatevendorstatusS").val(data.status).prop('checked',true))
                    $("#Updatepic").val(data.pic);
                    console.log(data.pic);
                    $("#Updatepic_phone").val(data.pic_phone);
                    $("#Updatepic_email").val(data.pic_email);
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
