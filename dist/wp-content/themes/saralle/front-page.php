<?php
/*
Template Name: Home
*/
get_header();

$args = array(
  'taxonomy' => 'products_cat',
  'parent' => 0,
  'hide_empty' => false,
);
$res = get_terms($args);
$categories = array();

foreach ($res as $row) {
	$categories[] = array($row->slug,$row->name);
}

$post_id = 2;

$product_title_top = get_field('product_title_top', $post_id);
if($product_title_top) {
	$product_title_top = '<div>'.$product_title_top.'</div>';
}

$product_title_bottom = get_field('product_title_bottom', $post_id);
if($product_title_bottom) {
	$product_title_bottom = '<div><span>'.$product_title_bottom.'</span></div>';
}

$product = get_field('products', $post_id);


$recipes_title_top = get_field('recipes_title_top', $post_id);
if($recipes_title_top) {
	$recipes_title_top = '<div>'.$recipes_title_top.'</div>';
}

$recipes_title_bottom = get_field('recipes_title_bottom', $post_id);
if($recipes_title_bottom) {
	$recipes_title_bottom = '<div><span>'.$recipes_title_bottom.'</span></div>';
}

$recipes = get_field('recipes', $post_id);

$recipes_button_all = get_field('recipes_button_all', $post_id);
if($recipes_button_all['title'] && $recipes_button_all['url']) {
	$recipes_button_all = '<div class="recipes__all"><a href="'.$recipes_button_all['url'].'">'.$recipes_button_all['title'].'</a></div>';
}

if(!empty($product) && $product_title_top && $product_title_bottom) { ?>
    <!-- products -->
    <div class="products">

        <!-- products__content -->
        <div class="products__content">

            <!-- products__title -->
            <div class="products__title">
               <?= $product_title_top.$product_title_bottom; ?>
            </div>
            <!-- /products__title -->

            <a href="#" class="products__prev">
                <svg viewBox="146 23 12 6"><path d="M7,10l6,6,6-6Z" transform="translate(139 13)"/></svg>
            </a>

            <!-- products__swiper -->
            <div class="products__swiper swiper-container">

                <!-- swiper-wrapper -->
                <div class="swiper-wrapper">

                    <?php $counter = 0; foreach ($product as $row) {  if ($counter > 4) {continue;} ?>
                        <a href="<?= get_permalink($row); ?>" class="products__item swiper-slide">
                            <div class="products__img">
                                <?= get_the_post_thumbnail($row); ?>
                            </div>
                            <p><?= get_the_title($row); ?></p>
                        </a>
                    <?php $counter++; } ?>

                </div>
                <!-- /swiper-wrapper -->

            </div>
            <!-- /products__swiper -->

            <a href="#" class="products__next">
                <svg viewBox="146 23 12 6"><path d="M7,10l6,6,6-6Z" transform="translate(139 13)"/></svg>
            </a>

        </div>
        <!-- /products__content -->

    </div>
    <!-- /products -->
    <?php }

if(!empty($recipes) && $recipes_title_top && $recipes_title_bottom) { ?>
    <!-- recipes -->
    <div class="recipes">

        <!-- recipes__title -->
        <div class="recipes__title">
					<?= $recipes_title_top.$recipes_title_bottom; ?>

        </div>
        <!-- /recipes__title -->

        <div class="recipes__row">

					<?php $counter = 0; foreach ($recipes as $row) { if ($counter > 4) {continue;} ?>
              <div class="recipes__item">
								<?= get_the_post_thumbnail($row); ?>
                  <div class="recipes__content">
                      <h3><?= get_the_title($row); ?></h3>
                      <p><?= get_the_excerpt($row); ?></p>
                      <a href="<?= get_permalink($row); ?>" class="btn btn_2">View Recipe</a>
                  </div>
              </div>
						<?php $counter++;} ?>

        </div>

			<?= $recipes_button_all; ?>

    </div>
    <!-- /recipes -->
<?php }

get_template_part( '/contents/content', 'locator');
get_template_part( '/contents/content', 'history');
get_footer();