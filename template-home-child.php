<!-- A_SETTINGS Impostazione pagina Template Home Child -->
<?php
/*
Template Name: Template Home Child
*/
?>
<?php while (have_posts()) : the_post(); ?>
  <?php get_part('templates/home'); ?>
<?php endwhile; ?>