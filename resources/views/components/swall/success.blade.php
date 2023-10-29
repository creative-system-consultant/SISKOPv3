@push('js')
<script>
    $( document ).ready(function() {
        Swal.fire({
            icon: 'success',
            title: `{{ $message }}`,
            showConfirmButton: false,
            timer: `{{ $time ?? 10000 }}`
        })
    });
</script>
@endpush