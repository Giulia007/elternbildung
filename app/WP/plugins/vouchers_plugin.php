<?php
/*
Plugin Name: Vouchers
Description: Add post types for voucher
Author: Giulietta Atzori
*/

// Hook <strong>la_custom_post_voucher()</strong> to the init action hook
add_action( 'init', 'la_custom_post_voucher' );

// The custom function to register a voucher post type
function la_custom_post_voucher() {

    // Set the labels, this variable is used in the $args array
    $labels = array(
        'name'               => __( 'Vouchers' ),
        'singular_name'      => __( 'Voucher' ),
        'add_new'            => __( 'Add New Voucher' ),
        'add_new_item'       => __( 'Add New Voucher' ),
        'edit_item'          => __( 'Edit Voucher' ),
        'new_item'           => __( 'New Voucher' ),
        'all_items'          => __( 'All Vouchers' ),
        'view_item'          => __( 'View Vouchers' ),
        'search_items'       => __( 'Search Vouchers' ),
        'featured_image'     => 'Image',
        'set_featured_image' => 'Add Image'
    );

    // The arguments for our post type, to be entered as parameter 2 of register_post_type()
    $args = array(
        'labels'            => $labels,
        'description'       => 'Holds vouchers and voucher specific data',
        'public'            => true,
        'menu_position'     => 5,
        'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'has_archive'       => true,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'show_in_rest'       => true,
        'has_archive'       => true,
        'query_var'         => 'voucher'
    );

    // Call the actual WordPress function
    // Parameter 1 is a name for the post type
    // Parameter 2 is the $args array
    register_post_type( 'voucher', $args);
}

