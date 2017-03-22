<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
        's3DiskUrl' => rtrim(Storage::disk('s3')->url('/'), '/'), // Stupid hack because Laravel wont let me get the base url without a filename
    ]) !!};
</script>

@yield('custom-header-js')

