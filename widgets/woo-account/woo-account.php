<?php
/*
 * Display Woocommerce Account
 * Widgets display Woocommerce Account
 */
use TemPlazaFramework\Functions;
if(!class_exists('TemplazaFramework_Widget_Woo_Account')) {
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
                'title'          => '',
                'button-text'       => '',
                'button-url'        => '',
            );
            parent::__construct();
        }
        public function register(){
            return array(
                'title'             => esc_html__( 'TemPlaza - Woocommerce Account', $this -> text_domain ),
                'widget_options'    => array(
                    'classname'                   => 'woocommerce-account',
                    'description'                 => esc_html__( 'WooCommerce Account login.', $this -> text_domain ),
                    'customize_selective_refresh' => true,
                ),
                'control_options'   => array( 'width' => 560 )
            );
        }
        /* function widget */
        public function  widget($args,$instance){
            extract($args);
            echo $args['before_widget'];
            if ( ! empty( $instance['title'] ) )
                echo $args['before_title'] . $instance['title'] . $args['after_title'];

            $instance = wp_parse_args( $instance, $this->defaults );
            ?>
            <div class="ui-button uk-text-center">
                <a class="uk-button uk-button-default uk-button-square"
                   href="<?php echo esc_url($instance['button-url']);?>" title="<?php echo esc_attr($instance['button-text']);?>"><?php echo esc_attr($instance['button-text']);?>
                </a>
            </div>
            <?php
            echo $args['after_widget'];
        }
        /* function form */
        public function form($instance) {
            $instance = wp_parse_args( $instance, array(
                'title'         => 'Title',
                'button-text'    => '',
                'button-url'       => '',
            ) );

            ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                    <?php esc_html_e('Title','templaza-elements'); ?>
                </label>
                <br>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" class="widefat" value="<?php echo esc_html($instance['title']); ?>" >
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_name('button-text')); ?>">
                    <?php esc_html_e('Button Text','templaza-elements'); ?>
                </label>
                <br>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('button-text')); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_name('button-text')); ?>" value="<?php echo esc_html($instance['button-text']); ?>" >
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_name('button-url')); ?>">
                    <?php esc_html_e('Button Url','templaza-elements'); ?>
                </label>
                <br>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('button-url')); ?>" id="<?php echo esc_attr($this->get_field_name('button-url')); ?>" class="widefat" value="<?php echo esc_html($instance['button-url']); ?>" >
            </p>

            <?php
        }

        /* function update */
        public function update($new_instance,$old_instance){
            $instance = $old_instance ;
            $instance['title']          =   $new_instance['title'];
            $instance['button-text']     =   $new_instance['button-text'];
            $instance['button-url']        =   $new_instance['button-url'];

            return $instance;
        }

    }
}