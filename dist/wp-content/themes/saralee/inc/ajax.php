<?php
add_action('wp_ajax_post', 'post_ajax');
add_action('wp_ajax_nopriv_post', 'post_ajax');
function post_ajax() {
	$post = $_GET['data'];

	echo wpautop(get_post_field('post_content', $post));
	exit;
}