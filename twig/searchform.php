<?php
$context = Timber::get_context();
$site = new TimberSite();
Timber::render( 'searchform.twig', $context );
?>