<div>
    {{-- @dd(auth()->user()->status_verifikasi); --}}
    @if(auth()->user()->status_verifikasi != 'terima' && auth()->user()->status_medis)
        <script>
            Swal.fire({
                title: "Mohon Maaf",
                text: "Data diri anda belum dikonfirmasi untuk menggunakan fitur ini",
                icon: "warning",
                showCancelButton: false,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Lihat Profil",
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    Turbolinks.visit('/profile');
                }
            });
       </script>
    @endif
</div>