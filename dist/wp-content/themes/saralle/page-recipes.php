<?php
/*
Template Name: Recipes
*/
get_header();


$post_id = get_the_ID();
$title = 'Not Found RECIPES';

if($_POST['search'] && $_POST['search'] !== '') {
	$popular_recipes = get_posts(array(
		'posts_per_page' => -1,
		'post_type' => 'recipe',
		'post_status' => 'publish',
		'orderby' => 'menu_order',
		'fields' => 'all',
        's' => $_POST['search']
		));
	if($popular_recipes) {
		$title = 'Found RECIPES';
	}
} elseif($_POST['product'] || $_POST['ingredient']) {

	$popular_recipes = get_posts(array(
		'posts_per_page' => -1,
		'post_type' => 'recipe',
		'post_status' => 'publish',
		'orderby' => 'menu_order',
		'fields' => 'all',
        'tax_query' => array(
          'relation' => 'AND',
          array(
            'taxonomy' => 'recipe_cat',
            'field'    => 'slug',
            'terms'    => $_POST['product'],
          ),
          array(
            'taxonomy' => 'recipe_tag',
            'field'    => 'slug',
            'terms'    => $_POST['ingredient'],
          )
        )
	));
	if($popular_recipes) {
			$title = 'Found RECIPES';
    }

} else {
	$popular_recipes = get_field('popular_recipes', $post_id);
	$title = get_field('title', $post_id);
}




if($title) {
	$title = '<strong class="products-list__title">'.$title.'</strong>';
}

$find_title = get_field('find_title', $post_id);
if($find_title) {
	$find_title = '<strong class="filter__title"><span>'.$find_title.'</span></strong>';
}
?>
	<!-- filter -->
	<div class="filter">

		<?= $find_title; ?>

		<!-- filter__wrap -->
		<form action="<?= get_permalink(13); ?>" class="filter__wrap" method="post">
            <?php
            $args = array(
              'taxonomy' => 'recipe_cat',
              'hide_empty' => false,
            );
            $terms_product = get_terms( $args );
            if(!empty($terms_product)) { ?>
			<select name="product">
                <?php foreach ($terms_product as $row) { ?>
				<option value="<?= $row->slug; ?>" <?php if (isset($_POST['product']) && ($_POST['product'] === $row->slug)) {echo 'selected';} ?>><?= $row->name; ?></option>
                <?php } ?>
			</select>
            <?php }
            $args = array(
                'taxonomy' => 'recipe_tag',
                'hide_empty' => false,
            );
            $terms_product = get_terms( $args );
            if(!empty($terms_product)) { ?>
			<select name="ingredient">
				<?php foreach ($terms_product as $row) { ?>
                <option value="<?= $row->slug; ?>" <?php if (isset($_POST['ingredient']) && ($_POST['ingredient'] === $row->slug)) {echo 'selected';} ?>><?= $row->name; ?></option>
				<?php } ?>
			</select>
            <?php } ?>
			<span>OR</span>
			<input type="search" placeholder="<?= get_field('find_placeholder', $post_id); ?>" name="search" value="<?php if (isset($_POST['search'])) {echo $_POST['search'];} ?>">
			<button type="submit" class="btn btn_5"><?= get_field('find_title_button', $post_id); ?></button>
		</form>
		<!-- /filter__wrap -->

	</div>
	<!-- /filter -->

	<!-- products-list -->
	<div class="products-list">

        <?= $title; ?>

      <div class="products-list__wrap">



          <?php
          if(is_array($popular_recipes)) {
          foreach ($popular_recipes as $row) {
	          setup_postdata($row);
          $rate = '';
          if (function_exists('five_star_rating_func')) {
          $rate = five_star_rating_func('star');
          }
          ?>
              <a href="<?= get_permalink($row); ?>" class="products-list__item">
                  <span class="products-list__pic"><?= get_the_post_thumbnail($row); ?></span>
                  <div class="products-list__info">
                      <strong><?= get_the_title($row); ?></strong>
                      <span class="rate">
                            <span class="rate__progress" style="width: 0%"></span>
                            <?= $rate; ?>
                     </span>
                      <span class="products-list__comments"><?= get_comments_number($row); ?></span>
                  </div>
              </a>
          <?php
          }
          wp_reset_postdata();
          } ?>

      </div>

	</div>
	<!-- /products-list -->

<?php

get_template_part( '/contents/content', 'tip');

get_footer();