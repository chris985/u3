<!doctype html>
<html @php(language_attributes())>
<head>
    @include('partials.head')
</head>
<body @php(body_class())>
    @php
    $sectionsList = get_theme_mod('sections');
    $sections = explode( ',', $sectionsList );
    @endphp

    @section('head')
    @php(do_action('get_header'))
    @show

    @foreach ($sections as $section)
    @section($section)
    @if (is_active_sidebar($section))
    @php
    $sectionContainer = get_theme_mod('sectionContainer-'. $section, 'uk-container');
    $sectionLayout = get_theme_mod('sectionLayout-'. $section, 'uk-section');
    $sectionStyle = get_theme_mod('sectionStyle-'. $section);
    @endphp
     <small><em>Debug:</em> Section: {{ $section }}, Container: {{ $sectionContainer}} Layout: {{ $sectionLayout}}, Style: {{ $sectionStyle }} </small> 
    <section id="{{ $section }}" class="{{ $sectionLayout}}{{ $sectionStyle }}">
        <div class="{{ $sectionContainer }}">
            <div class="uk-grid-match uk-child-width-expand@m" uk-grid>
                @php(dynamic_sidebar( $section ))
            </div>
        </div>
    </div>
</section>
@endif
@show
@endforeach

@section('foot')
@php(do_action('get_footer'))
@php(wp_footer())
@show
</body>
</html>
