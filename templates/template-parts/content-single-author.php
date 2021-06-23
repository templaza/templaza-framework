<?php
defined('ABSPATH') or exit();
?>
<div class="templaza-single-author uk-margin-large-bottom">
    <div class="templaza-block-author uk-flex-middle uk-margin-bottom" data-uk-grid>
        <div class="uk-width-auto templaza-block-author-avata">
            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID')));?>">
                <?php echo wp_kses_post(get_avatar( get_the_author_meta('ID'),120)); ?>
            </a>
        </div>
        <div class="uk-width-expand templaza-block-author-info">
            <h4 class="templaza-block-author-name">
                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID')));?>">
                    <?php the_author();?>
                </a>
            </h4>
        </div>
    </div>
    <div class="templaza-block-author-desc">
        <p class="templaza-block-author-desc uk-margin-remove">
            <?php the_author_meta('description'); ?>
        </p>
        <div class="templaza-block-author-social">
            <?php do_action('templaza-author-social');?>
        </div>
    </div>
</div>