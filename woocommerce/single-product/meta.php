<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>
<?php if (jwOpt::get_option('woo_skus', '1') == '1') { ?>
	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
		<span itemprop="productID" class="sku_wrapper"><?php _e( 'SKU:', 'jawtemplates' ); ?> <span class="sku" itemprop="sku"><?php echo $product->get_sku(); ?></span></span>
	<?php endif; ?>
<?php } ?>
	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
