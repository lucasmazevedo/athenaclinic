// $(document).on("click", '#btnStoreModal', function(e){
//     console.log(e);
// });

$(document).ready(function() {
      $('#coreModal').on('hidden.bs.modal', function (e) {
        console.log(e);
        $('#modal-content').html("");
        $('#coreModal').modal('dispose');
      })

    // -- SIDE MODAL -- //
    var drawerElement = document.querySelector("#sideModal");
    var drawer = KTDrawer.getInstance(drawerElement);
    $('body').on('click', '#btnActionFila', function(e) {
        e.preventDefault();
        var button = $(this);
        var buttonContent = $(this).html();
        var href = $(this).attr('data-href');
        var icon = $(this).hasClass('btn-icon');
        $.ajax({
            url: href,
            method: 'GET',
            success: function(result) {
                drawer.show();
                // $('#coreModal').modal('show');
                $('#sidemodal-content').html(result);
            },
            beforeSend: function() {
                if(icon)
                {
                    button.prop('disabled', true);
                    button.html('<span class="d-flex align-items-center"><span class="spinner-border spinner-border-sm flex-shrink-0" role="status"></span></span>');
                }else{
                    button.prop('disabled', true);
                    button.html('<span class="d-flex align-items-center"><span class="spinner-border spinner-border-sm flex-shrink-0" role="status"><span class="visually-hidden">Carregando...</span></span><span class="flex-grow-1 ms-2"> Carregando...</span></span>');
                }
            },
            complete: function() {
                button.prop('disabled', false);
                button.html(buttonContent);
            }
        });
    });
    // -- end SIDE MODAL -- //

    // -- ACTION MODAL OPEN -- //
    $('body').on('click', '#btnActionModal', function(e) {
        e.preventDefault();
        var button = $(this);
        var buttonContent = $(this).html();
        var href = $(this).attr('data-href');
        var icon = $(this).hasClass('btn-icon');
        $.ajax({
            url: href,
            method: 'GET',
            success: function(result) {
                $('#coreModal').modal('show');
                $('#modal-content').html(result);
            },
            beforeSend: function() {
                if(icon)
                {
                    button.prop('disabled', true);
                    button.html('<span class="d-flex align-items-center"><span class="spinner-border spinner-border-sm flex-shrink-0" role="status"></span></span>');
                }else{
                    button.prop('disabled', true);
                    button.html('<span class="d-flex align-items-center"><span class="spinner-border spinner-border-sm flex-shrink-0" role="status"><span class="visually-hidden">Carregando...</span></span><span class="flex-grow-1 ms-2"> Carregando...</span></span>');
                }
            },
            complete: function() {
                button.prop('disabled', false);
                button.html(buttonContent);
            }
        });
    });
    // -- end ACTION MODAL OPEN -- //
    //
    /**
    $(document).on('click', '#btnStoreModal', function(e) {
        console.log('clicou..');
        console.log(e);
         *

        e.preventDefault();
        var button = $(this);
        var buttonContent = $(this).html();
        var href = $(this).attr('data-href');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: href,
            method: 'POST',
            data: new FormData($('form#formData')[0]),
            contentType: false,
            processData: false,
            success: function(data, textStatus, xhr) {
                if (data.errors) {
                    $.each(data.errors, function(i, error) {
                        new Noty({
                            theme: 'limitless',
                            layout: 'topCenter',
                            text: error,
                            type: 'error',
                            timeout: 2500
                        }).show();
                    });
                } else {
                    $('#coreModal').modal('hide');
                    Swal.fire({
                        title: data.success,
                        icon: "success",
                        buttonsStyling: false,
                        timer: 3000,
                        showCloseButton: false,
                        showConfirmButton: false,
                        willClose: () => {
                            window.location.reload();
                            $('#coreDatatable').DataTable().ajax.reload(null, false);
                        }
                    });
                }
            },
            beforeSend: function() {
                button.html('<span class="d-flex align-items-center"><span class="spinner-border spinner-border-sm flex-shrink-0" role="status"><span class="visually-hidden">Carregando...</span></span><span class="flex-grow-1 ms-2"> Carregando...</span></span>');
            },
            complete: function() {
                button.html(buttonContent);
            }
        });
        */
    });

    // -- end ACTION MODAL STORE DATA -- //

    // -- ACTION DELETE BTN -- //
    $(document).on("click", ".btn_delete", function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var href = $(this).attr('data-href');
        Swal.fire({
            title: 'Deseja deletar o registro??',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sim, deletar!',
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: href,
                    method: 'DELETE',
                    success: function(result) {
                        if (result.errors) {
                            Swal.fire({
                                title: result.errors,
                                icon: "error",
                                buttonsStyling: false,
                                timer: 6000,
                                showCloseButton: false,
                                showConfirmButton: false,
                            });
                        } else {
                            Swal.fire({
                                title: result.success,
                                icon: "success",
                                buttonsStyling: false,
                                timer: 6000,
                                showCloseButton: false,
                                showConfirmButton: false,
                            });
                            $('#coreDatatable').DataTable().ajax.reload();
                        }
                    }
                });
            }
        });
    });
    // -- end ACTION DELETE BTN -- //

});
