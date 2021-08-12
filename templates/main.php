<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

//ob_start();
//do_action('templaza-framework_theme_body', apply_filters('templaza-framework_theme_file', basename(__FILE__)));
//$body   = ob_get_contents();
//ob_end_clean();

get_header();
//echo $body;
do_action('templaza-framework_theme_body', apply_filters('templaza-framework_theme_file', basename(__FILE__)));
get_footer();