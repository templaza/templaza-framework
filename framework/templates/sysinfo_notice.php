<?php
/**
 * Base layout for all admin pages
 */

defined('TEMPLAZA_FRAMEWORK') or die;

?>
<?php _e('<strong>Notice:</strong> Currently, there are some values in PHP settings not sufficient enough for the theme to work properly. Please configure them again to ensure the theme has a smooth performance.',
    $this -> text_domain);?>
<div class="action uk-margin-small-top">
    <a class="uk-button uk-button-danger uk-button-small" href="<?php
    echo esc_url(admin_url('admin.php?page=templaza-framework#system-information'));
    ?>"><?php _e('See PHP Settings', $this -> text_domain);?></a>
</div>

