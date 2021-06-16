{{-- General JS Scripts --}}
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('assets/modules/popper.js') }}"></script>
<script src="{{ asset('assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>

{{-- JS Libraries --}}

{{-- Page Specific JS File --}}

{{-- Template JS File --}}
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

{{-- Custom Script --}}
<script>
    $(document).ready(function(){
        $('select').select2({
            theme: 'bootstrap4',
            width: 'style'
        });
    });

    //flash message
    @if(session()->has('success'))
    swal({
        type: 'success',
        icon: 'success',
        title: "Sukses",
        text: "{{ session('success') }}",
        timer: 2000,
        showConfirmButton: false,
        showCancelButton: false,
        buttons: false
    });
    @elseif(session()->has('error'))
    swal({
        type: 'error',
        icon: 'error',
        title: "Gagal",
        text: "{{ session('error') }}",
        timer: 2000,
        showConfirmButton: false,
        showCancelButton: false,
        buttons: false
    });
    @endif
</script>
