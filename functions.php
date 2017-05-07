<?php

//Your awesome code could start here.

function add_template_override() {
	wp_enqueue_style('template-override', get_stylesheet_directory_uri() . '/css/template.css');
}

add_action('wp_enqueue_scripts', 'add_template_override', 100);


add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {

    // unset( $tabs['description'] );      	// Remove the description tab
    unset( $tabs['reviews'] ); 			// Remove the reviews tab
    // unset( $tabs['additional_information'] );  	// Remove the additional information tab

    return $tabs;
}


add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
function woo_new_product_tab( $tabs ) {

	global $post;
	$instruction = get_post_meta($post->ID, 'instruction', true);

	if ($instruction != "") {
		// Adds the new tab

		$tabs['instruction_tab'] = array(
			'title' 	=> __( '[:en]Instruction[:hk]使用說明[:zh]使用说明', 'woocommerce' ),
			'priority' 	=> 20,
			'callback' 	=> 'woo_new_product_tab_content'
		);
	}

	return $tabs;
}
function woo_new_product_tab_content() {
	global $post;
	echo get_post_meta($post->ID, 'instruction', true);
}

add_filter( 'woocommerce_product_tabs', 'woo_new_product_ingredients_tab' );
function woo_new_product_ingredients_tab( $tabs ) {

	global $post;
	$ingredients = get_post_meta($post->ID, 'ingredients', true);

	if ($ingredients != "") {
		// Adds the new tab

		$tabs['ingredients_tab'] = array(
			'title' 	=> __( '[:en]Ingredients[:hk]成份[:zh]成份', 'woocommerce' ),
			'priority' 	=> 20,
			'callback' 	=> 'woo_new_product_ingredients_tab_content'
		);
	}

	return $tabs;
}
function woo_new_product_ingredients_tab_content() {
	global $post;
	echo get_post_meta($post->ID, 'ingredients', true);
}
