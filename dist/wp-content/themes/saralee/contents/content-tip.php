<?php
$post_id = 13;
$tips_title = get_field('tips_title', $post_id);
if($tips_title) {
	$tips_title = '<strong class="tips__title">'.$tips_title.'</strong>';
}

$tips_link = get_field('tips_link', $post_id);
if(!empty($tips_link)) {
	$tips_link = '<a href="'.$tips_link['url'].'" class="btn btn_4" target="'.$tips_link['target'].'">'.$tips_link['title'].'</a>';
}

$tips_image = get_field('tips_image', $post_id);

if($tips_title && $tips_image) { ?>
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
