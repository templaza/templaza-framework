<?php
defined('ABSPATH') or exit();
if(get_the_author_meta('description')){
?>
<div class="templaza-single-author uk-margin-large-bottom">
    <div class="templaza-block-author uk-flex-middle uk-margin-bottom" data-uk-grid>
        <div class="uk-width-auto templaza-block-author-avata">
            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID')));?>">
                <?php echo wp_kses_post(get_avatar( get_the_author_meta('ID'),120)); ?>
            </a>
        </div>
        <div class="uk-width-expand templaza-block-author-info uk-flex-middle">
            <h4 class="templaza-block-author-name">
                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID')));?>">
                    <?php the_author();?>
                </a>
            </h4>
            <div class="templaza-block-author-social uk-text-meta uk-grid-small" data-uk-grid>
                <?php do_action('templaza_author_social');?>
            </div>
        </div>
    </div>
    <div class="templaza-block-author-desc">
        <p class="templaza-block-author-desc uk-margin-remove">
            <?php the_author_meta('description'); ?>
        </p>
    </div>
</div>
<?php
}