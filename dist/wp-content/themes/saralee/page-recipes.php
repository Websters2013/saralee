<?php
/*
Template Name: Recipes
*/
get_header();

if($_POST['search'] && $_POST['search'] !== '') {

} elseif($_POST['product'] || $_POST['ingredient']) {


} else {
	$popular_recipes = get_field('popular_recipes', $post_id);
	$popular_recipes_string = '';
	if(acf_is_array($popular_recipes)) {
	    foreach ($popular_recipes as $row) {
	        $popular_recipes_string .= '<a href="'.get_permalink($row).'" class="products-list__item">
				<span class="products-list__pic">'.get_the_post_thumbnail($row).'</span>
				<div class="products-list__info">
					<strong>'.get_the_title($row).'</strong>
					<span class="rate">
                            <span class="rate__progress" style="width: 36%"></span>
                        </span>
					<span class="products-list__comments">'.get_comments_number($row).'</span>
				</div>
			</a>';
        }
    }
}





$post_id = get_the_ID();
$title = get_field('title', $post_id);
if($title) {
	$title = '<strong class="products-list__title">'.$title.'</strong>';
}
$find_title = get_field('find_title', $post_id);
if($find_title) {
	$find_title = '<strong class="filter__title"><span>'.$find_title.'</span></strong>';
}

$tips_title = get_field('tips_title', $post_id);
if($tips_title) {
	$tips_title = '<strong class="tips__title">'.$tips_title.'</strong>';
}

$tips_link = get_field('tips_link', $post_id);
if(!empty($tips_link)) {
	$tips_link = '<a href="'.$tips_link['url'].'" class="btn btn_4" target="'.$tips_link['target'].'">'.$tips_link['title'].'</a>';
}

$tips_image = get_field('tips_image', $post_id);
?>
	<!-- filter -->
	<div class="filter">

		<?= $find_title; ?>

		<!-- filter__wrap -->
		<form action="<?= get_permalink(13); ?>" class="filter__wrap" method="post">

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
			<input type="search" placeholder="<?= get_field('find_placeholder', $post_id); ?>" name="search" value="<?php if (isset($_POST['search'])) {echo $_POST['search'];} ?>">
			<button type="submit" class="btn btn_5"><?= get_field('find_title_button', $post_id); ?></button>
		</form>
		<!-- /filter__wrap -->

	</div>
	<!-- /filter -->

	<!-- products-list -->
	<div class="products-list">

      <?php if($popular_recipes_string) {?>

        <?= $title; ?>

		<div class="products-list__wrap">
            <?= $popular_recipes_string; ?>
		</div>

      <?php } ?>

	</div>
	<!-- /products-list -->

    <?php if($tips_title && $tips_image) { ?>
	<!-- tips -->
	<div class="tips">

		<!-- tips__content -->
		<div class="tips__content">

			<?= $tips_title.get_field('tips_content', $post_id).$tips_link; ?>

		</div>
		<!-- /tips__content -->

		<!-- tips__pic -->
		<span class="tips__pic" style="background-image: url(<?= $tips_image['url']; ?>"></span>
		<!-- /tips__pic -->

	</div>
	<!-- /tips -->
<?php
}

get_footer();