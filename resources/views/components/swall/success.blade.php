@push('js')
<script>
    $( document ).ready(function() {
        Swal.fire({
            icon: 'success',
            title: `{{ $message }}`,
            showConfirmButton: false,
            timer: 2500
        })
    });
</script>
@endpush