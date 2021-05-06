<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

if (!defined('ABSPATH')) exit;

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

/*  A_SETTINGS Assegno tutte le variabili di ACF a Twig
    in caso avessi necessità puoi sostituire il valore $post con l'ID della pagina */
$fields = get_field_objects($post);
if ($fields):
    foreach ($fields as $field):
        $name_id = $field['name'];
        $value_id = $field['value'];
        $context[$name_id] = $value_id;
    endforeach;
endif;

/*  A_SETTINGS Elaboro una query per estrapolare la categoria */
$terms = get_the_terms($post->ID, 'category');
if ($terms) {
    foreach ($terms as $term) {
        $cat_obj = get_term($term->term_id, 'category');
        $cat_id = $cat_obj->term_id;
        $cat_slug = $cat_obj->slug;
    }
}

/*  A_SETTINGS Elaboro una query per i related con escluso i post corrente per categoria corrente */
$args = array(
    'post_type' => get_post_type(), // Nome del custom post
    'posts_per_page' => 3, // Numero custom post ( -1 = tutti )
    'cat' => $cat_id,
    'post__not_in' => array($post->ID),
);
$query_posts = new WP_Query($args);




if ($query_posts->have_posts()) {

    $query_posts = new Timber\PostQuery($args);

} else {
    /*  A_SETTINGS Elaboro una query per i related incaso non la prima quesry fosse vuota */
    $args_empty = array(
        'post_type' => get_post_type(), // Nome del custom post
        'posts_per_page' => 3, // Numero custom post ( -1 = tutti )
    );
    $query_posts = new WP_Query($args_empty);
}

/*  A_SETTINGS Assegno query definitiva */
$context['posts'] = $query_posts;



if (post_password_required($post->ID)) {
    Timber::render(
        'single-password.twig',
        $context
    );
} else {
    Timber::render(
        array(
            'single-' . $post->ID . '.twig',
            'single-' . $post->post_type . '.twig',
            'single.twig'),
        $context
    );
}
