<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

get_header();

do_action('templaza-framework_theme_body', apply_filters('templaza-framework_theme_file', basename(__FILE__)));

get_footer();
