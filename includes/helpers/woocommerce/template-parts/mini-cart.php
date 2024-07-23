<?php
/**
 * Template part for modal cart
 *
 * @package Templaza
 */

?>

<div class="modal-header">
    <h3 class="modal-title"><?php esc_html_e( 'Your Cart', 'templaza-framework' ) ?>
        <span class="cart-panel-counter">(<?php echo esc_html(WC()->cart->get_cart_contents_count()); ?>)</span>
    </h3>
    <a href="#" class="close-account-panel button-close"><i class="fas fa-close"></i></a>
</div>
<div class="modal-content">
    <div class="widget_shopping_cart_content">
        <?php woocommerce_mini_cart(); ?>
    </div>
</div>