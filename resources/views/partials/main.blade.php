<main id="main">
	@while(have_posts()) @php(the_post())
	<h2><a href="@php the_permalink() @endphp" class="uk-article-title">{{ get_the_title() }}</a></h2>
	@php(the_content())
	@endwhile
</main>