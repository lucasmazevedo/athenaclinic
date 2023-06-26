@if ($message = Session::get('success'))
    <script>
        Swal.fire({
            title: "{{ $message }}",
            icon: "success",
            buttonsStyling: false,
            timer: 3000,
            showCloseButton: false,
            showConfirmButton: false,
        });
    </script>
@endif


@if ($message = Session::get('error'))
    <script>
        Swal.fire({
            title: "{{ $message }}",
            icon: "error",
            buttonsStyling: false,
            timer: 3000,
            showCloseButton: false,
            showConfirmButton: false,
        });
    </script>
@endif


@if ($message = Session::get('warning'))
    <script>
        new Noty({
            theme: 'limitless',
            layout: 'topCenter',
            text: '{{ $message }}',
            type: 'warning',
            timeout: 2500
        }).show();
    </script>
@endif


@if ($message = Session::get('info'))
    <script>
        new Noty({
            theme: 'limitless',
            layout: 'topCenter',
            text: '{{ $message }}',
            type: 'info',
            timeout: 2500
        }).show();
    </script>
@endif


@if ($errors->any())
    <script>
        Swal.fire({
            title: "Verifique os dados abaixo e tente novamente!",
            icon: "error",
            buttonsStyling: false,
            timer: 3000,
            showCloseButton: false,
            showConfirmButton: false,
        });
    </script>
@endif
