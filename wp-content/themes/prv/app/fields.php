<?php

namespace App;

add_action('cmb2_admin_init', function () {
    /**
     * Single Product Meta Boxes
     */
    $cmb = new_cmb2_box(array(
        'id' => 'single_product_metabox',
        'title' => __('Ürün ekstra alanları', 'sage'),
        'object_types' => array('product'), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ));

    // URL text field
    $cmb->add_field(array(
        'name' => __('Video çözüm linki', 'sage'),
        'desc' => __('Örnek: "http://domain.com/link" gibi', 'sage'),
        'id' => 'prv_video-cozum_url',
        'type' => 'text_url',
        // 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
        // 'repeatable' => true,
    ));

    // URL text field
    $cmb->add_field(array(
        'name' => __('Kitap inceleme pdf linki', 'sage'),
        'desc' => __('Örnek: "http://domain.com/exapmle.pdf" gibi', 'sage'),
        'id' => 'prv_kitap_inceleme_url',
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
        'name' => 'Akraplan resmi',
        'desc' => 'Kitap arka plan desen resmi yükleyin',
        'id' => 'prv_kitap_arkaplan_resim',
        'type' => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text' => array(
            'add_upload_file_text' => 'Resim ekle', // Change upload button text. Default: "Add or Upload File"
        ),
        // query_args are passed to wp.media's library query.
        'query_args' => array(
            //Or only allow gif, jpg, or png images
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
