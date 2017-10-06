<?php
add_action('wp_ajax_post', 'post_ajax');
add_action('wp_ajax_nopriv_post', 'post_ajax');
function post_ajax() {
	$post = $_GET['data'];
	$flag = $_GET['flag'];
	if($flag === 'faq') {
		$pages = get_posts(array(
			'posts_per_page' => -1,
			'post_type' => 'faq',
			'post_status' => 'publish',
			'orderby' => 'menu_order',
			'order' => 'DESC',
			'fields' => 'ids',
		));
		if($pages) {
			foreach ($pages as $row) {
				foreach (get_field('faq', $row) as $row_2) {
					echo '<div class="dropdown__item">
                    <div class="dropdown__title">'.$row_2['question'].'</div>
                    <div class="dropdown__content">'.$row_2['answer'].'</div>
                </div>';
				}
			}
		}

	}
	echo wpautop(get_post_field('post_content', $post));
	exit;
}
