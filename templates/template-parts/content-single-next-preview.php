<?php
defined('ABSPATH') or exit();
$next_post = get_next_post();
$prev_post = get_previous_post();
if ( $next_post || $prev_post ) {
    $pagination_classes = '';
    if ( ! $next_post ) {
        $pagination_classes = ' only-one only-prev';
    } elseif ( ! $prev_post ) {
        $pagination_classes = ' only-one only-next';
    }
    ?>
    <div class="uk-clearfix templaza-post-navigation uk-child-width-1-2 uk-margin-large-bottom uk-grid-collapse" data-uk-grid>
        <div class="templaza-single-preview-post">
            <?php
            if ( $prev_post ) {
                ?>
                <a class="previous-post" href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
                    <p class="uk-flex uk-flex-middle uk-margin-remove-vertical">
                        <span class="uk-margin-small-right uk-visible@s" data-uk-icon="arrow-left"></span>
                        <span class="title"><?php echo esc_html_e('Previous Post','templaza-framework'); ?></span>
                    </p>
                    <h5 class="uk-margin-remove-vertical"><?php echo esc_html($prev_post->post_title); ?></h5>
                </a>
                <?php
            }
            ?>
        </div>
        <div class="templaza-single-next-post uk-text-right">
            <?php
            if ( $next_post ) {
                ?>
                <a class="next-post" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
                    <p class="uk-flex uk-flex-middle uk-flex-right uk-margin-remove-vertical">
                        <span class="title"><?php echo esc_html_e('Next Post','templaza-framework'); ?></span>
                        <span class="uk-margin-small-left uk-visible@s" data-uk-icon="arrow-right"></span>
                    </p>
                    <h5 class="uk-margin-medium-left uk-margin-remove-vertical"><?php echo esc_html($next_post->post_title); ?></h5>
                </a>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
}