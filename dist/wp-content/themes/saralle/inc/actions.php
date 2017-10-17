<?php
//required actions
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
add_filter('xmlrpc_enabled', '__return_false');
remove_action('wp_head', 'wlwmanifest_link');
// close required actions
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'signuppageheaders');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');
// Отключаем сам REST API
add_filter('rest_enabled', '__return_false');
// Отключаем фильтры REST API
remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');
remove_action('wp_head', 'rest_output_link_wp_head', 10, 0);
remove_action('template_redirect', 'rest_output_link_header', 11, 0);
remove_action('auth_cookie_malformed', 'rest_cookie_collect_status');
remove_action('auth_cookie_expired', 'rest_cookie_collect_status');
remove_action('auth_cookie_bad_username', 'rest_cookie_collect_status');
remove_action('auth_cookie_bad_hash', 'rest_cookie_collect_status');
remove_action('auth_cookie_valid', 'rest_cookie_collect_status');
remove_filter('rest_authentication_errors', 'rest_cookie_check_errors', 100);
// Отключаем события REST API
remove_action('init', 'rest_api_init');
remove_action('rest_api_init', 'rest_api_default_filters', 10, 1);
remove_action('parse_request', 'rest_api_loaded');
// Отключаем Embeds связанные с REST API
remove_action('rest_api_init', 'wp_oembed_register_route');
remove_filter('rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4);
remove_action('wp_head', 'wp_oembed_add_discovery_links');
// если собираетесь выводить вставки из других сайтов на своем, то закомментируйте след. строку.
//remove_action('wp_head', 'wp_oembed_add_host_js');
add_filter('the_content', 'do_shortcode');
add_filter('wpcf7_form_elements', 'do_shortcode');
add_filter( 'the_content', 'wpautop' );

register_nav_menus(array(
	'menu' => 'menu',
	'menu_footer' => 'menu_footer'
));

if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
}

/*add_action( 'wp_enqueue_scripts', 'custom_clean_head' );
function custom_clean_head() {
	remove_action('wp_head', 'wp_print_scripts');
	remove_action('wp_head', 'wp_print_head_scri  pts', 9);
	remove_action('wp_head', 'wp_enqueue_scripts', 1);
}*/

add_action('wp_enqueue_scripts', 'add_js');
function add_js() {
	wp_deregister_script('jquery');
	wp_register_script('jquery', get_template_directory_uri() . '/assets/js/vendors/jquery-2.2.1.min.js', false, filemtime(realpath(__DIR__ . DIRECTORY_SEPARATOR . '..') . '/assets/js/vendors/jquery-2.2.1.min.js'), false);
	wp_register_script('index', get_template_directory_uri() . '/assets/js/index.min.js', false, filemtime(realpath(__DIR__ . DIRECTORY_SEPARATOR . '..') . '/assets/js/index.min.js'), true);
	wp_register_script('swiper', get_template_directory_uri() . '/assets/js/vendors/swiper.jquery.min.js', false, filemtime(realpath(__DIR__ . DIRECTORY_SEPARATOR . '..') . '/assets/js/vendors/swiper.jquery.min.js'), true);
	wp_register_script('perfect-scrollbar', get_template_directory_uri() . '/assets/js/vendors/perfect-scrollbar.jquery.min.js', false, filemtime(realpath(__DIR__ . DIRECTORY_SEPARATOR . '..') . '/assets/js/vendors/perfect-scrollbar.jquery.min.js'), true);
	wp_register_script('recipe', get_template_directory_uri() . '/assets/js/recipe.min.js', false, filemtime(realpath(__DIR__ . DIRECTORY_SEPARATOR . '..') . '/assets/js/recipe.min.js'), true);
	wp_register_script('recipes', get_template_directory_uri() . '/assets/js/recipes.min.js', false, filemtime(realpath(__DIR__ . DIRECTORY_SEPARATOR . '..') . '/assets/js/recipes.min.js'), true);
	wp_register_script('contact-us', get_template_directory_uri() . '/assets/js/contact-us.min.js', false, filemtime(realpath(__DIR__ . DIRECTORY_SEPARATOR . '..') . '/assets/js/contact-us.min.js'), true);
	wp_register_script('map',  'http://maps.google.com/maps/api/js?key=AIzaSyBBm0kRd1Ala8zPQVH9XJR46H3s_IUisoU', false, '', false);

	wp_register_style('style', get_stylesheet_uri(), false, filemtime(realpath(__DIR__ . DIRECTORY_SEPARATOR . '..').'/style.css'));
	wp_register_style('index', get_template_directory_uri() . '/assets/css/index.css',false, filemtime( realpath(__DIR__ . DIRECTORY_SEPARATOR . '..').'/assets/css/index.css'));
	wp_register_style('swiper', get_template_directory_uri() . '/assets/css/swiper.min.css',false, filemtime( realpath(__DIR__ . DIRECTORY_SEPARATOR . '..').'/assets/css/swiper.min.css'));
	wp_register_style('about-us', get_template_directory_uri() . '/assets/css/about-us_page.css',false, filemtime( realpath(__DIR__ . DIRECTORY_SEPARATOR . '..').'/assets/css/about-us_page.css'));
	wp_register_style('products_page', get_template_directory_uri() . '/assets/css/products_page.css',false, filemtime( realpath(__DIR__ . DIRECTORY_SEPARATOR . '..').'/assets/css/products_page.css'));
	wp_register_style('contact-us', get_template_directory_uri() . '/assets/css/contact-us_page.css',false, filemtime( realpath(__DIR__ . DIRECTORY_SEPARATOR . '..').'/assets/css/contact-us_page.css'));
	wp_register_style('tips_page', get_template_directory_uri() . '/assets/css/tips_page.css',false, filemtime( realpath(__DIR__ . DIRECTORY_SEPARATOR . '..').'/assets/css/tips_page.css'));
	wp_register_style('faq_page', get_template_directory_uri() . '/assets/css/faq_page.css',false, filemtime( realpath(__DIR__ . DIRECTORY_SEPARATOR . '..').'/assets/css/faq_page.css'));
	wp_register_style('recipes_page', get_template_directory_uri() . '/assets/css/recipes_page.css',false, filemtime( realpath(__DIR__ . DIRECTORY_SEPARATOR . '..').'/assets/css/recipes_page.css'));
	wp_register_style('perfect-scrollbar', get_template_directory_uri() . '/assets/css/perfect-scrollbar.css',false, filemtime( realpath(__DIR__ . DIRECTORY_SEPARATOR . '..').'/assets/css/perfect-scrollbar.css'));
	wp_register_style('product_page', get_template_directory_uri() . '/assets/css/product_page.css',false, filemtime( realpath(__DIR__ . DIRECTORY_SEPARATOR . '..').'/assets/css/product_page.css'));
	wp_register_style('recipe_page', get_template_directory_uri() . '/assets/css/recipe_page.css',false, filemtime( realpath(__DIR__ . DIRECTORY_SEPARATOR . '..').'/assets/css/recipe_page.css'));
	wp_register_style('search_page', get_template_directory_uri() . '/assets/css/search_page.css',false, filemtime( realpath(__DIR__ . DIRECTORY_SEPARATOR . '..').'/assets/css/search_page.css'));
	wp_register_style('store-locator_page', get_template_directory_uri() . '/assets/css/store-locator_page.css',false, filemtime( realpath(__DIR__ . DIRECTORY_SEPARATOR . '..').'/assets/css/store-locator_page.css'));


	wp_enqueue_script('jquery');
	wp_enqueue_script('swiper');

	/*if(!is_singular('faq') || !is_page_template('page-faq.php') || !is_singular('recipes') || !is_page_template('page-recipes.php') || !is_page_template('page-contact.php')) {
		wp_enqueue_script( 'index' );
	}*/

	wp_enqueue_style('swiper');

	if(is_front_page()) {
		wp_enqueue_script('map');
		wp_enqueue_script( 'index' );

		wp_enqueue_style('index');
	}

	if(is_singular('tips') || is_page_template('page-tips.php')) {
		wp_enqueue_script( 'index' );

		wp_enqueue_style('tips_page');
	}

	if(is_singular('products')) {
		wp_enqueue_script( 'index' );

		wp_enqueue_style('product_page');
	}

	if(is_singular('recipe')) {
		wp_enqueue_script('perfect-scrollbar');
		wp_enqueue_script('recipe');

		wp_enqueue_style('perfect-scrollbar');
		wp_enqueue_style('recipe_page');
	}

	if(is_singular('faq') || is_page_template('page-faq.php')) {
		wp_enqueue_script('perfect-scrollbar');
		wp_enqueue_script('recipe');

		wp_enqueue_style('perfect-scrollbar');
		wp_enqueue_style('faq_page');
	}

	if(is_page_template('page-about.php')) {
		wp_enqueue_script( 'index' );

		wp_enqueue_style('about-us');
	}

	if(is_page_template('page-products.php') || is_tax()) {
		wp_enqueue_script( 'index' );

		wp_enqueue_style('products_page');
	}

	if(is_page_template('page-search.php')) {
		wp_enqueue_script( 'index' );

		wp_enqueue_style('search_page');
	}

	if(is_page_template('page-contact.php')) {
		wp_enqueue_script('perfect-scrollbar');
		wp_enqueue_script( 'contact-us' );

		wp_enqueue_style('contact-us');
	}

	if(is_page_template('page-store-locator.php')) {
		wp_enqueue_script('map');
		wp_enqueue_script( 'index' );

		wp_enqueue_style('store-locator_page');
	}

	if(is_page_template('page-recipes.php')) {
		wp_enqueue_script('perfect-scrollbar');
		wp_enqueue_script('recipes');

		wp_enqueue_style('perfect-scrollbar');
		wp_enqueue_style('recipes_page');
	}
	
	wp_enqueue_style('style');
}

function require_comment_name($fields) {

	if ($fields['comment_author'] == '')
		wp_die('Error: please enter a valid name.');

	return $fields;
}
add_filter('preprocess_comment', 'require_comment_name');

add_filter( 'gform_submit_button_1', 'form_submit_button', 10, 2 );
function form_submit_button( $button, $form ) {
	return "<button type=\"submit\" class='btn' id='gform_submit_button_{$form['id']}'><span>".get_field('form_button_title', 30)."</span></button>";
}

class Saralle_Walker extends Walker_Nav_Menu {

	function start_lvl( &$output, $depth = 0, $args = array() ) {

		if ($depth === 0){
			$output .= '<div class="menu__subcategory"><ul>';
		}

	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {

		if ($depth === 0){
			$output .= "</ul></div>";
		}

	}

	function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {
		$object = $item->object;
		$type = $item->type;
		$title = $item->title;
		$description = $item->description;
		$permalink = $item->url;
		$output .= "<li>";
		$active = '';

		if (is_page( $item->object_id )) {
			$active = ' active ';
		}
		$output .= '<a href="' . $permalink . '" class="menu__item'.$active.'">';


		if( $description != '' && $depth == 0 ) {
			$output .= '<small class="description">' . $description . '</small>';
		}
		if($depth == 1 && $type === 'taxonomy') {
			//var_dump($item);
			$image = get_field('image', 'products_cat_' . $item->object_id);
			$output .= '<div class="menu__item-img">
                      <img src="'.$image['sizes']['thumbnail'].'" alt="'.$image['title'].'">
                  </div>
                  <p>'.$title.'</p>';
		} else {
			$output .= $title;
		}

		$output .= '</a>';
	}
}
