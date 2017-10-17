<?php

$args = array(
	'taxonomy' => 'products_cat',
	'parent' => 0,
	'hide_empty' => false,
);
$res = get_terms($args);
$title = get_field('locator_title', 15);
?>
    <!-- store-locator -->
    <div class="store-locator">

        <!-- store-locator__control -->
        <aside class="store-locator__control">

            <!-- store-locator__form -->
            <form class="store-locator__form" autocomplete="off" method="post" action="/">

                <?php if($title) { ?>
                <h3><?= $title; ?></h3>
                <?php } ?>

                <input type="text" name="zip" class="" size="6" maxlength="10" tabindex="3" placeholder="Enter Your Zip Code" value="<?= $_POST['zip']; ?>"/>

                <select name="group">
                    <option value="0" selected="selected">All Categories</option>
									<?php foreach ($res as $row) { ?>
                      <option value="<?= $row->slug; ?>" <?php if($row->slug === $_POST['group']) {echo 'selected';} ?>><?= $row->name; ?></option>
									<?php } ?>
                </select>

                <select name="upc">
                    <option value="0" selected="selected">All Products</option>
                    <?php if($_POST['upc'] && $_POST['product_name']) { ?>
                        <option value="<?= $_POST['upc']; ?>" selected="selected"><?= $_POST['product_name']; ?></option>
                    <?php } ?>
                </select>

                <select name="miles">
                    <option selected="selected" value="5">5 Miles</option>
                    <option value="10">10 Miles</option>
                    <option value="15">15 Miles</option>
                    <option value="50">15+ Miles</option>
                </select>

                <button type="submit" name="form-go-btn"><span>Search</span></button>

            </form>
            <!-- /store-locator__form -->

            <!-- store-locator__list -->
            <div class="store-locator__list loader">
                <div class='preloader__points'>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="swiper-container"></div>
            </div>
            <!-- /store-locator__list -->

        </aside>
        <!-- /store-locator__control -->

        <div class="store-locator__map"></div>

    </div>
    <!-- /store-locator -->
<?php
