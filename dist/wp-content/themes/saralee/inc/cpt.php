<?php
add_action('init', 'custom_post_type', 0);

function custom_post_type() {
		$product_labels = array(
			'name' => 'Product',
			'singular_name' => 'Product',
			'menu_name' => 'Products',
			'all_items' => 'All Products',
			'view_item' => 'View Product',
			'add_new_item' => 'Add Product',
			'add_new' => 'Add Product',
			'edit_item' => 'Edit',
			'update_item' => 'Update',
			'search_items' => 'Search'
		);
		$product_args = array(
			'labels' => $product_labels,
			'supports' => array('title','thumbnail','editor','excerpt'),
			'hierarchical' => false,
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'show_in_admin_bar' => true,
			'can_export' => true,
			'has_archive' => false,
			'exclude_from_search' => true,
			'publicly_queryable' => true,
			'capability_type' => 'post',
			'menu_icon' => 'dashicons-products',
			'rewrite' => array(
				'with_front' => true
			)
		);
		register_post_type('product', $product_args);
		function product_taxonomy() {
			register_taxonomy(
				'product_cat',
				'product',
				array(
					'label' => __( 'Product Categories' ),
					'hierarchical' => true,
				)
			);
		}
		add_action( 'init', 'product_taxonomy' );



	$recipes_labels = array(
		'name' => 'Recipes',
		'singular_name' => 'Recipes',
		'menu_name' => 'Recipes',
		'all_items' => 'All Recipes',
		'view_item' => 'View Recipes',
		'add_new_item' => 'Add Recipes',
		'add_new' => 'Add Recipes',
		'edit_item' => 'Edit',
		'update_item' => 'Update',
		'search_items' => 'Search'
	);
	$recipes_args = array(
		'labels' => $recipes_labels,
		'supports' => array('title','thumbnail','editor','excerpt'),
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_admin_bar' => true,
		'can_export' => true,
		'has_archive' => false,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
		'menu_icon' => 'dashicons-welcome-write-blog',
		'rewrite' => array(
			'with_front' => true
		)
	);
	register_post_type('recipes', $recipes_args);

	function recipes_taxonomy() {
		register_taxonomy(
			'recipes_cat',
			'recipes',
			array(
				'label' => __( 'Recipes Categories' ),
				'hierarchical' => false,
			)
		);
	}
	add_action( 'init', 'recipes_taxonomy' );
}
