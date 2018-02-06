@php
$searchLayout = get_theme_mod('searchLayout');
@endphp

@if ($searchLayout == 3)

@elseif ($searchLayout == 2)
<a class="uk-navbar-toggle" href="#modal-full" uk-search-icon uk-toggle></a>
<div id="modal-full" class="uk-modal-full uk-modal" uk-modal>
	<div class="uk-modal-dialog uk-flex uk-flex-center uk-flex-middle" uk-height-viewport>
		<button class="uk-button uk-button-primary uk-modal-close-full" type="button"></button>
		<form class="uk-search uk-search-large" action="{{ home_url( '/' ) }}">
			<input class="uk-search-input uk-text-center" type="search" placeholder="Search..." value="{{ get_search_query() }}" autofocus>
		</form>
	</div>
</div>
@elseif ($searchLayout == 1)
<a class="uk-navbar-toggle" href="#" uk-search-icon></a>
<div class="uk-navbar-dropdown" uk-drop="mode: click; cls-drop: uk-navbar-dropdown; boundary: !nav">
	<div class="uk-grid-small uk-flex-middle" uk-grid>
		<div class="uk-width-expand">
			<form class="uk-search uk-search-navbar uk-width-1-1" action="{{ home_url( '/' ) }}">
				<input class="uk-search-input" type="search" placeholder="Search..." value="{{ get_search_query() }}" autofocus>
			</form>
		</div>
		<div class="uk-width-auto">
			<a class="uk-navbar-dropdown-close" href="#" uk-close></a>
		</div>
	</div>
</div>
@else
<form class="uk-search uk-search-navbar" action="{{ home_url( '/' ) }}">
	<span uk-search-icon></span>
	<input class="uk-search-input" type="search" placeholder="Search..." value="{{ get_search_query() }}">
</form>
@endif