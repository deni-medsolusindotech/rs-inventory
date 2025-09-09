<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="px-3 shadow-sm">
        @if ($file)
            @if ($ext == 'pdf')
                <embed src="/assets/{{$file}}" type="application/pdf" width="450" height="400" >
            @else
                <img style="max-width:300px;max-height:400px;" src="/assets/{{$file}}">
            @endif
        @endif
    </div>
</div>
