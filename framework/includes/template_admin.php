<?php

namespace TemPlazaFramework;

defined( 'TEMPLAZA_FRAMEWORK' ) || exit;

if(!class_exists('TemPlazaFramework\Template_Admin')){

    class Template_Admin extends Templates{
        protected static $subfolder = '/framework';
    }
}