<?php

namespace TemPlazaFramework\Core;

defined('TEMPLAZA_FRAMEWORK') or exit();

class Fields{
    public $args;
    public $section;

    public function __construct($args = null, $section = null)
    {
        $this -> args       = $args;
        $this -> section    = $section;
    }

    public function init(){
        // Load custom core fields
        require_once ( ABSPATH . '/wp-admin/includes/file.php' );
        $fieldPath  = TEMPLAZA_FRAMEWORK_FIELD_PATH;
        $fieldPath  = trailingslashit($fieldPath);

        if(is_dir($fieldPath)){
            $files  = list_files($fieldPath, 1);
            if($files && count($files)){
                foreach($files as $f){
                    if(!is_dir($f)){
                        continue;
                    }
                    $fName  = basename($f);
                    $fFile  = $f.'/field_'.$fName.'.php';
                    if(file_exists($fFile)){
                        add_filter( 'redux/' . $this->args['opt_name'] . '/field/class/' . $fName,function($field) use ($fFile){
                            return $fFile;
                        }); // Adds the local field

                    }
                }
            }
        }

        add_action('redux/options/'.$this->args['opt_name'].'/field/select/register', array($this, 'custom_select'));
        add_action('redux/field/'.$this->args['opt_name'].'/select/render/before', array($this, 'add_class_select'));

//        do_action('templaza-framework-field-init');
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
                // Add Font Icons
                $iconPath   = TEMPLAZA_FRAMEWORK_FIELD_PATH.'/select/font-icons/'.$field['data'].'.php';
                if(file_exists($iconPath)){
                    add_filter('redux/options/'.$this->args['opt_name'].'/data/'.$field['data'], function($data) use ($field, $iconPath){
                        require_once $iconPath;
                        $icons  = apply_filters('templaza-framework/font-icons', $data);
                        if($icons && count($icons)) {
                            $icons = array_combine($icons, $icons);
                        }
                        return $icons;
                    });
                }
            }
        }
    }

}