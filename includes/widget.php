<?php

//namespace TemPlazaFramework;

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\CSS;
use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

class TemplazaFramework_Widget extends WP_Widget {

    protected $cache;

    public function __construct(){

        $wdargs     = $this -> register();

        if(!empty($wdargs) && count($wdargs) && isset($wdargs['title'])){

            $id_base        = isset($wdargs['id'])?$wdargs['id']:strtolower(get_class($this));
            $title          = isset($wdargs['title'])?$wdargs['title']:$wdargs[1];
            $widget_options = isset($wdargs['widget_options'])?$wdargs['widget_options']:(isset($wdargs[2])?$wdargs[2]:array());
            $control_options= isset($wdargs['control_options'])?$wdargs['control_options']:(isset($wdargs[3])?$wdargs[3]:array());

            if(method_exists($this, 'hooks')) {
                $this->hooks();
            }

            parent::__construct($id_base, $title, $widget_options,$control_options);
        }
    }

    public function register(){
        return array();
    }

    public function get_widget_name(){
        $store_id   = __METHOD__;
        $store_id   = md5($store_id);

        if(isset($this -> cache[$store_id])){
            return $this -> cache[$store_id];
        }

        $class_name = get_class($this);
        $class_name = preg_replace('/^'.__CLASS__.'_/i', '', $class_name);
        $class_name = strtolower($class_name);

        $this -> cache[$store_id]   = $class_name;

        return $class_name;
    }
}
