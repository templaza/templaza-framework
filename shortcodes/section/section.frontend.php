<?php

defined('TEMPLAZA_FRAMEWORK') or exit();


//var_dump($atts);
use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Section')){
    class TemplazaFramework_Shortcode_Section{
        public function __construct()
        {
            add_filter('templaza-framework/layout/generate/shortcode/params/prepare',
                array($this, 'prepare_params'), 10, 2);
        }

        public function prepare_params($params, $element){
            $id = '';
            if(isset($element['id'])){
                $id = $element['id'];
            }
            if(isset($params['customid']) && !empty($params['customid'])){
                $id = $params['customid'];
            }
            $params['id']   = $id;

            $css    = $this -> custom_css($params, $element);

            if(!empty($css)) {
                $params['css']  = '.fl_custom_'.$id.'{'.$css.'}';
            }


            // Custom class
            if((isset($params['hideonxs']) && $params['hideonxs']) ||
                (isset($params['hideonsm']) && $params['hideonsm'])){
                if(!isset($params['customclass'])) {
                    $params['customclass'] = '';
                }
                if(isset($params['hideonxs']) && $params['hideonxs']){
                    $params['customclass']  = 'd-none d-sm-block '.$params['customclass'];
                    unset($params['hideonxs']);
                }
                if(isset($params['hideonsm']) && $params['hideonsm']){
                    $params['customclass']  = 'd-sm-none d-md-block '.$params['customclass'];
                    unset($params['hideonsm']);
                }
            }

//            var_dump(array_filter($params));

            return $params;
        }

//        public function custom_css(&$params, &$element){
//            $css = '';
//
//            if(isset($params['background'])){
//                $background = $params['background'];
//
//                if(!empty($background['background-color'])){
//                    if(is_array($background['background-color'])){
//                        $bg_color   = $background['background-color'];
//                        if(isset($bg_color['alpha']) && $bg_color['alpha'] == 1){
//                            $css .= 'background-color:' . $bg_color['color'] . ';';
//                        }else{
//                            $css .= 'background-color:' . $bg_color['rgba'] . ';';
//                        }
//
//                    }else {
//                        $css .= 'background-color:' . $background['background-color'] . ';';
//                    }
//                }
//                if(!empty($background['background-image'])){
//                    $css  .= 'background-image:'.$background['background-image'].';';
//                    if(!empty($background['background-size'])) {
//                        $css .= 'background-size:' . $background['background-size'] . ';';
//                    }
//                    if(!empty($background['background-position'])) {
//                        $css .= 'background-position:' . $background['background-position'] . ';';
//                    }
//                    if(!empty($background['background-repeat'])) {
//                        $css .= 'background-repeat:' . $background['background-repeat'] . ';';
//                    }
//                    if(!empty($background['background-attachment'])) {
//                        $css .= 'background-attachment:' . $background['background-attachment'] . ';';
//                    }
//                }
//                unset($params['background']);
//            }
//
//            return $css;
//        }

        public function shortcode($atts, $content = ''){
            ?>
            <section id="<?php echo $atts['id']; ?>" class="<?php echo $atts['customclass']; ?>">
                <div class="<?php echo $atts['layout_type'];?>"><?php echo $content; ?></div>
            </section>
        <?php
        }
    }
}
