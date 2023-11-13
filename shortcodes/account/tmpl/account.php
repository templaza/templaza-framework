<?php
defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;
use TemPlazaFramework\Fonts;
use TemPlazaFramework\CSS;
extract(shortcode_atts(array(
    'tz_id'                         => '',
    'tz_class'                      => '',
    'enable_user_register'          => true,
    'enable_icons'                  => true,
    'login_icon'                    => 'fas fa-lock',
    'register_icon'                 => 'fas fa-sign-in-alt',
    'account_icon'                  => 'fas fa-user',
    'login_text'                    => esc_html__('Login', 'templaza-framework'),
    'register_text'                 => esc_html__('Register', 'templaza-framework'),
    'welcome_text'                  => esc_html__('Welcome', 'templaza-framework'),
    'edit_profile_text'             => esc_html__('Edit Profile', 'templaza-framework'),
    'dashboard_text'                => esc_html__('Dashboard', 'templaza-framework'),
    'logout_text'                   => esc_html__('Logout', 'templaza-framework'),
    'enable_login_url'              => false,
    'login_url'                     => '',
    'register_url'                  => '',
    'dashboard_url'                 => '',
    'separator_text'                 => '',
    'typography_account_font'       => '',
    'typography_account_sub_font'   => '',
    'enable_account_custom_font'    => true,
    'submenu_background'            => '',
), $atts));
if($enable_login_url && $login_url !=''){
    $login = $login_url;
}else{
    $login = wp_login_url( get_permalink() );
}
if($enable_login_url && $register_url !=''){
    $register = $register_url;
}else{
    $register = wp_registration_url();
}
?>
<div<?php echo !empty($tz_id)?' id="'.esc_attr__($tz_id).'"':''; ?> class="<?php echo esc_attr__($tz_class); ?>">
<nav class="uk-navbar-container uk-navbar-transparent tz-navbar-login" data-uk-navbar>
    <div class="uk-navbar-right">
        <ul class="uk-navbar-nav">
            <?php if ( is_user_logged_in() ) {
                $current_user = wp_get_current_user();
                ?>
                <li>
                    <a href="javascript:">
                        <?php if($enable_icons && isset($account_icon)){ ?>
                            <i class="<?php echo esc_attr($account_icon);?>"></i>
                        <?php } ?>
                        <?php
                        echo esc_html($welcome_text.' ');
                        echo esc_html( $current_user->display_name );
                        ?>
                    </a>
                    <div class="uk-navbar-dropdown">
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                            <?php if($dashboard_text && $dashboard_url) { ?>
                            <li><a href="<?php echo esc_url($dashboard_url);?>"><?php echo esc_html($dashboard_text);?></a></li>
                            <?php } ?>
                            <li>
                                <a href="<?php echo esc_url(get_edit_profile_url($current_user->ID))?>">
                                    <?php echo esc_html($edit_profile_text);?>
                                </a></li>
                            <li><a href="<?php echo wp_logout_url( get_permalink() ); ?>">
                                    <?php echo esc_html($logout_text);?>
                                </a></li>
                        </ul>
                    </div>
                </li>
            <?php } else { ?>
                <li>
                    <a href="<?php echo esc_url($login); ?>">
                        <?php if($enable_icons && isset($login_icon)){ ?>
                            <i class="<?php echo esc_attr($login_icon);?>"></i>
                        <?php } ?>
                        <?php echo esc_html($login_text); ?>
                    </a>
                </li>
                <?php if($separator_text){ ?>
                    <li>
                        <?php echo esc_html( $separator_text ); ?>
                    </li>
                <?php } ?>
                <?php if($enable_user_register){ ?>
                <li>
                    <a href="<?php echo esc_url( $register); ?>">
                        <?php if($enable_icons && isset($register_icon)){ ?>
                            <i class="<?php echo esc_attr($register_icon);?>"></i>
                        <?php } ?>
                        <?php echo esc_html( $register_text ); ?>
                    </a>
                </li>
                <?php } ?>
            <?php } ?>
        </ul>
    </div>
</nav>
</div>
<?php
$typographies = array(
    array(
        'id'        => 'typography_account_font',
        'enable'    => (isset($enable_account_custom_font) && $enable_account_custom_font =='1'?true:false),
        'class'     => array(
            'desktop' => '#'.$tz_id.' .tz-navbar-login ul > li> a',
            'tablet' => '#'.$tz_id.' .tz-navbar-login ul > li> a',
            'mobile' => '#'.$tz_id.' .tz-navbar-login ul > li> a',
        )
    ),
    array(
        'id'        => 'typography_account_sub_font',
        'enable'    => (isset($enable_account_custom_font) && $enable_account_custom_font =='1'?true:false),
        'class'     => array(
            'desktop' => '#'.$tz_id.' .tz-navbar-login ul > li .uk-navbar-dropdown  a',
            'tablet' => '#'.$tz_id.' .tz-navbar-login ul > li .uk-navbar-dropdown a',
            'mobile' => '#'.$tz_id.' .tz-navbar-login ul > li .uk-navbar-dropdown a',
        )
    )
);

// Get typographies
$typographies   = apply_filters('templaza-framework/typography/list', $typographies);

// Generate typography styles.
if(count($typographies)) {
    foreach ($typographies as $typo) {
        $enable = isset($typo['enable']) ? (bool)$typo['enable'] : false;
        $typoParams = $typo['id'];
        if ($enable) {
            if (is_array($typo['class'])) {
                $devices = $typo['class'];
            } else {
                $devices['desktop'] = $typo['class'];
                $devices['tablet'] = $typo['class'];
                $devices['mobile'] = $typo['class'];
            }
            $_styles = Fonts::make_css_style($$typoParams, $devices);


            if (count($_styles)) {
                foreach ($_styles as $device => $style) {
                    Templates::add_inline_style($style, $device);
                }
            }
        }
    }
}
$account_css = '';
if($submenu_background){
    $submenu_background = json_decode($submenu_background,true);
    $dropdown_bg = CSS::make_color_rgba_redux($submenu_background);
    if($dropdown_bg !=''){
        $account_css .= '#'.$tz_id.' .tz-navbar-login .uk-navbar-dropdown{background-color:'.$dropdown_bg.'}';
        Templates::add_inline_style($account_css);
    }
}