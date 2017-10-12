<?php
get_header();
$term_id = get_queried_object()->term_id;
?>
<!-- product-category -->
<div class="product-category">
<?php
	        $term = get_term($term_id);
	        $terms = get_term_children( $term_id, 'products_cat');

            if ( empty( $terms ) && !is_wp_error( $terms ) ){

	            $pages = get_posts(array(
		            'posts_per_page' => -1,
		            'post_type' => 'products',
		            'post_status' => 'publish',
		            'orderby' => 'menu_order',
		            'fields' => 'ids',
		            'tax_query' => array(
			            array(
				            'taxonomy' => 'products_cat',
				            'field' => 'id',
				            'terms' => $term_id,
			            )
		            )
	            ));

	            $post_string = '';
	            $slider_string = '';
	            if(!empty($pages)) {
                    $post_string = '<!-- product-category__links --><div class="product-category__links">';
			        $slider_string = '<!-- products__swiper --><div class="products__swiper swiper-container"><!-- swiper-wrapper --><div class="swiper-wrapper">';
                    foreach ($pages as $rows) {
	                    $post_string .= '<a href="'.get_permalink($rows).'">'.get_the_title($rows).'</a>';
	                    $slider_string .= '<a href="'.get_permalink($rows).'" class="products__item swiper-slide"><div class="products__img">
                                                '.get_the_post_thumbnail($rows).'</div><p>'.get_the_title($rows).'</p></a>';
                    }
			        $post_string .= '</div><!-- /product-category__links -->';
                    $slider_string .= '</div><!-- /swiper-wrapper --></div><!-- /products__swiper -->';
                }
                if($post_string && $slider_string) {
                ?>
                <!-- product-category__item -->
                <div class="product-category__item">

                    <!-- product-category__list -->
                    <div class="product-category__list">

                        <!-- product-category__title -->
                        <strong class="product-category__title"><?= $term->name; ?></strong>
                        <!-- /product-category__title -->

                        <?= $post_string; ?>

                    </div>
                    <!-- /product-category__list -->

                    <!-- product-category__slider -->
                    <div class="product-category__slider">

                        <!-- products -->
                        <div class="products products_single">

                            <div class="products__content">
                                <a href="#" class="products__prev">
                                    <svg viewBox="146 23 12 6">
                                        <path d="M7,10l6,6,6-6Z" transform="translate(139 13)"/>
                                    </svg>
                                </a>

                                <?= $slider_string; ?>

                                <a href="#" class="products__next">
                                    <svg viewBox="146 23 12 6">
                                        <path d="M7,10l6,6,6-6Z" transform="translate(139 13)"/>
                                    </svg>
                                </a>
                            </div>

                        </div>
                        <!-- /products -->

                    </div>
                    <!-- /product-category__slider -->

                </div>
                <!-- /product-category__item -->
            <?php } } else {
	            $term_string = '';
	            $slider_string_2 = '';
                foreach ($terms as $rows) {
	                $pages = get_posts(array(
		                'posts_per_page' => -1,
		                'post_type' => 'products',
		                'post_status' => 'publish',
		                'orderby' => 'menu_order',
		                'fields' => 'ids',
		                'tax_query' => array(
			                array(
				                'taxonomy' => 'products_cat',
				                'field' => 'id',
				                'terms' => $rows,
			                )
		                )
	                ));
	                $post_string = '';
	                if(!empty($pages)) {
                        foreach ($pages as $post) {
	                        $post_string .= '<a href="'.get_permalink($post).'">'.get_the_title($post).'</a>';
	                        $slider_string_2 .= '<a href="'.get_permalink($post).'" class="products__item swiper-slide">
                                            <div class="products__img">'.get_the_post_thumbnail($post).'</div>
                                            <p>'.get_the_title($post).'</p>
                                        </a>';
                        }
	                } else {
	                    continue;
                    }

	                $sub_term = get_term_by('id', $rows, 'products_cat');

	                $term_string .= '<!-- dropdown__item -->
                            <div class="dropdown__item">

                                <!-- dropdown__title -->
                                <div class="dropdown__title">'.$sub_term->name.'</div>
                                <!-- /dropdown__title -->

                                <!-- dropdown__content -->
                                <div class="dropdown__content">
                                    <!-- product-category__links -->
                                    <div class="product-category__links">
                                        '.$post_string.'
                                    </div>
                                    <!-- /product-category__links -->
                                </div>
                                <!-- /dropdown__content -->

                            </div>
                            <!-- /dropdown__item -->';
                }
                 if($term_string) {
                ?>

                <!-- product-category__item -->
                <div class="product-category__item">

                    <!-- product-category__list -->
                    <div class="product-category__list">

                        <!-- product-category__title -->
                        <strong class="product-category__title"><?= $term->name; ?></strong>
                        <!-- /product-category__title -->

                        <!-- dropdown -->
                        <div class="dropdown">
                            <?= $term_string; ?>
                        </div>
                        <!-- /dropdown -->

                    </div>
                    <!-- /product-category__list -->

                    <!-- product-category__slider -->
                    <div class="product-category__slider">

                        <!-- products -->
                        <div class="products products_single">

                            <div class="products__content">
                                <a href="#" class="products__prev">
                                    <svg viewBox="146 23 12 6"><path d="M7,10l6,6,6-6Z" transform="translate(139 13)"/></svg>
                                </a>

                                <!-- products__swiper -->
                                <div class="products__swiper swiper-container">

                                    <!-- swiper-wrapper -->
                                    <div class="swiper-wrapper">

                                        <?= $slider_string_2; ?>

                                    </div>
                                    <!-- /swiper-wrapper -->

                                </div>
                                <!-- /products__swiper -->

                                <a href="#" class="products__next">
                                    <svg viewBox="146 23 12 6"><path d="M7,10l6,6,6-6Z" transform="translate(139 13)"/></svg>
                                </a>
                            </div>

                        </div>
                        <!-- /products -->

                    </div>
                    <!-- /product-category__slider -->

                </div>
                <!-- /product-category__item -->

            <?php } }  ?>
</div>
<!-- /product-category -->
<?php
get_footer();