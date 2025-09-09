@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
    <div class="image-container">
        <img src="{{ env('APP_URL') }}/logo.png" alt="logo" height="60" >
        <img src="{{ env('APP_URL') }}/logo-2.png" alt="logo" height="60" >
    </div>
</a>
</td>
</tr>
