<?php
/*
Template Name: Template Home Child
*/
?>
<h1>ciao child</h1>
<?php while (have_posts()) : the_post(); ?>
  <?php get_part('templates/content-home'); ?>
<?php endwhile; ?>
