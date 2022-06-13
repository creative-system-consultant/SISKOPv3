@push('js')
<script>
    $( document ).ready(function() {
        Swal.fire({
            icon: 'info',
            title: `{{$message}}`,
            showConfirmButton: false,
            timer: 2500
        })
    });
</script>
@endpush