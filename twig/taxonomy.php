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

/* A_SETTINGS Assegnazione dei template  */
$templates = array( 'archive.twig', 'index.twig' );

/* A_SETTINGS Assegnazione del numero di paginazione di post per pagina */
$paginazione = 2;

/* A_SETTINGS Elaborazione dell'impaginato impostare il numero successivo qui '%/page/([0-3]+)%' in base al valore assegnato nella paginazione */
preg_match('%/page/([0-3]+)%', $_SERVER['REQUEST_URI'], $matches);
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

/* A_SETTINGS Smistamento delle impaginazioni ai relativi template di pagina */
$context['title'] = 'Archive';
if ( is_day() ) {
    $context['title'] = 'Archive: '.get_the_date( 'D M Y' );
} else if ( is_month() ) {
    $context['title'] = 'Archive: '.get_the_date( 'M Y' );
} else if ( is_year() ) {
    $context['title'] = 'Archive: '.get_the_date( 'Y' );
} else if ( is_tag() ) {
    $context['title'] = single_tag_title( '', false );
    $context['term'] = $term = new Timber\Term( get_queried_object_id() );
    /* array_unshift( $templates, 'tag-' . $term->slug . '.twig' ); */
    $templates = array( 'tag-' . $term->slug . '.twig', 'tag.twig', 'archive.twig', 'index.twig' );
    // var_dump($term);
} else if ( is_category() ) {
    $context['title'] = single_cat_title( '', false );
    $context['term'] = $term = new Timber\Term( get_queried_object_id() );
    /* array_unshift( $templates, 'category-' . $term->slug . '.twig' ); */
    $templates = array( 'category-' . $term->slug . '.twig', 'categoy.twig', 'archive.twig', 'index.twig' );
    // var_dump($term);
} else if ( is_tax() ) {
    $context['title'] = single_cat_title( '', false );
    $context['term'] = $term = new Timber\Term( get_queried_object_id() );
    /* array_unshift( $templates, 'taxonomy-' . $term->slug . '.twig' ); */
    $templates = array( 'taxonomy-' . $term->slug . '.twig', 'taxonomy.twig', 'archive.twig', 'index.twig' );
    // var_dump($term);
} else if ( is_post_type_archive() ) {
    $context['title'] = post_type_archive_title( '', false );
    $context['term'] = $term = new Timber\Term( get_queried_object_id() );
    array_unshift( $templates, 'archive-' . get_post_type() . '.twig' );
}

/*  A_SETTINGS Assegno tutte le variabili di ACF a Twig
    in caso avessi necessità puoi sostituire il valore $post con l'ID della pagina */
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
    'tax_query' => array(                     //(array) - use taxonomy parameters (available with Version 3.1).
        'relation' => 'AND',                      //(string) - Possible values are 'AND' or 'OR' and is the equivalent of ruuning a JOIN for each taxonomy
        array(
            'taxonomy' => $term->taxonomy,
            'terms'      => $term->slug,                 // Tassonomia
            'field' => 'slug',                       // Cosa usare per selezionare la tassonomie (id o slug)
            // 'terms' => array( 'rosso', 'verde' ),    // Termini della tassonomia. Possibili valori stringa/intero/array
            // 'include_children' => true,              // Includere o meno le i termini annidati nelle tassonomie gerarchiche
            // 'operator' => 'IN'                       // Testare la corrispondenza del termine. Possibili valori 'IN', 'NOT IN', 'AND'.
        ),
        /*
        array(
            'taxonomy' => 'actor',
            'field' => 'id',
            'terms' => array( 103, 115, 206 ),
            'include_children' => false,
            'operator' => 'NOT IN'
        )
        */
    ),
);
$context['posts'] = $posts_query = new Timber\PostQuery($args);




// Stampa child della categoria
$context['childs'] = $childs = get_terms(
    $term->taxonomy, array(
    'parent'    => $term->term_id,
    'hide_empty' => false
) );

// Stampa parent della categoria
$parent_id = $term->parent;
$context['parents'] = $parents = get_terms(
    $term->taxonomy, array(
    'term_id'    =>  $parent_id,
) );


/* paginato */
$context['found_posts'] = $posts_query->found_posts;
$context['startpost'] = $startpost = 1;
$context['startpost'] = $startpost =  $paginazione*($paged - 1)+1;
$context['endpost'] = $endpost = ($paginazione * $paged < $posts_query->found_posts ? $paginazione * $paged : $posts_query->found_posts);

Timber::render( $templates, $context );


