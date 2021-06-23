<?php
defined('ABSPATH') or exit();

?>
<div class="templaza-blog-desc uk-margin-top">
    <?php
    if (!has_excerpt()) {
        the_content( __( 'Continue reading', 'templaza-framework' ) );
    } else {
        the_excerpt();
    }
    ?>
</div>