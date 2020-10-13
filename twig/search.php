<?php
/**
 * Search results page
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

if ( ! defined( 'ABSPATH' ) ) exit;
$post = Timber::query_post();
$context = Timber::get_context();

$templates = array( 'search.twig', 'archive.twig', 'index.twig' );

$context          = Timber::get_context();
$context['title'] = 'Search results for ' . get_search_query();


preg_match('%/page/([0-12]+)%', $_SERVER['REQUEST_URI'], $matches );
if ( get_query_var( 'paged' ) ) {
    $paged = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) {
    $paged = get_query_var( 'page' );
} else {
    $paged = isset( $matches[1] ) ? $matches[1] : 1;
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



/* ascolta url per prendere campo di ricerca */
$s = $_GET['s'];
$context['s'] = $s;


/*
 *  Recupero da url categorie e ricerca
$brand = $_GET['brand'];
$context['brand'] = $brand;
$applicazioni = $_GET['applicazioni'];
$context['applicazioni'] = $applicazioni;
*/

/*
 * Ricerco categorie cominate
$tax_query = array(
    'relation' => 'AND',
    array(
        'taxonomy' => 'brand',
        'field'    => 'slug',
        'terms'    => array( $brand ),
        'operator'  => 'AND'
    ),
    array(
        'taxonomy' => 'applicazioni',
        'field'    => 'slug',
        'terms'    => array( $applicazioni ),
        'operator'  => 'AND'
    )
);
*/


$args = array(
    'post_type'             => 'post', //////////// Nome del custom post
    'posts_per_page'        => 12, //////////// Numero custom post ( -1 = tutti )
    's'                     => $s,
    'paged'                 => $paged,  //////////// Impaginazione
    /*'tax_query'             => $tax_query, //////////// Combo ricerca fra due categorie */

    /************************ ordinamento per quelle che prima hanno immagini o no
    'meta_query' => array(  //query post based on meta key
    array(
    'relation' => 'OR', // add condition if meta key is exists or not
    array(
    'key' => '_thumbnail_id',
    'compare' => 'NOT EXISTS' // include post without _thumbnail_id key
    ),
    array(
    'key' => '_thumbnail_id',
    'compare' => '!NOT EXISTS' // include post with _thumbnail_id key
    )
    )
    ),
     */
    /************************ ordinamento per titolo e poi per data */
    'orderby' => array(
        array(
            'post_title' => 'ASC',
            'post_date' => 'ASC',
        )
    ),
    /************************ ordinamento per meta
    'meta_query' => array(
    'relation' => 'AND',
    array(
    'key' => 'volt',
    'value' => '36',
    'compare' => '=',
    ),
    ),
     */

);
/* elaboro query */
$query = new WP_Query($args);

/* se query da risultiti */
if ( $query->have_posts() ) {
    /* elaboro query */
    $wp_query = new Timber\PostQuery($args);
}
/* se query è vuota */
else
{
/* assegna variabile vuota per intestaizione della frase */
    $context['vuoto'] = 'Nessun risultato trovato per: ';

    /* query delle tassonomie alternativa
    $tax_query2 = array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'brand',
            'field'    => 'slug',
            'terms'    => array( $brand ),
            'operator'  => 'AND'
        ),
        array(
            'taxonomy' => 'applicazioni',
            'field'    => 'slug',
            'terms'    => array( $applicazioni ),
            'operator'  => 'AND'
        )
    );
    */

    $args2 = array(
        'post_type'             => 'any', // Nome del custom post
        'posts_per_page'        => 12, // Numero custom post ( -1 = tutti )
        's'                     => $s,
        'paged'                 => $paged,
        /*'tax_query'             => $tax_query2,*/

        'orderby' => array(
            array(
                'post_title' => 'ASC',
                'post_date' => 'ASC',
            )
        ),


    );
    /* elaboro query con risultati alternativi */
    $wp_query = new Timber\PostQuery($args2);
}
 /*assegno definitivamento query */
$context['posts'] = $wp_query;



$context[ 'found_posts' ] = $wp_query->found_posts;
$context['startpost'] = $startpost = 1;
$context['startpost'] = $startpost =  12*($paged - 1)+1;
$context['endpost']   = $endpost =  (12*$paged < $wp_query->found_posts ? 12*$paged : $wp_query->found_posts);


Timber::render( $templates, $context );

