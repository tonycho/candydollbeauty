<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author     WooThemes
 * @package    WooCommerce/Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$args = array( 'taxonomy' => 'brands',);
$terms = wp_get_post_terms(get_the_ID(),'brands', $args);

if ($terms) {
  $link = get_term_link(intval($terms[0]->term_id), 'brands');

  echo "<div class='brand'>";
    echo "<a href='" . $link . "'>" . $terms[0]->name . "</a>";
  echo "</div>";
}

the_title( '<h1 class="product_title entry-title">', '</h1>' );
