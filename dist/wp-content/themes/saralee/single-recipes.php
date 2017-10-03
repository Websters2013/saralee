<?php
get_header();

$post_id = get_the_ID();

$ingredients = get_field('ingredients', $post_id);

$like_product = get_field('like_product', $post_id);
$like_product_string = '';
if(acf_is_array($like_product)) {
    foreach ($like_product as $row) {
	    $like_product_string .= '<a href="'.get_permalink($row).'" class="products__item swiper-slide">
                        <div class="products__img">'.get_the_post_thumbnail($row).'</div>
                        <p>'.get_the_title($row).'</p>
                    </a>';
    }
} else {
	$like_product_string = '<a href="'.get_permalink($like_product).'" class="products__item swiper-slide">
                        <div class="products__img">'.get_the_post_thumbnail($like_product).'</div>
                        <p>'.get_the_title($like_product).'</p>
                    </a>';
}
?>

    <!-- recipe -->
    <div class="recipe">

        <!-- main-title -->
        <h2 class="main-title single"><span><?= get_the_title($post_id); ?></span></h2>
        <!-- main-title -->

        <!-- recipe__pic -->
        <div class="recipe__pic"><?= get_the_post_thumbnail($post); ?></div>
        <!-- /recipe__pic -->

        <!-- recipe__indicators -->
        <div class="recipe__indicators">

            <!-- recipe__indicators-item -->
            <div class="recipe__indicators-item">
                <!-- recipe__indicators-title -->
                <strong class="recipe__indicators-title">
                    <svg x="0px" y="0px" viewBox="0 0 27.5 27.5" style="enable-background:new 0 0 27.5 27.5;" xml:space="preserve">
                            <path style="fill:#1D1D1B" d="M17.7,16.7l-2-2c0,0-0.1,0-0.1-0.1c0.1-0.3,0.2-0.5,0.2-0.8c0-0.9-0.5-1.6-1.3-1.9c0,0,0-0.1,0-0.1V4.4
                                c0-0.4-0.3-0.7-0.7-0.7C13.4,3.7,13,4,13,4.4v7.4c0,0,0,0.1,0,0.1c-0.8,0.3-1.3,1-1.3,1.9c0,1.1,0.9,2,2,2c0.3,0,0.6-0.1,0.8-0.2
                                c0,0,0,0.1,0.1,0.1l2,2c0.3,0.3,0.7,0.3,1,0S17.9,17,17.7,16.7z M12.5,13.8c0-0.7,0.6-1.2,1.2-1.2s1.2,0.6,1.2,1.2S14.4,15,13.8,15
                                S12.5,14.4,12.5,13.8z"/>
                        <g>
                            <path style="fill:#1D1D1B" d="M13.8,27.5C6.2,27.5,0,21.3,0,13.8S6.2,0,13.8,0s13.8,6.2,13.8,13.8S21.3,27.5,13.8,27.5z M13.8,2
                                    C7.3,2,2,7.3,2,13.8s5.3,11.8,11.8,11.8s11.8-5.3,11.8-11.8S20.2,2,13.8,2z"/>
                        </g>
                        <g>
                            <circle style="fill:#1D1D1B" cx="7.2" cy="7.2" r="0.8"/>
                        </g>
                        <g>
                            <circle style="fill:#1D1D1B" cx="4.6" cy="13.8" r="0.8"/>
                        </g>
                        <g>
                            <circle style="fill:#1D1D1B" cx="22.8" cy="13.8" r="0.8"/>
                        </g>
                        <g>
                            <circle style="fill:#1D1D1B" cx="20.2" cy="7.2" r="0.8"/>
                        </g>
                        <g>
                            <circle style="fill:#1D1D1B" cx="20.2" cy="20.3" r="0.8"/>
                        </g>
                        <g>
                            <circle style="fill:#1D1D1B" cx="7.2" cy="20.3" r="0.8"/>
                        </g>
                        <g>
                            <circle style="fill:#1D1D1B" cx="13.7" cy="22.9" r="0.8"/>
                        </g>
                        </svg>
                    Prep/Cook Time
                </strong>
                <!-- /recipe__indicators-title -->
                <ul>
                    <li>
                        <span><?= get_field('prep_time', $post_id); ?></span>
                        minutes prep
                    </li>
                    <li>
                        <span><?= get_field('cook_time', $post_id); ?></span>
                        minutes cook
                    </li>
                </ul>
            </div>
            <!-- /recipe__indicators-item -->

            <!-- recipe__indicators-item -->
            <div class="recipe__indicators-item">
                <!-- recipe__indicators-title -->
                <strong class="recipe__indicators-title">
                    <svg x="0px" y="0px" viewBox="0 0 27.5 27.5" style="enable-background:new 0 0 27.5 27.5;" xml:space="preserve">
                           <path style="fill:#1D1D1B" d="M26.9,15l-0.3-0.3c-0.8-0.6-1.7-1.2-2.7-1.7c-0.8-0.4-1.7-0.7-2.6-1c2-1.5,3.1-4,2.6-6.7
                                c-0.5-2.6-2.7-4.7-5.3-5.3c-4-0.8-7.6,2-8.1,5.7c-3.8,0-6.8,3-6.8,6.7c0,2.2,1.1,4.1,2.7,5.4c-0.9,0.2-1.8,0.6-2.6,1
                                c-1,0.5-1.8,1.1-2.7,1.7l-0.3,0.3C0.2,21.2,0,21.7,0,22.2v2v1.9c0,0.8,0.6,1.4,1.4,1.4h17.9c0.8,0,1.4-0.6,1.4-1.4v-1.9v-2
                                c0-0.2,0-0.4-0.1-0.6h5.4c0.8,0,1.4-0.6,1.4-1.4v-1.9v-2C27.5,15.8,27.3,15.4,26.9,15z M12.4,6.2C12.4,6.2,12.4,6.2,12.4,6.2
                                C12.7,3.8,14.7,2,17.1,2C19.8,2,22,4.1,22,6.8c0,2.6-2.2,4.8-4.8,4.8c0,0,0,0-0.1,0c0,0,0,0,0,0c0-0.1,0-0.2,0-0.3
                                c-0.5-2.6-2.7-4.7-5.3-5.3C11.5,6,12.1,6.1,12.4,6.2z M17.2,12.5C17.2,12.5,17.2,12.5,17.2,12.5C17.2,12.5,17.2,12.5,17.2,12.5z
                                 M5.5,12.6c0-2.6,2.2-4.8,4.8-4.8c2.7,0,4.8,2.2,4.8,4.8c0,2.6-2.2,4.8-4.8,4.8C7.7,17.4,5.5,15.3,5.5,12.6z M18.8,25.5H2v-2.9
                                c0-0.2,0.1-0.5,0.3-0.6c2.3-1.7,5.1-2.7,8.1-2.7c3,0,5.8,1,8.1,2.7c0.2,0.1,0.3,0.4,0.3,0.6V25.5z M20.4,21.2
                                C20.4,21.2,20.4,21.2,20.4,21.2C20.4,21.2,20.4,21.2,20.4,21.2z M25.5,19.7h-7.2h0c-0.4-0.3-0.8-0.5-1.3-0.7c-0.8-0.4-1.7-0.7-2.6-1
                                c1.4-1.1,2.4-2.7,2.6-4.5c0,0,0,0,0,0c3,0,5.8,1,8.1,2.7c0.2,0.1,0.3,0.4,0.3,0.6V19.7z"/>
                        </svg>
                    Servings
                </strong>
                <!-- /recipe__indicators-title -->
                <span><?= get_field('serving', $post_id); ?></span>
                people
            </div>
            <!-- /recipe__indicators-item -->

            <!-- recipe__indicators-item -->
            <div class="recipe__indicators-item">
                <!-- recipe__indicators-title -->
                <strong class="recipe__indicators-title">
                    <svg x="0px" y="0px" viewBox="0 0 27.5 27.5" style="enable-background:new 0 0 27.5 27.5;" xml:space="preserve">
                            <g>
                                <path d="M26.6,15.4c0.1,0.4,0.2,0.7,0.2,1.1c0,0.8-0.2,1.6-0.7,2.4c0,0.2,0.1,0.5,0.1,0.7c0,1.1-0.4,2.1-1.1,2.9v0.1
                                    c0,1.5-0.5,2.7-1.5,3.6c-1,0.9-2.4,1.3-4.1,1.3h-2c-1.3,0-2.4-0.1-3.6-0.4c-1.1-0.2-2.5-0.6-4-1.1c-1.4-0.4-2.2-0.7-2.5-0.7H2.3
                                    c-0.6,0-1.2-0.2-1.6-0.6C0.2,24.4,0,23.9,0,23.3V12.7c0-0.6,0.2-1.1,0.7-1.5c0.4-0.4,1-0.6,1.6-0.6h4.9C7.6,10.3,8.4,9.5,9.6,8
                                    c0.7-0.8,1.3-1.5,1.9-2.1c0.2-0.2,0.4-0.6,0.6-1.1c0.1-0.5,0.2-0.9,0.3-1.4c0.1-0.5,0.2-1,0.5-1.5c0.2-0.5,0.6-1,1-1.4
                                    c0.5-0.4,1-0.6,1.6-0.6c1,0,1.9,0.2,2.7,0.5C19,0.9,19.6,1.5,20,2.2C20.4,3,20.6,4,20.6,5.3c0,1-0.3,2.1-0.9,3.2h3.2
                                    c1.2,0,2.3,0.4,3.2,1.3c0.9,0.8,1.4,1.8,1.4,3C27.5,13.7,27.2,14.6,26.6,15.4z M4.2,21.5c-0.2-0.2-0.5-0.3-0.8-0.3
                                    c-0.3,0-0.6,0.1-0.8,0.3c-0.2,0.2-0.3,0.5-0.3,0.7c0,0.3,0.1,0.5,0.3,0.7c0.2,0.2,0.5,0.3,0.8,0.3c0.3,0,0.6-0.1,0.8-0.3
                                    c0.2-0.2,0.3-0.5,0.3-0.7C4.6,21.9,4.5,21.7,4.2,21.5z M24.5,11.2c-0.5-0.4-1-0.6-1.6-0.6h-6.3c0-0.6,0.3-1.5,0.9-2.6
                                    c0.6-1.1,0.9-2,0.9-2.7c0-1.1-0.2-1.9-0.6-2.4c-0.4-0.5-1.1-0.8-2.3-0.8c-0.3,0.3-0.5,0.8-0.7,1.4c-0.1,0.6-0.3,1.3-0.5,2.1
                                    c-0.2,0.7-0.6,1.3-1.1,1.8c-0.3,0.3-0.7,0.8-1.4,1.5c0,0.1-0.2,0.2-0.4,0.5c-0.2,0.3-0.4,0.5-0.6,0.7c-0.1,0.2-0.4,0.4-0.6,0.7
                                    c-0.3,0.3-0.5,0.5-0.7,0.7c-0.2,0.2-0.4,0.4-0.7,0.6c-0.2,0.2-0.5,0.3-0.7,0.4c-0.2,0.1-0.4,0.1-0.6,0.1H6.9v10.6h0.6
                                    c0.2,0,0.3,0,0.6,0c0.2,0,0.4,0.1,0.6,0.1c0.2,0,0.4,0.1,0.7,0.2c0.3,0.1,0.5,0.1,0.6,0.2c0.1,0,0.3,0.1,0.6,0.2
                                    c0.3,0.1,0.5,0.2,0.5,0.2c2.5,0.8,4.6,1.2,6.1,1.2h2.3c1,0,1.9-0.2,2.4-0.7c0.6-0.5,0.9-1.1,0.9-2.1c0-0.3,0-0.6-0.1-0.9
                                    c0.4-0.2,0.6-0.5,0.9-0.9c0.2-0.4,0.3-0.8,0.3-1.2c0-0.4-0.1-0.8-0.3-1.1c0.6-0.6,0.9-1.2,0.9-2c0-0.3-0.1-0.6-0.2-0.9
                                    c-0.1-0.3-0.3-0.6-0.4-0.8c0.4,0,0.7-0.3,1-0.8c0.3-0.5,0.4-1,0.4-1.3C25.2,12.1,25,11.6,24.5,11.2z"/>
                            </g>
                        </svg>
                    Rating
                </strong>
                <!-- /recipe__indicators-title -->
                <span>4.5/5</span>
                <!-- rate -->
                <div class="rate">
                    <!-- rate__progress -->
                    <span class="rate__progress" style="width: 68%"></span>
                    <!-- /rate__progress -->
                </div>
                <!-- /rate -->
            </div>
            <!-- /recipe__indicators-item -->

            <!-- recipe__indicators-item -->
            <div class="recipe__indicators-item">
                <!-- recipe__indicators-title -->
                <strong class="recipe__indicators-title">
                    <svg x="0px" y="0px" viewBox="0 0 27.5 27.5" style="enable-background:new 0 0 27.5 27.5;" xml:space="preserve">
                            <path d="M18.4,2.3c0.1,0.1,0.2,0.2,0.3,0.2c2.8,2.1,5.6,4.2,8.4,6.4c0.1,0.1,0.2,0.2,0.4,0.3c-3,2.3-6.1,4.5-9.2,6.8
                                        c0-1.5,0-3,0-4.6c-1,0.1-1.9,0.1-2.9,0.2c-3.2,0.3-5.4,2.1-7.2,4.6c-0.4,0.6-0.9,1.3-1.4,1.9c0.1-0.5,0.1-1.1,0.2-1.6
                                        c0.4-2.3,1.2-4.4,2.7-6.2c1.8-2.3,4.2-3.4,7-3.8c0.5-0.1,1-0.1,1.6-0.1C18.3,5.1,18.3,3.7,18.4,2.3C18.4,2.3,18.4,2.3,18.4,2.3z"
                            />
                        <path d="M2.8,9.6c0,4.3,0,8.6,0,12.9c5.9,0,11.9,0,17.9,0c0-0.1,0-0.2,0-0.4c0-1.2,0-2.3,0-3.5c0-0.2,0.1-0.4,0.3-0.5
                                c0.8-0.6,1.6-1.3,2.5-2c0,0.2,0,0.3,0,0.4c0,2.4,0,4.8,0,7.2c0,1-0.5,1.6-1.6,1.6c-6.7,0-13.5,0-20.2,0c-1.1,0-1.6-0.5-1.6-1.6
                                c0-5,0-10.1,0-15.1c0-1.1,0.5-1.6,1.6-1.6c2.6,0,5.3,0,7.9,0c0.1,0,0.2,0,0.4,0C9.8,7,9.7,7,9.6,7.1C8.7,7.7,7.8,8.5,7,9.4
                                C6.9,9.5,6.7,9.6,6.6,9.6C5.3,9.6,4.1,9.6,2.8,9.6z"/>
                        </svg>
                    Share This
                </strong>
                <!-- /recipe__indicators-title -->

                <!-- social -->
                <div class="social">
                    <a href="#" class="social__item social__item-facebook">
                        <svg enable-background="new 0 0 56.693 56.693" viewBox="0 0 56.693 56.693"><path d="M40.43,21.739h-7.645v-5.014c0-1.883,1.248-2.322,2.127-2.322c0.877,0,5.395,0,5.395,0V6.125l-7.43-0.029  c-8.248,0-10.125,6.174-10.125,10.125v5.518h-4.77v8.53h4.77c0,10.947,0,24.137,0,24.137h10.033c0,0,0-13.32,0-24.137h6.77  L40.43,21.739z"/></svg>
                    </a>
                    <a href="#" class="social__item social__item-twetter">
                        <svg enable-background="new 0 0 56.693 56.693" viewBox="0 0 56.693 56.693"><path d="M52.837,15.065c-1.811,0.805-3.76,1.348-5.805,1.591c2.088-1.25,3.689-3.23,4.444-5.592c-1.953,1.159-4.115,2-6.418,2.454  c-1.843-1.964-4.47-3.192-7.377-3.192c-5.581,0-10.106,4.525-10.106,10.107c0,0.791,0.089,1.562,0.262,2.303  c-8.4-0.422-15.848-4.445-20.833-10.56c-0.87,1.492-1.368,3.228-1.368,5.082c0,3.506,1.784,6.6,4.496,8.412  c-1.656-0.053-3.215-0.508-4.578-1.265c-0.001,0.042-0.001,0.085-0.001,0.128c0,4.896,3.484,8.98,8.108,9.91  c-0.848,0.23-1.741,0.354-2.663,0.354c-0.652,0-1.285-0.063-1.902-0.182c1.287,4.015,5.019,6.938,9.441,7.019  c-3.459,2.711-7.816,4.327-12.552,4.327c-0.815,0-1.62-0.048-2.411-0.142c4.474,2.869,9.786,4.541,15.493,4.541  c18.591,0,28.756-15.4,28.756-28.756c0-0.438-0.009-0.875-0.028-1.309C49.769,18.873,51.483,17.092,52.837,15.065z"/></svg>
                    </a>
                    <a href="#" class="social__item social__item-pinterest">
                        <svg enable-background="new 0 0 56.693 56.693" viewBox="0 0 56.693 56.693"><g><path d="M28.348,5.158c-13.599,0-24.625,11.023-24.625,24.625c0,10.082,6.063,18.744,14.739,22.553   c-0.069-1.721-0.012-3.783,0.429-5.654c0.473-2,3.168-13.418,3.168-13.418s-0.787-1.572-0.787-3.896   c0-3.648,2.115-6.373,4.749-6.373c2.24,0,3.322,1.682,3.322,3.695c0,2.252-1.437,5.619-2.175,8.738   c-0.616,2.613,1.31,4.744,3.887,4.744c4.665,0,7.808-5.992,7.808-13.092c0-5.397-3.635-9.437-10.246-9.437   c-7.47,0-12.123,5.57-12.123,11.792c0,2.146,0.633,3.658,1.624,4.83c0.455,0.537,0.519,0.754,0.354,1.371   c-0.118,0.453-0.389,1.545-0.501,1.977c-0.164,0.625-0.669,0.848-1.233,0.617c-3.44-1.404-5.043-5.172-5.043-9.408   c0-6.994,5.899-15.382,17.599-15.382c9.4,0,15.588,6.804,15.588,14.107c0,9.658-5.369,16.875-13.285,16.875   c-2.659,0-5.16-1.438-6.016-3.068c0,0-1.43,5.674-1.732,6.768c-0.522,1.9-1.545,3.797-2.479,5.275   c2.215,0.654,4.554,1.01,6.979,1.01c13.598,0,24.623-11.023,24.623-24.623C52.971,16.181,41.945,5.158,28.348,5.158z"/></g></svg>
                    </a>
                    <a href="#" class="social__item social__item-email">
                        <svg x="0px" y="0px" viewBox="0 0 395 395" style="enable-background:new 0 0 395 395;" xml:space="preserve">
                                <polygon points="395,320.089 395,74.911 258.806,197.5 	"/>
                            <polygon points="197.5,252.682 158.616,217.682 22.421,340.271 372.579,340.271 236.384,217.682 	"/>
                            <polygon points="372.579,54.729 22.421,54.729 197.5,212.318 	"/>
                            <polygon points="0,74.911 0,320.089 136.194,197.5 	"/>
                            </svg>
                    </a>
                </div>
                <!-- /social -->
            </div>
            <!-- /recipe__indicators-item -->

        </div>
        <!-- /recipe__indicators -->

        <!-- recipe__wrap -->
        <div class="recipe__wrap">

            <?php if($ingredients) { ?>
            <!-- recipe__ingredients -->
            <div class="recipe__ingredients">
                <!-- recipe__sub-title -->
                <strong class="recipe__sub-title">Ingredients:</strong>
                <!-- /recipe__sub-title -->

                <?= $ingredients; ?>

            </div>
            <!-- /recipe__ingredients -->
            <?php } ?>

            <?php if(get_the_content($post_id)) { ?>
            <!-- recipe__directions -->
            <div class="recipe__directions">
                <!-- recipe__sub-title -->
                <strong class="recipe__sub-title">Directions:</strong>
                <!-- /recipe__sub-title -->

                <?php the_content($post_id); ?>

            </div>
            <!-- /recipe__directions -->
            <?php } ?>

        </div>
        <!-- /recipe__wrap -->

    </div>
    <!-- /recipe -->

    <?php if($like_product_string) { ?>
    <!-- products -->
    <div class="products">

        <!-- site__title -->
        <h2 class="site__title"><span>Products you Might enjoy</span></h2>
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

<?php
}
get_footer();