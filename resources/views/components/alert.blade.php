<div>
    @push('script')
        
    {{-- Stop trying to control. --}}
    @if(session('success'))
    <script>
        Swal.fire({title:"Kamu Berhasil",text:"{{ session('success') }}!",icon:"success",})
        </script>
    @elseif(session('warning'))
    <script>
        Swal.fire({title:"Pemberitahuan",text:"{{ session('warning') }}!",icon:"warning",})
    </script>uu
    @endif
    <script>
        Livewire.on('alert-warning',function(data){
            Swal.fire({title:"Pemberitahuan",text:data,icon:"warning",})
        })
        Livewire.on('alert-success',function(data){
            Swal.fire({title:"Kamu Berhasil",text:data,icon:"success",})
        })
    </script>
    @endpush
</div>
