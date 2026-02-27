@props(['tagsCsv'])
{{-- //tagsCsv is a variable  --}}
@php
// explode php function hai iska kaam string ko tor kr array banana hai
$tags=explode(',',$tagsCsv);
@endphp
<ul class="flex">
    @foreach ($tags as $tag)
        <li class="flex items-center justify-center bg-black text-white rounded-xl px-3 py-1 mr-2 text-xs">
            <a href="/?tag={{ $tag }}">{{ $tag }}</a>
        </li>
    @endforeach
</ul>
