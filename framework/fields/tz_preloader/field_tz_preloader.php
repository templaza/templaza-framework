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

if ( ! class_exists( 'ReduxFramework_TZ_Preloader' ) ) {
    class ReduxFramework_TZ_Preloader {

        protected $text_domain;

        /**
         * Field Constructor.
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since ReduxFramework 1.0.0
         */
        function __construct( $field = array(), $value = '', $parent = null ) {
            $this -> text_domain    = Functions::get_my_text_domain();
            $this->parent = $parent;
            $this->field  = $field;
            $this->value  = $value;

            $defaults   = array(
                'options' => array(
                    'rotating-plane' => array(
                        'title' => __('Rotating Plane', 'templaza-framework'),
                        'html'  => '<div class="sk-rotating-plane"></div>',
                    ),
                    'fading-circle' => array(
                        'title' => __('Fading Circle', 'templaza-framework'),
                        'html'  => '<div class="sk-fading-circle"><div class="sk-circle1 sk-circle"></div><div class="sk-circle2 sk-circle"></div><div class="sk-circle3 sk-circle"></div><div class="sk-circle4 sk-circle"></div><div class="sk-circle5 sk-circle"></div><div class="sk-circle6 sk-circle"></div><div class="sk-circle7 sk-circle"></div><div class="sk-circle8 sk-circle"></div><div class="sk-circle9 sk-circle"></div><div class="sk-circle10 sk-circle"></div><div class="sk-circle11 sk-circle"></div><div class="sk-circle12 sk-circle"></div></div>',
                    ),
                    'folding-cube' => array(
                        'title' => __('Folding Cube', 'templaza-framework'),
                        'html'  => '<div class="sk-folding-cube"><div class="sk-cube1 sk-cube"></div><div class="sk-cube2 sk-cube"></div><div class="sk-cube4 sk-cube"></div><div class="sk-cube3 sk-cube"></div></div>',
                    ),
                    'double-bounce' => array(
                        'title' => __('Double Bounce', 'templaza-framework'),
                        'html'  => '<div class="sk-double-bounce"><div class="sk-child sk-double-bounce1"></div><div class="sk-child sk-double-bounce2"></div></div>',
                    ),
                    'wave' => array(
                        'title' => __('Wave', 'templaza-framework'),
                        'html'  => '<div class="sk-wave"><div class="sk-rect sk-rect1"></div><div class="sk-rect sk-rect2"></div><div class="sk-rect sk-rect3"></div><div class="sk-rect sk-rect4"></div><div class="sk-rect sk-rect5"></div></div>',
                    ),
                    'wandering-cubes' => array(
                        'title' => __('Wandering Cubes', 'templaza-framework'),
                        'html'  => '<div class="sk-wandering-cubes"><div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div></div>',
                    ),
                    'pulse' => array(
                        'title' => __('Pulse', 'templaza-framework'),
                        'html'  => '<div class="sk-spinner sk-spinner-pulse"></div>',
                    ),
                    'chase' => array(
                        'title' => __('Chase', 'templaza-framework'),
                        'html'  => '<div class="sk-chase"><div class="sk-chase-dot"></div><div class="sk-chase-dot"></div><div class="sk-chase-dot"></div><div class="sk-chase-dot"></div><div class="sk-chase-dot"></div><div class="sk-chase-dot"></div></div>',
                    ),
                    'chasing-dots' => array(
                        'title' => __('Chasing Dots', 'templaza-framework'),
                        'html'  => '<div class="sk-chasing-dots"><div class="sk-child sk-dot1"></div><div class="sk-child sk-dot2"></div></div>',
                    ),
                    'three-bounce' => array(
                        'title' => __('Three Bounce', 'templaza-framework'),
                        'html'  => '<div class="sk-three-bounce"><div class="sk-child sk-bounce1"></div><div class="sk-child sk-bounce2"></div><div class="sk-child sk-bounce3"></div></div>',
                    ),
                    'circle' => array(
                        'title' => __('Circle', 'templaza-framework'),
                        'html'  => '<div class="sk-circle"><div class="sk-circle1 sk-child"></div><div class="sk-circle2 sk-child"></div><div class="sk-circle3 sk-child"></div><div class="sk-circle4 sk-child"></div><div class="sk-circle5 sk-child"></div><div class="sk-circle6 sk-child"></div><div class="sk-circle7 sk-child"></div><div class="sk-circle8 sk-child"></div><div class="sk-circle9 sk-child"></div><div class="sk-circle10 sk-child"></div><div class="sk-circle11 sk-child"></div><div class="sk-circle12 sk-child"></div></div>',
                    ),
                    'cube-grid' => array(
                        'title' => __('Cube Grid', 'templaza-framework'),
                        'html'  => '<div class="sk-cube-grid"><div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div><div class="sk-cube sk-cube3"></div><div class="sk-cube sk-cube4"></div><div class="sk-cube sk-cube5"></div><div class="sk-cube sk-cube6"></div><div class="sk-cube sk-cube7"></div><div class="sk-cube sk-cube8"></div><div class="sk-cube sk-cube9"></div></div>',
                    ),
                    'bouncing-loader' => array(
                        'title' => __('Bouncing Loader', 'templaza-framework'),
                        'html'  => '<div class="bouncing-loader"><div></div><div></div><div></div></div>',
                    ),
                    'donut' => array(
                        'title' => __('Donut', 'templaza-framework'),
                        'html'  => '<div class="donut"></div>',
                    ),
                ),
            );

            if(isset($this -> field['options']) && count($this -> field['options'])){
                $this -> field['options']    = array($defaults['options'], $this -> field['options']);
            }
            $this -> field  = wp_parse_args($this -> field, $defaults);
        }

        /**
         * Field Render Function.
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since ReduxFramework 1.0.0
         */
        function render() {
            
            $options        = isset($this -> field['options'])?(array) $this -> field['options']:array();
            $dialog_title   = isset($this -> field['dialog_title'])?$this -> field['dialog_title']:'';

            $value  = $this -> value;
            if(empty($this -> value) && isset($this -> field['default'])) {
                $value = $this -> field['default'];
            }
            if(!empty($value)){
                $selected  = isset($options[$value])?$options[$value]:array();
            }
        ?>
        <div class="field-tz-preloader">
            <a href="#<?php echo $this -> field['id'].'__modal';
            ?>" data-toggle="tz-preloader-modal" data-uk-toggle><span class="tz-preloader-field-select"></span></a>
            <div class="select-preloader"><?php
                if(isset($selected) && isset($selected['html'])){
                    echo $selected['html'];
                }
                ?></div>
        </div>
        <div id="<?php echo $this -> field['id'].'__modal'; ?>" title="<?php
        echo $dialog_title; ?>" class="field-tz-preloader-dialog-content uk-modal-container" data-uk-modal>
            <div class="uk-modal-dialog">
                <button class="uk-modal-close-default" type="button" data-uk-close></button>
                <div class="uk-modal-header">
                    <h2 class="uk-h4"><?php echo $dialog_title; ?></h2>
                </div>
                <div class="uk-modal-body tz-field-preloaders-selector" data-uk-overflow-auto>
                    <?php if(isset($this -> field['options']) && count($this -> field['options'])){
                        foreach ($this -> field['options'] as $key => $option){
                        ?>
                    <div class="tz-preloader-select" data-value="<?php echo $key; ?>" data-id="<?php
                        echo $this -> field['id'];?>" data-html="<?php echo htmlspecialchars($option['html']); ?>">
                        <div class="tz-preloader-select-inner">
                            <?php echo isset($option['html'])?$option['html']:$option['title'];?>
                        </div>
                    </div>
                    <?php }
                    } ?>
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button"><?php
                        echo __('Cancel', 'templaza-framework');?></button>
                </div>
            </div>
        </div>
        <input type="hidden" name="<?php echo $this->field['name']; ?>" id="<?php echo $this -> field['id'];
        ?>" value="<?php echo esc_attr( $value );?>"/>

        <?php
        } //function

        /**
         * Enqueue Function.
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since ReduxFramework 1.0.0
         */
        function enqueue() {

            if (!wp_style_is('field-tz_preloader-css')) {
                wp_enqueue_style(
                    'field-tz_preloader-css',
                    Functions::get_my_frame_url() . '/fields/tz_preloader/field_tz_preloader.css',
                    array(),
                    time(),
                    'all'
                );
            }

            if (!wp_script_is('field-tz_preloader-js')) {
                wp_enqueue_script('field-tz_preloader-js',       // handle
                    Functions::get_my_frame_url() . '/fields/tz_preloader/field_tz_preloader.js',       // source
                    array('jquery','jquery-ui-dialog', 'redux-js'),
                    time(),
                    'all'); // dependencies
            }
        } //function
    } //class
}