@extends('layouts.dashboard')
@section('content')


<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div style="height: 65px; border-radius: 15px;" class="card">
            <div class="card-body">
                <div style="display: flex; align-items: flex-start; justify-content: space-between; height: 40px;">
                    <h4 class="card-title" style="font-size: 2rem; font-weight: 300; margin-bottom: 0px;">Account Group</h4>
                    <button style="margin: -0.2rem .05rem -1rem auto;" type="button" class="btn btn-primary btn-sm"
                        data-toggle="modal" data-target="#showModalInsertAccountGroup"><i
                            class="ti-plus menu-icon"></i>&ensp;
                        ADD</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div class="card" style="border-radius: 15px;">
                <div class="card-body">
                {{-- <h4 class="card-title">Data table</h4> --}}
                <div class="row">
                    <div class="col-12">
                    <div class="table-responsive">
                        <table id="accountchartGroupTable" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th style="width: 100px;">Id Account Group</th>
                                <th style="width: 500px;">Account Group Name</th>
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

@endsection

@section('jscustom')
<script>

    var mTable;

    $(document).ready(function () {
        //RENDER DATA TABLES
        var url = "{{url('/')}}";
        mTable = $('#accountchartGroupTable').DataTable({
            responsive: true,
            processing: true,
            "language": {
                "processing": "<div class='dot-opacity-loader'></div>"
            },
            "order": [[ 0, "desc" ]],
            serverSide: true,
            ajax: "{{ route('account_group.create')}}",
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
                    data: 'id_account_group',
                    name: 'id_account_group'
                },
                {
                    data: 'account_group_name',
                    name: 'account_group_name'
                },
                {
                    data: 'id',
                    render: function (data, type, row) {
                        let buttonViewsub =
                            '<a href="'+url+'/account_sub/'+data +'" class="btn btn-primary btn-rounded btn-icon" data-placement="buttom" data-custom-class="tooltip-success" title="Show sub location" style="margin-right:5px;" onclick="buttonViewsub;"><i style="font-size:1.5rem; margin-left:-7px;" class="ti-eye"></i></a>';
                        let buttonEdit =
                            '<button type="button" class="btn btn-success btn-rounded btn-icon" data-toggle="modal" data-placement="buttom" data-custom-class="tooltip-success" title="EDIT" data-target="#showModalUpdateAccountGroup" style="margin-right:5px;" onclick="buttonEdit(\'' + data + '\');"><i style="font-size:1.5rem; margin-left:-7px;" class="ti-pencil-alt"></i></button>';
                        let buttonHapus =
                            '<button type="button" class="btn btn-danger btn-rounded btn-icon" data-toggle="tooltip" data-placement="bottom" data-custom-class="tooltip-success" title="DELETE" onclick="delete_data(\''+
                            data +'\',\'account_group\');"><i style="font-size:1.5rem; margin-left:-8px;" class="ti-trash"></i></button>';
                        return buttonViewsub + buttonEdit + buttonHapus;
                    }
                }
            ]
        });

        //INSERT Account Group
        $('#formInputAccountGroup').on('submit', function (e) {
            e.preventDefault();

            var url,data,form;

            url = 'account_group';           //For routing
            data = $(this).serialize();    // Data Form
            form = 'AccountGroup';          //Reset Trigger and Close Modal

            // General form insert_data(url,data,form)
            insert_data(url,data,form);

        });

            $("#hide").click(function(){
            $("p").hide();
            });

        //UPDATE Account Group
        $('#formUpdateAccountGroup').on('submit', function (e) {

            e.preventDefault();
            var url,data,form;

            url = 'account_group';           //For routing
            data = $(this).serialize(); // Data Form
            form = 'AccountGroup';          // Reset Trigger and Close Modal

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
            url: "{{ route('account_group.edit',['account_group'=>1]) }}",
            data: {
                id: id
            },
            success: function (data) {
                if (data) {
                    clear_error();
                    console.log(data);
                    $("#idAccountGroup").val(data.id);
                    $("#UpdateaccountnoGroup").val(data.id_account_group);
                    $("#UpdateaccountnameGroup").val(data.account_group_name);
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
