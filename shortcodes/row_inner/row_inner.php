<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

if(!class_exists('TemplazaFramework_ShortCode_Row_Inner')){
    class TemplazaFramework_ShortCode_Row_Inner extends TemplazaFramework_ShortCode_Row {

        public function register(){
            global $pagenow;

            $element = parent::register();
            $element['id']              = 'row_inner';

            if($pagenow != 'nav-menus.php') {
                $element['core'] = false;
            }

            return $element;
        }
    }

}

?>