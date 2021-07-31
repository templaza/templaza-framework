<?php
/**
 * Base layout for all admin pages
 */

defined('TEMPLAZA_FRAMEWORK') or die;

use TemPlazaFramework\Template_Admin;

//extract(wp_parse_args( $args,
//    array('framework' => '') ));

//var_dump($this); die();
?>
<div id="templaza-framework" class="templaza-framework__wrap mr-wrap">
    <div class="container-fluid">
        <?php
//        Template_Admin::load_my_layout('header', true, true, $args);
//
//        Template_Admin::load_my_layout('notices');
//        Template_Admin::load_my_layout('nav');
//        Template_Admin::load_my_layout('main', true, true, $args);


//        Template_Admin::load_my_layout('footer');


//        $current_page   = $this -> get_current_page();

        $this -> the_header();
        $this -> the_notices();
//        $this -> the_nav();
        $this -> the_content();
        $this -> the_footer();
        ?>
    </div>
</div>
