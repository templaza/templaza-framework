<?php
defined('ABSPATH') or exit();
?>
<div class="templaza-search-no-result uk-text-center">
    <p><?php esc_html_e( 'We could not find any results for your search. You can give it another try through the search form below.', 'templaza-framework' ); ?></p>
    <?php get_search_form(); ?>
</div>
