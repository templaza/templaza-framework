<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options    = Functions::get_theme_options();
$plugin_uri = Functions::get_my_url();


// Add tracking code
add_action('wp_head', function() use($options){

    // Add custom css files
    $customcssfiles = isset($options['customcss-files'])?$options['customcss-files']:'';
    if (!empty($customcssfiles)) {
        $customcssfiles = explode("\n", $customcssfiles);
        foreach ($customcssfiles as $customcssfile) {
            if (!empty($customcssfile)) {
                echo "<link rel=\"stylesheet\" href=\"" .$customcssfile. "\"  type=\"text/css\" media=\"all\" />\n";
            }
        }
    }

    // Add custom js files
    $customjsfiles = isset($options['customjs-files'])?$options['customjs-files']:'';
    if (!empty($customjsfiles)) {
        $customjsfiles = explode("\n", $customjsfiles);
        foreach ($customjsfiles as $customjsfile) {
            if (!empty($customjsfile)) {
                echo "<script type=\"text/javascript\" src=\"".$customjsfile."\"></script>\n";
            }
        }
    }
}, 8);

add_action('wp_head', function() use($options){

    // Add tracking code
    $tracking_code  = isset($options['trackingcode-editor'])?$options['trackingcode-editor']:'';
    if(!empty($tracking_code)){
        echo $tracking_code."\n";
    }

    // Add Custom CSS
    $customcss_editor   = isset($options['customcss-editor'])?$options['customcss-editor']:'';
    if(!empty($customcss_editor)){
        echo "<style>$customcss_editor</style>\n";
    }
}, 10);

// Add before head
add_action('wp_head', function() use($options){
    $beforehead_editor  = isset($options['beforehead-editor'])?$options['beforehead-editor']:'';
    if(!empty($beforehead_editor)){
        echo $beforehead_editor."\n";
    }
}, 9999);

add_action('wp_footer', function() use($options){
    $beforebody_editor  = isset($options['beforebody-editor'])?$options['beforebody-editor']:'';
    if(!empty($beforebody_editor)){
        echo $beforebody_editor."\n";
    }
},9999);