<?php
defined( 'TEMPLAZA_FRAMEWORK' ) || exit;

use \TemPlazaFramework\Functions;

$plugin = Functions::get_my_data();
$theme  = wp_get_theme();

?>
<div class="information ">
    <div class="row">
        <div class="col-lg-6 text-center">
            <div class="welcome-container p-4">
                <h1 class="templaza-welcome-heading pb-3"><?php echo sprintf(__('Welcome to %s!', $this -> text_domain), $theme -> get('Name')); ?></h1>
                <p><?php echo sprintf(__('%s is now installed and ready to use! Get ready to build something beautiful. We hope you enjoy it!'), $theme -> get('Name'));?></p>
                <img class="welcome-image mw-100 mt-4" src="<?php echo get_template_directory_uri().'/screenshot.png'; ?>"/>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="setup-container p-4">
                <h2 class="h3"><?php echo __('Setup your website', $this -> text_domain); ?></h2>
                <p><?php echo __('Set up your website with 3 easy steps.', $this -> text_domain); ?></p>
<!--                <p>--><?php //echo $theme -> get('Description'); ?><!--</p>-->
                <ul class="steps">
                    <li>
                        <a href="#tzinst-license" class="setup-step">
                            <div class="setup-step-info">
                                <span class="setup-step-heading"><?php echo __('Theme Activation', $this -> text_domain); ?></span>
                                <p><?php echo __('Enter your purchase code manually. Follow steps to activate the theme', $this -> text_domain);?></p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="setup-step" href="<?php echo admin_url('admin.php?page='.TEMPLAZA_FRAMEWORK.'-importer'); ?>">
                            <div class="setup-step-info">
                                <span class="setup-step-heading"><?php echo __('Data Importation', $this -> text_domain); ?></span>
                                <p><?php echo __('One-click import one of our demo content.', $this -> text_domain);?></p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="setup-step" href="<?php echo admin_url('admin.php?page='.Functions::get_theme_option_name().'_options'); ?>">
                            <div class="setup-step-info">
                                <span class="setup-step-heading"><?php echo __('Config Your Website', $this -> text_domain); ?></span>
                                <p><?php echo __('Gives you full control over the design of both the main menu and the sticky menu', $this -> text_domain);?></p>
                            </div>
                        </a>
                    </li>
<!--                    <li>-->
<!--                        <h3 class="h5">--><?php //echo __('Create Custom Config', $this -> text_domain); ?><!--</h3>-->
<!--                        <p>--><?php //echo __('', $this -> text_domain);?><!--</p>-->
<!--                    </li>-->
                </ul>
            </div>
        </div>
    </div>
</div>

