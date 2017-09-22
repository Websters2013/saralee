<?php
$post_id = 11;

$history_title_top = get_field('history_title_top', $post_id);
if($history_title_top) {
	$history_title_top = '<div>'.$history_title_top.'</div>';
}

$history_title_bottom = get_field('history_title_bottom', $post_id);
if($history_title_bottom) {
	$history_title_bottom = '<div><span>'.$history_title_bottom.'</span></div>';
}

$history = get_field('history', $post_id);

if(!empty($history) && $history_title_top && $history_title_bottom) {?>
    <!-- history -->
    <div class="history">

        <!-- history__title -->
        <div class="history__title">
            <?= $history_title_top.$history_title_bottom; ?>
        </div>
        <!-- /history__title -->

        <!-- history__years -->
        <div class="history__years">

            <!-- history__years-list -->
            <div class="history__years-list"></div>
            <!-- /history__years-list -->

            <!-- history__years-line -->
            <span class="history__years-line">
                    <span class="history__years-point"></span>
                </span>
            <!-- /history__years-line -->

        </div>
        <!-- /history__years -->

        <!-- history__content -->
        <div class="history__content">
            <div class="swiper-wrapper">
	            <?php foreach ($history as $row) {?>
                <div class="swiper-slide" data-year="<?= $row['year']; ?>">
                    <!-- history__content-title -->
                    <strong class="history__content-title"><?= $row['year']; ?></strong>
                    <!-- /history__content-title -->

                    <!-- history__content-description -->
                    <div class="history__content-description">

                        <p><?= $row['content']; ?></p>

                        <!--<a href="#" class="btn btn_3">Learn more</a>-->
                    </div>
                    <!-- /history__content-description -->

                    <!-- history__content-pic -->
                    <span class="history__content-pic" style="background-image: url(<?= $row['image']['url']; ?>)"></span>
                    <!-- /history__content-pic -->
                </div>
                <?php } ?>
            </div>
        </div>
        <!-- /history__content -->

    </div>
    <!-- /history -->
<?php } ?>
