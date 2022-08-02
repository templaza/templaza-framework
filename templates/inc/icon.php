<?php

// No direct access.
defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

$gb_options                 = Functions::get_theme_options();
$options                    = Functions::get_header_options();

$login_modals               = isset($gb_options['templaza-shop-account-login'])?$gb_options['templaza-shop-account-login']:'modal';
$header_cart                = isset($gb_options['templaza-shop-mini-cart'])?$gb_options['templaza-shop-mini-cart']:'';
$header_stack_search        = isset($options['stacked-divided-search'])?filter_var($options['stacked-divided-search'], FILTER_VALIDATE_BOOLEAN):true;
$header_stack_account       = isset($options['stacked-divided-account'])?filter_var($options['stacked-divided-account'], FILTER_VALIDATE_BOOLEAN):true;
$header_stack_cart          = isset($options['stacked-divided-cart'])?filter_var($options['stacked-divided-cart'], FILTER_VALIDATE_BOOLEAN):true;
$search_icon_type           = isset($options['search-icon-type'])?$options['search-icon-type']:'default';
$account_icon_type          = isset($options['account-icon-type'])?$options['account-icon-type']:'default';
$cart_icon_type             = isset($options['cart-icon-type'])?$options['cart-icon-type']:'default';
$search_icon_html = '<i class="fas fa-search"></i>';
$account_icon_html = '<i class="fas fa-user"></i>';
$cart_icon_html = '<i class="fas fa-shopping-cart"></i>';
if($search_icon_type == 'fontawesome' ){
    $search_icon = isset($options['search-icon'])?$options['search-icon']:'';
    $search_icon_html = '<i class="'.$search_icon.'"></i>';
}elseif ($search_icon_type == 'custom'){
    $search_icon = isset($options['search-icon-custom'])?$options['search-icon-custom']:'';
    if($search_icon){
        $log_svg              = '';
        if(Functions::file_ext_exists($search_icon['url'], 'svg')){
            $log_svg  = ' data-uk-svg';
        }
        $search_icon_html = '<img src="'.$search_icon['url'].'" alt="'.esc_attr__('Search','templaza-framework').'" '.$log_svg.'/>';
    }
}
if($account_icon_type == 'fontawesome' ){
    $account_icon = isset($options['account-icon'])?$options['account-icon']:'';
    $account_icon_html = '<i class="'.$account_icon.'"></i>';
}elseif ($account_icon_type == 'custom'){
    $account_icon = isset($options['account-icon-custom'])?$options['account-icon-custom']:'';
    if($account_icon){
        $log_svg              = '';
        if(Functions::file_ext_exists($account_icon['url'], 'svg')){
            $log_svg  = ' data-uk-svg';
        }
        $account_icon_html = '<img src="'.$account_icon['url'].'" alt="'.esc_attr__('Account','templaza-framework').'" '.$log_svg.'/>';
    }
}
if($cart_icon_type == 'fontawesome' ){
    $cart_icon = isset($options['cart-icon'])?$options['cart-icon']:'';
    $cart_icon_html = '<i class="'.$account_icon.'"></i>';
}elseif ($cart_icon_type == 'custom'){
    $cart_icon = isset($options['cart-icon-custom'])?$options['cart-icon-custom']:'';
    if($account_icon){
        $log_svg              = '';
        if(Functions::file_ext_exists($cart_icon['url'], 'svg')){
            $log_svg  = ' data-uk-svg';
        }
        $cart_icon_html = '<img src="'.$cart_icon['url'].'" alt="'.esc_attr__('Cart','templaza-framework').'" '.$log_svg.'/>';
    }
}
if($header_stack_search){ ?>
    <div class="header-search uk-position-relative header-icon">
        <span>
            <?php echo $search_icon_html; ?>
        </span>
        <form method="get" class="searchform " action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <input type="text" class="field uk-input inputbox search-query uk-margin-remove-vertical" name="s" placeholder="<?php esc_attr_e( 'Search...', 'baressco');?>" />
            <button type="submit" class="submit searchsubmit has-button-icon uk-position-right" name="submit" data-uk-icon="search"></button>
        </form>
    </div>
<?php } ?>
<?php if($header_stack_cart && class_exists( 'woocommerce' )){ ?>
    <div class="header-cart header-icon">
        <a href="<?php echo esc_url( wc_get_cart_url() ) ?>" data-toggle="<?php echo esc_attr($header_cart); ?>" data-target="cart-modal">
            <?php echo $cart_icon_html; ?>
            <span class="counter cart-counter"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></span>
        </a>
    </div>
<?php } ?>
<?php if($header_stack_account && class_exists( 'woocommerce' )){ ?>
    <div class="header-account header-icon">
        <a class="account-icon" href="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ) ?>"
           data-toggle="<?php echo esc_attr($login_modals);?>"
           data-target="account-modal">
            <?php echo $account_icon_html; ?>
        </a>
        <?php if ( is_user_logged_in() ) : ?>
            <div class="account-links">
                <ul>
                    <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
                        <li class="account-link--<?php echo esc_attr( $endpoint ); ?>">
                            <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>" class="underline-hover">
                                <?php echo esc_html( $label ); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
<?php } ?>