<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Account')){
    class TemplazaFramework_ShortCode_Account extends TemplazaFramework_ShortCode {

        public function __construct($field_parent = array(), $value = '', $parent = '')
        {
            parent::__construct($field_parent, $value, $parent);
        }

        public function register(){
            return array(
                'id'          => 'account',
                'icon'        => 'fas fa-user',
                'title'       => esc_html__('Account','templaza-framework'),
                'param_title' => esc_html__('Account login settings','templaza-framework'),
                'desc'        => esc_html__('Login, Register, user account','templaza-framework'),
                'admin_label' => true,
                'params'      => array(
                    array(
                        'id'       => 'enable_user_register',
                        'type'     => 'switch',
                        'title'    => esc_html__('Enable User Register', 'templaza-framework'),
                        'default'  => true,
                    ),
                    array(
                        'id'       => 'enable_icons',
                        'type'     => 'switch',
                        'title'    => esc_html__('Enable icons', 'templaza-framework'),
                        'default'  => true,
                    ),
                    array(
                        'id'          => 'login_icon',
                        'type'        => 'select',
                        'title'       => esc_html__( 'Login icon', 'templaza-framework' ),
                        'data'        => 'fontawesome',
                        'default'     => 'fas fa-lock',
                        'required'    => array( 'enable_icons', '=', true ),
                    ),
                    array(
                        'id'          => 'register_icon',
                        'type'        => 'select',
                        'title'       => esc_html__( 'Register icon', 'templaza-framework' ),
                        'data'        => 'fontawesome',
                        'default'     => 'fas fa-sign-in-alt',
                        'required'    => array( 'enable_icons', '=', true ),
                    ),
                    array(
                        'id'          => 'account_icon',
                        'type'        => 'select',
                        'title'       => esc_html__( 'Account icon', 'templaza-framework' ),
                        'data'        => 'fontawesome',
                        'default'     => 'fas fa-user',
                        'required'    => array( 'enable_icons', '=', true ),
                    ),
                    array(
                        'id'       => 'enable_dasboard_url',
                        'type'     => 'switch',
                        'title'    => esc_html__('Custom Dashboard url', 'templaza-framework'),
                        'default'  => true,
                    ),
                    array(
                        'id'       => 'dashboard_url',
                        'type'     => 'text',
                        'title'    => esc_html__('Dashboard url', 'templaza-framework'),
                        'required'    => array( 'enable_dasboard_url', '=', true ),
                    ),
                    array(
                        'id'       => 'login_text',
                        'type'     => 'text',
                        'title'    => esc_html__('Login text', 'templaza-framework'),
                        'default'  => esc_html__('Login', 'templaza-framework'),
                    ),
                    array(
                        'id'       => 'register_text',
                        'type'     => 'text',
                        'title'    => esc_html__('Register text', 'templaza-framework'),
                        'default'  => esc_html__('Register', 'templaza-framework'),
                        'required'    => array( 'enable_user_register', '=', true ),
                    ),
                    array(
                        'id'       => 'separator_text',
                        'type'     => 'text',
                        'title'    => esc_html__('Separator text', 'templaza-framework'),
                    ),
                    array(
                        'id'       => 'welcome_text',
                        'type'     => 'text',
                        'title'    => esc_html__('Welcome text', 'templaza-framework'),
                        'default'  => esc_html__('Welcome', 'templaza-framework'),
                    ),
                    array(
                        'id'       => 'edit_profile_text',
                        'type'     => 'text',
                        'title'    => esc_html__('Edit profile text', 'templaza-framework'),
                        'default'  => esc_html__('Edit Profile', 'templaza-framework'),
                    ),
                    array(
                        'id'       => 'logout_text',
                        'type'     => 'text',
                        'title'    => esc_html__('Logout text', 'templaza-framework'),
                        'default'  => esc_html__('Logout', 'templaza-framework'),
                    ),
                    array(
                        'id'       => 'dashboard_text',
                        'type'     => 'text',
                        'title'    => esc_html__('Dashboard text', 'templaza-framework'),
                        'default'  => esc_html__('Dashboard', 'templaza-framework'),
                    ),
                    array(
                        'id'       => 'enable_account_custom_font',
                        'type'     => 'switch',
                        'title'    => esc_html__('Account Custom font', 'templaza-framework'),
                        'default'  => false,
                    ),
                    array(
                        /* To use this id is a variable. You should create id with "_" character*/
                        'id'                      => 'typography_account_font',
                        'type'                    => 'typography',
                        'title'                   => esc_html__( 'Account Font', 'templaza-framework' ),
                        'subtitle'                => esc_html__( 'Specify Account font properties.', 'templaza-framework' ),
                        'required'                => array('enable_account_custom_font', '=', true),
                        'color'                   => true,
                        'text-align'              => false,
                        'preview'                 => true, // Disable the previewer
                        'word-spacing'            => false,
                        'letter-spacing'          => true,
                        'text-transform'          => true,
                        'font-backup'             => true,
                        'allow_responsive'        => true,
                        'allow_empty_line_height' => true,
                        'google'                  => true,
                        'units'                   => array(
                            'font-size'   => 'px',
                            'line-height' => 'em',
                        ),
                        'default'                 => array(
                            'color'          => '',
                            'font-weight'    => '',
                            'letter-spacing' => '',
                            'text-transform' => 'none',
                        ),
                    ),
                    array(
                        /* To use this id is a variable. You should create id with "_" character*/
                        'id'                      => 'typography_account_sub_font',
                        'type'                    => 'typography',
                        'title'                   => esc_html__( 'Sub menu account font', 'templaza-framework' ),
                        'subtitle'                => esc_html__( 'Specify sub font properties.', 'templaza-framework' ),
                        'required'                => array('enable_account_custom_font', '=', true),
                        'color'                   => true,
                        'text-align'              => false,
                        'preview'                 => true, // Disable the previewer
                        'word-spacing'            => false,
                        'letter-spacing'          => true,
                        'text-transform'          => true,
                        'font-backup'             => true,
                        'allow_responsive'        => true,
                        'allow_empty_line_height' => true,
                        'google'                  => true,
                        'units'                   => array(
                            'font-size'   => 'px',
                            'line-height' => 'em',
                        ),
                        'default'                 => array(
                            'color'          => '',
                            'font-weight'    => '',
                            'letter-spacing' => '',
                            'text-transform' => 'none',
                        ),
                    ),
                    array(
                        'id'     => 'item_margin',
                        'type'   => 'spacing',
                        'mode'   => 'margin',
                        'all'    => false,
                        'allow_responsive'    => true,
                        'units'  => array( 'em', 'rem', 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
                        'title'  => esc_html__('Custom Margin', 'templaza-framework'),
                        'default' => array(
                            'units' => 'px'
                        ),
                    ),
                    array(
                        'id'        => 'submenu_background',
                        'type'      => 'color_rgba',
                        'title'     => 'Dropdown Background',
                    ),

                )
            );
        }
    }

}

?>