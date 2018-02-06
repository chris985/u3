@php
$siteLayout = get_theme_mod('siteLayout');
$footerBranding = get_theme_mod('footerBranding');
@endphp 
<footer id="footer" class="uk-section">
	<div class="{{ $siteLayout }}">
		<div class="uk-grid-match uk-child-width-expand@m" uk-grid>
			@php(dynamic_sidebar('footer'))
		</div>
	</div>

	@if ($footerBranding == 1)
	<div class="{{ $siteLayout }}">
		<div class="uk-grid-match uk-child-width-expand@m" uk-grid>
			<p>Powered by Template Engine</p>
		</div>
	</div>
	@else
		@include('partials.section', ['section' => 'copyright'])
	@endif
</footer>
