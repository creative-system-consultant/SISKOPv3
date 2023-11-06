@push('js')
<script>
    $( document ).ready(function() {
        Swal.fire({
            icon: 'warning',
            title: `{{ $message }}`,
            showConfirmButton: false,
            timer: `{{ $time ?? 10000 }}`
        })
    });
</script>
@endpush
