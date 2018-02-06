@extends('layouts.app')

@section('main')
@php
$section = 'main';
$sectionLayout = get_theme_mod('sectionLayout-'. $section, 'uk-section');
$sectionContainer = get_theme_mod('sectionContainer-'. $section, 'uk-container');
@endphp

<section id="{{ $section }}" class="{{ $sectionLayout}}">
	<div class="{{ $sectionContainer }}">
		<div class="uk-grid-match uk-child-width-expand@m" uk-grid>
			<div>
				@while(have_posts()) @php(the_post())
				<h2><a href="@php the_permalink() @endphp" class="uk-article-title">{{ get_the_title() }}</a></h2>
				@php(the_content())
				@endwhile
			</div>
		</div>
	</div>
</div>
</section>
@endsection