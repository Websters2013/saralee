<?php
get_header();

$post_id = get_the_ID();

$like_product = get_field('like_product', $post_id);
$like_product_string = '';
if($like_product) {
	if(acf_is_array($like_product)) {
		foreach ($like_product as $row) {
			$like_product_string .= '<a href="'.get_permalink($row).'" class="products__item swiper-slide">
						<div class="products__img">'.get_the_post_thumbnail($row).'</div>
						<p>'.get_the_title($row).'</p>
					</a>';
		}
	} else {
		$like_product_string = '<a href="'.get_permalink($like_product).'" class="products__item swiper-slide">
						<div class="products__img">
							'.get_the_post_thumbnail($like_product).'
						</div>
						<p>'.get_the_title($like_product).'</p>
					</a>';
	}
}


$related_recipes = get_field('related_recipes', $post_id);
$related_recipes_string = '';
if($related_recipes) {
	if(acf_is_array($related_recipes)) {
		foreach ($related_recipes as $row) {
			$related_recipes_string .= '<div class="recipes__item">
				'.get_the_post_thumbnail($row).'
				<div class="recipes__content">
					<h3>'.get_the_title($row).'</h3>
					<p>'.get_the_excerpt($row).'</p>
					<a href="'.get_permalink($row).'" class="btn btn_2">View Recipe</a>
				</div>
			</div>';
		}
	} else {
		$related_recipes_string = '<div class="recipes__item">
				'.get_the_post_thumbnail($related_recipes).'
				<div class="recipes__content">
					<h3>'.get_the_title($related_recipes).'</h3>
					<p>'.get_the_excerpt($related_recipes).'</p>
					<a href="'.get_permalink($related_recipes).'" class="btn btn_2">View Recipe</a>
				</div>
			</div>';
	}
}


$gallery = get_field('gallery', $post_id);
if(!empty($gallery)) {
    foreach ($gallery as $row) {
	    $gallery_string_1 .= '<div class="swiper-slide" style="background-image:url('.$row['url'].')"></div>';
	    $gallery_string_2 .= '<div class="swiper-slide" style="background-image:url('.$row['sizes']['thumbnail'].')"></div>';
    }
}

$category = get_the_terms($post_id, 'products_cat');
$category_string = '';
if(!empty($category)) {
    foreach ($category as $row) {
	    $category_string .= '<a href="'.get_term_link($row->term_id).'">'.$row->name.'</a>';
    }

}
$category_count = count($category);

?>



	<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<a href="<?= get_site_url(); ?>">Home</a>
		<a href="<?= get_permalink(); ?>">Products</a>
		<?= $category_string; ?>
		<span><?= get_the_title(); ?></span>
	</div>
	<!-- /breadcrumbs -->

	<!-- product -->
	<div class="product">
        <?php if($gallery) { ?>
		<!-- product__slider -->
		<div class="product__slider">
			<!-- product__slider-top -->
			<div class="product__slider-top">
				<div class="swiper-container gallery-top">
					<div class="swiper-wrapper">
						<?= $gallery_string_1; ?>
					</div>
				</div>
			</div>
			<!-- /product__slider-top -->
			<div class="swiper-container gallery-thumbs">
				<div class="swiper-wrapper">
					<?= $gallery_string_2; ?>
				</div>
			</div>
		</div>
		<!-- /product__slider -->
        <?php } ?>

		<!-- product__content -->
		<div class="product__content">

			<!-- product__title -->
			<h1 class="product__title">
				<span><?= get_the_title($post_id); ?></span>
				<?= get_field('subtitle', $post_id); ?>
			</h1>
			<!-- /product__title -->

			<?php the_content($post_id); ?>

			<!-- product__list -->
			<div class="product__list">

				<!-- product__list-item -->
				<form action="<?= get_permalink(15); ?>" class="product__list-item" method="post">

					<!-- product__subtitle -->
					<h2 class="product__subtitle with-icon">
						<img src="<?= get_template_directory_uri(); ?>/assets/img/location.png" alt="Where to Buy">
						Where to Buy
					</h2>
					<!-- /product__subtitle -->

					<input type="search" placeholder="Enter Zipcode" name="zip" maxlength="10" size="6">
                    <input type="hidden" name="miles" value="5">
                    <input type="hidden" name="upc" value="dfsdghj,k.jhjgjfdrgesfasdsvbnbmg">

				</form>
				<!-- /product__list-item -->

				<!-- product__list-item -->
				<div class="product__list-item">

					<!-- product__subtitle -->
					<h2 class="product__subtitle">Share this!</h2>
					<!-- /product__subtitle -->

					<!-- social -->
					<div class="social">
						<?= do_shortcode('[addtoany buttons="facebook,twitter,google_plus"]'); ?>
						<!--<a href="#" class="social__item social__item-facebook">
							<svg enable-background="new 0 0 56.693 56.693" viewBox="0 0 56.693 56.693"><path d="M40.43,21.739h-7.645v-5.014c0-1.883,1.248-2.322,2.127-2.322c0.877,0,5.395,0,5.395,0V6.125l-7.43-0.029  c-8.248,0-10.125,6.174-10.125,10.125v5.518h-4.77v8.53h4.77c0,10.947,0,24.137,0,24.137h10.033c0,0,0-13.32,0-24.137h6.77  L40.43,21.739z"></path></svg>
						</a>
						<a href="#" class="social__item social__item-twetter">
							<svg enable-background="new 0 0 56.693 56.693" viewBox="0 0 56.693 56.693"><path d="M52.837,15.065c-1.811,0.805-3.76,1.348-5.805,1.591c2.088-1.25,3.689-3.23,4.444-5.592c-1.953,1.159-4.115,2-6.418,2.454  c-1.843-1.964-4.47-3.192-7.377-3.192c-5.581,0-10.106,4.525-10.106,10.107c0,0.791,0.089,1.562,0.262,2.303  c-8.4-0.422-15.848-4.445-20.833-10.56c-0.87,1.492-1.368,3.228-1.368,5.082c0,3.506,1.784,6.6,4.496,8.412  c-1.656-0.053-3.215-0.508-4.578-1.265c-0.001,0.042-0.001,0.085-0.001,0.128c0,4.896,3.484,8.98,8.108,9.91  c-0.848,0.23-1.741,0.354-2.663,0.354c-0.652,0-1.285-0.063-1.902-0.182c1.287,4.015,5.019,6.938,9.441,7.019  c-3.459,2.711-7.816,4.327-12.552,4.327c-0.815,0-1.62-0.048-2.411-0.142c4.474,2.869,9.786,4.541,15.493,4.541  c18.591,0,28.756-15.4,28.756-28.756c0-0.438-0.009-0.875-0.028-1.309C49.769,18.873,51.483,17.092,52.837,15.065z"></path></svg>
						</a>
						<a href="#" class="social__item social__item-pinterest">
							<svg enable-background="new 0 0 56.693 56.693" viewBox="0 0 56.693 56.693"><g><path d="M28.348,5.158c-13.599,0-24.625,11.023-24.625,24.625c0,10.082,6.063,18.744,14.739,22.553   c-0.069-1.721-0.012-3.783,0.429-5.654c0.473-2,3.168-13.418,3.168-13.418s-0.787-1.572-0.787-3.896   c0-3.648,2.115-6.373,4.749-6.373c2.24,0,3.322,1.682,3.322,3.695c0,2.252-1.437,5.619-2.175,8.738   c-0.616,2.613,1.31,4.744,3.887,4.744c4.665,0,7.808-5.992,7.808-13.092c0-5.397-3.635-9.437-10.246-9.437   c-7.47,0-12.123,5.57-12.123,11.792c0,2.146,0.633,3.658,1.624,4.83c0.455,0.537,0.519,0.754,0.354,1.371   c-0.118,0.453-0.389,1.545-0.501,1.977c-0.164,0.625-0.669,0.848-1.233,0.617c-3.44-1.404-5.043-5.172-5.043-9.408   c0-6.994,5.899-15.382,17.599-15.382c9.4,0,15.588,6.804,15.588,14.107c0,9.658-5.369,16.875-13.285,16.875   c-2.659,0-5.16-1.438-6.016-3.068c0,0-1.43,5.674-1.732,6.768c-0.522,1.9-1.545,3.797-2.479,5.275   c2.215,0.654,4.554,1.01,6.979,1.01c13.598,0,24.623-11.023,24.623-24.623C52.971,16.181,41.945,5.158,28.348,5.158z"></path></g></svg>
						</a>-->
					</div>
					<!-- /social -->

				</div>
				<!-- /product__list-item -->

			</div>
			<!-- /product__list -->

		</div>
		<!-- /product__content -->

	</div>
	<!-- /product -->

    <?php if($like_product_string) { ?>
	<!-- products -->
	<div class="products products_borders">

		<!-- site__title -->
		<h2 class="site__title"><span>You may also like</span></h2>
		<!-- site__title -->

		<!-- products__content -->
		<div class="products__content">

			<a href="#" class="products__prev">
				<svg viewBox="146 23 12 6"><path d="M7,10l6,6,6-6Z" transform="translate(139 13)"/></svg>
			</a>

			<!-- products__swiper -->
			<div class="products__swiper swiper-container">

				<!-- swiper-wrapper -->
				<div class="swiper-wrapper">

					<?= $like_product_string; ?>

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
    <?php } ?>

    <?php if($related_recipes_string) { ?>
	<!-- recipes -->
	<div class="recipes recipes_product">

		<!-- recipes__title -->
		<div class="recipes__title">
			<div>related</div>
			<div><span>RECIPES</span></div>
		</div>
		<!-- /recipes__title -->

		<div class="recipes__row">

            <?= $related_recipes_string; ?>

		</div>

	</div>
	<!-- /recipes -->
    <?php }

get_footer();