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
    <div class="uk-clearfix templaza-single-other-post uk-margin-large-bottom">
        <div class="uk-float-left templaza-single-preview-post">
            <?php
            if ( $prev_post ) {
                ?>
                <a class="previous-post" href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
                    <span class="arrow" aria-hidden="true"><?php echo esc_html_e('&larr;','martha');?></span>
                    <span class="title"><span class="title-inner"><?php echo esc_html_e('Preview Post','martha'); ?></span></span>
                </a>
                <?php
            }
            ?>
        </div>
        <div class="uk-float-right templaza-single-next-post">
            <?php
            if ( $next_post ) {
                ?>
                <a class="next-post" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
                    <span class="arrow" aria-hidden="true"><?php echo esc_html_e('&rarr;','martha');?></span>
                    <span class="title"><span class="title-inner"><?php echo esc_html_e('Next Post','martha'); ?></span></span>
                </a>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
}