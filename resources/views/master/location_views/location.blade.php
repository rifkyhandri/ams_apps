@extends('layouts.dashboard')
@section('content')
<!-- Tittle -->
@section('modal_import_excel'){{route('location.import')}}@stop
<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div style="height: 65px; border-radius: 15px;" class="card">
            <div class="card-body">
                <div style="display: flex; align-items: flex-start; justify-content: space-between; height: 40px;">
                    <h4 class="card-title" style="font-size: 2rem; font-weight: 300; margin-bottom: 0px;">Location</h4>
                    {{-- <button type="button" class="btn btn-success btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" data-custom-class="tooltip-success" title="EDIT" data-target="#showModalUpdateAssetClass" style="margin-right:5px;"><i style="font-size:1.5rem; margin-left:-7px;" class="ti-pencil-alt"></i></button> --}}
                    <button style="margin: -0.2rem .05rem -1rem auto;" type="button" class="btn btn-primary btn-sm"
                        data-toggle="modal" data-target="#showModalInsertLocation"><i
                            class="ti-plus menu-icon"></i>&ensp;
                        ADD</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Tittle End -->
<a href="{{route('location_export')}}" class="btn btn-primary btn-sm btn-rounded-sm mb-3 mt-3">Export Excel</a>
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#importExcel">
    Import Excel
</button>
<a href="#" onclick="print_location()" class="btn btn-primary btn-sm btn-rounded-sm mb-3 mt-3">Print</a>
<a href="#" onclick="print_list()" class="btn btn-primary btn-sm btn-rounded-sm mb-3 mt-3">Print Location List</a>
<!-- Table -->
<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div class="card" style="border-radius: 15px;">
                <div class="card-body">
                {{-- <h4 class="card-title">Data table</h4> --}}
                <div class="row">
                    <div class="col-12">
                    <div class="table-responsive">
                        <table id="locationTable" class="table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th style="width: 100px;">LOCATION CODE</th>
                                <th style="width: 500px;">CITY</th>
                                <th style="width: 200px;">COUNTRY</th>
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
{{-- Table End --}}
@endsection

@section('jscustom')
<script>

    var mTable;

    $(document).ready(function () {
        //RENDER DATA TABLE
        var url = "{{url('/')}}";
        mTable = $('#locationTable').DataTable({
            responsive: true,
            processing: true,
            "language": {
                "processing": "<div class='dot-opacity-loader'></div>"
            },
            "order": [[ 0, "desc" ]],
            serverSide: true,
            ajax: "{{ route('location.create')}}",
            dom: 'Bfrtip',
            buttons: [
               
            ],
            
            columns: [
                {  data: 'id',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { data: 'locationcode', name: 'locationcode' },
                { data: 'locationname', name: 'locationname' },
                { data: 'country', name: 'country' },
                {
                    data: 'id',
                    render: function (data, type, row) {
                        let buttonViewsub =
                            '<a href="'+url+'/sublocation/'+data +'" class="btn btn-primary btn-rounded btn-icon" data-placement="buttom" data-custom-class="tooltip-success" title="Show sub location" style="margin-right:5px;" onclick="buttonViewsub;"><i style="font-size:1.5rem; margin-left:-7px;" class="ti-eye"></i></a>';
                        let buttonEdit =
                            '<button type="button" class="btn btn-success btn-rounded btn-icon" data-toggle="modal" data-placement="buttom" data-custom-class="tooltip-success" title="EDIT" data-target="#showModalUpdateLocation" style="margin-right:5px;" onclick="buttonEdit(\'' + data + '\');"><i style="font-size:1.5rem; margin-left:-7px;" class="ti-pencil-alt"></i></button>';
                        let buttonHapus =
                            '<button type="button" class="btn btn-danger btn-rounded btn-icon" data-toggle="tooltip" data-placement="bottom" data-custom-class="tooltip-success" title="DELETE" onclick="delete_data(\''+
                            data +'\',\'location\');"><i style="font-size:1.5rem; margin-left:-8px;" class="ti-trash"></i></button>';
                        return buttonViewsub + buttonEdit + buttonHapus ;
                    }
                }
            ]
           
        });
      

        //INSERT LOCATION
        $('#formInputLocation').on('submit', function (e) {
            e.preventDefault();

            var url,data,form;

            url = 'location';                 //For routing
            data = $(this).serialize();      // Data Form
            form = 'Location';              //Reset Trigger and Close Modal
            insert_data(url,data,form);
            
            // $("input[name='locationcode']").val(!!!!);                         
            // General form insert_data(url,data,form)
          

        });

        //UPDATE location
        $('#formUpdateLocation').on('submit', function (e) {

            e.preventDefault();
            var url,data,form;

            url = 'location';           //For routing
            data = $(this).serialize(); // Data Form
            form = 'Location';          // Reset Trigger and Close Modal
            
            // General form update_data(url,data,form)
            update_data(url,data,form);
            
        });

    });
  
    //EDIT BUTTON VIEW
    function buttonEdit(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("input[name='_token']").val()
            }
        });
        $.ajax({
            type: "GET",
            url: "{{ route('location.edit',['location'=>1]) }}",
            data: {
                id: id
            },
            success: function (data) {
                if (data) {
                    clear_error();
                    $("#idLocation").val(data.id);
                    $("#Updatelocationcode").val(data.locationcode);
                    $("#Updatecountry").val(data.country);
                    $("#Updatelocationname").val(data.locationname);
                 
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
    function print_location(){
        let url = "{{ url('/') }}/location_print?";
        var win = window.open(url, '_blank');
        win.focus();
    }
    function print_list(){
        let url = "{{ url('/') }}/location_print_list?";
        var win = window.open(url, '_blank');
        win.focus();
    }

</script>
@endsection
