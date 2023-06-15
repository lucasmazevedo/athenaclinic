$(document).ready(function() {
    // CONFIG AJAX CSRF //
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // end CONFIG AJAX CSRF //

    // BLOCK UI CONFIG //
    var target = document.querySelector("#modal-content");
    var blockUI = new KTBlockUI(target, {
        message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Processando...</div>',
    });
    // end BLOCK UI CONFIG //

    // SIDE MODAL EVENTS //
    var drawer = KTDrawer.getInstance(document.querySelector("#sideModal"));
    drawer.on("kt.drawer.after.hidden", function() {
        console.log("SideModal Close");
    });

    drawer.on("kt.drawer.show", function() {
        console.log("sideModal Open!!");
    });
    // end SIDE MODAL EVENTS //

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

    // MODAL EVENTS //
    var coreModalEL = document.getElementById('coreModal')
    coreModalEL.addEventListener('hidden.bs.modal', function (event) {
        $('#modal-content').html("");
        if (typeof tinymce !== 'undefined') {
            tinymce.activeEditor.destroy();
        }
    });
    coreModalEL.addEventListener('shown.bs.modal', function (event) {

     });
    // end MODAL EVENTS //

    // MODAL CORE ACTION //
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
    // end MODAL CORE //

    // ACTION STORE DATA MODAL //
    $('body').on('click', '#btnStoreModal', function(e) {
        e.preventDefault();
        var button = $(this);
        var buttonContent = $(this).html();
        var href = $(this).attr('data-href');

        $.ajax({
            url: href,
            method: 'POST',
            data: new FormData($('form#formData')[0]),
            contentType: false,
            processData: false,
            success: function(data, textStatus, xhr) {
                if (data.errors) {
                    $.each(data.errors, function(i, error) {
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                            "positionClass": "toastr-top-right",
                            "timeOut": "8000",
                            "preventDuplicates": false,
                          };
                        toastr.error(error);
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
            error: function(data) {
                button.html(buttonContent);
                blockUI.release();
            },
            beforeSend: function() {
                button.html('<span class="d-flex align-items-center"><span class="spinner-border spinner-border-sm flex-shrink-0" role="status"><span class="visually-hidden">Carregando...</span></span><span class="flex-grow-1 ms-2"> Carregando...</span></span>');
                blockUI.block();
            },
            complete: function() {
                button.html(buttonContent);
                blockUI.release();
            }
        });
    });
    // end ACTION STORE DATA MODAL //

    // ACTION DELETE BUTTON //
    $(document).on("click", ".btn_delete", function(e) {
        e.preventDefault();
        var href = $(this).attr('data-href');
        Swal.fire({
            title: 'Deseja deletar o registro??',
            icon: 'warning',
            showCancelButton: true,
            backdrop: true,
            confirmButtonText: 'Sim, deletar!',
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return $.ajax({
                    url: href,
                    method: 'DELETE',
                    success: function(result) {
                        return result;
                    },
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        })
        .then((result) => {
            if (result.isConfirmed) {
                if (result.value.error) {
                    Swal.fire({
                        title: result.value.error,
                        icon: "error",
                        buttonsStyling: false,
                        timer: 6000,
                        showCloseButton: false,
                        showConfirmButton: false,
                    });
                }else{
                    Swal.fire({
                        title: result.value.success,
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

        // -- ACTION EDITOR CLOUDMED (TINYMCE) -- //

        // -- end ACTION EDITOR CLOUDMED (TINYMCE) -- //
        /*
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
                    },
                    error: function(data) {
                        // blockUI.release();
                    },
                    beforeSend: function() {
                        // blockUI.block();
                    },
                    complete: function() {
                        // blockUI.release();
                    }
                });
            }
        });
        **/
    });

});
