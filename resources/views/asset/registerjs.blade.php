<script>
    function buttonQR(tangnumber){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("input[name='_token']").val()
            }
        });
        $.ajax({
            type: "GET",
            url: "{{ url('/') }}/asset_qr",
            data: {
                tangnumber: tangnumber
            },
            success: function (data) {
                $('#showQR').html(data);
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
        
        var result = result.split('-');
        
        if(flag == 'smlocation'){
            $('#Updateregobj'+flag).children("option:selected").html(result[1]).val(result[0]);
            $('#reg'+flag).children("option:selected").html(result[1]).val(result[0]);
        }
        
        $('#reg'+flag).children("option:selected").html(result[1]).val(result[0]);
        $('#Updateregobj'+flag).children("option:selected").html(result[1]).val(result[0]);
        $('#closeModalDetailValue').click();
        $('#closeModalDetailLocation').click();
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

    function detail_viewlocation(route){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("input[name='_token']").val()
            }
        });

        $.ajax({
            type: "GET",
            url: "{{ url('/') }}/"+route+"/create",
            success: function (data) {
                $('#showModalDetailLocation').modal();
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
                    $('.file-validation').html('');
                    $('#current-img').attr('src','default.jpg');
                    
                    var pathatt = "{{ asset('assets/attachment/') }}";
                    var pathimg = "{{ asset('assets/images/') }}";
                    /* GET VALUE */
                    var selectbox = [
                        'objassetclass','objcustodian','objcostgroup',
                        'objcostcenter','objcondition','objlocation',
                        'objdepartement','objvendor','objaccount',
                        'objprovider','objowner','objassetstatus',
                        'objassettype'
                    ];

                    clear_error();
                    
                    for (let i = 0; i < selectbox.length; i++) {
                        var retrieve = _.pick(data,selectbox[i])
                        _.forIn(retrieve, function(value, key) {
                            
                            var innerkey = _.keys(value)

                            if(value == null){
                                $("#Updatereg"+key).children("option:selected").html('').val('');
                            }else{
                                _.forIn(value,function(invalue, inner) {
                                    if(inner == innerkey[1]){
                                        // console.log(key)
                                        if(key == "objlocation"){
                                            // console.log(key,invalue)
                                            $("#Updateregobjsmlocation").children("option:selected").val(invalue);
                                        }else{
                                            $("#Updatereg"+key).children("option:selected").val(invalue);
                                        }
                                    }
                                    if(inner == innerkey[2]){

                                        if(key == "objlocation"){
                                            $("#Updateregobjsmlocation").children("option:selected").html(value.location_sub.locationname_sub+' | '+invalue);
                                        }else{
                                            $("#Updatereg"+key).children("option:selected").html(invalue);
                                        }
                                    }
                                })
                            }

                        });
                        
                    }
                     /* END GET VALUE */
                   
                    $("#idAssetRegister").val(data.asset_id);
                    $("#Updateassetcode").val(data.tangnumber);
                    $("#Updateregdesc").val(data.assetname);
                    $("#Updateregmodel").val(data.models);
                    $("#Updateregnotes").val(data.notes);
                    $("#Updateregtagging").val(data.tagged).trigger('change');
                    $("#Updateregdepreciation").val(data.comdepreciation).trigger('change');
                    $("#Updateregpo_number").val(data.payment);
                    $("#Updatereglicense").val(data.serial);
                    $("#Updateregprc_date").val(data.datepurchase);
                    $("#Updateregacq_date").val(data.dateacq);
                    $("#Updateregprc_cost").val(data.purchasecost);
                    $("#Updateregacq_cost").val(data.purchaseacq);
                    $("#Updateregyear").val(data.lifetimeyear);
                    $("#Updateregmonth").val(data.livetimemonth);
                    $("#Updateregsalvage").val(data.salvage1);
                    $("#Updateregdepr").val(data.bookrate);
                    $("#Updateregnext_service").val(data.nextservice);
                    $("#Updateregwarranty").val(data.warranty);
                    $("#Updateregcontract").val(data.servicecontract);
                    $("#Updateregbrand").val(data.brand);
                    $("#Updateregmanufacture").val(data.manufacture);
                    $("#Updateregpart").val(data.partnumber);
                    $("#Updateregsoftware").val(data.ESN);
                    $("#Updateregip_address").val(data.IP);
                    $("#Updatereglat").val(data.gps_lat);
                    $("#Updatereglong").val(data.gps_long); 
                    if(data.att1 != 'default-att.pdf'){
                        var att1 = '<div id="wrapper-att3" class="file-validation">'+
                                     '<button type="button" id="delete-1" class="close" aria-label="Close"'+
                                        'onClick="delete_file(\''+data.asset_id+'\',\''+data.att1+'#att1'+'\')">'+
                                        '<span aria-hidden="true">&times;</span>'+
                                     '</button>'+
                                     '<a href="#" id="curr-att1">Attachment 1</a>'+
                                    '</div>'
                        $(att1).insertAfter('#Updateregatt1');
                        $("#curr-att1").attr('href',pathatt+'/'+data.att1);
                    }
                    if(data.att2 != 'default-att.pdf'){
                        var att2 = '<div id="wrapper-att2" class="file-validation">'+
                                    '<button type="button" id="delete-2" class="close" aria-label="Close"'+
                                        'onClick="delete_file(\''+data.asset_id+'\',\''+data.att2+'#att2'+'\')">'+
                                        '<span aria-hidden="true">&times;</span>'+
                                     '</button>'+
                                     '<a href="#" id="curr-att2">Attachment 2</a>'+
                                     '</div>'
                        $(att2).insertAfter('#Updateregatt2');
                        $("#curr-att2").attr('href',pathatt+'/'+data.att2);
                    }
                    if(data.att3 != 'default-att.pdf'){
                        var att3 = '<div id="wrapper-att3" class="file-validation">'+
                                    '<button type="button" id="delete-3" class="close" aria-label="Close"'+
                                        'onClick="delete_file(\''+data.asset_id+'\',\''+data.att3+'#att3'+'\')">'+
                                        '<span aria-hidden="true">&times;</span>'+
                                     '</button>'+
                                     '<a href="#" id="curr-att3">Attachment 3</a>'+
                                    '</div>'
                        $(att3).insertAfter('#Updateregatt3');
                        $("#curr-att3").attr('href',pathatt+'/'+data.att3);
                    }
                    if(data.filename != 'default.jpg'){
                        $("#current-img").attr('src',pathimg+'/'+data.filename);
                        var img =   '<div id="wrapper-filename" class="file-validation">'+
                                     '<button type="button" id="delete-3" class="close" aria-label="Close"'+
                                        'onClick="delete_file(\''+data.asset_id+'\',\''+data.filename+'#filename'+'\')">'+
                                        '<span aria-hidden="true">&times;</span>'+
                                     '</button>'+
                                    '</div>'
                        $(img).insertBefore('#current-img');
                    }

                    
                
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

    function delete_file(id,data){
        @php $prefix = url('/')."/"; @endphp
        swal({
                title: "Apakah Kamu Yakin?",
                text: "Klik OK, Maka Data Kamu Tidak Dapat DiKembalikan",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });

                $.ajax({
                    url: "{{ $prefix }}"+ 'delete_file' +"/"+ id,
                    method: 'post',
                    data: {
                        _method: "DELETE",
                        _token: "{{ csrf_token() }}",
                        data: data
                    },
                        success: function(result){
                            var div = result.success;
                            
                            $('#wrapper-'+div).remove();

                            if(div=='filename'){
                                $("#current-img").attr('src','');
                            }

                            $.toast({
                                heading: 'Success',
                                text: 'Berhasil menghapus data terkait.',
                                showHideTransition: 'slide',
                                icon: 'success',
                                loaderBg: '#f96868',
                                position: 'top-right'
                            })
                            mTable.ajax.reload();
                        },
                        error: function(data) {
                            console.log(data)
                        }
                    });
                } else {
                    $.toast({
                        heading: 'Warning',
                        text: 'Batal Menghapus Data',
                        showHideTransition: 'slide',
                        icon: 'warning',
                        loaderBg: '#57c7d4',
                        position: 'top-right'
                    })
                    $('#btnCloseModalInsert').click();
                }
        });
    }

    function clear_thumbnail(id){
        $('#thumb-'+id).html('');
        $('#'+id).val('');
        $('#cancel-'+id).remove();
    }

    function att_change(id){
        var html='<button type="button" id="cancel-'+id+'" class="close" aria-label="Close" onClick="clear_thumbnail(\''+id+'\')">'+
                    '<span aria-hidden="true">&times;</span>'+
                 '</button>'
        $(html).insertBefore('#'+id);
    }

    //THUMBNAIL BEFORE UPLOAD
    function thumbnail_asset(id){
     //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            // console.log(id)
            $('#thumb-'+id).html(''); //clear html of output element
            var data = $("#"+id)[0].files; //this file data
            
            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('form-control').attr('src', e.target.result).attr('height',248).attr('id','image_thumb'); //create image element 
                        $('#thumb-'+id).append(img); //append image to output element
                        var html='<label>Thumbnail:</label><button type="button" class="close" aria-label="Close" onClick="clear_thumbnail(\''+id+'\')">'+
                                '<span aria-hidden="true">&times;</span>'+
                                '</button>'
                        $(html).insertBefore('#image_thumb');
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });
        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
    }

    function import_asset(){
        let url = "{{ url('/') }}/import_asset";
        var win = window.open(url, '_blank');
        win.focus();
    }
    
</script>