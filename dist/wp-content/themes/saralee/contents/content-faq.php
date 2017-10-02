<?php
$pages = get_posts(array(
	'posts_per_page' => -1,
	'post_type' => 'faq',
	'post_status' => 'publish',
	'orderby' => 'menu_order',
	'order' => 'DESC',
	'fields' => 'ids',
));
$title = get_field('title', 177);
if($title) {
	$title = '<h2 class="main-title">'.$title.'</h2>';
}
$title_sub_nav = get_field('title_sub_nav', 177);
if($title_sub_nav) {
	$title_sub_nav = '<strong class="faq__menu-title">'.$title_sub_nav.'</strong>';
}

?>
<!-- faq -->
<div class="faq">

    <!-- main-title -->
    <?= $title; ?>
    <!-- main-title -->

	<?php if (!empty($pages)) { ?>
    <!-- faq__wrap -->
    <div class="faq__wrap">

        <!-- faq__menu -->
        <div class="faq__menu">

            <?= $title_sub_nav; ?>

            <nav>
	            <?php foreach ($pages as $row) { ?>
                <a href="<?= basename(get_permalink($row)); ?>" <?php if(is_singular('tips') && ($row === $post->ID)) {echo 'class="active"';}?> data-post="<?= $row; ?>"><?= get_the_title($row); ?></a>
                <?php } ?>
            </nav>

        </div>
        <!-- /faq__menu -->

        <!-- faq__content -->
        <div class="faq__content">

            <!-- dropdown -->
            <div class="dropdown">

              <?php
              if(is_singular('faq')) {
	              foreach (get_field('faq', get_the_ID()) as $row) {
		              echo '<div class="dropdown__item">
                    <div class="dropdown__title">'.$row['question'].'</div>
                    <div class="dropdown__content">'.$row['answer'].'</div>
                </div>';
	              }
              }
              ?>

            </div>
            <!-- /dropdown -->

        </div>
        <!-- /faq__content -->

    </div>
    <!-- /faq__wrap -->
    <?php } ?>

</div>
<!-- /faq -->
