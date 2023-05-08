<?php
/**
 * Base layout for all admin pages
 */

defined('TEMPLAZA_FRAMEWORK') or die;

use TemPlazaFramework\Template_Admin;

?>
<div id="templaza-framework" class="templaza-framework__wrap mr-wrap">
    <div class="uk-padding-small uk-padding-remove-vertical">
        <?php
        $this -> the_header();
        $this -> the_notices();
        $this -> the_content();
        $this -> the_footer();
        ?>
    </div>
</div>
