<?php
/*
Template Name: About
*/
get_header();

$post_id = 11;
?>
<!-- about-us -->
        <div class="about-us">

            <!-- main-title -->
            <h2 class="main-title">
            	<?php the_field('title', $post_id); ?>
            </h2>
            <!-- main-title -->

            <!-- about-us__wrap -->
            <div class="about-us__wrap">
                <?php the_field('content', $post_id); ?>
            </div>
            <!-- /about-us__wrap -->
        </div>
        <!-- /about-us -->

        <?php get_template_part( '/contents/content', 'history'); ?>
<?php
get_footer();