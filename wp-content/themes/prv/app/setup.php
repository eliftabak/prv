<?php

namespace App;

use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Container;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css', false, '4.7.0');
    wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
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
        'footer_nagivation-1' => __('Footer Navigation - 1', 'sage'),
        'footer_nagivation-2' => __('Footer Navigation - 2', 'sage'),
        'footer_nagivation-3' => __('Footer Navigation - 3', 'sage'),
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

    /**
     * Normal Logo
     * @author Muhammet DÜLGER
     */

    add_theme_support('custom-logo');

}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $primary_config = [
        'name' => __('Primary', 'sage'),
        'id' => 'sidebar-primary',
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="primary-sdidebar__title">',
        'after_title' => '</h3>',
    ];
    $footer_config_1 = [
        'name' => __('Footer-1', 'sage'),
        'id' => 'sidebar-footer-1',
        'before_widget' => '<div class="footer-widget__content %1$s %2$s col-3">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="footer-widget__title">',
        'after_title' => '</h5>',
    ];
    $footer_config_2 = [
        'name' => __('Footer-2', 'sage'),
        'id' => 'sidebar-footer-2',
        'before_widget' => '<div class="footer-widget__content %1$s %2$s col-3">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="footer-widget__title">',
        'after_title' => '</h5>',
    ];
    $footer_config_3 = [
        'name' => __('Footer-3', 'sage'),
        'id' => 'sidebar-footer-3',
        'before_widget' => '<div class="footer-widget__content %1$s %2$s col-3">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="footer-widget__title">',
        'after_title' => '</h5>',
    ];
    $footer_config_4 = [
        'name' => __('Footer-4', 'sage'),
        'id' => 'sidebar-footer-4',
        'before_widget' => '<div class="footer-widget__content footer-widget__social  %1$s %2$s col-12 text-right pt-5">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="footer-widget__title">',
        'after_title' => '</h5>',
    ];
    register_sidebar($primary_config);
    register_sidebar($footer_config_1);
    register_sidebar($footer_config_2);
    register_sidebar($footer_config_3);
    register_sidebar($footer_config_4);
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