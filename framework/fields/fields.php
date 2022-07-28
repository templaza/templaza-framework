<?php

namespace TemPlazaFramework\Core;

defined('TEMPLAZA_FRAMEWORK') or exit();

class Fields{
    public $args;
    public $section;

    protected $cache    = array();
    protected static $loaded   = array();

    public function __construct($args = null, $section = null)
    {
        $this -> args       = $args;
        $this -> section    = $section;

        $this -> init();
        $this -> hooks();
    }

    public function init(){
        // Load custom core fields
        require_once ( ABSPATH . '/wp-admin/includes/file.php' );
        $fieldPath  = TEMPLAZA_FRAMEWORK_FIELD_PATH;
        $fieldPath  = trailingslashit($fieldPath);

        if(is_dir($fieldPath)){
            $files  = \list_files($fieldPath, 1);
            if($files && count($files)){
                foreach($files as $f){
                    if(!is_dir($f)){
                        continue;
                    }
                    $fName  = basename($f);

                    $field_type = str_replace( '_', '-', $fName );

                    // Register my fields to redux
                    $fFile  = $f.'class-templaza-'.$field_type.'.php';

                    if(!file_exists($fFile)) {
                        $fFile = $f . 'field_' . $fName . '.php';
                    }

                    if(file_exists($fFile)){
                        add_filter( 'redux/' . $this->args['opt_name'] . '/field/class/' . $fName,function($field) use ($fFile){
                            return $fFile;
                        }); // Adds the local field

                    }

                    // Require override exists file
                    $override_file   =  $f."override-redux-{$field_type}.php";
                    if(file_exists($override_file)) {
                        add_filter("redux/{$this->args['opt_name']}/field/class/{$fName}", function ($filter_path, $field) use ($fName, $field_type) {
                            $_filter_path = TEMPLAZA_FRAMEWORK_FIELD_PATH . "/{$fName}/override-redux-{$field_type}.php";
                            $filter_path = file_exists($_filter_path) ? $_filter_path : $filter_path;

                            return $filter_path;
                        }, 10, 2);
                    }

                    // Register my custom field override redux's fields
                    $custom_file    = $f.'custom-redux-'.$fName.'.php';
                    if(file_exists($custom_file)){
                        require_once $custom_file;
                        $custom_class   = 'Templaza_Custom_Redux_'.ucfirst($fName);
                        if(class_exists($custom_class)){
                            $reduxFramework = \Redux::instance($this -> args['opt_name']);

                            if(!$reduxFramework instanceof \ReduxFramework) {
                                $reduxFramework = new \ReduxFramework();
                                $reduxFramework -> args = $this -> args;
                            }

                            $field_class = new $custom_class(array(), null, $reduxFramework);

                            if(method_exists($field_class, '__tz_init')){
                                $field_class -> __tz_init($this -> args, $this);
                            }
                        }

//                        do_action('templaza-framework/field/'.$fName.'/init');
                    }
                }
            }
        }

//        do_action('templaza-framework-field-init');
    }

    public static function load_field($field, $value = '', $parent = null)
    {
        // Load custom core fields
        if(!$field){
            return;
        }

        $field_type = $field['type'];

        if(isset(static::$loaded[$field_type])){
            return;
        }

        $field_path = TEMPLAZA_FRAMEWORK_FIELD_PATH;
        $field_path  .= '/'.$field_type.'/field_'.$field_type.'.php';
        $field_classes = array( 'Redux_' . $field_type, 'ReduxFramework_' . $field_type );

        $field_class = \Redux_Functions::class_exists_ex( $field_classes );
        if(!class_exists($field_class) && file_exists($field_path)){
            require_once $field_path;
        }
        $field_class = \Redux_Functions::class_exists_ex( $field_classes );

        if(!class_exists($field_class)){
            return;
        }

        static::$loaded[$field_type]    = new $field_class($field, '', $parent);

    }

    public static function load_fields($fields, $parent = null)
    {
        if(!$fields || !count($fields)){
            return;
        }

        foreach ($fields as $field){
            static::load_field($field, '', $parent);
        }
    }

    public function hooks(){

        // Override redux select field (with data is icon)
        add_action('redux/options/'.$this->args['opt_name'].'/field/select/register', array($this, 'custom_select'));
        add_action('redux/field/'.$this->args['opt_name'].'/select/render/before', array($this, 'add_class_select'));

        do_action('templaza-framework/field/hooks', $this);
    }

    public function add_class_select(&$field){
        if($field && isset($field['data']) && $field['data'] && empty($field['options'])) {
            $iconPath = TEMPLAZA_FRAMEWORK_FIELD_PATH . '/select/font-icons/' . $field['data'] . '.php';
            if (file_exists($iconPath)) {
                $field['class'] .= 'font-icons';
            }
        }
    }

    public function custom_select($field){

        if(empty($field['options'])){
            if($field && isset($field['data']) && $field['data']){
//                if($field['data'] == 'icons'){
//                    add_filter('redux/options/'.$this->args['opt_name'].'/data/'.$field['data'], function($data)use ($field){
//
//                    });
//                }else{

                // Add Font Icons
                $iconPath   = TEMPLAZA_FRAMEWORK_FIELD_PATH.'/select/font-icons/'.$field['data'].'.php';
                if(file_exists($iconPath)){
                    add_filter('redux/options/'.$this->args['opt_name'].'/data/'.$field['data'], function($data) use ($field, $iconPath){

//                        if(isset($field['data-icons']) && $field['data-icons']){
//                            $icons   = $field['data-icons'];
////                            $data   = $field['data-icons'];
////                            $icons  = apply_filters('templaza-framework/field/select/'.$field['id'].'/data-icons', $data);
//                        }else{
                            require_once $iconPath;
                            $icons  = apply_filters('templaza-framework/field/select/font-icons', $data);
                            $icons  = apply_filters('templaza-framework/field/select/font-icons/'.$field['data'], $icons);
//                        }
                        if($icons && count($icons)) {
                            $icons = array_combine($icons, $icons);
                        }
                        return $icons;
                    });
                }
//                }
            }
        }
    }

}