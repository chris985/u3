@php
$siteLayout = get_theme_mod('siteLayout');
$sectionLayout = get_theme_mod('sectionLayout-'. $section);
$sectionContainer = get_theme_mod('sectionContainer-'. $section);
@endphp
<small>Section: {{ $section }}, Layout: {{ $sectionLayout}}, Container: {{ $sectionContainer}}</small>
<section id="{{ $section }}" class="{{ $sectionLayout}}">
	<div class="{{ $sectionContainer }}">
		<div class="uk-grid-match uk-child-width-expand@m" uk-grid>
			@php(dynamic_sidebar( $section ))
		</div>
	</div>
</section>