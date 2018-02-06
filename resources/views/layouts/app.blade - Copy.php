<!doctype html>
<html @php(language_attributes())>
<head>
    @include('partials.head')
</head>
<body @php(body_class())>
    @php
    $siteLayout = get_theme_mod('siteLayout');
    $sections = get_theme_mod('sectionsList');
var_dump( explode( ',', $sections ) );
    @endphp

    @section('head')
    @php(do_action('get_header'))
    @show

    @section('toolbar')
    @if (is_active_sidebar(toolbar))
    @include('partials.section', ['section' => 'toolbar'])
    @endif
    @show

    @section('header')
    @include('partials.header')
    @show

    @section('top')
    @if (is_active_sidebar(top))
    @include('partials.section', ['section' => 'top'])
    @endif
    @show

    @section('showcase')
    @if (is_active_sidebar(showcase))
    @include('partials.section', ['section' => 'showcase'])
    @endif
    @show

    @section('feature')
    @if (is_active_sidebar(feature))
    @include('partials.section', ['section' => 'feature'])
    @endif
    @show

    @php
    $mainLayout = get_theme_mod('mainLayout');
    @endphp

    @section('main')
    <main id="main" class="uk-section">
        <div class="{{ $siteLayout }}">
            <div id="content" class="uk-grid-match uk-grid-small uk-child-width-expand@m" uk-grid>
                @if ($mainLayout == 0)
                @include('partials.sidebar', ['sidebar' => 'secondary'])
                @section('content')
                @include('partials.main')
                @show
                @include('partials.sidebar', ['sidebar' => 'primary'])
                @include('partials.sidebar', ['sidebar' => 'tertiary'])
                @elseif ($mainLayout == 1)
                @include('partials.sidebar', ['sidebar' => 'primary'])
                @include('partials.sidebar', ['sidebar' => 'secondary'])
                @section('content')
                @include('partials.main')
                @show
                @include('partials.sidebar', ['sidebar' => 'tertiary'])
                @elseif ($mainLayout == 2)
                @section('content')
                @include('partials.main')
                @show
                @include('partials.sidebar', ['sidebar' => 'primary'])
                @include('partials.sidebar', ['sidebar' => 'secondary'])
                @include('partials.sidebar', ['sidebar' => 'tertiary'])
                @elseif ($mainLayout == 3)
                @include('partials.sidebar', ['sidebar' => 'primary'])
                @include('partials.sidebar', ['sidebar' => 'secondary'])
                @include('partials.sidebar', ['sidebar' => 'tertiary'])
                @section('content')
                @include('partials.main')
                @show
                @else
                @endif
            </div>
        </div>
    </main>
    @show

    @section('bottom')
    @if (is_active_sidebar(bottom))
    @include('partials.section', ['section' => 'bottom'])
    @endif
    @show

    @section('footer')
    @if (is_active_sidebar(footer))
    @include('partials.footer')
    @endif
    @show

    @section('foot')
    @php(do_action('get_footer'))
    @php(wp_footer())
    @show
</body>
</html>
