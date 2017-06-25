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

//Show empty categories in category widget
add_filter('widget_categories_args','show_empty_categories');
function show_empty_categories($cat_args){
	$cat_args['hide_empty'] = 0;
	return $cat_args;
}

// Place the following code in your theme's functions.php file
// override the quantity input with a dropdown
// Note that you still have to invoke this function like this:
/*
$product_quantity = woocommerce_quantity_input( array(
  'input_name'  => "cart[{$cart_item_key}][qty]",
  'input_value' => $cart_item['quantity'],
  'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
  'min_value'   => '0'
), $_product, false );
*/
// function woocommerce_quantity_input($data) {
//     global $product;
//
//   $defaults = array(
//     'input_name'    => $data['input_name'],
//     'input_value'   => $data['input_value'],
//     'max_value'   => apply_filters( 'woocommerce_quantity_input_max', '', $product ),
//     'min_value'   => apply_filters( 'woocommerce_quantity_input_min', '', $product ),
//     'step'    => apply_filters( 'woocommerce_quantity_input_step', '1', $product ),
//     'style'   => apply_filters( 'woocommerce_quantity_style', 'float:left; margin-right:10px;', $product )
//   );
//   if ( ! empty( $defaults['min_value'] ) )
//     $min = $defaults['min_value'];
//   else $min = 1;
//
//   if ( ! empty( $defaults['max_value'] ) )
//     $max = $defaults['max_value'];
//   else $max = 20;
//
//   if ( ! empty( $defaults['step'] ) )
//     $step = $defaults['step'];
//   else $step = 1;
//
//   $options = '';
//   for ( $count = $min; $count <= $max; $count = $count+$step ) {
//     $selected = $count === $defaults['input_value'] ? ' selected' : '';
//     $options .= '<option value="' . $count . '"'.$selected.'>' . $count . '</option>';
//   }
//   echo '<div class="quantity_select" style="' . $defaults['style'] . '"><select name="' . esc_attr( $defaults['input_name'] ) . '" title="' . _x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) . '" class="form-control qty">' . $options . '</select></div>';
// }
