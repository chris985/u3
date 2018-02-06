@php
$siteLayout = get_theme_mod('siteLayout');
$headerLayout = get_theme_mod('headerLayout');
@endphp

@if ($headerLayout == 0)
<nav class="uk-navbar-container uk-navbar-transparent" uk-navbar>
	<div class="{{ $siteLayout }}">
		<div class="uk-navbar-center">
			@include('partials.nav')
		</div>
	</div>
</nav>
<header id="header" class="uk-section">
	<div class="{{ $siteLayout }} uk-text-center" >
		@include('partials.logo')
	</div>
</header>
@elseif ($headerLayout == 1)
<header id="header" class="uk-section">
	<div class="{{ $siteLayout }}">
		<nav class="uk-navbar-container uk-navbar-transparent" uk-navbar>
			@include('partials.logo')
			<div class="uk-navbar-right">
				@include('partials.nav')
			</div>
		</nav>
	</div>
</header>
@elseif ($headerLayout == 2)
<header id="header" class="uk-section">
	<div class="{{ $siteLayout }} uk-text-center">
		@include('partials.logo')
	</div>
</header>
<nav class="uk-navbar-container uk-navbar-transparent" uk-navbar>
	<div class="{{ $siteLayout }}">
		<div class="uk-navbar-center">
			@include('partials.nav')
		</div>
	</div>
</nav>
@elseif ($headerLayout == 3)
<header id="header" class="uk-section">
	<div class="{{ $siteLayout }}">
		<nav class="uk-navbar-container uk-navbar-transparent" uk-navbar>
			<div class="uk-navbar-left">
				@include('partials.nav')
			</div>
			<div class="uk-navbar-right">
			@include('partials.logo')
			</div>
		</nav>
	</div>
</header>
@elseif ($headerLayout == 4)
<nav class="uk-navbar-container uk-navbar-transparent" uk-navbar>
	<div class="{{ $siteLayout }}">
		<div class="uk-navbar-center">
			@include('partials.nav')
		</div>
	</div>
</nav>
@elseif ($headerLayout == 5)
<header id="header" class="uk-section">
	<div class="{{ $siteLayout }} uk-text-center" >
		@include('partials.logo')
	</div>
</header>
@else
    @include('partials.section', ['section' => 'header'])
@endif