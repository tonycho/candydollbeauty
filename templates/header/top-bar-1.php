<?php global $woocommerce, $yith_wcwl; ?>

<?php
//Vypocitavani sirky prave a leve casti topbaru - kdyz chce nekdo do leva vic textu, tak si vypne nakou kraviny nalevo - a oblast pro text se mu zvetsi
$right_area = 0;
if (jwOpt::get_option('top_bar_login_button', '0') == '1') {
    $right_area = $right_area + 2;
}
if (jwOpt::get_option('top_bar_wishllist', '1') == '1') {
    $right_area = $right_area + 2;
}
if (jwOpt::get_option('top_bar_compare', '0') == '1') {
    $right_area = $right_area + 2;
}
if (jwOpt::get_option('top_bar_cart', 'off') == 'woo') {
    $right_area = $right_area + 3;
}
if (jwOpt::get_option('top_bar_search', '1') == '1') {
    $right_area = $right_area + 3;
}
if($right_area > 9){
    $right_area = 9;
}

$left_area = 12 - $right_area;

$show_left_area = 'hide-mobiles';
if (jwOpt::get_option('top_bar_login_button', '0') == '0' && jwOpt::get_option('top_bar_wishllist', '1') == '0' && jwOpt::get_option('top_bar_cart', 'off') == 'off' && jwOpt::get_option('top_bar_search', '1') == '0') {
    $show_left_area = 'show-mobiles';
}
?>
<div class="col-lg-<?php echo $left_area . ' ' . $show_left_area; ?>  top-bar-1-left">
    <?php echo qtranxf_generateLanguageSelectCode('text'); ?>
</div>
<div class="col-lg-<?php echo $right_area; ?> top-bar-1-right">
    <ul>
        <?php if (jwOpt::get_option('top_bar_login_button', '0') == '1') { ?>
            <li class="top-bar-login-content" aria-haspopup="true">
                <?php
                $myaccount_page_id = get_option('woocommerce_myaccount_page_id');
                $myaccount_page_url = '';
                if ($myaccount_page_id) {
                    $myaccount_page_url = get_permalink($myaccount_page_id);
                }
                if (is_user_logged_in()) {
                    $text = __('[:en]My account[:hk]我的帳戶[:zh]我的帳戶', 'jawtemplates');
                } else {
                    $text = __('[:en]Login[:hk]登入[:zh]登入', 'jawtemplates');
                }
                ?>
                <a href="<?php echo $myaccount_page_url; ?>">
                    <span class="topbar-title-text">                        
                        <?php echo $text; ?>
                    </span>
                </a>
                <?php if (!is_user_logged_in()) { ?>
                    <a href="<?php echo $myaccount_page_url; ?>">
                        <span class="topbar-title-text">                        
                            <?php echo __("[:en]Register[:zh]注冊[:hk]注冊"); ?>
                        </span>
                    </a>                            
                <? } ?>
                <?php
                $class = '';
                if (class_exists('WooCommerce') && is_user_logged_in()) {
                    $class = 'woo-menu';
                }
                ?>         
            </li>
        <?php } ?>
        <?php if (class_exists('YITH_Woocompare') && class_exists('WooCommerce')) { ?>
            <?php if (jwOpt::get_option('top_bar_compare', '0') == '1') { ?>
                <li class="compare-contents">
                    <?php echo jaw_get_template_part('compare', array('header', 'top_bar')); ?>
                </li>
            <?php } ?>
        <?php } ?>
        
        
        <?php if (is_plugin_active('yith-woocommerce-wishlist/init.php') && class_exists('WooCommerce')) { ?>
            <?php if (jwOpt::get_option('top_bar_wishllist', '1') == '1') { ?>
                <li class="wishlist-contents">
                    <?php echo jaw_get_template_part('wishlist', array('header', 'top_bar')); ?>
                </li>
            <?php } ?>
        <?php } ?>

        <?php if (class_exists('WooCommerce')) { ?>
            <?php if (jwOpt::get_option('top_bar_cart', 'off') == 'woo') { ?>
                <li class="top-bar-woo-cart" aria-haspopup="true">
                    <?php echo jaw_get_template_part('woo_cart', array('header', 'top_bar')); ?>
                </li>
            <?php } ?>
        <?php } ?>



        <?php if (jwOpt::get_option('top_bar_search', '1') == '1') { ?>    
            <li>
                <?php
                if (jwOpt::get_option('top_bar_search_type', 'wordpress') == 'woo' && class_exists('WooCommerce')) {
                    get_product_search_form();
                } else {
                    get_search_form();
                }
                ?>
            </li>
        <?php } ?>
    </ul>
</div>