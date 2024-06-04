<?php get_header(); ?>


<section class="page-wrap">
<div class="container">
    <h1><?php the_title(); ?></h1>
    <!--<p>Before including section-content.php</p>-->
    <?php get_template_part('includes/section', 'content'); ?>
    <!--<p>After including section-content.php</p>-->
</div>
</section>

<?php get_footer(); ?>
