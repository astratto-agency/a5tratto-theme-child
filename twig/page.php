<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * To generate specific templates for your pages you can use:
 * /mytheme/views/page-mypage.twig
 * (which will still route through this PHP file)
 * OR
 * /mytheme/page-mypage.php
 * (in which case you'll want to duplicate this file and save to the above path)
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */
if ( ! defined( 'ABSPATH' ) ) exit;
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;


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

// $context['categorie_principali'] = Timber::get_terms(array('taxonomy' => 'categoria-prodotti' ,'parent' => 0 , ));
// $context['sub_categorie'] = Timber::get_terms(array('taxonomy' => 'categoria-prodotti' ,'child' => 0 , ));


Timber::render( array( 'page-' . $post->post_name . '.twig', 'page.twig' ), $context );