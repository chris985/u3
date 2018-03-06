<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);
    wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);
}, 100);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
        'secondary_navigation' => __('Secondary Navigation', 'sage'),
        'tertiary_navigation' => __('Tertiary Navigation', 'sage')
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
   $config = [
    'before_widget' => '<div class="uk-card uk-card-body widget %1$s %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="uk-card-title">',
    'after_title'   => '</h3>'
];

$sections = explode( ',', get_theme_mod('sections') );
foreach ($sections as $value) {
    register_sidebar([
        'name'          => __($value, 'u3'),
        'id'            => $value
    ] + $config);
}
    register_sidebar([
        'name'          => __('Primary Sidebar', 'u3'),
        'id'            => 'primary'
    ] + $config);
    register_sidebar([
        'name'          => __('Secondary Sidebar', 'u3'),
        'id'            => 'secondary'
    ] + $config);
    register_sidebar([
        'name'          => __('Tertiary Sidebar', 'u3'),
        'id'            => 'tertiary'
    ] + $config);
/*
    register_sidebar([
        'name'          => __('Primary', 'u3'),
        'id'            => 'primary'
    ] + $config);
    register_sidebar([
        'name'          => __('Secondary', 'u3'),
        'id'            => 'secondary'
    ] + $config);
    register_sidebar([
        'name'          => __('Tertiary', 'u3'),
        'id'            => 'tertiary'
    ] + $config);
    register_sidebar([
        'name'          => __('Toolbar', 'u3'),
        'id'            => 'toolbar'
    ] + $config);
    register_sidebar([
        'name'          => __('Top', 'u3'),
        'id'            => 'top'
    ] + $config);
    register_sidebar([
        'name'          => __('Header', 'u3'),
        'id'            => 'header'
    ] + $config);
    register_sidebar([
        'name'          => __('Showcase', 'u3'),
        'id'            => 'showcase'
    ] + $config);
    register_sidebar([
        'name'          => __('Feature', 'u3'),
        'id'            => 'feature'
    ] + $config);
    register_sidebar([
        'name'          => __('Bottom', 'u3'),
        'id'            => 'bottom'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer', 'u3'),
        'id'            => 'footer'
    ] + $config);
    register_sidebar([
        'name'          => __('Copyright', 'u3'),
        'id'            => 'copyright'
    ] + $config);
    
    */
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });
});
