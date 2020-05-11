<?php

namespace App;


/**
 *
 * Single Product Meta Boxes
 *
 */

add_action('cmb2_admin_init', function () {

    $cmb = new_cmb2_box(array(
        'title' => __('Ürün ekstra alanları', 'sage'),
        'id' => 'single_product_metabox',
        'object_types' => array('product'), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ));

    $cmb->add_field(array(
        'name' => __('Video çözüm linki', 'sage'),
        'desc' => __('Örnek: "http://domain.com/link" gibi', 'sage'),
        'id' => 'prv_video-cozum_url',
        'type' => 'text_url',
        // 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
        // 'repeatable' => true,
    ));

    $cmb->add_field(array(
        'name' => __('Sayfa arkaplan rengi', 'sage'),
        'desc' => __('Kitabın arka planında gözüken renk seçme alanı', 'sage'),
        'id' => 'prv_kitap_arkaplan_renk',
        'type' => 'colorpicker',
        'default' => '#ffffff',
        'options' => array(
            'alpha' => true, // Make this a rgba color picker.
        ),
    ));

    $cmb->add_field(array(
        'name' => __('Kitap inceleme pdf linki', 'sage'),
        'desc' => __('Örnek: "http://domain.com/exapmle.pdf" gibi', 'sage'),
        'id' => 'prv_kitap_inceleme_pdf',
        'type' => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text' => array(
            'add_upload_file_text' => __('PDF ekle', 'sage'), // Change upload button text. Default: "Add or Upload File"
        ),
        // query_args are passed to wp.media's library query.
        'query_args' => array(
            'type' => 'application/pdf', // Make library only display PDFs.
        ),
        'preview_size' => 'large', // Image size to use when previewing in the admin.
    ));

    $cmb->add_field(array(
        'name' => __('Akraplan resmi', 'sage'),
        'desc' => __('Kitap arka plan desen resmi yükleyin', 'sage'),
        'id' => 'prv_kitap_arkaplan_resim',
        'type' => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text' => array(
            'add_upload_file_text' => __('Resim ekle', 'sage'), // Change upload button text. Default: "Add or Upload File"
        ),
        // query_args are passed to wp.media's library query.
        'query_args' => array(
            'type' => array(
                'image/gif',
                'image/jpeg',
                'image/png',
                'image/svg+xml',
            ),
        ),
        'preview_size' => 'large', // Image size to use when previewing in the admin.
    ));
});


/**
 *
 * Slider Meta Boxes
 *
 */


add_action('cmb2_admin_init', function () {


    $cmb = new_cmb2_box(array(
        'title' => __('Slider Ekstra Alanları', 'sage'),
        'id' => 'single_slider_metabox',
        'object_types' => array('slider'), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ));

    $group_field_id = $cmb->add_field(array(
        'id'          => 'slider_repeat_group',
        'type'        => 'group',
        // 'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'       => __('Slayt {#}', 'sage'), // since version 1.1.4, {#} gets replaced by row number
            'add_button'        => __('Yeni Slayt Ekle', 'sage'),
            'remove_button'     => __('Slayt Sil', 'sage'),
            'sortable'          => true,
            'closed'         => true, // true to have the groups closed by default
            'remove_confirm' => esc_html__('Bu slayt\'ı gerçekten silmek istiyormusun ?', 'sage'), // Performs confirmation before removing group.
        ),
    ));

    // Id's for group's fields only need to be unique for the group. Prefix is not needed.
    $cmb->add_group_field($group_field_id, array(
        'name' => __('Slayt Ana Başlık', 'sage'),
        'description' => __('Slayt kısa ana başlık', 'sage'),
        'id'   => 'prv_slider_title',
        'type' => 'text',
        // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
    ));

    // Id's for group's fields only need to be unique for the group. Prefix is not needed.
    $cmb->add_group_field($group_field_id, array(
        'name' => __('Slayt Alt Başlık', 'sage'),
        'description' => __('Slayt kısa alt başlık', 'sage'),
        'id'   => 'prv_slider_sub_title',
        'type' => 'text',
        // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
    ));

    // Id's for group's fields only need to be unique for the group. Prefix is not needed.
    $cmb->add_group_field($group_field_id, array(
        'name' => __('Slayt Slogan', 'sage'),
        'description' => __('Slayt kısa genel vurgu', 'sage'),
        'id'   => 'prv_slider_manifesto',
        'type' => 'text',
        // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
    ));


    $cmb->add_group_field($group_field_id, array(
        'name' => __('Slayt Açıklama', 'sage'),
        'description' => __('Slayt kısa açıklama', 'sage'),
        'id'   => 'prv_slider_desc',
        'type' => 'textarea_small',
    ));

    $cmb->add_group_field($group_field_id, array(
        'name' => __('Buton Link Url', 'sage'),
        'desc' => __('Örnek: "http://pruvaakademi.com/link" gibi', 'sage'),
        'id' => 'prv_slider_button',
        'type' => 'text_url',
        // 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
        //'repeatable' => true,
    ));

    // Id's for group's fields only need to be unique for the group. Prefix is not needed.
    $cmb->add_group_field($group_field_id, array(
        'name' => __('Buton İç Yazı', 'sage'),
        'description' => __('Buton Yazı', 'sage'),
        'id'   => 'prv_slider_button_text',
        'type' => 'text',
        // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
    ));


    $cmb->add_group_field($group_field_id, array(
        'name' => __('Sol Resim', 'sage'),
        'desc' => __('Sol yan resim yükleyin', 'sage'),
        'id' => 'prv_slider_left_pic',
        'type' => 'file',
        // Optional:
        'text' => array(
            'add_upload_file_text' => __('Resim Ekle', 'sage'), // Change upload button text. Default: "Add or Upload File"
        ),
        // query_args are passed to wp.media's library query.
        'query_args' => array(
            'type' => array(
                'image/jpeg',
                'image/png',
                'image/svg+xml',
            ),
        ),
        'preview_size' => 'large', // Image size to use when previewing in the admin.
    ));

    $cmb->add_group_field($group_field_id, array(
        'name' => __('Akraplan Resim', 'sage'),
        'desc' => __('Arka plan resmi yükleyin', 'sage'),
        'id' => 'prv_slider_main_pic',
        'type' => 'file',
        'text' => array(
            'add_upload_file_text' => __('Resim Ekle', 'sage'), // Change upload button text. Default: "Add or Upload File"
        ),
        // query_args are passed to wp.media's library query.
        'query_args' => array(
            'type' => array(
                'image/jpeg',
                'image/png',
                'image/svg+xml',
            ),
        ),
        'preview_size' => 'large', // Image size to use when previewing in the admin.
    ));

    $cmb->add_group_field($group_field_id, array(
        'name' => __('Sayfa arkaplan rengi', 'sage'),
        'desc' => __('Slayt arka planında gözüken renk seçme alanı', 'sage'),
        'id' => 'prv_slider_background_color',
        'type' => 'colorpicker',
        'default' => '#1d185c',
        'options' => array(
            'alpha' => true, // Make this a rgba color picker.
        ),
    ));
});



/**
 *
 * Testimonals Meta Boxes
 *
 */

add_action('cmb2_admin_init', function () {

    $cmb = new_cmb2_box(array(
        'title' => __('İnceleme ekstra alanları', 'sage'),
        'id' => 'testimonal_metabox',
        'object_types' => array('testimonal'), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ));


    $cmb->add_field(array(
        'name' => __('Açıklama', 'sage'),
        'description' => __('İnceleme yazısı', 'sage'),
        'id'   => 'prv_testimonal_student_review',
        'type' => 'textarea_small',
    ));

    $cmb->add_field(array(
        'name' => __('Öğrenci resmi', 'sage'),
        'desc' => __('Öğrenci resmi yükleyin', 'sage'),
        'id' => 'prv_testimonal_student_pic',
        'type' => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text' => array(
            'add_upload_file_text' => __('Resim ekle', 'sage'), // Change upload button text. Default: "Add or Upload File"
        ),
        // query_args are passed to wp.media's library query.
        'query_args' => array(
            'type' => array(
                'image/gif',
                'image/jpeg',
                'image/png',
                'image/svg+xml',
            ),
        ),
        'preview_size' => 'medium', // Image size to use when previewing in the admin.
    ));
});


/**
 *
 * Akıllı Tahta Meta Boxes
 *
 */

add_action('cmb2_admin_init', function () {

    $cmb = new_cmb2_box(array(
        'title' => __('Akıllı tahta ekstra alanları', 'sage'),
        'id' => 'akilli_tahta_metabox',
        'object_types' => array('akilli_tahta'), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ));

    $cmb->add_field(array(
        'name' => __('Akllı Tahta Dosyası', 'sage'),
        'desc' => __('Örnek: "http://pruvakademi.com/dosyaismi.zip" gibi', 'sage'),
        'id' => 'prv_akilli_tahta',
        'type' => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text' => array(
            'add_upload_file_text' => __('Dosya yükle', 'sage'), // Change upload button text. Default: "Add or Upload File"
        ),
        // query_args are passed to wp.media's library query.
        'query_args' => array(
            'type' => array(
                'application/zip',
                'application/octet-stream',
                'application/x-zip-compressed',
                'multipart/x-zip',
            ), // Make library only display ZIP files.
        ),
        'preview_size' => 'thumbnail', // Image size to use when previewing in the admin.
    ));
});



/**
 *
 * Akıllı Tahta Meta Boxes
 *
 */

add_action('cmb2_admin_init', function () {

    $cmb = new_cmb2_box(array(
        'title' => __('Akıllı tahta ekstra alanları', 'sage'),
        'id' => 'user_metabox',
        'object_types' => array('user'), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ));

    $cmb->add_field(array(
        'name'             => 'Kullanıcı Tipi',
        'desc'             => 'Kullanıcı tipi belirleyin',
        'id'               => 'prv_user_type',
        'type'             => 'select',
        'show_option_none' => true,
        'default'          => 'Standart',
        'options'          => array(
            'Öğretmen'   => __('Öğretmen', 'sage'),
            'Öğrenci' => __('Öğrenci', 'sage'),
        ),
    ));

    $cmb->add_field(array(
        'name'             => 'Kullanıcı Onay',
        'desc'             => 'Kullanıcıyı onaylayın',
        'id'               => 'prv_user_validate',
        'type'             => 'select',
        'show_option_none' => true,
        'default'          => 'Onaylanmadı',
        'options'          => array(
            'Onaylandı'   => __('Onaylandı', 'sage'),
            'Onaylanmadı' => __('Onaylanmadı', 'sage')
        ),
    ));
});
