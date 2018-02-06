<h1><a href="{{ home_url('/') }}" class="uk-logo">
@if (get_theme_mod( 'logo' ))
		<img src="{{ get_theme_mod( 'logo' ) }}" alt="{{ get_bloginfo('name', 'display') }}" style="height: 80px;">
@else
	{{ get_bloginfo('name', 'display') }}
@endif
</a></h1>