<?php

/**
 * Plugin Name: MetaBox
 * Adds a box to the main column on the Post and Page edit screens.
 */
function myplugin_add_custom_box() {

    $screens = array( 'post', 'page' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'myplugin_sectionid',
            __( 'Kommentare auf Seite ansehen', 'myplugin_textdomain' ),
            'myplugin_inner_custom_box',
            $screen
        );
    }
}
add_action( 'add_meta_boxes', 'myplugin_add_custom_box' );

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function myplugin_inner_custom_box( $post ) {

    $url = str_replace(
        get_site_url(),
        'http://elternbildung.local/post',
        get_permalink($post)
    );

    $date = date('Y-m-d');
    $hash = md5($date . 'xadcetopv');

    $slug = get_post_field( 'post_name', get_post() );

    echo "<a target='_blank' href='$url?token=$hash'>click here</a>";
}