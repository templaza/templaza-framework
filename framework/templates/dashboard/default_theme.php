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
                <h2 class="templaza-welcome-heading uk-heading-small"><?php echo sprintf(__('Welcome to %s!', 'templaza-framework'), $theme -> get('Name')); ?></h2>
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
                <h2 class="uk-h3 uk-margin-small-bottom"><?php echo __('Setup your website', 'templaza-framework'); ?></h2>
                <p class="uk-margin-remove-top"><?php echo __('Set up your website with our useful resources', 'templaza-framework'); ?></p>
                <ul class="steps">
                    <?php if(isset($this -> theme_config_registered) && !empty($this -> theme_config_registered)){ ?>
                        <li>
                            <a href="#tzinst-license" class="setup-step p-4">
                                <div class="setup-step-info">
                                    <h5 class="setup-step-heading uk-margin-small"><?php echo __('Theme Activation', 'templaza-framework'); ?></h5>
                                    <p class="uk-margin-remove"><?php echo __('Enter your purchase code manually. Follow steps to activate the theme', 'templaza-framework');?></p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="setup-step p-4" href="<?php echo admin_url('admin.php?page='.TEMPLAZA_FRAMEWORK.'_importer'); ?>">
                                <div class="setup-step-info">
                                    <h5 class="setup-step-heading uk-margin-small"><?php echo __('Data Importation', 'templaza-framework'); ?></h5>
                                    <p class="uk-margin-remove"><?php echo __('One-click import one of our demo content.', 'templaza-framework');?></p>
                                </div>
                            </a>
                        </li>
                    <?php } ?>
                    <li>
                        <a class="setup-step p-4" href="<?php echo admin_url('admin.php?page='.TEMPLAZA_FRAMEWORK.'_support'); ?>">
                            <div class="setup-step-info">
                                <h5 class="setup-step-heading uk-margin-small"><?php echo __('Get Support', 'templaza-framework'); ?></h5>
                                <p class="uk-margin-remove"><?php echo __('Documentation, help files, and video tutorials for beginners and professionals', 'templaza-framework');?></p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="setup-step p-4">
                            <div class="setup-step-info">
                                <h5 class="setup-step-heading uk-margin-small"><?php echo __('Useful Links', 'templaza-framework'); ?></h5>
                                <dl class="uk-description-list uk-margin-remove-bottom">
                                    <dt><?php echo __('Author:', 'templaza-framework'); ?></dt>
                                    <dd><a class="uk-link-text" href="https://www.templaza.com/"><?php echo __('TemPlaza.com', 'templaza-framework'); ?></a></dd>
                                    <dt><?php echo __('Forum Support:', 'templaza-framework'); ?></dt>
                                    <dd><a class="uk-link-text" href="https://www.templaza.com/forums.html"><?php echo __('Ask a question.', 'templaza-framework'); ?></a></dd>
                                    <dt><?php echo __('Online Document:', 'templaza-framework'); ?></dt>
                                    <dd><a class="uk-link-text" href="https://docs.templaza.com/themes/<?php echo strtolower($theme -> get('Name')); ?>"><?php echo sprintf(__('Check %s Documentation.'), $theme -> get('Name')); ?></a></dd>
                                </dl>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

