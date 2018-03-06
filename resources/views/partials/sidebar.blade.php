<?php if ( is_active_sidebar( $sidebar )) { ?>
<aside id="{{ $sidebar }}" class="">
	@php(dynamic_sidebar( $sidebar ))
</aside>
<?php } ?>