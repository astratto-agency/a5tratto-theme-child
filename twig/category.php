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
$context = Timber::get_context();
$post = Timber::query_post();

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
    $context['term'] = $term = new Timber\Term( get_queried_object_id() );
    /* array_unshift( $templates, 'tag-' . $term->slug . '.twig' ); */
    $templates = array( 'tag-' . $term->slug . '.twig', 'tag.twig', 'archive.twig', 'index.twig' );
    // var_dump($term);
} else if ( is_category() ) {
    $context['title'] = single_cat_title( '', false );
    $context['term'] = $term = new Timber\Term( get_queried_object_id() );
    /* array_unshift( $templates, 'category-' . $term->slug . '.twig' ); */
    $templates = array( 'category-' . $term->slug . '.twig', 'category.twig', 'archive.twig', 'index.twig' );
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
    'cat'                   => $term->id,
    /*
    'cat' => 6,
    'category_name' => 'sport', 'attualita',
    'category__and' => array( 4, 9 ),
    'category__in' => array( 5, 9 ),
    'category__not_in' => array( 3, 6 ),
    */
);
$context['posts'] = new Timber\PostQuery($args);
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
    'term_taxonomy_id'  => $parent_id,
    'hide_empty' => false,

) );


/* paginato */
$context['found_posts' ] = $wp_query->found_posts;
$context['startpost'] = $startpost = 1;
$context['startpost'] = $startpost =  $paginazione*($paged - 1)+1;
$context['endpost']   = $endpost =  ($paginazione*$paged < $wp_query->found_posts ? $paginazione*$paged : $wp_query->found_posts);

Timber::render( $templates, $context );


//      Parametri WP_Query
//      Post e pagine
//      Mostrare i contenuti in base ad alcune caratteristiche dei post o pagine. I numeri rappresentano un indice mentre quando usiamo del testo ci riferiamo a uno slug.
//
//      'p' => 1,
//      'name' => 'ciao-modo',
//      'page_id' => 1,
//      'pagename' => 'pagina-di-esempio',
//      'pagename' => 'contact_us/canada',
//      'post_parent' => 1,
//      'post__in' => array(1,2,3),
//      'post__not_in' => array(1,2,3),
//      Post type
//      Carichiamo i post che appartengono a un dato post type. ‘annunci’ è lo slug di un post type custom.
//
//      'post_type' => array(
//              'post',               // articoli
//              'page',               // pagine
//              'revision',           // revisioni
//              'attachment',         // allegati
//              'annunci',            // custom post type annunci
//              'any'                 // tutti i post type tranne revision e quelli che hanno exclude_from_search impostato su true
//              ),
//      Stato di un post
//      Il valore di default è publish.
//
//      'post_status' => array(
//              'publish',                      // pubblicato
//              'pending',                      // in attesa di revisione
//              'draft',                        // bozza
//              'auto-draft',                   // bozza creata automaticamente per un nuovo articolo
//              'future',                       // post programmato (data futura)
//              'private',                      // non visibile a chi non è loggato
//              'inherit',                      // revisioni
//              'trash',                        // nel cestino
//              'any'                          // tutti i post tranne quelli che hanno exclude_from_search impostato su true
//              ),
//      Autori
//      Usare l’id dell’autore o l’user_nicename (non il nome). Per escludere un autore far precedere l’id dal segno meno (-2)
//
//      'author' => 1,2,3,
//      'author_name' => 'paolo',
//      Data di pubblicazione
//      Post associati a un certo periodo di pubblicazione
//
//      'year' => 2015,                         // 4 numeri
//      'monthnum' => 3,                        // marzo
//      'w' =>  25,                             // da 0 a 53
//      'day' => 17,                            // da 1 a 31
//      'hour' => 13,                           // da 0 a 23
//      'minute' => 19,                         // da 0 a 60
//      'second' => 30,                         // da 0 a 60
//      Categorie
//      Come mostrare i post associati a una o più categorie. Usare l’indice numerico o lo slug.
//
//      'cat' => 6,
//      'category_name' => 'sport', 'attualita',
//      'category__and' => array( 4, 9 ),
//      'category__in' => array( 5, 9 ),
//      'category__not_in' => array( 3, 6 ),
//      Tag
//      Post associati a un tag. Come per le categorie utilizzare id e slug.
//
//      'tag' => 'ricette',
//      'tag_id' => 9,
//      'tag__and' => array( 1, 6, 12),
//      'tag__in' => array( 2, 6, 9),
//      'tag__not_in' => array( 4, 11, 14),
//      'tag_slug__and' => array( 'pesce', 'carne'),
//      'tag_slug__in' => array( 'dolci', 'frutta'),
//      Tassonomie personalizzate
//      Mostrare i post associati a una certa tassonomia.
//      È possibile creare query per tassonomie multiple usando il parametro ‘relation’
//
//      'tax_query' => array(                     //(array) - use taxonomy parameters (available with Version 3.1).
//      'relation' => 'AND',                      //(string) - Possible values are 'AND' or 'OR' and is the equivalent of ruuning a JOIN for each taxonomy
//        array(
//          'taxonomy' => 'colore',                  // Tassonomia
//          'field' => 'slug',                       // Cosa usare per selezionare la tassonomie (id o slug)
//          'terms' => array( 'rosso', 'verde' ),    // Termini della tassonomia. Possibili valori stringa/intero/array
//          'include_children' => true,              // Includere o meno le i termini annidati nelle tassonomie gerarchiche
//          'operator' => 'IN'                       // Testare la corrispondenza del termine. Possibili valori 'IN', 'NOT IN', 'AND'.
//        ),
//        array(
//          'taxonomy' => 'actor',
//          'field' => 'id',
//          'terms' => array( 103, 115, 206 ),
//          'include_children' => false,
//          'operator' => 'NOT IN'
//        )
//      ),
//      Sticky post
//      Di default non sono visualizzati (false)
//
//      'ignore_sticky_posts' => true,          // visualizza sticky post
//      Custo field
//      È possibile fare query in base al valore di un campo personalizzato (custom field) o meta box
//
//      'meta_query'=> array(
//         array(
//             'key' => 'prezzo',
//             'value' => 100,
//             'type' => 'numeric',
//             'compare' => '>=',  //  Operatore per testare 'value'. Valori possibili '=', '!=', '>', '>=', '<', '<=', 'LIKE', 'NOT LIKE', 'IN', 'NOT IN', 'BETWEEN', 'NOT BETWEEN'
//          )
//      È possibile creare query per campi multipli usando il parametro ‘relation’
//
//      'meta_query' => array(
//        'relation' => 'OR',                   // default AND
//         array(
//           'key' => 'regione',
//           'value' => 'toscana',
//           'compare' => '='
//         ),
//         array(
//           'key' => 'price',
//           'value' => array( 1,200 ),
//           'compare' => 'NOT LIKE'
//         )
//      Ordinare i risultati
//
//      Per decidere se ordinare in modo ascendente (dal più piccolo al più grande) o discendente
//
//      'order' => 'DESC',          // ASC o DESC
//      In base a quale parametro ordinare i post. Di default i post sono ordinati in base alla data. Possibili valori sono
//
//      ‘date‘ – per data (default).
//      ‘none‘ – nessun ordinamento.
//      ‘ID‘ – in base all’indice del post.
//      ‘author‘ – per autore.
//      ‘title‘ – per titolo.
//      ‘modified‘ – in base all’ultima data di modifica.
//      ‘parent‘ – in base all’id del post o della pagina a un livello superiore
//      ‘rand‘ – ordinamento casuale.
//      ‘comment_count‘ – in base al numero di commenti
//      ‘menu_order‘ – utilizzato soprattutto per pagine (meta box ‘ordinamento’ nell’editor)
//      ‘meta_value‘ – usato assieme a ‘meta_key=chive_campo’ nella stessa query. Ordina in base al campo sia numerico che testuale.
//      ‘meta_value_num‘ – usato assieme a ‘meta_key=chive_campo’ che deve essere presente nella stessa query. Ordina in base al campo numerico
//      ‘post__in‘ – Conserva l’ordine post__in array (available with Version 3.5).
//      'orderby' => 'date',
//      Parametri di ricerca
//      Eseguire una ricerca, passando la query di ricerca e altri parametri..
//
//      's' => $s,                              // la query di ricerca
//      'exact' => true                         // ricerca nei titoli / post
//      'sentence' => true                      // ricerca per frase