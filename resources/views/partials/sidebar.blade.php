@php
$width = get_theme_mod($sidebar . 'Width');
$style = get_theme_mod($sidebar . 'Style');
@endphp

@if (is_active_sidebar($sidebar))
<aside id="{{ $sidebar }}" class="sidebar {{$width}}{{$style}}">
	@php(dynamic_sidebar( $sidebar ))
</aside>
@endif