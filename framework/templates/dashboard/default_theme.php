<?php
defined( 'TEMPLAZA_FRAMEWORK' ) || exit;

use \TemPlazaFramework\Functions;

$plugin = Functions::get_my_data();
$theme  = wp_get_theme();

?>
<div class="information ">
    <div class="uk-child-width-1-2@l" data-uk-grid>
        <div class="text-center">
            <div class="welcome-container">
                <h2 class="templaza-welcome-heading uk-heading-small"><?php echo sprintf(__('Welcome to %s!', $this -> text_domain), $theme -> get('Name')); ?></h2>
                <p class="uk-text-meta"><?php echo sprintf(__('%s is now installed and ready to use! Get ready to build something beautiful. We hope you enjoy it!'), $theme -> get('Name'));?></p>
                <img class="welcome-image w-100 mt-4" src="<?php echo get_template_directory_uri().'/screenshot.png'; ?>"/>
            </div>
        </div>
        <div>
            <div class="setup-container">
                <?php
                $step_count = 2;
                if(isset($this -> theme_config_registered) && !empty($this -> theme_config_registered)){
                    $step_count += 2;
                }
                ?>
                <h2 class="h3"><?php echo __('Setup your website', $this -> text_domain); ?></h2>
                <p><?php echo sprintf(__('Set up your website with %d easy steps.', $this -> text_domain), $step_count); ?></p>
                <ul class="steps">
                    <?php if(isset($this -> theme_config_registered) && !empty($this -> theme_config_registered)){ ?>
                        <li>
                            <a href="#tzinst-license" class="setup-step">
                                <div class="setup-step-info">
                                    <h5 class="setup-step-heading"><?php echo __('Theme Activation', $this -> text_domain); ?></h5>
                                    <p class="uk-margin-remove"><?php echo __('Enter your purchase code manually. Follow steps to activate the theme', $this -> text_domain);?></p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="setup-step" href="<?php echo admin_url('admin.php?page='.TEMPLAZA_FRAMEWORK.'-importer'); ?>">
                                <div class="setup-step-info">
                                    <h5 class="setup-step-heading"><?php echo __('Data Importation', $this -> text_domain); ?></h5>
                                    <p class="uk-margin-remove"><?php echo __('One-click import one of our demo content.', $this -> text_domain);?></p>
                                </div>
                            </a>
                        </li>
                    <?php } ?>
                    <li>
                        <a class="setup-step" href="<?php echo admin_url('admin.php?page='.Functions::get_theme_option_name().'_options'); ?>">
                            <div class="setup-step-info">
                                <h5 class="setup-step-heading"><?php echo __('Document Link', $this -> text_domain); ?></h5>
                                <p class="uk-margin-remove"><?php echo __('Documentation, help files, and video tutorials for beginners and professionals', $this -> text_domain);?></p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="setup-step" href="<?php echo admin_url('admin.php?page='.Functions::get_theme_option_name().'_options'); ?>">
                            <div class="setup-step-info">
                                <h5 class="setup-step-heading"><?php echo __('Support Link', $this -> text_domain); ?></h5>
                                <p class="uk-margin-remove"><?php echo __('Join our community', $this -> text_domain);?></p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

