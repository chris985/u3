<div class="uk-navbar-item uk-navbar-right uk-visible@m">
	@if (has_nav_menu('primary_navigation'))
	{!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'uk-navbar-nav']) !!}
	@endif
    @include('partials.search')
</div>
<?php if ( is_active_sidebar( '$header' )) { ?>
<div class="uk-navbar-item">
	@php(dynamic_sidebar('$header' ))
</div>
<?php } ?>