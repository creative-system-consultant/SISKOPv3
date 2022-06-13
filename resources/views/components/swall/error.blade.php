@push('js')
<script>
    $( document ).ready(function() {
        Swal.fire({
            icon: 'error',
            title: `{{$message}}`,
            showConfirmButton: false,
            timer: 2500
        })
    });
</script>
@endpush