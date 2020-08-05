<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class App extends Controller
{
    public static function site_name()
    {
        return get_bloginfo('name');
    }

    public static function title()
    {
        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }
            return __('Latest Posts', 'sage');
        }
        if (is_archive() && !is_shop()) {
            return get_the_archive_title();
        }
        if (is_shop() && is_archive()) {
            return __('Mağaza', 'sage');
        }
        if (is_search()) {
            return sprintf(__('Search Results for %s', 'sage'), get_search_query());
        }
        if (is_404()) {
            return __('404 Hata', 'sage');
        }

        return get_the_title();
    }

    public static function home_url_with_slash()
    {
        return home_url('/');
    }


    public static function logo($class = "")
    {
        $logo = wp_get_attachment_image(get_theme_mod('custom_logo'), 'full', false, ["class" => "main-logo {$class}", "alt" => "pruvakademi-logo"]);
        return $logo;
    }
}
