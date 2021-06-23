<?php

namespace TemPlazaFramework;

use ScssPhp\ScssPhp\Compiler;

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
                    $css .= 'background-repeat: '.$repeat.';';
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
}
