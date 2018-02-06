<article @php(post_class())>
  <header>
    <h2 class="entry-title"><a href="{{ get_permalink() }}">{{ get_the_title() }}</a></h2>
    @include('partials/entry-meta')
  </header>
  @while(have_posts()) @php(the_post())
    @include('partials.content-page')
  @endwhile
</article>
