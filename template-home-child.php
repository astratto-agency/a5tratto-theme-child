<?php
/*
Template Name: Template Home Child
*/

?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_part('templates/content-home'); ?>
<?php endwhile; ?>