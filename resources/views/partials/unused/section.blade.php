@php
$siteLayout = get_theme_mod('siteLayout');
$sectionContainer = get_theme_mod('sectionContainer-'. $section);
$sectionLayout = get_theme_mod('sectionLayout-'. $section);
$sectionStyle = get_theme_mod('sectionStyle-'. $section);
@endphp
<small>Section: {{ $section }}, Layout: {{ $sectionLayout}}, Container: {{ $sectionContainer}}</small>
<section id="{{ $section }}" class="{{ $sectionLayout}}{{ $sectionStyle}}">
	<div class="{{ $sectionContainer }}">
		<div class="uk-grid-match uk-child-width-expand@m" uk-grid>
			@php(dynamic_sidebar( $section ))
		</div>
	</div>
</section>