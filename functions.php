<?php

/*-----------------------------------------------------------------------------------*/
/*  A5T-Framework Child core 
/*-----------------------------------------------------------------------------------*/


/* enqueue script for parent theme stylesheeet */
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');
function my_theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}

$a5t_includes = array(
    'functions.php',                          // function.php
);

add_filter('timber/context', 'add_to_context_child');
function add_to_context_child($context)
{
    $context['child']            = "child";
    // $context['slider'] = get_field('slider');
    // $context['home']            = site_url();
    // $context['menu']            = new Timber\Menu('primary-menu');
    // $context['content']         = get_the_content();
    // $context['title']           = get_the_title();
    // $context['post_class']	    = get_post_class()[0];
    // $context['time']			= get_the_time('c');
    // $context['date']		    = get_the_date();
    // $context['author_url']	    = get_author_posts_url(get_the_author_meta('ID'));
    // $context['author']		    = get_the_author();
    // $context['urltema']		    = get_template_directory_uri();
    // $context['imgpage']		    = get_the_post_thumbnail_url();
    // $context['urlpage']		    = get_page_link();
    // $context['intro']    = get_the_excerpt();
    // $context['footer_col_1']    = Timber::get_widgets('footer_col_1');
    // $context['footer_col_2']    = Timber::get_widgets('footer_col_2');
    // $context['footer_col_3']    = Timber::get_widgets('footer_col_3');
    // $context['footer_col_4']    = Timber::get_widgets('footer_col_4');
    // $context['footer_bottom']   = Timber::get_widgets('footer_bottom');
    // $context['sidebar_primary']   = Timber::get_widgets('sidebar_primary');
    // $context['pre_footer']   = Timber::get_widgets('pre_footer');
    // $context['main_container']           = get_theme_mod("a5t_setting_main_container");
    // $context['setting_intestazione']           = get_theme_mod("a5t_setting_intestazione");
    // $context['setting_piva']           = get_theme_mod("a5t_setting_piva");
    // $context['setting_indirizzo']           = get_theme_mod("a5t_setting_indirizzo");
    // $context['setting_telefono']           = get_theme_mod("a5t_setting_telefono");
    // $context['setting_mail']           = get_theme_mod("a5t_setting_mail");
    // if ( function_exists( 'yoast_breadcrumb' ) ) {
    //     $context['breadcrumbs'] = yoast_breadcrumb('<div id="breadcrumbs" class="breadcrumb center mb-50">','</div>', false );
    // }
    // $context['menu_pricipale'] = new Timber\Menu( 'menu-principale' );
    // $context['menuu'] = new \Timber\Menu( 'primary-menu' );
    // $context['menu'] = new \Timber\Menu( 'primary-menu' );
    // $context['menu_servizi'] = new \Timber\Menu( 'Servizi' );
    // $context['menu'] = new \Timber\Menu( 'primary-menu' );
    // $context['menu_servizi'] = new \Timber\Menu( 'Servizi' );
    return $context;
}
