<?php

namespace App;



// Register Custom Post Type
function cpt_slider()
{

    $labels = array(
        'name'                  => _x('Slaytlar', 'Post Type General Name', 'sage'),
        'singular_name'         => _x('Slayt', 'Post Type Singular Name', 'sage'),
        'menu_name'             => __('Slayt', 'sage'),
        'name_admin_bar'        => __('Slayt', 'sage'),
        'archives'              => __('Slayt Arşiv', 'sage'),
        'parent_item_colon'     => __('Parent Slide:', 'sage'),
        'all_items'             => __('Tüm Slaytlar', 'sage'),
        'add_new_item'          => __('Yeni Slayt Ekle', 'sage'),
        'add_new'               => __('Yeni Ekle', 'sage'),
        'new_item'              => __('Yeni Slayt', 'sage'),
        'edit_item'             => __('Slayt Düzenle', 'sage'),
        'update_item'           => __('Slayt Güncelle', 'sage'),
        'view_item'             => __('Slayt Görüntüle', 'sage'),
        'search_items'          => __('Slayt Ara', 'sage'),
        'not_found'             => __('Slayt Bulunamadı', 'sage'),
        'not_found_in_trash'    => __('Çöp Kutusunda Bulunamadı', 'sage'),
        'featured_image'        => __('Öneçıkan Resim', 'sage'),
        'set_featured_image'    => __('Öneçıkan Resim Seç', 'sage'),
        'remove_featured_image' => __('Öneçıkan Resim Sil', 'sage'),
        'use_featured_image'    => __('Öneçıkan Resim olarak kullan', 'sage'),
        'insert_into_item'      => __('Slaytın içine ekle', 'sage'),
        'uploaded_to_this_item' => __('Yüklenmiş Slayt', 'sage'),
        'items_list'            => __('Slayt Listesi', 'sage'),
        'items_list_navigation' => __('Slayt Navigasyonu', 'sage'),
        'filter_items_list'     => __('Slayt Filtrele', 'sage'),
    );
    $args = array(
        'label'                 => __('Slayt', 'sage'),
        'description'           => __('Açıklama', 'sage'),
        'labels'                => $labels,
        'supports'              => array('title', 'thumbnail',),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type('slider', $args);
}

// Register Custom Post Type
function cpt_testimonals()
{

    $labels = array(
        'name'                  => _x('İncelemeler', 'Post Type General Name', 'sage'),
        'singular_name'         => _x('İnceleme', 'Post Type Singular Name', 'sage'),
        'menu_name'             => __('İnceleme', 'sage'),
        'name_admin_bar'        => __('İnceleme', 'sage'),
        'archives'              => __('İnceleme Arşiv', 'sage'),
        'parent_item_colon'     => __('Ana İnceleme:', 'sage'),
        'all_items'             => __('Tüm İncelemeler', 'sage'),
        'add_new_item'          => __('Yeni İnceleme Ekle', 'sage'),
        'add_new'               => __('Yeni Ekle', 'sage'),
        'new_item'              => __('Yeni İnceleme', 'sage'),
        'edit_item'             => __('İnceleme Düzenle', 'sage'),
        'update_item'           => __('İnceleme Güncelle', 'sage'),
        'view_item'             => __('İnceleme Görüntüle', 'sage'),
        'search_items'          => __('İnceleme Ara', 'sage'),
        'not_found'             => __('İnceleme Bulunamadı', 'sage'),
        'not_found_in_trash'    => __('Çöp Kutusunda Bulunamadı', 'sage'),
        'featured_image'        => __('Öneçıkan Resim', 'sage'),
        'set_featured_image'    => __('Öneçıkan Resim Seç', 'sage'),
        'remove_featured_image' => __('Öneçıkan Resim Sil', 'sage'),
        'use_featured_image'    => __('Öneçıkan Resim olarak kullan', 'sage'),
        'insert_into_item'      => __('İncelemenin içine ekle', 'sage'),
        'uploaded_to_this_item' => __('Yüklenmiş İnceleme', 'sage'),
        'items_list'            => __('İnceleme Listesi', 'sage'),
        'items_list_navigation' => __('İnceleme Navigasyonu', 'sage'),
        'filter_items_list'     => __('İnceleme Filtrele', 'sage'),
    );
    $args = array(
        'label'                 => __('İnceleme', 'sage'),
        'description'           => __('Açıklama', 'sage'),
        'labels'                => $labels,
        'supports'              => array('title'),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => false,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type('testimonal', $args);
}


// Register Custom Post Type for Akıllı Tahta
function cpt_akilli_tahta()
{

    $labels = array(
        'name'                  => _x('Akıllı Tahtalar', 'Post Type General Name', 'sage'),
        'singular_name'         => _x('Akıllı Tahta', 'Post Type Singular Name', 'sage'),
        'menu_name'             => __('Akıllı Tahta', 'sage'),
        'name_admin_bar'        => __('Akıllı Tahta', 'sage'),
        'archives'              => __('Akıllı Tahtalar Arşiv', 'sage'),
        'parent_item_colon'     => __('Ana Akıllı Tahtalar:', 'sage'),
        'all_items'             => __('Tüm Akıllı Tahtalar', 'sage'),
        'add_new_item'          => __('Yeni Akıllı Tahta Ekle', 'sage'),
        'add_new'               => __('Yeni Ekle', 'sage'),
        'new_item'              => __('Yeni Akıllı Tahta ', 'sage'),
        'edit_item'             => __('Akıllı Tahta Düzenle', 'sage'),
        'update_item'           => __('Akıllı Tahta Güncelle', 'sage'),
        'view_item'             => __('Akıllı Tahta Görüntüle', 'sage'),
        'search_items'          => __('Akıllı Tahta Ara', 'sage'),
        'not_found'             => __('Akıllı Tahta Bulunamadı', 'sage'),
        'not_found_in_trash'    => __('Çöp Kutusunda Bulunamadı', 'sage'),
        'featured_image'        => __('Öneçıkan Resim', 'sage'),
        'set_featured_image'    => __('Öneçıkan Resim Seç', 'sage'),
        'remove_featured_image' => __('Öneçıkan Resim Sil', 'sage'),
        'use_featured_image'    => __('Öneçıkan Resim olarak kullan', 'sage'),
        'insert_into_item'      => __('Akıllı Tahtanın içine ekle', 'sage'),
        'uploaded_to_this_item' => __('Yüklenmiş Akıllı Tahta', 'sage'),
        'items_list'            => __('Akıllı Tahta Listesi', 'sage'),
        'items_list_navigation' => __('Akıllı Tahta Navigasyonu', 'sage'),
        'filter_items_list'     => __('Akıllı Tahta Filtrele', 'sage'),
    );
    $args = array(
        'label'                 => __('Akıllı Tahta', 'sage'),
        'description'           => __('Açıklama', 'sage'),
        'labels'                => $labels,
        'supports'              => array('title', 'thumbnail'),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => false,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type('akilli_tahta', $args);
}


add_action('init',    __NAMESPACE__ . '\cpt_slider', 0);
add_action('init',    __NAMESPACE__ . '\cpt_testimonals', 0);
add_action('init',    __NAMESPACE__ . '\cpt_akilli_tahta', 0);
