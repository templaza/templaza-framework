<?php
defined('ABSPATH') or exit();
use TemPlazaFramework\Functions;
$options            = Functions::get_theme_options();
$post_type          = get_post_type(get_the_ID());
$prefix             = $post_type.'-page';
if($post_type == 'post'){
    $prefix = 'blog-page';
}
if($post_type == 'post' && is_single()){
    $prefix = 'blog-single';
}
$show_tag           = isset($options[$prefix.'-tag'])?filter_var($options[$prefix.'-tag'], FILTER_VALIDATE_BOOLEAN):true;
$show_comment_count = isset($options[$prefix.'-comment-count'])?filter_var($options[$prefix.'-comment-count'], FILTER_VALIDATE_BOOLEAN):true;
$show_date          = isset($options[$prefix.'-date'])?filter_var($options[$prefix.'-date'], FILTER_VALIDATE_BOOLEAN):true;
$show_author        = isset($options[$prefix.'-author'])?filter_var($options[$prefix.'-author'], FILTER_VALIDATE_BOOLEAN):true;
$show_category      = isset($options[$prefix.'-category'])?filter_var($options[$prefix.'-category'], FILTER_VALIDATE_BOOLEAN):true;
$show_date          = isset($options[$prefix.'-date'])?filter_var($options[$prefix.'-date'], FILTER_VALIDATE_BOOLEAN):true;
$show_post_view         = isset($options[$prefix.'-post-view'])?filter_var($options[$prefix.'-post-view'], FILTER_VALIDATE_BOOLEAN):true;
?>
<div class="templaza-blog-item-Info templaza-post-meta uk-article-meta">
    <?php if ($show_date){ ?>
        <span><i class="fa fa-calendar"></i><?php echo esc_attr(get_the_date()); ?></span>
    <?php } ?>
    <?php if($show_author){ ?>
        <span class="author">
            <i class="fas fa-user"></i>
            <?php echo get_the_author_posts_link();?>
        </span>
    <?php } ?>
    <?php if ($show_comment_count){ ?>
        <span class="comment_count">
            <i class="fas fa-comment"></i>
            <?php do_action('templaza_get_commentcount_post'); ?>
        </span>
    <?php } ?>
    <?php if($show_post_view):?>
        <span class="views">
            <i class="fas fa-eye"></i>
            <?php do_action('templaza_get_postviews',get_the_ID()); ?>
        </span>
    <?php endif; ?>
    <?php if($show_category){ ?>
        <span class="category">
            <i class="fas fa-folder"></i>
            <?php the_category(', '); ?>
        </span>
    <?php } ?>
    <?php if($show_tag && has_tag()){ ?>
        <span class="tag">
            <i class="fas fa-tags"></i>
            <?php the_tags(); ?>
        </span>
    <?php } ?>
    <?php
    edit_post_link();
    ?>
</div>