<?php

/**
 * Field Select Image
 *
 * @package     Wordpress
 * @subpackage  ReduxFramework
 * @since       3.1.2
 * @author      Kevin Provance <kprovance>
 */

// Exit if accessed directly
 defined( 'TEMPLAZA_FRAMEWORK' ) or exit;

 use TemPlazaFramework\Functions;

if ( ! class_exists( 'ReduxFramework_TZ_Social' ) ) {
    class ReduxFramework_TZ_Social {

        protected $text_domain;

        /**
         * Field Constructor.
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since ReduxFramework 1.0.0
         */
        function __construct( $field = array(), $value = '', $parent = null) {
            $this -> text_domain    = Functions::get_my_text_domain();
            $this->parent = $parent;
            $this->field  = $field;
            $this->value  = $value;

            $defaults   = array(
                'options' => array(
                    'behance' => array(
                        'id'      => 'behance',
                        'title'   => __('Behance', 'templaza-framework'),
                        'link'    => '',
                        'icons'   => array('fab fa-behance', 'fab fa-behance-square'),
                        'color'   => '#2252FF',
                        'enabled' => false,
                        'icon'    => 'fab fa-behance'
                    ),
                    'dribbble' => array(
                        'id'      => 'dribbble',
                        'title'   => __('Dribbble', 'templaza-framework'),
                        'link'    => '',
                        'icons'   => array('fab fa-dribbble','fab fa-dribbble-square'),
                        'color'   => '#F10A77',
                        'enabled' => false,
                        'icon'    => 'fab fa-dribbble'
                    ),
                    'facebook' => array(
                        'id'      => 'facebook',
                        'title'   => __('Facebook', 'templaza-framework'),
                        'link'    => '',
                        'icons'   => array('fab fa-facebook-f', 'fab fa-facebook', 'fab fa-facebook-square'),
                        'color'   => '#39539E',
                        'enabled' => false,
                        'icon'    => 'fab fa-facebook-f'
                    ),
                    'flickr' => array(
                        'id'      => 'flickr',
                        'title'   => __('Flickr', 'templaza-framework'),
                        'link'    => '',
                        'icons'   => array('fab fa-flickr'),
                        'color'   => '#0054E3',
                        'enabled' => false,
                        'icon'    => 'fab fa-flickr'
                    ),
                    'gitHub' => array(
                        'id'      => 'gitHub',
                        'title'   => __('GitHub', 'templaza-framework'),
                        'link'    => '',
                        'icons'   => array('fab fa-github', 'fab fa-github-square', 'fab fa-github-alt'),
                        'color'   => '#171515',
                        'enabled' => false,
                        'icon'    => 'fab fa-github'
                    ),
                    'instagram' => array(
                        'id'      => 'instagram',
                        'title'   => __('Instagram', 'templaza-framework'),
                        'link'    => '',
                        'icons'   => array('fab fa-instagram'),
                        'color'   => '#467FAA',
                        'enabled' => false,
                        'icon'    => 'fab fa-instagram'
                    ),
                    'linkedIn' => array(
                        'id'      => 'linkedIn',
                        'title'   => __('LinkedIn', 'templaza-framework'),
                        'link'    => '',
                        'icons'   => array('fab fa-linkedin-in', 'fab fa-linkedin'),
                        'color'   => '#006FB8',
                        'enabled' => false,
                        'icon'    => 'fab fa-linkedin-in'
                    ),
                    'messenger' => array(
                        'id'      => 'messenger',
                        'title'   => __('Messenger', 'templaza-framework'),
                        'link'    => '',
                        'icons'   => array('fab fa-facebook-messenger'),
                        'color'   => '#3876C4',
                        'enabled' => false,
                        'icon'    => 'fab fa-facebook-messenger'
                    ),
                    'pinterest' => array(
                        'id'      => 'pinterest',
                        'title'   => __('Pinterest', 'templaza-framework'),
                        'link'    => '',
                        'icons'   => array('fab fa-pinterest', 'fab fa-pinterest-square', 'fab fa-pinterest-p'),
                        'color'   => '#DB0000',
                        'enabled' => false,
                        'icon'    => 'fab fa-pinterest'
                    ),
                    'reddit' => array(
                        'id'      => 'reddit',
                        'title'   => __('Reddit', 'templaza-framework'),
                        'link'    => '',
                        'icons'   => array('fab fa-reddit', 'fab fa-reddit-square', 'fab fa-reddit-alien'),
                        'color'   => '#FF2400',
                        'enabled' => false,
                        'icon'    => 'fab fa-reddit'
                    ),
                    'skype' => array(
                        'id'               => 'skype',
                        'title'            => __('Skype', 'templaza-framework'),
                        'link'             => '',
                        'icons'            => array('fab fa-skype'),
                        'color'            => '#00A6F7',
                        'enabled'          => false,
                        'icon'             => 'fab fa-skype',
                        'link_placeholder' => 'johndeo'
                    ),
                    'slack' => array(
                        'id'      => 'slack',
                        'title'   => __('Slack', 'templaza-framework'),
                        'link'    => '',
                        'icons'   => array('fab fa-slack', 'fab fa-slack-hash'),
                        'color'   => '#50364C',
                        'enabled' => false,
                        'icon'    => 'fab fa-slack'
                    ),
                    'soundcloud' => array(
                        'id'      => 'soundcloud',
                        'title'   => __('SoundCloud', 'templaza-framework'),
                        'link'    => '',
                        'icons'   => array('fab fa-soundcloud'),
                        'color'   => '#FF0000',
                        'enabled' => false,
                        'icon'    => 'fab fa-soundcloud'
                    ),
                    'spotify' => array(
                        'id'      => 'spotify',
                        'title'   => __('Spotify', 'templaza-framework'),
                        'link'    => '',
                        'icons'   => array('fab fa-spotify'),
                        'color'   => '#00E155',
                        'enabled' => false,
                        'icon'    => 'fab fa-spotify'
                    ),
                    'twitter' => array(
                        'id'      => 'twitter',
                        'title'   => __('Twitter', 'templaza-framework'),
                        'link'    => '',
                        'icons'   => array('fa-brands fa-x-twitter', 'fa-brands fa-square-x-twitter'),
                        'color'   => '#3DA9F6',
                        'enabled' => false,
                        'icon'    => 'fa-brands fa-x-twitter'
                    ),
                    'telegram' => array(
                        'id'               => 'telegram',
                        'title'            => __('Telegram', 'templaza-framework'),
                        'link'             => '',
                        'icons'            => array('fab fa-telegram-plane', 'fab fa-telegram'),
                        'color'            => '#004056',
                        'enabled'          => false,
                        'icon'             => 'fab fa-telegram-plane',
                        'link_placeholder' => 'johndeo'
                    ),
                    'tumblr' => array(
                        'id'      => 'tumblr',
                        'title'   => __('Tumblr', 'templaza-framework'),
                        'link'    => '',
                        'icons'   => array('fab fa-tumblr', 'fab fa-tumblr-square'),
                        'color'   => '#00263C',
                        'enabled' => false,
                        'icon'    => 'fab fa-tumblr'
                    ),
                    'vk' => array(
                        'id'      => 'vk',
                        'title'   => __('VK', 'templaza-framework'),
                        'link'    => '',
                        'icons'   => array('fab fa-vk'),
                        'color'   => '#4273AD',
                        'enabled' => false,
                        'icon'    => 'fab fa-vk'
                    ),
                    'whatsapp' => array(
                        'id'               => 'whatsapp',
                        'title'            => __('WhatsApp', 'templaza-framework'),
                        'link'             => '',
                        'icons'            => array('fab fa-whatsapp', 'fab fa-whatsapp-square'),
                        'color'            => '#00C033',
                        'enabled'          => false,
                        'icon'             => 'fab fa-whatsapp',
                        'link_placeholder' => '919876543210'
                    ),
                    'youtube' => array(
                        'id'      => 'youtube',
                        'title'   => __('YouTube', 'templaza-framework'),
                        'link'    => '',
                        'icons'   => array('fab fa-youtube', 'fab fa-youtube-square'),
                        'color'   => '#DE0000',
                        'enabled' => false,
                        'icon'    => 'fab fa-youtube'
                    ),
                ),
            );

            if(isset($this -> field['options']) && count($this -> field['options'])){
                $this -> field['options']    = array($defaults['options'], $this -> field['options']);
            }
            $this -> field  = wp_parse_args($this -> field, $defaults);

            $this -> hooks();

        }

        public function hooks(){

            add_action('admin_footer', array($this, 'template'));

            do_action('templaza-framework/fields/tz_social/hooks');
        }

        public function template(){
            require __DIR__.'/tmpl/tz_social.tpl.php';
        }

        /**
         * Field Render Function.
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since ReduxFramework 1.0.0
         */
        function render() {
            $options        = isset($this -> field['options'])?(array) $this -> field['options']:array();

        ?>
            <textarea class="hide" name="<?php echo $this -> field['name'];?>" id="<?php echo $this -> field['id'];
            ?>"><?php echo html_entity_decode(stripslashes ($this -> value)); ?></textarea>
            <div class="row">
                <div class="col-sm-8">
                    <h2 class="text-center my-5 hide"><?php echo __('No Profile Selected', 'templaza-framework');?></h2>
                    <div class="field-tz-social" data-field-form="<?php //echo ($value && !empty($value))?htmlspecialchars(json_encode((array) $value)):''; ?>"></div>
                    <div class="mt-4 text-center">
                        <button type="button" class="button" data-add-custom-field><?php echo __('Add Custom Profile');?></button>
                    </div>
                </div>
                <div class="col-sm-4">
                    <h3><?php echo __('Social Brands', 'templaza-framework');?></h3>
                    <input type="text"placeholder="Search Brand" class="form-control mb-3 w-100" data-search-brand>
                    <small><em class="mb-3 d-block text-center text-info"><?php echo __('Click to Add Profile', 'templaza-framework');?></em></small>

                    <div data-sources-list="<?php echo count($options)?htmlspecialchars(json_encode(array_values($options))):''; ?>"></div>
                </div>
            </div>
        <?php
        } //function

        /**
         * Enqueue Function.
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since ReduxFramework 1.0.0
         */
        function enqueue() {

            // Set up min files for dev_mode = false.
            $min = Redux_Functions::isMin();

            if (!wp_style_is('field-tz_social-css')) {
                wp_enqueue_style(
                    'field-tz-social-css',
                    Functions::get_my_frame_url() . '/fields/tz_social/field_tz_social.css',
                    array(),
                    time(),
                    'all'
                );
            }

//            if (!wp_script_is('tzfrm_jquery-tmpl-js')) {
//                wp_enqueue_script(
//                    'tzfrm_jquery-tmpl-js',
//                    Functions::get_my_frame_url() . '/assets/vendors/jquery-tmpl/jquery.tmpl.js',
//                    array(),
//                    time(),
//                    'all'
//                );
//            }

            if (!wp_script_is('field-tz_social-js')) {
                wp_enqueue_script(
                    'field-tz_social-js',
                    Functions::get_my_frame_url() . '/fields/tz_social/field_tz_social.js',
                    array( 'jquery', 'wp-util', 'redux-js', 'redux-spectrum-js'),
                    time(),
                    'all'
                );
            }

        } //function

    } //class
}