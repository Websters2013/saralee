<?php
$pages = get_posts(array(
	'posts_per_page' => -1,
	'post_type' => 'tips',
	'post_status' => 'publish',
	'orderby' => 'menu_order',
	'order' => 'DESC',
	'fields' => 'ids',
));
?>
<!-- list-info -->
<div class="list-info">

    <!-- list-info__menu -->
    <div class="list-info__menu">

        <strong class="list-info__menu-title"><?= get_field('title', 165); ?></strong>
			<?php if (!empty($pages)) { ?>
          <nav>
						<?php $counter = 0; foreach ($pages as $row) { ?>
                <a href="<?= basename(get_permalink($row)); ?>" <?php if((is_singular('tips') && ($row === $post->ID)) || (is_page_template('page-tips.php') && $counter === 0)) {echo 'class="active"';}?> data-post="<?= $row; ?>"><?= get_the_title($row); ?> <img src="<?= get_template_directory_uri(); ?>/assets/img/arrow.png" alt="arrow"></a>
						<?php $counter++;} ?>
          </nav>
			<?php } ?>

    </div>
    <!-- /list-info__menu -->

    <!-- list-info__content -->
    <div class="list-info__content">

			<?php
            if(is_singular('tips')) {
                echo get_post_field('post_content', $post->ID);
            }
            ?>

    </div>
    <!-- /list-info__content -->

</div>
<!-- /list-info -->