<?php
/**
 * The template for the menu container of the panel.
 *
 * Override this template by specifying the path where it is stored (templates_path) in your Redux config.
 *
 * @author 	Redux Framework
 * @package 	ReduxFramework/Templates
 * @version:    3.5.4
 */
?>
<nav class="sidebar position-relative">
    <div class="sidebar-header">
<!--        <a href="#" class="sidebar-brand">-->
<!--            Noble<span>UI</span>-->
<!--        </a>-->
<!--        <div class="sidebar-toggler not-active">-->
<!--            <span></span>-->
<!--            <span></span>-->
<!--            <span></span>-->
<!--        </div>-->
        <?php $this->get_template( 'sidebar.header.tpl.php' ); ?>
    </div>
    <div class="sidebar-body">
        <?php $this->get_template( 'menu_container.tpl.php' ); ?>
    </div>
</nav>
