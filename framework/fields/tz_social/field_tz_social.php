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
        function __construct( $field = array(), $value = '', $parent ) {
            $this -> text_domain    = Functions::get_my_text_domain();
            $this->parent = $parent;
            $this->field  = $field;
            $this->value  = $value;

            $defaults   = array(
                'options' => array(
                    'behance' => array(
                        'title'   => __('Behance', $this -> text_domain),
                        'link'    => '',
                        'icons'   => array('fab fa-behance', 'fab fa-behance-square'),
                        'color'   => '#2252FF',
                        'enabled' => false,
                        'icon'    => 'fab fa-behance'
                    ),
                    'dribbble' => array(
                        'title'   => __('Dribbble', $this -> text_domain),
                        'link'    => '',
                        'icons'   => array('fab fa-dribbble','fab fa-dribbble-square'),
                        'color'   => '#F10A77',
                        'enabled' => false,
                        'icon'    => 'fab fa-dribbble'
                    ),
                    'facebook' => array(
                        'title'   => __('Facebook', $this -> text_domain),
                        'link'    => '',
                        'icons'   => array('fab fa-facebook-f', 'fab fa-facebook', 'fab fa-facebook-square'),
                        'color'   => '#39539E',
                        'enabled' => false,
                        'icon'    => 'fab fa-facebook-f'
                    ),
                    'flickr' => array(
                        'title'   => __('Flickr', $this -> text_domain),
                        'link'    => '',
                        'icons'   => array('fab fa-flickr'),
                        'color'   => '#0054E3',
                        'enabled' => false,
                        'icon'    => 'fab fa-flickr'
                    ),
                    'gitHub' => array(
                        'title'   => __('GitHub', $this -> text_domain),
                        'link'    => '',
                        'icons'   => array('fab fa-github', 'fab fa-github-square', 'fab fa-github-alt'),
                        'color'   => '#171515',
                        'enabled' => false,
                        'icon'    => 'fab fa-github'
                    ),
                    'instagram' => array(
                        'title'   => __('Instagram', $this -> text_domain),
                        'link'    => '',
                        'icons'   => array('fab fa-instagram'),
                        'color'   => '#467FAA',
                        'enabled' => false,
                        'icon'    => 'fab fa-instagram'
                    ),
                    'linkedIn' => array(
                        'title'   => __('LinkedIn', $this -> text_domain),
                        'link'    => '',
                        'icons'   => array('fab fa-linkedin-in', 'fab fa-linkedin'),
                        'color'   => '#006FB8',
                        'enabled' => false,
                        'icon'    => 'fab fa-linkedin-in'
                    ),
                    'messenger' => array(
                        'title'   => __('Messenger', $this -> text_domain),
                        'link'    => '',
                        'icons'   => array('fab fa-facebook-messenger'),
                        'color'   => '#3876C4',
                        'enabled' => false,
                        'icon'    => 'fab fa-facebook-messenger'
                    ),
                    'pinterest' => array(
                        'title'   => __('Pinterest', $this -> text_domain),
                        'link'    => '',
                        'icons'   => array('fab fa-pinterest', 'fab fa-pinterest-square', 'fab fa-pinterest-p'),
                        'color'   => '#DB0000',
                        'enabled' => false,
                        'icon'    => 'fab fa-pinterest'
                    ),
                    'reddit' => array(
                        'title'   => __('Reddit', $this -> text_domain),
                        'link'    => '',
                        'icons'   => array('fab fa-reddit', 'fab fa-reddit-square', 'fab fa-reddit-alien'),
                        'color'   => '#FF2400',
                        'enabled' => false,
                        'icon'    => 'fab fa-reddit'
                    ),
                    'skype' => array(
                        'title'            => __('Skype', $this -> text_domain),
                        'link'             => '',
                        'icons'            => array('fab fa-skype'),
                        'color'            => '#00A6F7',
                        'enabled'          => false,
                        'icon'             => 'fab fa-skype',
                        'link_placeholder' => 'johndeo'
                    ),
                    'slack' => array(
                        'title'   => __('Slack', $this -> text_domain),
                        'link'    => '',
                        'icons'   => array('fab fa-slack', 'fab fa-slack-hash'),
                        'color'   => '#50364C',
                        'enabled' => false,
                        'icon'    => 'fab fa-slack'
                    ),
                    'soundcloud' => array(
                        'title'   => __('SoundCloud', $this -> text_domain),
                        'link'    => '',
                        'icons'   => array('fab fa-soundcloud'),
                        'color'   => '#FF0000',
                        'enabled' => false,
                        'icon'    => 'fab fa-soundcloud'
                    ),
                    'spotify' => array(
                        'title'   => __('Spotify', $this -> text_domain),
                        'link'    => '',
                        'icons'   => array('fab fa-spotify'),
                        'color'   => '#00E155',
                        'enabled' => false,
                        'icon'    => 'fab fa-spotify'
                    ),
                    'twitter' => array(
                        'title'   => __('Twitter', $this -> text_domain),
                        'link'    => '',
                        'icons'   => array('fab fa-twitter', 'fab fa-twitter-square'),
                        'color'   => '#3DA9F6',
                        'enabled' => false,
                        'icon'    => 'fab fa-twitter'
                    ),
                    'telegram' => array(
                        'title'            => __('Telegram', $this -> text_domain),
                        'link'             => '',
                        'icons'            => array('fab fa-telegram-plane', 'fab fa-telegram'),
                        'color'            => '#004056',
                        'enabled'          => false,
                        'icon'             => 'fab fa-telegram-plane',
                        'link_placeholder' => 'johndeo'
                    ),
                    'tumblr' => array(
                        'title'   => __('Tumblr', $this -> text_domain),
                        'link'    => '',
                        'icons'   => array('fab fa-tumblr', 'fab fa-tumblr-square'),
                        'color'   => '#00263C',
                        'enabled' => false,
                        'icon'    => 'fab fa-tumblr'
                    ),
                    'vk' => array(
                        'title'   => __('VK', $this -> text_domain),
                        'link'    => '',
                        'icons'   => array('fab fa-vk'),
                        'color'   => '#4273AD',
                        'enabled' => false,
                        'icon'    => 'fab fa-vk'
                    ),
                    'whatsapp' => array(
                        'title'            => __('WhatsApp', $this -> text_domain),
                        'link'             => '',
                        'icons'            => array('fab fa-whatsapp', 'fab fa-whatsapp-square'),
                        'color'            => '#00C033',
                        'enabled'          => false,
                        'icon'             => 'fab fa-whatsapp',
                        'link_placeholder' => '919876543210'
                    ),
                    'youtube' => array(
                        'title'   => __('YouTube', $this -> text_domain),
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

        }

        public function template(){
            ?>
            <script type="text/html" id="tmpl-tzfrm-field-tz_social__<?php echo $this -> field['id'];?>-source">
                <#
                var data_source = JSON.stringify(data);
                #>
                <div class="card mb-2 social-profile-item" data-source="{{data_source}}">
                    <div class="border radius p-2 ng-binding"><i class="{{{data.icon}}}"></i> {{{data.title}}}</div>
                </div>
            </script>
            <script type="text/html" id="tmpl-tzfrm-field-tz_social__<?php echo $this -> field['id'];?>-form">
                <div class="card mb-2 tz-social-item">
                    <#
                    var title = (typeof data.title !== "undefined" && data.title.trim().length)?data.title:"<?php echo __('Custom social profile', $this -> text_domain);?>";
                    #>
                    <div class="card-header">
                        <span><i class="<# if (data.icon){ #>{{{data.icon}}}<# }else if (data.icon_class){ #>{{{data.icon_class}}}<# } #>" style="<# if (data.color){ #>color: {{{data.color}}}<# } #>"></i> {{{title}}}</span>
                        <span class="text-danger float-right" style="cursor: pointer" data-delete-form-item><i class="fa fa-trash"></i></span>
                        <div class="clearfix"></div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <label><?php echo __('Link', $this -> text_domain);?></label>
                            </div>
                            <div class="col-sm-8">
                                <#
                                var link_placeholder = 'https://example.com';
                                if(typeof data.link_placeholder !== "undefined"){
                                    link_placeholder = data.link_placeholder;
                                }
                                #>
                                <input type="text" data-input="link" placeholder="{{{link_placeholder}}}" value="{{{data.link}}}"  class="form-control w-100" autocomplete="off" style=""/>
                            </div>
                        </div>
                        <# if (data.icons && data.icons.length > 1){ #>
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <label><?php echo __('Icon', $this -> text_domain);?></label>
                            </div>
                            <div class="col-sm-8">
                                <ul class="list-inline m-0">
                                    <# _.each( data.icons, function( value, key ) { #>
                                    <li class="select-icon ng-scope<# if (value === data.icon){ #> active<# } #>"><i class="{{{value}}}"></i></li>
                                    <# }); #>
                                </ul>
                            </div>
                        </div>
                        <# }else if(data.icon.length == 0 || (data.icon.length > 0 && data.icons.length == 0)){ #>
                        <div class="row mt-2">
                            <div class="col-sm-4">
                                <label><?php echo __('Icon Class', $this -> text_domain); ?></label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control w-100" autocomplete="off" data-input="icon" value="{{{data.icon}}}" placeholder="fab fa-youtube"/>
<!--                                <input type="text" class="form-control w-100" autocomplete="off" name="--><?php
//                                echo $this -> field['name']; ?><!--[icon-class][]" value="{{{data.icon_class}}}" data-input-icon-class placeholder="fab fa-youtube">-->
                            </div>
                        </div>
                        <div class="mt-2 row">
                            <div class="col-sm-4">
                                <label><?php echo __('Color', $this -> text_domain); ?></label>
                            </div>
                            <div class="col-sm-8">
                                <div class="redux-color-rgba-container " data-id="color" data-show-input="1"
                                     data-show-initial="" data-show-alpha="1" data-show-palette="" data-show-palette-only="" data-show-selection-palette="" data-max-palette-size="10" data-allow-empty="1" data-clickout-fires-change="" data-choose-text="Choose" data-cancel-text="Cancel" data-input-text="Select Color" data-show-buttons="1" data-palette="null">

                                    <input type="text" data-input="color" data-block-id="<?php echo $this -> field['id'];
                                    ?>-tz_social-{{{data.random_id}}}" class="form-control redux-color-rgba" autocomplete="off" id="<?php
                                    echo $this -> field['id']; ?>-tz_social-color" data-current-color="{{{data.color}}}" data-color="{{{data.color}}}"/>
                                    <input type="hidden" class="redux-hidden-alpha" data-id="<?php
                                    echo $this -> field['id'].'-tz_social'; ?>-{{{data.random_id}}}-alpha" id="<?php
                                    echo $this -> field['id'].'-tz_social'; ?>-{{{data.random_id}}}-alpha" value="">
                                    <input type="hidden" class="redux-hidden-alpha" data-id="<?php
                                    echo $this -> field['id'].'-tz_social'; ?>-{{{data.random_id}}}-rgba" id="<?php
                                    echo $this -> field['id'].'-tz_social'; ?>-{{{data.random_id}}}-rgba" value=""/>
                                </div>
                            </div>
                        </div>
                        <# } #>
                    </div>
                </div>
            </script>
            <?php
        }

        /**
         * Field Render Function.
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since ReduxFramework 1.0.0
         */
        function render() {
            add_action('admin_footer', array($this, 'template'));

            $options        = isset($this -> field['options'])?(array) $this -> field['options']:array();

        ?>
            <textarea class="hide" name="<?php echo $this -> field['name'];?>" id="<?php echo $this -> field['id'];
            ?>"><?php echo html_entity_decode(stripslashes ($this -> value)); ?></textarea>
            <div class="row">
                <div class="col-sm-8">
                    <h2 class="text-center my-5 hide"><?php echo __('No Profile Selected', $this -> text_domain);?></h2>
                    <div class="field-tz-social" data-field-form="<?php //echo ($value && !empty($value))?htmlspecialchars(json_encode((array) $value)):''; ?>"></div>
                    <div class="mt-4 text-center">
                        <button type="button" class="button" data-add-custom-field><?php echo __('Add Custom Profile');?></button>
                    </div>
                </div>
                <div class="col-sm-4">
                    <h3><?php echo __('Social Brands', $this -> text_domain);?></h3>
                    <input type="text"placeholder="Search Brand" class="form-control mb-3 w-100" data-search-brand>
                    <small><em class="mb-3 d-block text-center text-info"><?php echo __('Click to Add Profile', $this -> text_domain);?></em></small>

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

            $this -> template();

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
                    array( 'jquery', 'wp-util', 'redux-js', 'redux-spectrum-js', 'redux-field-color-rgba-js'),
                    time(),
                    'all'
                );
            }

        } //function

    } //class
}