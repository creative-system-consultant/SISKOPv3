@push('js')
<script>
    $( document ).ready(function() {
        Swal.fire({
            icon: 'warning',
            title: `{{ $message }}`,
            showConfirmButton: false,
            timer: 2500
        })
    });
</script>
@endpush
