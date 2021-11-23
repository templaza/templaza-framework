<?php

namespace TemPlazaFramework;

use TemPlazaFramework\Templates;

defined('TEMPLAZA_FRAMEWORK') or exit();

class CSS{

    protected static $cache = array();

    public static function background($color='', $image='', $repeat='', $attachment='', $position='', $size='',
                                      $origin='', $clip='', $important = false){
        $store_id   = __METHOD__;
        $store_id  .= ':'.$color;
        $store_id  .= ':'.$image;
        $store_id  .= ':'.$repeat;
        $store_id  .= ':'.$attachment;
        $store_id  .= ':'.$position;
        $store_id  .= ':'.$size;
        $store_id  .= ':'.$origin;
        $store_id  .= ':'.$clip;
        $store_id  .= ':'.$important;
        $store_id   = md5($store_id);

        if(isset(static::$cache[$store_id])){
            return static::$cache[$store_id];
        }

        if(!$color && !$image){
            return '';
        }

        $important  = $important?' !important':'';

        $css    = '';
        if(!empty($color) && !empty($image)){
            $css = 'background:'.$color.' url('.$image.')';
            if(!empty($repeat)){
                $css .= ' '.$repeat;
            }
            $css    .= $important.';';
        }else{
            if(!empty($image)){
                $css .= 'background-image:url('.$image.')'.$important.';';
                if(!empty($repeat)){
                    $css .= 'background-repeat: '.$repeat.$important.';';
                }
            }
            if(!empty($color)){
                $css .= 'background-color:'.$color.$important.';';
            }
        }

        if(!empty($image)){
            if(!empty($size)){
                $css .= 'background-size:'.$size.$important.';';
            }
            if(!empty($attachment)){
                $css .= 'background-attachment:'.$attachment.$important.';';
            }
            if(!empty($position)){
                $css .= 'background-position:'.$position.$important.';';
            }
            if(!empty($origin)){
                $css .= 'background-origin:'.$origin.$important.';';
            }
            if(!empty($clip)){
                $css .= 'background-clip:'.$clip.$important.';';
            }
        }

        if(empty($css)){
            return '';
        }

        static::$cache[$store_id]   = $css;
        return $css;
    }

    public static function box_shadow($box_shadow, $important = false){
        $store_id   = __METHOD__;
        $store_id  .= ':'.$box_shadow;
        $store_id  .= ':'.$important;
        $store_id   = md5($store_id);

        if(isset(static::$cache[$store_id])){
            return static::$cache[$store_id];
        }

        if(!$box_shadow){
            return '';
        }

        $important  = $important?' !important':'';

        $css    = '-webkit-box-shadow: '.$box_shadow.$important.';';
        $css   .= '-moz-box-shadow: '.$box_shadow.$important.';';
        $css   .= 'box-shadow: '.$box_shadow.$important.';';

        static::$cache[$store_id]   = $css;
        return $css;
    }

    public static function margin($top = '',$right = '',$bottom = '',$left = '', $important = false){
        $store_id   = __METHOD__;
        $store_id  .= ':'.$top;
        $store_id  .= ':'.$right;
        $store_id  .= ':'.$bottom;
        $store_id  .= ':'.$left;
        $store_id  .= ':'.$important;
        $store_id   = md5($store_id);

        if(isset(static::$cache[$store_id])){
            return static::$cache[$store_id];
        }

        if(!$top && !$right && !$bottom && !$left){
            return '';
        }

        $important  = $important?' !important':'';

        if(!empty($top) && !empty($right) && !empty($bottom) && !empty($left)){
            if($top == $bottom && $top == $left && $top == $right){
                $css    = 'margin:'.$top.$important;
            }elseif($top == $bottom && $left == $right){
                $css    = 'margin:'.$top.' '.$left . $important . ';';
            }elseif($left == $right && $top != $bottom) {
                $css    = 'margin:'.$top.' '.$left.' '.$bottom.$important.';';
            }else{
                $css    = 'margin:'.$top.' '.$right.' '
                    . $bottom.' '.$left.$important.';';
            }
        }else {
            $css    = !empty($top)?'margin-top:' . $top . $important . ';':'';
            $css   .= !empty($right)?'margin-right:' . $right . $important . ';':'';
            $css   .= !empty($bottom)?'margin-bottom:' . $bottom . $important . ';':'';
            $css   .= !empty($left)?'margin-left:' . $left . $important . ';':'';
        }

        if(empty($css)){
            return '';
        }

        static::$cache[$store_id]   = $css;
        return $css;
    }

    public static function padding($top = '',$right = '',$bottom = '',$left = '', $important = false){
        $store_id   = __METHOD__;
        $store_id  .= ':'.$top;
        $store_id  .= ':'.$right;
        $store_id  .= ':'.$bottom;
        $store_id  .= ':'.$left;
        $store_id  .= ':'.$important;
        $store_id   = md5($store_id);

        if(isset(static::$cache[$store_id])){
            return static::$cache[$store_id];
        }

        if(!$top && !$right && !$bottom && !$left){
            return '';
        }

        $important  = $important?' !important':'';

        if(!empty($top) && !empty($right) && !empty($bottom) && !empty($left)){
            if($top == $bottom && $top == $left && $top == $right){
                $css    = 'padding:'.$top.$important.';';
            }elseif($top == $bottom && $left == $right){
                $css    = 'padding:'.$top.' '.$left . $important . ';';
            }elseif($left == $right && $top != $bottom) {
                $css    = 'padding:'.$top.' '.$left.' '.$bottom.$important.';';
            }else{
                $css    = 'padding:'.$top.' '.$right.' '
                    . $bottom.' '.$left.$important.';';
            }
        }else {
            $css    = !empty($top)?'padding-top:'.$top.$important.';':'';
            $css   .= !empty($right)?'padding-right:'.$right.$important.';':'';
            $css   .= !empty($bottom)?'padding-bottom:' . $bottom.$important.';':'';
            $css   .= !empty($left)?'padding-left:'.$left.$important.';':'';
        }

        if(empty($css)){
            return '';
        }

        static::$cache[$store_id]   = $css;
        return $css;
    }

    public static function border($top = '',$right = '',$bottom = '',$left = '', $style = '', $color = '', $important = false){
        $store_id   = __METHOD__;
        $store_id  .= ':'.$top;
        $store_id  .= ':'.$right;
        $store_id  .= ':'.$bottom;
        $store_id  .= ':'.$left;
        $store_id  .= ':'.$style;
        $store_id  .= ':'.$color;
        $store_id  .= ':'.$important;
        $store_id   = md5($store_id);

        if(isset(static::$cache[$store_id])){
            return static::$cache[$store_id];
        }

        if(!$top && !$right && !$bottom && !$left){
            return '';
        }

        $important  = $important?' !important':'';
        $css        = '';

        if(!empty($top) && !empty($right) && !empty($bottom) && !empty($left)){
            if($top == $right && $top == $bottom && $top == $left){
                $css    = 'border:'.$top;
                $css   .= !empty($style)?' '.$style:'';
                $css   .= !empty($color)?' '.$color:'';
                $css   .= $important.';';
            }else{
                $css    = 'border-width:'.$top.' '.$right.' '.$bottom.' '.$left.$important.';';
                $css   .= !empty($style)?'border-style:'.$style.$important.';':'';
                $css   .= !empty($color)?'border-color:'.$color.$important.';':'';
            }
        }else {
            if(!empty($top)) {
                $css    = 'border-top:'.$top;
                $css   .= !empty($style)?' '.$style:'';
                $css   .= !empty($color)?' '.$color:'';
                $css   .= $important.';';
            }
            if(!empty($right)) {
                $css   .= 'border-right:'.$right;
                $css   .= !empty($style)?' '.$style:'';
                $css   .= !empty($color)?' '.$color:'';
                $css   .= $important.';';
            }
            if(!empty($bottom)) {
                $css   .= 'border-bottom:'.$bottom;
                $css   .= !empty($style)?' '.$style:'';
                $css   .= !empty($color)?' '.$color:'';
                $css   .= $important.';';
            }
            if(!empty($left)) {
                $css   .= 'border-left:'.$left;
                $css   .= !empty($style)?' '.$style:'';
                $css   .= !empty($color)?' '.$color:'';
                $css   .= $important.';';
            }
        }

        if(empty($css)){
            return '';
        }

        static::$cache[$store_id]   = $css;
        return $css;
    }

    public static function border_redux($border = array(), $important = false){
        $store_id   = __METHOD__;
        $store_id  .= ':'.serialize($border);
        $store_id  .= ':'.$important;
        $store_id   = md5($store_id);

        if(isset(static::$cache[$store_id])){
            return static::$cache[$store_id];
        }

        $top_name       = 'border-top';
        $right_name     = 'border-right';
        $bottom_name    = 'border-bottom';
        $left_name      = 'border-left';

        $top    = isset($border[$top_name])?$border[$top_name]:'';
        $right  = isset($border[$right_name])?$border[$right_name]:'';
        $bottom = isset($border[$bottom_name])?$border[$bottom_name]:'';
        $left   = isset($border[$left_name])?$border[$left_name]:'';
        $color  = isset($border['border-color'])?$border['border-color']:'';
        $style  = isset($border['border-style'])?$border['border-style']:'';

        return self::border($top, $right, $bottom, $left, $style, $color, $important);
    }

    public static function border_radius($top_left = '',$top_right = '',$bottom_left = '',$bottom_right = '', $important = false){
        $store_id   = __METHOD__;
        $store_id  .= ':'.$top_left;
        $store_id  .= ':'.$top_right;
        $store_id  .= ':'.$bottom_left;
        $store_id  .= ':'.$bottom_right;
        $store_id  .= ':'.$important;
        $store_id   = md5($store_id);

        if(isset(static::$cache[$store_id])){
            return static::$cache[$store_id];
        }

        if(empty($top_left) && empty($top_right) && empty($bottom_left) && empty($bottom_right)){
            return '';
        }

        $important  = $important?' !important':'';

        $css  = '';
        if(!empty($top_left) && !empty($top_right) && !empty($bottom_right) && !empty($bottom_left)){
            if($top_left == $bottom_right && $top_right == $bottom_left){
                $border_radius  = $top_left.' '.$bottom_left;
            }elseif($top_left == $top_right && $top_left == $bottom_right && $top_left == $bottom_left){
                $border_radius  = $top_left;
            }else{
                $border_radius  = $top_left.' '.$top_right.' '.$bottom_right.' '.$bottom_left;
            }

            $css    .= 'border-radius:'.$border_radius.$important.';';
        }else{
            if(!empty($top_left)) {
                $css   .= 'border-top-left-radius:'.$top_left.$important.';';
            }
            if(!empty($top_right)) {
                $css   .= 'border-top-right-radius:'.$top_right.$important.';';
            }
            if(!empty($bottom_left)) {
                $css   .= 'border-bottom-left-radius:'.$bottom_left.$important.';';
            }
            if(!empty($bottom_right)) {
                $css   .= 'border-bottom-right-radius:'.$bottom_right.$important.';';
            }
        }

        if(empty($css)){
            return '';
        }

        static::$cache[$store_id]   = $css;

        return $css;
    }

    public static function make_color_rgba($color, $alpha, $rgba){
        $store_id   = __METHOD__;
        $store_id  .= ':'.$color;
        $store_id  .= ':'.$alpha;
        $store_id  .= ':'.$rgba;
        $store_id   = md5($store_id);

        if(isset(static::$cache[$store_id])){
            return static::$cache[$store_id];
        }

        if(!$color && $alpha == '' && !$rgba){
            return '';
        }

        if($alpha > 0 && $alpha < 1){
            return $rgba;
        }elseif($alpha == 1){
            return $color;
        }
        return '';
    }

    public static function make_color_rgba_redux($color_options = array()){
        $store_id   = __METHOD__;
        $store_id  .= ':'.serialize($color_options);
        $store_id   = md5($store_id);

        if(isset(static::$cache[$store_id])){
            return static::$cache[$store_id];
        }

        if(empty($color_options)){
            return '';
        }

        return self::make_color_rgba($color_options['color'], $color_options['alpha'], $color_options['rgba']);
    }

    public static function background_redux($background_options = array(), $important = false){
        $store_id   = __METHOD__;
        $store_id  .= ':'.serialize($background_options);
        $store_id  .= ':'.$important;
        $store_id   = md5($store_id);

        if(isset(static::$cache[$store_id])){
            return static::$cache[$store_id];
        }

        if(empty($background_options)){
            return '';
        }

        $color      = isset($background_options['background-color'])?$background_options['background-color']:'';
        $image      = isset($background_options['background-image'])?$background_options['background-image']:'';
        $clip       = isset($background_options['background-clip'])?$background_options['background-clip']:'';
        $repeat     = isset($background_options['background-repeat'])?$background_options['background-repeat']:'';
        $attachment = isset($background_options['background-attachment'])?$background_options['background-attachment']:'';
        $position   = isset($background_options['background-position'])?$background_options['background-position']:'';
        $size       = isset($background_options['background-size'])?$background_options['background-size']:'';
        $origin     = isset($background_options['background-origin'])?$background_options['background-origin']:'';

        return self::background($color, $image, $repeat, $attachment,
            $position, $size, $origin, $clip, $important);
    }

    /**
     * @param array $spacing_option Padding, margin, border.. options
     * @param string $important The css will be add "!important"
     * @param string $mode Accepts: padding or margin.
     * @param string $default_unit Default unit
     */
    public static function spacing_redux($mode = 'padding', $spacing_option = array(), $important = false, $default_unit = ''){
        $store_id   = __METHOD__;
        $store_id  .= ':'.serialize($spacing_option);
        $store_id  .= ':'.$important;
        $store_id   = md5($store_id);

        if(isset(static::$cache[$store_id])){
            return static::$cache[$store_id];
        }

        if(!count($spacing_option)){
            return '';
        }

        $units  = isset($spacing_option['units']) && !empty($spacing_option['units'])?$spacing_option['units']:$default_unit;

        $top_name       = $mode.'-top';
        $right_name     = $mode.'-right';
        $bottom_name    = $mode.'-bottom';
        $left_name      = $mode.'-left';
        if($mode == 'border-radius'){
            $top_name        = $mode.'-top-left';
            $right_name      = $mode.'-top-right';
            $bottom_name     = $mode.'-bottom-right';
            $left_name       = $mode.'-bottom-left';
        }

        $top    = isset($spacing_option[$top_name])?$spacing_option[$top_name]:'';
        $top   .= (is_numeric($top) && !empty($units))?$units:'';

        $right  = isset($spacing_option[$right_name])?$spacing_option[$right_name]:'';
        $right .= (is_numeric($right) && !empty($units))?$units:'';

        $bottom = isset($spacing_option[$bottom_name])?$spacing_option[$bottom_name]:'';
        $bottom.= (is_numeric($bottom) && !empty($units))?$units:'';

        $left   = isset($spacing_option[$left_name])?$spacing_option[$left_name]:'';
        $left  .= (is_numeric($left) && !empty($units))?$units:'';

        $important  = $important?' !important':'';

        if(!empty($top) && !empty($right) && !empty($bottom) && !empty($left)){
            if($top == $bottom && $top == $left && $top == $right){
                $css    = $mode.':'.$top.$important.';';
            }elseif($top == $bottom && $left == $right){
                $css    = $mode.':'.$top.' '.$left . $important . ';';
            }elseif($left == $right && $top != $bottom) {
                $css    = $mode.':'.$top.' '.$left.' '.$bottom.$important.';';
            }else{
                $css    = $mode.':'.$top.' '.$right.' '
                    . $bottom.' '.$left.$important.';';
            }
        }else {
            $css    = !empty($top)?$top_name.':'.$top.$important.';':'';
            $css   .= !empty($right)?$right_name.':'.$right.$important.';':'';
            $css   .= !empty($bottom)?$bottom_name.':' . $bottom.$important.';':'';
            $css   .= !empty($left)?$left_name.':'.$left.$important.';':'';
        }

        if(empty($css)){
            return '';
        }

        static::$cache[$store_id]   = $css;
        return $css;
    }

    /**
     * @param string $selector The id css name or class css name,...
     * @param array $spacing_option Padding, margin, border.. options
     * @param string $important The css will be add "!important"
     * @param string $mode Accepts: absolute padding or margin.
     * @param string|array $default_unit Default unit
     */
    public static function make_spacing_redux($mode = 'padding', $spacing_option = array(),
                                              $important = false, $default_unit = '', $selector = ''){
        $store_id   = __METHOD__;
        $store_id  .= ':'.serialize($spacing_option);
        $store_id  .= ':'.$important;
        $store_id   = md5($store_id);

        if(isset(static::$cache[$store_id])){
            return static::$cache[$store_id];
        }

        $spacing_option = array_filter($spacing_option);

        if(!count($spacing_option)){
            return '';
        }

        $devices    = Templates::$_devices;
        $css        = array();

        $is_responsive  = false;
        if(is_array($spacing_option) && count($spacing_option)){
            $values         = array_values($spacing_option);

            if(isset($values[0]) && is_array($values[0]) && count($values[0])
                && (array_key_exists('desktop', $values[0]) || array_key_exists('tablet', $values[0])
                || array_key_exists('mobile', $values[0]))){
                $is_responsive  = true;
            }
        }

        if($is_responsive){
            foreach($devices as $device => $dval){
                $padding_device = array();
                $padding_device[$device]    = array();
                foreach($spacing_option as $name => $value){
                    if(isset($value[$device])) {
                        $padding_device[$device][$name] = $value[$device];
                    }
                }

                $_default_unit  = !empty($default_unit) && is_array($default_unit) && isset($default_unit[$device])?$default_unit[$device]:$default_unit;

                $_css   = self::spacing_redux($mode, $padding_device[$device], $important, $_default_unit);

                if(!empty($_css)){
                    if(!isset($css[$device])){
                        $css[$device]   = '';
                    }
                    if(!empty($selector)){
                        if ($device == 'mobile') {
                            $css[$device] = !empty($_css)?'@media (max-width: 767.98px) {'.$selector.'{'. $_css . '}}':'';
                        } elseif ($device == 'tablet') {
                            $css[$device] = !empty($_css)?'@media (max-width: 991.98px) {'.$selector.'{'. $_css . '}}':'';
                        } else {
                            $css[$device] = !empty($_css)?$selector.'{'.$_css.'}':'';
                        }
                    }else{
                        $css[$device] = $_css;
                    }
                }
            }

        }else{
            $css    = self::spacing_redux($mode, $spacing_option, $important, $default_unit);
            $css    = !empty($css) && !empty($selector)?$selector.'{'.$css.'}':(!empty($css)?$css:'');
        }

        if(!empty($css)){
            self::$cache[$store_id] = $css;
            return $css;
        }

        return '';
    }
}
