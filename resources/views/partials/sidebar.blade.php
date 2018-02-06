<?php if ( is_active_sidebar( $sidebar )) { ?>
<aside id="{{ $sidebar }}" class="uk-width-1-4@m">
	@php(dynamic_sidebar( $sidebar ))
</aside>
<?php } ?>