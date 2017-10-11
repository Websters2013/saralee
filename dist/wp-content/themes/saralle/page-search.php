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
		'post_type' => 'recipe',
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
		'post_type' => 'recipe',
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
            <div class="tab__controls-item active">
                <span class="tab__controls-icon pie">
                            <svg viewBox="0 0 678.5 545" style="enable-background:new 0 0 678.5 545;" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M125.7,545c-1-1.5-1.9-3.2-3.1-4.6c-3-3.4-6.6-6.4-9-10.1c-4.4-6.9-8.2-14.3-12.2-21.5c-5.5-9.8-10.9-19.6-16.4-29.3
                                        c-1.9-3.4-4-6.8-6.2-10.1c-5.7-8.3-4.6-13.5,4.9-15.7c10.8-2.6,20.1-7.6,29.4-13.2c1.5-0.9,4.8-0.8,6.1,0.3
                                        c9.8,7.8,21.3,12.2,32.9,15.6c14.6,4.3,29.4,4.1,44.2-1.4c9.9-3.7,19.2-8.2,27.8-14.3c1.3-0.9,3.9-0.4,5.8-0.1
                                        c1.3,0.2,2.3,1.4,3.5,2.2c18.9,12.6,39.4,19.3,62.1,15.3c12.8-2.3,25-7.4,35.8-15c4.4-3.1,8.2-2.9,12.7,0.1
                                        c18.5,12.3,38.8,18.9,61.1,15c13.8-2.4,26.7-7.9,38.1-16.2c3.7-2.7,6.4-2.4,10.1,0.2c19.5,14,41.3,20.5,64.9,15.6
                                        c12.5-2.6,24.9-7.2,35.1-15.5c3.8-3.1,6.5-2.4,10.6-0.2c7.1,3.9,13.4,9.7,22.3,10.4c3.7,0.3,5.1,3.2,4.2,6.9
                                        c-0.4,1.5-0.9,3-1.6,4.4c-8.7,18.7-17.5,37.4-26.2,56.1c-2.1,4.5-3.4,9.4-5.8,13.8c-1.4,2.6-4.1,4.6-6,7c-1.1,1.4-1.7,3-2.5,4.6
                                        c-1.4,0-2.8,0-4.1,0c0.2-2.9-1.4-4-4.1-3.9c-1.9,0.1-3.8,0-5.7,0c-131.8,0-263.6,0-395.4,0c-2.1,0-4.1,0.1-6.2,0
                                        c-2.7-0.1-4.3,1.1-4.2,3.9C127.7,545,126.7,545,125.7,545z"/>
                                    <path d="M678.5,378.9c-0.6,3.5-0.1,6.9-4.3,8.8c-1.7,0.8-2.4,3.7-3.5,5.6c-6.3,10.7-16,16.9-27.5,20.3c-13.3,4-26.5,4.4-40.3,1.3
                                        c-13.4-3-23.4-10.4-32.6-19.5c-2.5-2.4-4.5-5.2-6.9-7.7c-3.3-3.4-7.1-3.6-10.6-0.5c-2.5,2.1-4.6,4.7-6.7,7.2
                                        c-9.6,11.4-20.7,20.3-36.2,21.9c-15.4,1.6-29.2-2-40.4-12.9c-4.7-4.5-8.6-9.8-13-14.8c-5.6-6.4-12.3-5.6-18,0.9
                                        c-6.7,7.6-13.4,15.5-21.6,21.2c-8.4,5.8-19.1,6.8-29.4,5.7c-13.5-1.3-24.5-7.6-33.3-17.9c-2.8-3.3-5.7-6.5-8.4-9.8
                                        c-5-6.2-11.2-5.9-16.5,0.1c-6,6.8-12.3,13.6-19.2,19.4c-10,8.4-22.2,9.1-34.7,7.9c-17.3-1.7-27.9-13.2-37.9-25.5
                                        c-6.7-8.4-12.2-8.4-19.3-0.6c-6.2,6.8-12.7,13.6-20,19.3c-8.5,6.7-19,8.1-29.4,7.5c-17.8-1.1-30.8-10.7-41-24.7
                                        c-1.3-1.8-2.7-3.6-4.4-5.1c-4.4-3.9-9.2-3.6-13.2,0.8c-2.2,2.4-4.2,5.1-6.4,7.5c-8.7,9.4-18.6,16.1-31.4,19.6
                                        c-14.8,4-28.7,1.8-42.9-1.5c-13.1-3-27.5-19.1-29.1-32.1c-1.9-15.2,10.5-27.4,25.7-25.1c3.2,0.5,6.4,1.5,9.5,2.5
                                        c8,2.3,10.6,1.5,15.3-5.4c3.5-5.1,6.7-10.4,9.9-15.7c8.9-14.8,21.1-26.9,33.6-38.4c13.1-12,26.6-23.6,41.1-33.8
                                        c12.9-9.1,27-16.6,41-23.8c13.9-7.2,28.3-13.6,42.8-19.5c9.8-4,20.2-6.6,30.4-9.8c0.2-0.1,0.4,0,0.5-0.1
                                        c12.6-5.6,26.2-6.9,39.5-9.4c9.5-1.8,19-4.1,28.5-4.2c18.6-0.3,37.3,0.3,55.8,1.6c11.3,0.8,22.5,3.2,33.5,6.1
                                        c11.9,3.1,23.5,7.4,35.2,11.4c8,2.7,16.1,5.2,23.7,8.6c14.9,6.6,29.9,13.3,44.2,21c13.6,7.3,27.3,15,39.4,24.5
                                        c16.3,12.9,31.4,27.4,46.4,41.9c7,6.8,12.7,15,18.5,22.8c3.7,4.9,6.8,10.3,10,15.7c4.2,7.2,7.7,8.9,15.8,6.3
                                        c6.4-2,12.6-3.4,19.3-1.7c4.6,1.2,8,3.5,10.3,7.9c1.5,2.9,4.4,5.1,6.1,8C677.6,374.2,677.8,376.7,678.5,378.9z M359.8,281.9
                                        c0.4-7.9-0.3-15.2-5.3-21.4c-1-1.3-1-3.3-1.9-4.8c-3.4-5.7-6.5-11.7-10.7-16.8c-3.7-4.6-9.1-5-11.6-1.3
                                        c-5.4,7.8-11.5,15.4-14.7,24.1c-3.9,10.6-5.1,22.1-1.6,33.5c2.7,8.9,8.9,14.2,16.7,17.9c4.6,2.1,9.5,1.3,13.7-1.9
                                        C354.2,303.7,361.5,294.9,359.8,281.9z M448,272.9c0.5-5.6-3.3-11.1-7.6-16.4c-6.3-7.8-14.2-13.4-23.4-17.2
                                        c-3.5-1.5-7.2-2.3-10.6-4c-5.3-2.6-10.8-3.6-15.6,0.2c-4.7,3.7-3.8,9.4-2.6,14.4c1,3.8,3.5,7.2,4.3,11c2.7,11.9,9.9,20.8,19,28.1
                                        c7,5.7,15,8.5,24,4.1C443.5,289.5,448,283.6,448,272.9z M219.1,275.6c0.6,2,0.9,5.5,2.6,8.1c7.7,12.4,21.1,15.6,34.6,5.2
                                        c12.7-9.8,17.5-23.9,22.7-37.9c0.6-1.7,0.8-3.7,0.9-5.6c0.3-10.1-6.4-15.4-15.5-11.2c-9,4.1-19.1,5.6-26.9,12.5
                                        C228.8,254.3,220.3,261.8,219.1,275.6z"/>
                                    <path d="M312.3,110.9c0-16.5,6.2-27.9,18-36.6c7.3-5.4,15.1-10.6,17.8-20.1c0.8-2.6,1.9-5.5,1.4-8c-2.4-11.9-6-23.3-15.5-31.9
                                        c-2.2-2-4.5-3.9-6.2-6.2c-1-1.4-1.6-4.2-0.8-5.5c0.8-1.4,3.4-2.7,5-2.6c2.6,0.2,5.6,1.1,7.6,2.7C354.8,15,364.6,40,358.9,59.5
                                        c-2.5,8.7-8.9,14.2-15.5,19.5c-7,5.6-14.3,11-17.8,19.7c-1.4,3.5-3.2,7.3-2.8,10.8c1.2,13,5.9,24.4,18,31.3
                                        c2.5,1.4,5.3,2.8,7.2,4.9c1.5,1.6,2.9,5,2.1,6.4c-0.9,1.6-4.4,2.8-6.4,2.5c-8.3-1.4-15-5.9-20.5-12.2
                                        C315.1,132.8,312.9,121.2,312.3,110.9z"/>
                                    <path d="M236.3,119.4c-2-14.8,8.6-22.7,19.1-30.4c9.9-7.2,13.3-15.2,8.9-24.7c-2.3-4.9-6.2-9-9.5-13.3c-1.4-1.7-3.8-2.9-4.6-4.7
                                        c-1-2.2-2.1-6.3-1.1-7.2c1.7-1.5,6-2.6,7.6-1.5c4.8,3.2,9.5,7,12.8,11.6c5,7,7.9,14.9,8.2,24c0.3,8.7-2.9,15-8.9,20.5
                                        c-3.6,3.2-7.5,6.1-11.3,9c-13.6,9.9-13,29.4,1.3,38.2c2.3,1.4,4.7,2.9,7.2,4.2c2.9,1.5,4.9,3.6,3.6,7c-1.4,3.5-4.5,3.3-7.5,2.7
                                        c-13.8-2.8-25-15.7-25.7-29.8C236.2,123.2,236.3,121.7,236.3,119.4z"/>
                                    <path d="M391.1,115.7c0.2-5.2,3.9-13,11.1-19.2c3.7-3.1,7.7-5.8,11.3-9.1c8-7.2,10.5-14.1,6.2-22.8c-3.1-6.2-6.3-11.8-11.6-16.2
                                        c-1.3-1.1-2.9-2.3-3.4-3.8c-0.6-1.9-0.8-4.6,0.1-6.2c0.7-1.2,3.6-1.8,5.3-1.6c2.1,0.3,4.3,1.3,6,2.7c10.5,8.7,16.3,20,16.8,33.7
                                        c0.3,8.1-2.5,15-9,20.5c-6.3,5.3-12.4,10.9-17.8,16.9c-4.9,5.5-4.1,11.8-1.2,18.4c3.3,7.5,9.8,11.2,15.9,15.6c2.3,1.7,6.4,3,4.3,7
                                        c-2,3.8-5.8,3.4-9.6,2.4C400.7,150.3,391.1,134.2,391.1,115.7z"/>
                                </g>
                            </g>
                        </svg>
                        </span>
                Products
            </div>
            <!-- /tab__controls-item -->
            <!-- tab__controls-item -->
            <div class="tab__controls-item">
                <span class="tab__controls-icon">
                            <svg viewBox="0 0 678.5 545" style="enable-background:new 0 0 678.5 545;" xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M16,98.4c1.4-1,3.6-1.8,4-3.1c2.2-7.9,3.3-16.1,5.9-23.9c2.6-7.5,5.6-15.2,10.1-21.7c5.6-8.1,12.3-15.7,19.6-22.3
                                            c4.8-4.5,11.5-7,17.3-10.3c2-1.1,4-2.2,6-3.2c2.2-1.1,4.3-2.5,6.6-3.1c7.6-2,16-2.3,22.8-5.7c11.7-6,23.7-3.8,35.6-3.8
                                            C257.3,1.1,370.6,1.2,484,1c7,0,11.5,5.1,17.8,6c5.2,0.7,10.2,2.2,15.3,3.3c1.4,0.3,2.9,0.2,4.1,0.8c14.5,8,29.2,15.7,38.4,30.5
                                            c3.8,6,7.6,12,11.4,18c0.4,0.6,0.8,1.2,0.9,1.9c2.5,13.2,6.9,26.3,7,39.5c0.6,93.4,0.3,186.8,0.3,280.2c0,4,0.3,8.1,0.3,12.1
                                            c0,3.9-2,5.8-5.9,5.8c-6.7,0-13.3,0-20,0.1c-3.6,0-5.6-1.8-5.7-5.4c-0.1-4,0-8.1,0-12.1c0-97.1-0.1-194.1,0.2-291.2
                                            c0-11.5-6.3-19.9-11.6-28.6c-5.6-9.3-14.5-15.2-24.3-20.7c-9.5-5.3-18.8-5.8-28.7-5.8c-114.6-0.1-229.2-0.1-343.8-0.1
                                            c-2.3,0-4.8-0.4-6.8,0.4c-2.7,1.1-6.7,2.7-7.1,4.8c-0.6,2.5,1.5,6,3.3,8.5c1.3,1.8,3.8,3.1,6.1,3.9c12.2,4.2,15.4,14.9,17.9,25.6
                                            c1,4.3,0.3,9.1,0.3,13.6c0,110.7,0,221.5,0,332.2c0,4.7,0.2,9.5-0.2,14.2c-1.8,18.4,5.2,33.8,17,46.7c7.5,8.2,16.8,14.5,27.4,19.6
                                            c12.9,6.1,25.7,6.3,38.9,5.6c4.7-0.2,9.2-2.6,13.8-4.1c1.3-0.4,2.4-1.5,3.8-1.8c17.1-4.2,27.4-16.7,37.8-29.6
                                            c6-7.4,7.1-16.6,11.3-24.5c1.9-3.5,1.4-8.5,1.4-12.8c0-6,1.3-7.7,7.1-7.7c112.3,0,224.6,0,336.9,0.1c8.7,0,16.5,8.1,14.4,15.1
                                            c-1.3,4.2-3.9,8-5.2,12.2c-1.7,5.5-2.5,11.2-3.8,16.8c-0.5,2-0.6,4.3-1.6,6c-6,10.8-10.9,22.4-20.1,31.1
                                            c-7.9,7.3-16.7,13.2-26.2,18.6c-11.3,6.4-24.4,5.2-35.2,11.3c-10.4,5.9-21.2,3.9-31.9,3.9c-102.8,0.2-205.7,0-308.5,0.3
                                            c-8,0-13.6-5.5-21-6.3c-5.4-0.6-10.7-1.8-15.9-3.2c-3.3-0.8-6.5-2.3-9.6-3.6c-1.6-0.7-2.9-2-4.5-2.6c-15.9-6.5-29-16.3-38.2-31
                                            c-3.3-5.3-6.7-10.6-10.1-15.9c-0.4-0.6-0.9-1.2-1-1.8c-1.9-13.3-8.9-25.2-8.9-39.2c0.3-99.2,0.1-198.3,0.2-297.5
                                            c0-5.6,0.2-11.2-0.1-16.8c-0.5-8.5-2.9-10.8-11.5-10.8c-24.7-0.1-49.4,0-74.1,0c-6.3,0-12.8,0.9-16.5-6.3c-0.4-0.7-2.2-0.7-3.4-1
                                            C16,105.4,16,101.9,16,98.4z"/>
                                        <path d="M431.3,358.9c-20,0-39.9,0-59.9,0c-6.6,0-7.5-1.1-7.3-7.7c0.1-5.9,0.1-11.9-0.1-17.8c-0.1-4.2,1.5-6.1,5.8-6.1
                                            c40.8,0.1,81.6,0,122.3,0.1c5.4,0,6.4,1.5,6.4,7.2c0,6.1,0.1,12.2,0.4,18.3c0.3,4.8-2,6.1-6.3,6.1
                                            C472.3,358.8,451.8,358.9,431.3,358.9C431.3,358.9,431.3,358.9,431.3,358.9z"/>
                                        <path d="M431.8,127.8c19.9,0,39.9,0,59.8,0c7.1,0,7.8,1.2,7.2,8.1c-0.4,4.2-0.2,8.4-0.2,12.6c0,7.7-1.8,9.8-9.5,9.8
                                            c-23.6,0-47.2-0.1-70.9,0c-15.7,0-31.5,0.1-47.2,0.3c-4.1,0.1-6.4-1.6-6.5-5.7c-0.2-6.6-0.3-13.3-0.3-19.9c0-4.6,2.9-5.2,6.7-5.2
                                            C391.2,127.8,411.5,127.7,431.8,127.8C431.8,127.7,431.8,127.8,431.8,127.8z"/>
                                        <path d="M430.6,257c-19.6,0-39.2,0-58.8,0c-6.4,0-7.6-1.3-7.6-7.7c0-5.3,0-10.5,0.2-15.8c0.3-5.8,1.9-6.8,7.5-6.8
                                            c37.3,0.2,74.6,0.2,111.9,0.3c0.7,0,1.4-0.1,2.1-0.1c11.5-0.2,13.2,1.6,12.5,13c-0.2,2.8,0,5.6,0.2,8.4c0.6,7-0.4,8.5-7.6,8.5
                                            c-15.2,0.2-30.5,0.1-45.7,0.1C440.4,256.9,435.5,256.9,430.6,257C430.6,257,430.6,257,430.6,257z"/>
                                        <path d="M249,177.1c-3.4-2.2-6.7-3.4-8.7-5.8c-6.1-7-11.5-14.5-17.5-21.6c-5.4-6.4-11-12.6-16.9-18.6c-3.2-3.2-3.4-5.7,0-8.8
                                            c2-1.9,3.7-4.2,5.6-6.2c2.6-2.8,5.4-3,8.3-0.3c5.8,5.3,11.7,10.5,17.3,15.9c8.3,7.9,16.1,7.2,23.1-1.7
                                            c10.4-13.1,21.1-26,31.8-38.9c4.2-5.1,6.1-5.1,11.8-1.3c0.6,0.4,1.3,0.6,1.8,1.1c2.7,2.2,6,4.1,7.8,6.9c2.8,4.4-2.7,5.7-4.5,8.2
                                            c-7.6,10.4-15.5,20.7-23.4,30.9c-9.1,11.6-18.3,23.2-27.8,34.6C255.7,173.9,252.2,175.1,249,177.1z"/>
                                        <path d="M215.7,215.7c1.7,0.9,3.6,1.4,5,2.6c6.4,5.4,12.8,10.9,19.1,16.4c5.9,5.2,12.4,5.2,17.5-0.6c6.2-7.1,11.9-14.6,17.9-21.9
                                            c6.2-7.5,12.5-14.9,18.9-22.3c2.4-2.8,5.3-2.9,8.3-0.5c2.7,2.2,5.6,4.1,8.4,6.1c3.8,2.7,4.1,5.1,1.3,8.7
                                            c-9,11.5-17.9,23.1-26.9,34.5c-4.8,6-9.9,11.8-14.7,17.7c-4.5,5.6-8.8,11.3-13.1,17c-4.1,5.5-9.2,6.4-13.6,1.4
                                            c-11.6-12.8-22.7-26-34-39c-0.3-0.4-0.6-0.9-0.9-1.3c-6.4-9.1-6.4-9.1,1.9-16.7C211.9,216.9,213.7,216.5,215.7,215.7z"/>
                                        <path d="M215.1,316.9c3.5,1.6,5.9,2.3,7.7,3.8c6.3,5.2,12.4,10.7,18.6,16.2c5.2,4.7,9.3,5.1,14-0.2c9.4-10.5,18.3-21.4,27.4-32.3
                                            c3.1-3.7,5.9-7.8,9.1-11.5c3.4-4,8.3-4.2,12.7-1c2.5,1.9,5.1,3.7,7.6,5.4c2.8,1.9,2.9,4.2,0.9,6.6c-8,9.7-16.2,19.2-24,29
                                            c-6,7.5-11.4,15.5-17.3,23c-5.6,7.1-11.4,14-17.4,20.9c-3.7,4.3-5.9,4.5-9.9,0.1c-9.5-10.4-18.7-21.2-27.9-31.9
                                            c-3.5-4.1-6.5-8.7-10.2-12.6c-2.8-3-2.7-5.3,0.2-7.9C209.5,322,212.3,319.4,215.1,316.9z"/>
                                    </g>
                                </g>
                            </svg>
                        </span>
                Recipes
            </div>
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