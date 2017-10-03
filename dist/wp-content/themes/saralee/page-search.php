<?php
/*
Template Name: Search
*/
get_header();

$post_id = get_the_ID();

$products = '';
$recipes = '';
if($_POST['search'] && $_POST['search'] !== '') {
	$products = get_posts(array(
		'posts_per_page' => -1,
		'post_type' => 'products',
		'post_status' => 'publish',
		'orderby' => 'menu_order',
		'fields' => 'ids',
		's' => $_POST['search']
	));
	$recipes = get_posts(array(
		'posts_per_page' => -1,
		'post_type' => 'recipes',
		'post_status' => 'publish',
		'orderby' => 'menu_order',
		'fields' => 'ids',
		's' => $_POST['search']
	));
} else {
	$products = get_posts(array(
		'posts_per_page' => 5,
		'post_type' => 'products',
		'post_status' => 'publish',
		'orderby' => 'menu_order',
		'fields' => 'ids',
	));
	$recipes = get_posts(array(
		'posts_per_page' => 5,
		'post_type' => 'recipes',
		'post_status' => 'publish',
		'orderby' => 'menu_order',
		'fields' => 'ids',
	));
}
?>

<!-- search-info -->
<div class="search-info">

    <?php if (isset($_POST['search']) && $_POST['search'] !== '') {?>
    <!-- main-title -->
    <h2 class="main-title">
        <span>Results for: “<?= $_POST['search']; ?>”</span>
    </h2>
    <!-- main-title -->
    <?php } ?>

    <!-- tab -->
    <div class="tab">

        <!-- search-info__form -->
        <form action="<?= get_permalink($post_id); ?>" class="search-info__form" method="post">
            <input type="search" placeholder="New Search" name="search" value="<?php if (isset($_POST['search'])) {echo $_POST['search'];} ?>">
            <button type="submit">
                <svg  viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve">
                            <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23
                                s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92
                                c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17
                                s-17-7.626-17-17S14.61,6,23.984,6z"/>
                        </svg>
            </button>
        </form>
        <!-- /search-info__form -->

        <!-- tab__controls -->
        <div class="tab__controls">
            <!-- tab__controls-item -->
            <div class="tab__controls-item active">Products</div>
            <!-- /tab__controls-item -->
            <!-- tab__controls-item -->
            <div class="tab__controls-item">Recipes</div>
            <!-- /tab__controls-item -->
        </div>
        <!-- /tab__controls -->
        <!-- tab__content -->
        <div class="tab__content">
            <!-- tab__content-item -->
            <div class="tab__content-item">

                <?php if(!empty($products)) { foreach ($products as $row) {?>
                <div class="search-info__item">
                    <div class="search-info__item-pic"><?= get_the_post_thumbnail($row); ?></div>
                    <div class="search-info__item-description">
                        <h2><?= get_the_title($row); ?></h2>
                        <p><?= get_the_excerpt($row); ?></p>
                    </div>
                </div>
                 <?php } } ?>

            </div>
            <!-- /tab__content-item -->
            <!-- tab__content-item -->
            <div class="tab__content-item">

	            <?php if(!empty($recipes)) { foreach ($recipes as $row) {?>
                  <div class="search-info__item">
                      <div class="search-info__item-pic"><?= get_the_post_thumbnail($row); ?></div>
                      <div class="search-info__item-description">
                          <h2><?= get_the_title($row); ?></h2>
                          <p><?= get_the_excerpt($row); ?></p>
                      </div>
                  </div>
	            <?php } } ?>

            </div>
            <!-- /tab__content-item -->
        </div>
        <!-- /tab__content -->
    </div>
    <!-- /tab -->

</div>
<!-- /search-info -->

<?php
get_footer();