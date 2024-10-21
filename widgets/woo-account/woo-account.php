<?php
/*
 * Display Woocommerce Account
 * Widgets display Woocommerce Account
 */
use TemPlazaFramework\Functions;
if(!class_exists('TemplazaFramework_Widget_Woo_Account') && is_plugin_active( 'woocommerce/woocommerce.php' )) {
    class TemplazaFramework_Widget_Woo_Account extends TemplazaFramework_Widget
    {
        /**
         * Holds widget settings defaults, populated in constructor.
         *
         * @var array
         */
        protected $default;

        public function __construct()
        {

            $this->defaults = array(
                'account-text'       => '',
                'account-icon'       => 'far fa-user',
            );
            parent::__construct();
        }
        public function register(){
            return array(
                'title'             => esc_html__( 'TemPlaza - Woocommerce Account', 'templaza-framework' ),
                'widget_options'    => array(
                    'classname'                   => 'woocommerce-account',
                    'description'                 => esc_html__( 'WooCommerce Account login.', 'templaza-framework' ),
                    'customize_selective_refresh' => true,
                ),
                'control_options'   => array( 'width' => 560 )
            );
        }
        /* function widget */
        public function  widget($args,$instance){
            extract($args);
            echo wp_kses($args['before_widget'],'post');
            if ( ! empty( $instance['title'] ) )
                echo wp_kses($args['before_title'] . $instance['title'] . $args['after_title']);

            $instance = wp_parse_args( $instance, $this->defaults );
            if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
                $templaza_options = array();
            }else{
                $templaza_options = Functions::get_theme_options();
            }
            $modals = isset($templaza_options['templaza-shop-account-login'])?$templaza_options['templaza-shop-account-login']:'modal';

            ?>
            <div class="header-account">
                <a class="account-icon" href="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ) ?>"
                   data-toggle="<?php echo esc_attr($modals);?>"
                   data-target="account-modal">
                    <i class="<?php echo esc_attr($instance['account-icon']);?>"></i>
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
            <?php
            echo wp_kses($args['after_widget'],'post');
        }
        /* function form */
        public function form($instance) {
            $instance = wp_parse_args( $instance, array(
                'account-text'      => '',
                'account-icon'      => '',
            ) );

            ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('account-text')); ?>">
                    <?php esc_html_e('Account text','templaza-framework'); ?>
                </label>
                <br>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('account-text')); ?>" id="<?php echo esc_attr($this->get_field_id('account-text')); ?>" class="widefat" value="<?php echo esc_html($instance['account-text']); ?>" >
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_name('account-icon')); ?>">
                    <?php esc_html_e('Account icon','templaza-framework'); ?>
                </label>
                <br>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('account-icon')); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_name('account-icon')); ?>" value="<?php echo esc_html($instance['account-icon']); ?>" >
            </p>

            <?php
        }

        /* function update */
        public function update($new_instance,$old_instance){
            $instance = $old_instance ;
            $instance['account-text']       =   $new_instance['account-text'];
            $instance['account-icon']       =   $new_instance['account-icon'];

            return $instance;
        }

    }
}