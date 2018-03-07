@extends('layouts.app')

@section('header')

@php
$section = 'header';
$sectionContainer = get_theme_mod('sectionContainer-'. $section, 'uk-container');
$sectionLayout = get_theme_mod('sectionLayout-'. $section, 'uk-section');
$sectionStyle = get_theme_mod('sectionStyle-'. $section);
$headerLayout = get_theme_mod('headerLayout');
@endphp

@if($headerLayout == 1)
<header id="{{ $section }}" class="{{ $sectionLayout}}{{ $sectionStyle }}">
	<div class="{{ $sectionContainer }} uk-text-center">
		<nav id="menu" class="{{ $sectionLayout}}{{ $sectionStyle }} uk-navbar-container uk-navbar-transparent" uk-navbar>
			<div class="uk-navbar-center">
				@include('partials.nav')
			</div>
		</nav>
		@include('partials.logo')
	</div>
</header>
@elseif($headerLayout == 2)
<header id="{{ $section }}" class="{{ $sectionLayout}}{{ $sectionStyle }}">
	<div class="{{ $sectionContainer }}">
		<nav id="menu" class="uk-navbar-container uk-navbar-transparent" uk-navbar>
			@include('partials.logo')
			<div class="uk-navbar-right">
				@include('partials.nav')
			</div>
		</nav>
	</div>
</header>
@elseif($headerLayout == 3)
<header id="{{ $section }}" class="{{ $sectionLayout}}{{ $sectionStyle }}">
	<div class="{{ $sectionContainer }} uk-text-center">
		@include('partials.logo')
		<nav id="menu" class="{{ $sectionLayout}}{{ $sectionStyle }} uk-navbar-container uk-navbar-transparent" uk-navbar>
			<div class="uk-navbar-center">
				@include('partials.nav')
			</div>
		</nav>
	</div>
</header>
@elseif($headerLayout == 4)
<header id="{{ $section }}" class="{{ $sectionLayout}}{{ $sectionStyle }}">
	<div class="{{ $sectionContainer }}">
		<nav id="menu" class="uk-navbar-container uk-navbar-transparent" uk-navbar>
			<div class="uk-navbar-left">
				@include('partials.nav')
			</div>
			<div class="uk-navbar-right">
				@include('partials.logo')
			</div>
		</nav>
	</div>
</header>
@elseif($headerLayout == 5)
<nav id="menu" class="uk-navbar-container uk-navbar-transparent" uk-navbar>
	<div class="uk-navbar-center">
		@include('partials.nav')
	</div>
</nav>
@elseif($headerLayout == 6)
<header id="{{ $section }}" class="{{ $sectionLayout}}{{ $sectionStyle }}">
	<div class="uk-text-center">
		@include('partials.logo')
	</div>
</header>
@else

@endif
@endsection

@section('main')
@php
$section = 'main';
$sectionContainer = get_theme_mod('sectionContainer-'. $section, 'uk-container');
$sectionLayout = get_theme_mod('sectionLayout-'. $section, 'uk-section');
$sectionStyle = get_theme_mod('sectionStyle-'. $section);
$contentLayout = get_theme_mod('contentLayout');
@endphp
<section id="{{ $section }}" class="{{ $sectionLayout}}{{ $sectionStyle }}">
	<div class="{{ $sectionContainer }}">
		<div class="uk-grid-match uk-child-width-expand@m" uk-grid>
			@if ($contentLayout == 1)
			@include('partials.sidebar', ['sidebar' => 'primary'])
			@include('partials.sidebar', ['sidebar' => 'secondary'])
			@include('partials.main')
			@include('partials.sidebar', ['sidebar' => 'tertiary'])
			@elseif ($contentLayout == 2)
			@include('partials.main')
			@include('partials.sidebar', ['sidebar' => 'primary'])
			@include('partials.sidebar', ['sidebar' => 'secondary'])
			@include('partials.sidebar', ['sidebar' => 'tertiary'])
			@elseif ($contentLayout == 3)
			@include('partials.sidebar', ['sidebar' => 'primary'])
			@include('partials.sidebar', ['sidebar' => 'secondary'])
			@include('partials.sidebar', ['sidebar' => 'tertiary'])
			@include('partials.main')
			@else
			@include('partials.sidebar', ['sidebar' => 'secondary'])
			@include('partials.main')
			@include('partials.sidebar', ['sidebar' => 'primary'])
			@include('partials.sidebar', ['sidebar' => 'tertiary'])
			@endif
		</div>
	</div>
</section>
@endsection