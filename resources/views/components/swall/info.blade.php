@push('js')
<script>
    $( document ).ready(function() {
        Swal.fire({
            icon: 'info',
            title: `{{ $message }}`,
            showConfirmButton: false,
            timer: `{{ $time ?? 10000 }}`
        })
    });
</script>
@endpush