{{-- GLOBAL JS IS USE FOR ALL MODULE --}}
<script>
    @php $prefix = url('/')."/"; @endphp

    //FIXING MODAL BUGS
    $('body').on('hidden.bs.modal', function () {
        if($('.show').length > 1)
        {
            $('body').addClass('modal-open');
        }
    });

    // CLEAR FORM INPUT
    function clear_form(){
        var form = $("form");
        // var disabled = form.find(':input:disabled').removeAttr('disabled');
        // var select = form.find('select').removeAttr('disabled').text('').val('');
        form.trigger("reset");
        // disabled.attr('disabled','disabled');
    }

    //RESET ERROR
    function clear_error(){
        $('.text-left').html('');
    }

    //ERROR HANDLER
    function error_handler(data,status){
      
		var testing = 0;

		$('.text-left').html('');

		for (let [key, value] of Object.entries(data)) {
			if(status == 'u'){
				testing = `${key}`.split(".");
			    if(testing[1]==0){
			        $('#error_u_'+testing[0]).html(`${value}`)
			    }else{
			       	$('#error_u_'+`${key}`).html(`${value}`)
			    }

			}else{
			    testing = `${key}`.split(".");
			    if(testing[1]==0){
			        $('#error_'+testing[0]).html(`${value}`)
			    }else{
			        $('#error_'+`${key}`).html(`${value}`)
			    }

			}
		}
    }

    // ASSET REGISTER
    // General form asset_register(url,data,form)
    // url = 'location';           For routing
    // data = $(this).serialize(); Data Form
    // form = 'Location';          Reset Trigger and Close Modal
    function asset_register(url,data,form){
        console.log(data)
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
        });
        
        $.ajax({
                type: "POST",
                url: "{{ $prefix }}" + url ,
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false,
                data: data,
                success: function (response) {
                    $('#formInput'+form).trigger("reset");
                    clear_error();
                    clear_form();
                    mTable.ajax.reload();

                    $.toast({
                        heading: 'Success',
                        text: response.message,
                        showHideTransition: 'slide',
                        icon: 'success',
                        loaderBg: '#f96868',
                        position: 'top-right'
                    })

                    $('#btnCloseModal'+form+'Insert').click();

                    setTimeout(function() {
                        window.location.reload()
                    }, (2 * 1000));	
                },
                error: function(response) {

                    var errors = response.responseJSON.errors;

                    try {
                        error_handler(errors,'s');
                    } catch (err) {

                    }

                    $.toast({
                        heading: 'Danger',
                        text: response.responseJSON.message,
                        showHideTransition: 'slide',
                        icon: 'error',
                        loaderBg: '#f2a654',
                        position: 'top-right'
                    })
                }
            });

    }

    // UPDATE ASSET REGISTER
    // General form asset_register(url,data,form)
    // url = 'location';           For routing
    // data = $(this).serialize(); Data Form
    // form = 'Location';          Reset Trigger and Close Modal
    function uasset_register(url,data,form){

            id = $('input[id="id'+form+'"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ $prefix }}"+ url + '/' + id,
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false,
                data: data,
                success: function (response) {

                    $('#formUpdate'+form).trigger("reset");
                    clear_error();
                    
                    mTable.ajax.reload();

                    $.toast({
                        heading: 'Success',
                        text: response.message,
                        showHideTransition: 'slide',
                        icon: 'success',
                        loaderBg: '#f96868',
                        position: 'top-right'
                    })

                    $('#btnCloseModal'+form+'Update').click();

                    setTimeout(function() {
                        window.location.reload()
                    }, (2 * 1000));	
                },
                error: function(response) {

                    var errors = response.responseJSON.errors;

                    try {
                        error_handler(errors,'u');
                    } catch (err) {

                    }

                    $.toast({
                        heading: 'Danger',
                        text: response.responseJSON.message,
                        showHideTransition: 'slide',
                        icon: 'error',
                        loaderBg: '#f2a654',
                        position: 'top-right'
                    })
                }
            });
    }

    //INSERT DATA
    // General form insert_data(url,data,form)
    // url = 'location';           For routing
    // data = $(this).serialize(); Data Form
    // form = 'Location';          Reset Trigger and Close Modal
    function insert_data(url,data,form){

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
        });

        $.ajax({
                type: "POST",
                url: "{{ $prefix }}" + url ,
                data: data,
                success: function (response) {

                    $('#formInput'+form).trigger("reset");
                    clear_error();
                    clear_form();
                    mTable.ajax.reload();

                    $.toast({
                        heading: 'Success',
                        text: response.message,
                        showHideTransition: 'slide',
                        icon: 'success',
                        loaderBg: '#f96868',
                        position: 'top-right'
                    })
                    console.log(form);
                    $('#btnCloseModal'+form+'Insert').click();

                },
                error: function(response) {

                    var errors = response.responseJSON.errors;

                    try {
                        error_handler(errors,'s');
                    } catch (err) {

                    }

                    $.toast({
                        heading: 'Danger',
                        text: response.responseJSON.message,
                        showHideTransition: 'slide',
                        icon: 'error',
                        loaderBg: '#f2a654',
                        position: 'top-right'
                    })
                }
            });

    }

    //UPDATE DATA
    function update_data(url,data,form){

            id = $('input[id="id'+form+'"]').val();
            console.log(id,form)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            $.ajax({
                type: "PATCH",
                url: "{{ $prefix }}"+ url + '/' + id,
                data: data,
                success: function (response) {

                    $('#formUpdate'+form).trigger("reset");
                    clear_error();
                    clear_form();
                    mTable.ajax.reload();

                    $.toast({
                        heading: 'Success',
                        text: response.message,
                        showHideTransition: 'slide',
                        icon: 'success',
                        loaderBg: '#f96868',
                        position: 'top-right'
                    })

                    $('#btnCloseModal'+form+'Update').click();

                },
                error: function(response) {

                    var errors = response.responseJSON.errors;

                    try {
                        error_handler(errors,'u');
                    } catch (err) {

                    }

                    $.toast({
                        heading: 'Danger',
                        text: response.responseJSON.message,
                        showHideTransition: 'slide',
                        icon: 'error',
                        loaderBg: '#f2a654',
                        position: 'top-right'
                    })
                }
            });
    }

    //DELETE DATA
    function delete_data(id,url){
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
                    url: "{{ $prefix }}"+ url +"/"+ id,
                    method: 'post',
                    data: {
                        _method: "DELETE",
                        _token: "{{ csrf_token() }}",
                    },
                        success: function(result){
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

</script>
