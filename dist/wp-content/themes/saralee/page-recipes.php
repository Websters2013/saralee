<?php
/*
Template Name: Recipes
*/
get_header();
$post_id = get_the_ID();
$title = get_field('title', $post_id);
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
		<form action="#" class="filter__wrap">

			<select name="product">
				<option value="0">Product</option>
				<option value="1">Product 1</option>
				<option value="2">Product 2</option>
				<option value="3">Product 3</option>
				<option value="4">Product 4</option>
				<option value="5">Product 5</option>
				<option value="6">Product 6</option>
			</select>
			<select name="ingredient">
				<option value="0">Ingredient</option>
				<option value="1">Ingredient 1</option>
				<option value="2">Ingredient 2</option>
				<option value="3">Ingredient 3</option>
				<option value="4">Ingredient 4</option>
				<option value="5">Ingredient 5</option>
				<option value="6">Ingredient 6</option>
			</select>
			<span>OR</span>
			<input type="search" placeholder="<?= get_field('find_placeholder', $post_id); ?>" name="search">
			<button type="submit" class="btn btn_5"><?= get_field('find_title_button', $post_id); ?></button>
		</form>
		<!-- /filter__wrap -->

	</div>
	<!-- /filter -->

	<!-- products-list -->
	<div class="products-list">

		<?= $title; ?>

		<!-- products-list__wrap -->
		<div class="products-list__wrap">

			<!-- products-list__item -->
			<a href="#" class="products-list__item">

				<!-- products-list__pic -->
				<span class="products-list__pic"><img src="pic/pic1.jpg" alt=""></span>
				<!-- /products-list__pic -->

				<!-- products-list__info -->
				<div class="products-list__info">
					<strong>Nutella Filled Pound  Cake</strong>

					<!-- rate -->
					<span class="rate">
                            <!-- rate__progress -->
                            <span class="rate__progress" style="width: 36%"></span>
						<!-- /rate__progress -->
                        </span>
					<!-- /rate -->

					<!-- products-list__comments -->
					<span class="products-list__comments">12</span>
					<!-- /products-list__comments -->
				</div>
				<!-- /products-list__info -->

			</a>
			<!-- /products-list__item -->

			<!-- products-list__item -->
			<a href="#" class="products-list__item">

				<!-- products-list__pic -->
				<span class="products-list__pic"><img src="pic/pic2.jpg" alt=""></span>
				<!-- /products-list__pic -->

				<!-- products-list__info -->
				<div class="products-list__info">
					<strong>Nutella Filled Pound  Cake</strong>

					<!-- rate -->
					<span class="rate">
                            <!-- rate__progress -->
                            <span class="rate__progress" style="width: 36%"></span>
						<!-- /rate__progress -->
                        </span>
					<!-- /rate -->

					<!-- products-list__comments -->
					<span class="products-list__comments">12</span>
					<!-- /products-list__comments -->
				</div>
				<!-- /products-list__info -->

			</a>
			<!-- /products-list__item -->

			<!-- products-list__item -->
			<a href="#" class="products-list__item">

				<!-- products-list__pic -->
				<span class="products-list__pic"><img src="pic/pic3.jpg" alt=""></span>
				<!-- /products-list__pic -->

				<!-- products-list__info -->
				<div class="products-list__info">
					<strong>Nutella Filled Pound  Cake</strong>

					<!-- rate -->
					<span class="rate">
                            <!-- rate__progress -->
                            <span class="rate__progress" style="width: 36%"></span>
						<!-- /rate__progress -->
                        </span>
					<!-- /rate -->

					<!-- products-list__comments -->
					<span class="products-list__comments">12</span>
					<!-- /products-list__comments -->
				</div>
				<!-- /products-list__info -->

			</a>
			<!-- /products-list__item -->

			<!-- products-list__item -->
			<a href="#" class="products-list__item">

				<!-- products-list__pic -->
				<span class="products-list__pic"><img src="pic/pic1.jpg" alt=""></span>
				<!-- /products-list__pic -->

				<!-- products-list__info -->
				<div class="products-list__info">
					<strong>Nutella Filled Pound Cake</strong>

					<!-- rate -->
					<span class="rate">
                            <!-- rate__progress -->
                            <span class="rate__progress" style="width: 36%"></span>
						<!-- /rate__progress -->
                        </span>
					<!-- /rate -->

					<!-- products-list__comments -->
					<span class="products-list__comments">12</span>
					<!-- /products-list__comments -->
				</div>
				<!-- /products-list__info -->

			</a>
			<!-- /products-list__item -->

			<!-- products-list__item -->
			<a href="#" class="products-list__item">

				<!-- products-list__pic -->
				<span class="products-list__pic"><img src="pic/pic2.jpg" alt=""></span>
				<!-- /products-list__pic -->

				<!-- products-list__info -->
				<div class="products-list__info">
					<strong>Nutella Filled Pound Cake</strong>

					<!-- rate -->
					<span class="rate">
                            <!-- rate__progress -->
                            <span class="rate__progress" style="width: 36%"></span>
						<!-- /rate__progress -->
                        </span>
					<!-- /rate -->

					<!-- products-list__comments -->
					<span class="products-list__comments">12</span>
					<!-- /products-list__comments -->
				</div>
				<!-- /products-list__info -->

			</a>
			<!-- /products-list__item -->

			<!-- products-list__item -->
			<a href="#" class="products-list__item">

				<!-- products-list__pic -->
				<span class="products-list__pic"><img src="pic/pic3.jpg" alt=""></span>
				<!-- /products-list__pic -->

				<!-- products-list__info -->
				<div class="products-list__info">
					<strong>Nutella Filled Pound Cake</strong>

					<!-- rate -->
					<span class="rate">
                            <!-- rate__progress -->
                            <span class="rate__progress" style="width: 36%"></span>
						<!-- /rate__progress -->
                        </span>
					<!-- /rate -->

					<!-- products-list__comments -->
					<span class="products-list__comments">12</span>
					<!-- /products-list__comments -->
				</div>
				<!-- /products-list__info -->

			</a>
			<!-- /products-list__item -->

		</div>
		<!-- /products-list__wrap -->

	</div>
	<!-- /products-list -->

	<!-- tips -->
	<div class="tips">

		<!-- tips__content -->
		<div class="tips__content">

			<!-- tips__title -->
			<strong class="tips__title">
				<span>More Inspiration?</span>
				Check Our Tips & How To’s
			</strong>
			<!-- /tips__title -->

			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed dolor sit amet, Lorem ipsum dolor sit
				amet, consectetur adipiscing elit,.</p>

			<a href="#" class="btn btn_4">View Tips & How-To’s</a>
		</div>
		<!-- /tips__content -->

		<!-- tips__pic -->
		<span class="tips__pic" style="background-image: url(pic/tips-pic1.jpg)"></span>
		<!-- /tips__pic -->

	</div>
	<!-- /tips -->
<?php
get_footer();