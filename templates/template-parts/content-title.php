<?php
defined('ABSPATH') or exit();
?>
<h3 class="templaza-blog-item-title title">
    <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
    <?php
    if(is_sticky(get_the_ID()) && has_post_thumbnail()==false){
        ?>
        <span class="templaza-sticky-post" title="<?php echo esc_html__('Sticky Post','templaza-framework');?>"><i class="fas fa-thumbtack"></i></span>
        <?php
    }
    ?>
</h3>