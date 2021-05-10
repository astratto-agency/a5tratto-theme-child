<?php

/*-----------------------------------------------------------------------------------*/
/*  A5T-Framework Child core 
/*-----------------------------------------------------------------------------------*/

/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::    * A_SETTINGS WP Enqueue style with child
::::::::::::::      enqueue script for parent theme stylesheeet
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
function theme_child_enqueue_styles()
{
    // $parenthandle = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
    // $theme = wp_get_theme();
    // wp_enqueue_style($parenthandle, get_template_directory_uri() . '/style.css',
    //     array(),  // if the parent theme code has a dependency, copy it to here
    //     $theme->parent()->get('Version')
    // );
    // wp_enqueue_style('child-style', get_stylesheet_uri(),
    //     array($parenthandle),
    //     $theme->get('Version') // this only works if you have Version in the style header
    // );
    // wp_enqueue_style('child-custom', get_stylesheet_uri() . '/assets/custom.css',
    //     array($parenthandle),
    //     $theme->get('Version') // this only works if you have Version in the style header
    // );

    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css');
    wp_enqueue_style('child-custom', get_stylesheet_directory_uri() . '/assets/custom.css');
}

add_action('wp_enqueue_scripts', 'theme_child_enqueue_styles', 115);

$a5t_includes = array(
    'functions.php',                          // function.php
);

function theme_child_enqueue_scripts()
{

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Carico il JS custom
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    wp_enqueue_script('child-scripts', get_stylesheet_directory_uri() . '/assets/custom.js', array(), '1.0.0', true);

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Carico i Credits
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    wp_enqueue_script('child-credits', get_stylesheet_directory_uri() . '/assets/credits.js', array(), '1.0.0', true);

}

add_action('wp_enqueue_scripts', 'theme_child_enqueue_scripts', 120);


/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::    * A_SETTINGS CONTEXT
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
add_filter('timber/context', 'add_to_context_child');

function add_to_context_child($context)
{

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Site
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $context['home'] = site_url();

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Logo
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $custom_logo_url = wp_get_attachment_image_src( $custom_logo_id , 'full' );
    $context['custom_logo_url'] = $custom_logo_url;

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Menu
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    $context['primary_menu'] = new Timber\Menu('Primary Navigation');
    // $context['footer_menu'] = new Timber\Menu('Footer Navigation 1');


    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Theme Dir
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    $context['tema_url'] = get_template_directory_uri();
    $context['urltema'] = get_template_directory_uri();

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Post
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/


    $context['post_title'] = get_the_title();

    $context['title'] = get_the_title();
    $context['the_title'] = get_the_title();

    if (is_page() || is_single()) {

        $context['post_class'] = get_post_class()[0];

        $context['content'] = get_the_content();
        $context['the_content'] = get_the_content();

        $context['urlpage'] = get_page_link();
        $context['page_link'] = get_page_link();
    }

    $context['imgpage'] = get_the_post_thumbnail_url();
    $context['post_image'] = get_the_post_thumbnail_url();

    $context['intro'] = get_the_excerpt();
    $context['the_excerpt'] = get_the_excerpt();



    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Placeholder
    ::::::::::::::      https://source.unsplash.com/

    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $context['placeholder'] = 'https://source.unsplash.com/';

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Time & Data
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $context['time'] = get_the_time('c');
    $context['date'] = get_the_date();

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS User
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $context['author_url'] = get_author_posts_url(get_the_author_meta('ID'));
    $context['author'] = get_the_author();

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS User WooCommerce Memberships
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

        $context['memberships'] = $memberships = wc_memberships_get_user_active_memberships(get_current_user_id());
    }

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Footer
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $context['pre_footer'] = Timber::get_widgets('pre_footer');
    $context['footer_col_1'] = Timber::get_widgets('footer_col_1');
    $context['footer_col_2'] = Timber::get_widgets('footer_col_2');
    $context['footer_col_3'] = Timber::get_widgets('footer_col_3');
    $context['footer_col_4'] = Timber::get_widgets('footer_col_4');
    $context['footer_bottom'] = Timber::get_widgets('footer_bottom');

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Sidebar
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $context['sidebar_primary'] = Timber::get_widgets('sidebar_primary');

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Slide
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    $context['slider'] = get_field('slider');


    $context['main_container'] = get_theme_mod("a5t_setting_main_container");


    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Setting
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    // intestazioni
    $context['setting_intestazione'] = get_theme_mod('a5t_setting_intestazione');
    $context['setting_piva'] = get_theme_mod('a5t_setting_piva');
    $context['setting_rea'] = get_theme_mod('a5t_setting_rea');
    $context['setting_cap_soc'] = get_theme_mod('a5t_setting_cap_soc');
    // indirizzo
    $context['setting_indirizzo_1'] = get_theme_mod('a5t_setting_indirizzo_1');
    $context['setting_indirizzo_2'] = get_theme_mod('a5t_setting_indirizzo_2');
    $context['setting_indirizzo_3'] = get_theme_mod('a5t_setting_indirizzo_3');
    // tel
    $context['setting_tel_1'] = get_theme_mod('a5t_setting_tel_1');
    $context['setting_tel_2'] = get_theme_mod('a5t_setting_tel_2');
    $context['setting_tel_3'] = get_theme_mod('a5t_setting_tel_3');
    $context['setting_fax'] = get_theme_mod('a5t_setting_fax');
    // mail
    $context['setting_mail_1'] = get_theme_mod('a5t_setting_mail_1');
    $context['setting_mail_2'] = get_theme_mod('a5t_setting_mail_2');
    $context['setting_mail_3'] = get_theme_mod('a5t_setting_mail_3');
    // social
    $context['setting_facebook'] = get_theme_mod('a5t_setting_facebook');
    $context['setting_linkedin'] = get_theme_mod('a5t_setting_linkedin');
    $context['setting_instagram'] = get_theme_mod('a5t_setting_instagram');


    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS If Plugin is active
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    /*if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
        echo 'WooCommerce is active.';
    } else {
        echo 'WooCommerce is not Active.';
    }*/


    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS WooCommerce
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

        if (WC()->cart->get_cart_contents_count() == 0) {
            $context['carrello'] = '';
        } else {
            $context['carrello'] = '1';
        }

    }


    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Google Maps
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $key = get_theme_mod('a5t_setting_maps');
    $context['googleapis'] = 'http://maps.googleapis.com/maps/api/js?key=' . $key . '&amp;sensor=false';


    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Yoast
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $id = get_the_ID();

    $post         = get_post( $id, ARRAY_A );
    $yoast_title = get_post_meta( $id, '_yoast_wpseo_title', true );
    $yoast_desc = get_post_meta( $id, '_yoast_wpseo_metadesc', true );

    $metatitle_val = wpseo_replace_vars($yoast_title, $post );
    $metatitle_val = apply_filters( 'wpseo_title', $metatitle_val );

    $metadesc_val = wpseo_replace_vars($yoast_desc, $post );
    $metadesc_val = apply_filters( 'wpseo_metadesc', $metadesc_val );


    $context['metatitle'] = $metatitle_val;

    $context['metadesc'] = $metadesc_val;

    if (function_exists('yoast_breadcrumb')) {
        $context['breadcrumbs'] = yoast_breadcrumb('<div id="breadcrumbs" class="breadcrumb center mb-50">', '</div>', false);
    }


    /*
   $custom_logo_id = get_theme_mod( 'custom_logo' );
   $context['logo'] = wp_get_attachment_image_src( $custom_logo_id , 'full' );
   */


// $context['menuu'] = new \Timber\Menu( 'primary-menu' );
// $context['menu'] = new \Timber\Menu( 'primary-menu' );
// $context['menu_servizi'] = new \Timber\Menu( 'Servizi' );
// $context['menu'] = new \Timber\Menu( 'primary-menu' );
// $context['menu_servizi'] = new \Timber\Menu( 'Servizi' );


    return $context;
}




