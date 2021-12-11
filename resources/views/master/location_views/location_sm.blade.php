@extends('layouts.dashboard')
@section('content')
@section('location_code_big_to_sm'){{$location_sub->locationcode_big}}@endsection
@section('location_code_sub_to_sm'){{$location_sub->id}}@endsection
<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div style="height: 65px; border-radius: 15px;" class="card">
            <div class="card-body">
                <div style="display: flex; align-items: flex-start; justify-content: space-between; height: 40px;">
                    <h4 class="card-title" style="font-size: 2rem; font-weight: 300; padding-bottom: 10px;">Location {{ $location_sub->location->locationname }} - {{$location_sub->locationname_sub}}</h4>
                    {{-- <button type="button" class="btn btn-success btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" data-custom-class="tooltip-success" title="EDIT" data-target="#showModalUpdateAssetClass" style="margin-right:5px;"><i style="font-size:1.5rem; margin-left:-7px;" class="ti-pencil-alt"></i></button> --}}
                    <button style="margin: -0.2rem .05rem -1rem auto;" type="button" class="btn btn-primary btn-sm"
                        data-toggle="modal" data-target="#showModalInsertLocationSM"><i
                            class="ti-plus menu-icon"></i>&ensp;
                        ADD</button>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <a href="/sublocation/{{$location_sub->id}}" class="mt-3 btn btn-primary btn-sm"><i class="ti-arrow-left"></i></a> --}}
<div class="row mt-3">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div class="card" style="border-radius: 15px;">
                <div class="card-body">
                {{-- <h4 class="card-title">Data table</h4> --}}
                <div class="row">
                    <div class="col-12">
                    <div class="table-responsive">
                        <table id="smlocationTable" class="table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th style="width: 100px;">LOCATION CODE</th>
                                <th style="width: 500px;">LOCATION NAME</th>
                                <th style="width: 200px;">ADDRESS</th>
                                <th style="padding-left: 10px;">ACTION</th>
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
    

<script>
var mTable;

$(document).ready(function () {
    //RENDER DATA TABLES
    var url = "{{url('/')}}";
    mTable = $('#smlocationTable').DataTable({
        responsive: true,
        processing: true,
        "language": {
            "processing": "<div class='dot-opacity-loader'></div>"
        },
        "order": [[ 0, "desc" ]],
        serverSide: true,
        ajax: "{{ route('smlocation.index',['id'=>request()->route('smlocation')])}}",
        dom: 'Bfrtip',
        dataSrc: "data",
        buttons: [
           
        ],
        columns: [
           
            {  data: 'id',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'locationcode_sm', name: 'locationcode_sm' },
            { data: 'locationname_sm', name: 'locationname_sm' },
            { data: 'address_sm', name: 'address_sm' },
            {
                data: 'id',
                render: function (data, type, row) {
                    let buttonEdit = '<button type="button" class="btn btn-success btn-rounded btn-icon" data-toggle="modal" data-placement="buttom" data-custom-class="tooltip-success" title="EDIT" data-target="#showModalUpdateLocationSm" style="margin-right:5px;" onclick="buttonEdit(\'' + data + '\');"><i style="font-size:1.5rem; margin-left:-7px;" class="ti-pencil-alt"></i></button>';
                    let buttonHapus = '<button type="button" class="btn btn-danger btn-rounded btn-icon" data-toggle="tooltip" data-placement="bottom" data-custom-class="tooltip-success" title="DELETE" onclick="delete_data(\''+
                        data +'\',\'smlocation\');"><i style="font-size:1.5rem; margin-left:-8px;" class="ti-trash"></i></button>';
                    return buttonEdit + buttonHapus ;
                }
            }
        
        ]
    });

    $('#formInputLocationSm').on('submit', function (e) {
            e.preventDefault();

            var url,data,form;

            url = "smlocation";            //For routing
            data = $(this).serialize();   // Data Form
            form = 'LocationSm';         //Reset Trigger and Close Modal
            insert_data(url,data,form);
        
          

        });
        
        $('#formUpdateLocationSm').on('submit', function (e) {

                    e.preventDefault();
                    var url,data,form;

                    url = 'smlocation';             //For routing
                    data = $(this).serialize();     // Data Form
                    form = 'LocationSm';          // Reset Trigger and Close Modal

                    // General form update_data(url,data,form)
                    update_data(url,data,form);

         });

});
function buttonEdit(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("input[name='_token']").val()
            }
        });
        $.ajax({
            type: "GET",
            url: "{{ route('smlocation.edit',['smlocation'=>1]) }}",
            data: {
                id: id
            },
            success: function (data) {
                if (data) {
                    clear_error();
                    $("#idLocationSm").val(data.id);
                    $("#Updatelocationcode_big").val(data.locationcode_big);
                    $("#Updatelocationcode_sub").val(data.locationcode_sub);
                    $("#Updatelocationcode_sm").val(data.locationcode_sm);
                    $("#Updatelocationname_sm").val(data.locationname_sm);
                    $("#Updatecontact_sm").val(data.contact);
                    $("#Updateopening_sm").val(data.OpeningDate);
                    $("#Updatephone_sm").val(data.phone);
                    $("#Updateaddress_sm").val(data.address_sm);
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



{{-- Update Location SMALL --}}
<div class="modal fade" id="showModalUpdateLocationSm" tabindex="-1" role="dialog"
        aria-labelledby="locationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Location</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="forms-sample" method="POST" action="#" id="formUpdateLocationSm">
                    <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                    <input type="hidden" class="form-control" id="idLocationSm" name="id" required>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6" >
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Location Code</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_u_locationcode" style="padding: 2px; color:red;"></div>
                                    <input type="hidden"
                                        class="form-control form-control-sm" name="locationcode_big" id="Updatelocationcode_big" placeholder="Location Code Big" required />
                                    <input type="hidden"
                                        class="form-control form-control-sm" name="locationcode_sub" id="Updatelocationcode_sub" placeholder="Location Code Sub" required />
                                    <input type="text"
                                        class="form-control form-control-sm" name="locationcode_sm" id="Updatelocationcode_sm" placeholder="Location Code Small" required readonly/>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Contact</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_u_contact" style="padding: 2px; color:red;"></div>
                                        <input type="text" class="form-control form-control-sm" placeholder="Contact" name="contact" id="Updatecontact_sm" required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Location Name</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_u_locationname" style="padding: 2px; color:red;"></div>
                                        <input type="locationname" class="form-control form-control-sm" name="locationname_sm" id="Updatelocationname_sm" placeholder="Location Name" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Opening Date</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_u_opening" style="padding: 2px; color:red;"></div>
                                        <input type="date" class="form-control form-control-sm" name="OpeningDate" id="Updateopening_sm" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Mobile Phone</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_u_phone" style="padding: 2px; color:red;"></div>
                                        <input type="text" class="form-control form-control-sm" name="phone" id="Updatephone_sm" placeholder="Mobile Phone" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Address</label>
                                    <div class="col-sm-9">
                                        <div class="text-left" id="error_u_address" style="padding: 2px; color:red;"></div>
                                        <textarea class="form-control form-control-sm" id="Updateaddress_sm" name="address"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-success btn-fw" style="border-radius: 21px;">Update</button>
                        <button type="button" class="btn btn-outline-danger btn-fw"  style="border-radius: 21px;" data-dismiss="modal"
                            id="btnCloseModalLocationSmUpdate">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection