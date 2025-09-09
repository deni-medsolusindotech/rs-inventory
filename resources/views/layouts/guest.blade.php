
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Data Pegawai</title>
      <!-- Sweet Alerts js -->
    <script src="/assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <!-- Sweet Alert-->
    <link href="/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="/login/style.css" rel="stylesheet">
    <!-- Sweet Alerts js -->
    <script src="/assets/libs/sweetalert2/sweetalert2.min.js"></script>
   {{-- <script src="js/app.js"></script> --}}
        
</head>
<body>
    {{ $slot }}
    
   
    @if($errors->any())
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Error !',
                text: '{{ $errors->first() }}!!',
            })
        </script>
    @endif
<script src="/login/style.js"></script>
@if (old('name'))
<script>
    container.classList.add("right-panel-active");
</script>
@endif
</body>
</html>
