<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.2
 */

if ( ! defined( 'ABSPATH' ) ) exit;
$post = Timber::query_post();
$context = Timber::get_context();
/* themplates */
$templates = array( 'archive.twig', 'index.twig' );
/* definizco il numero di paginazione */
$paginazione = 2;
/* elaboro la paginazione */
preg_match('%/page/([0-2]+)%', $_SERVER['REQUEST_URI'], $matches );
if ( get_query_var( 'paged' ) ) {
    $paged = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) {
    $paged = get_query_var( 'page' );
} else {
    $paged = isset( $matches[1] ) ? $matches[1] : 1;
}
if (!isset($paged) || !$paged) {
    $paged = 1;
}
/* smisto le impaginazioni */
$context['title'] = 'Archive';
if ( is_day() ) {
    $context['title'] = 'Archive: '.get_the_date( 'D M Y' );
} else if ( is_month() ) {
    $context['title'] = 'Archive: '.get_the_date( 'M Y' );
} else if ( is_year() ) {
    $context['title'] = 'Archive: '.get_the_date( 'Y' );
} else if ( is_tag() ) {
    $context['title'] = single_tag_title( '', false );
    $term = new Timber\Term( get_queried_object_id() );
    /* array_unshift( $templates, 'tag-' . $term->slug . '.twig' ); */
    $templates = array( 'tag-' . $term->slug . '.twig', 'tag.twig', 'archive.twig', 'index.twig' );
    // var_dump($term);
} else if ( is_category() ) {
    $context['title'] = single_cat_title( '', false );
    $term = new Timber\Term( get_queried_object_id() );
    /* array_unshift( $templates, 'category-' . $term->slug . '.twig' ); */
    $templates = array( 'category-' . $term->slug . '.twig', 'categoy.twig', 'archive.twig', 'index.twig' );
    // var_dump($term);
} else if ( is_tax() ) {
    $context['title'] = single_cat_title( '', false );
    $term = new Timber\Term( get_queried_object_id() );
    /* array_unshift( $templates, 'taxonomy-' . $term->slug . '.twig' ); */
    $templates = array( 'taxonomy-' . $term->slug . '.twig', 'taxonomy.twig', 'archive.twig', 'index.twig' );
    // var_dump($term);
} else if ( is_post_type_archive() ) {
    $context['title'] = post_type_archive_title( '', false );
    array_unshift( $templates, 'archive-' . get_post_type() . '.twig' );
}



/* assegno tutte le variabili di ACF */
$fields = get_field_objects( $post );
if( $fields ):
    foreach( $fields as $field ):
        $name_id = $field['name'];
        $value_id = $field['value'];
        $context[$name_id] = $value_id;
    endforeach;
endif;



/* elaboro la query */
$args = array(
    'post_type'             => 'any', // Nome del custom post
    /*
    * 'any', Tutti i custom post type ( attenzione che prende teaser in base alle CPT)
    * 'post_type' => array('post','movie','actor'), CPT multipli
    * get_post_type(), // Nome del custom post
    */
    'posts_per_page'        => $paginazione, // Numero custom post ( -1 = tutti )
    'paged'                 => $paged,
    'tag_id'                => $term->id,
    /*
     'tag' => 'ricette',
     'tag_id' => 9,
     'tag__and' => array( 1, 6, 12),
     'tag__in' => array( 2, 6, 9),
     'tag__not_in' => array( 4, 11, 14),
     'tag_slug__and' => array( 'pesce', 'carne'),
     'tag_slug__in' => array( 'dolci', 'frutta'),
    */
);
$context['posts'] = $wp_query = new Timber\PostQuery($args);
/* paginato */
$context['found_posts' ] = $wp_query->found_posts;
$context['startpost'] = $startpost = 1;
$context['startpost'] = $startpost =  $paginazione*($paged - 1)+1;
$context['endpost']   = $endpost =  ($paginazione*$paged < $wp_query->found_posts ? $paginazione*$paged : $wp_query->found_posts);

Timber::render( $templates, $context );


