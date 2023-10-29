@push('js')
<script>
    $( document ).ready(function() {
        Swal.fire({
            icon: 'error',
            title: `{{ $message }}`,
            showConfirmButton: false,
            timer: `{{ $time ?? 10000 }}`
        })
    });
</script>
@endpush