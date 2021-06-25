<?php
defined('ABSPATH') or exit();
?>
<h1 class="templaza-blog-item-title title uk-container-small uk-container uk-text-center">
    <?php the_title(); ?>
    <?php
    if(is_sticky(get_the_ID()) && has_post_thumbnail()==false){
        ?>
        <span class="templaza-sticky-post" title="<?php echo esc_html__('Sticky Post','templaza-framework');?>"><i class="fas fa-thumbtack"></i></span>
        <?php
    }
    ?>
</h1>