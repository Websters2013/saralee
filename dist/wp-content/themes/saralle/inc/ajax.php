<?php
add_action('wp_ajax_post', 'post_ajax');
add_action('wp_ajax_nopriv_post', 'post_ajax');
function post_ajax() {
	$post = $_GET['data'];
	$flag = $_GET['flag'];
	if($flag === 'faq') {

				foreach (get_field('faq', $post) as $row_2) {
					echo '<div class="dropdown__item">
                    <div class="dropdown__title">' . $row_2['question'] . '</div>
                    <div class="dropdown__content">' . $row_2['answer'] . '</div>
                </div>';
				}



	} elseif ($flag === 'tips') {
		echo wpautop(get_post_field('post_content', $post));
	}

	exit;
}
