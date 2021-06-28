<?php
/*
 * Archive Service
 */

defined('TEMPLAZA_FRAMEWORK') or exit();
use TemPlazaFramework\Functions;

$id             = isset($atts['id'])?$atts['id']:time();
$custom_class   = isset($atts['custom_container_class'])?' '.$atts['custom_container_class']:'';

$options            = Functions::get_theme_options();
$post_type          = get_post_type(get_the_ID());
$prefix             = $post_type.'-page';

if($post_type == 'post'){
    $prefix = 'blog-page';
}
if(isset($_GET['view'])){
    $blog_layout = $_GET['view'];
}else{
    $blog_layout        = $options[$prefix.'-layout'];
}
$blog_grid_col      = $options[$prefix.'-grid-column'];
$blog_thumbnail_size= $options[$prefix.'-thumbnail-size'];
$blog_thumbnail_effect = $options[$prefix.'-thumbnail-effect'];
$blog_leading      = isset($options[$prefix.'-leading'])?filter_var($options[$prefix.'-leading'], FILTER_VALIDATE_BOOLEAN):true;
$show_thumbnail     = isset($options[$prefix.'-thumbnail'])?filter_var($options[$prefix.'-thumbnail'], FILTER_VALIDATE_BOOLEAN):true;
$show_title         = isset($options[$prefix.'-title'])?filter_var($options[$prefix.'-title'], FILTER_VALIDATE_BOOLEAN):true;
$show_description   = isset($options[$prefix.'-description'])?filter_var($options[$prefix.'-description'], FILTER_VALIDATE_BOOLEAN):true;
$show_readmore      = isset($options[$prefix.'-readmore'])?filter_var($options[$prefix.'-readmore'], FILTER_VALIDATE_BOOLEAN):true;
$show_share         = isset($options[$prefix.'-share'])?filter_var($options[$prefix.'-share'], FILTER_VALIDATE_BOOLEAN):true;
$show_thumbnail_audio = isset($options[$prefix.'-thumb-audio'])?filter_var($options[$prefix.'-thumb-audio'], FILTER_VALIDATE_BOOLEAN):true;
$show_thumbnail_video = isset($options[$prefix.'-thumb-video'])?filter_var($options[$prefix.'-thumb-video'], FILTER_VALIDATE_BOOLEAN):true;
$show_thumbnail_link = isset($options[$prefix.'-thumb-link'])?filter_var($options[$prefix.'-thumb-link'], FILTER_VALIDATE_BOOLEAN):true;
$show_thumbnail_quote = isset($options[$prefix.'-thumb-quote'])?filter_var($options[$prefix.'-thumb-quote'], FILTER_VALIDATE_BOOLEAN):true;
$show_pagination = isset($options[$prefix.'-pagination'])?filter_var($options[$prefix.'-pagination'], FILTER_VALIDATE_BOOLEAN):true;
$blog_cl = '';
if ($blog_layout == 'grid') {
    $bl_layout_cl = 'templaza-blog-grid uk-child-width-1-'.$blog_grid_col.'@m';
    $blog_cl = '';
}else{
    $bl_layout_cl = 'templaza-blog-list uk-child-width-1-1';
    $blog_cl = '';
}
?>
<div id="templaza-archive-<?php echo esc_attr($id);?>" class="templaza-blog templaza-archive templaza-archive-<?php echo get_post_type().$custom_class; ?>">
    <div class="templaza-blog-body <?php echo esc_attr($bl_layout_cl);?>" data-uk-grid>
        <?php
        $d=1;
        if (have_posts()) : while (have_posts()) : the_post();
            if(is_sticky(get_the_ID())){
                $sticky_cl = 'templaza-sticky';
            }else{
                $sticky_cl = '';
            }
            if($blog_leading && $d==1 && $blog_layout=='grid'){
                $lead = 'uk-width-1-1';
                $wrap_lead_content = 'uk-container-small uk-container templaza-item-lead';
            }else{
                $lead = $wrap_lead_content = ' ';
            }
            ?>
            <div id='post-<?php the_ID(); ?>' class="<?php echo esc_attr($blog_cl. ' '.$sticky_cl.' '.$lead); ?> templaza-blog-item ">
                <div class="templaza-blog-item-wrap">
                    <?php
                    if(is_sticky(get_the_ID()) && has_post_thumbnail()){
                        ?>
                        <span class="templaza-sticky-post" title="<?php echo esc_html__('Sticky Post','templaza-framework');?>"><i class="fas fa-thumbtack"></i></span>
                        <?php
                    }
                    if ($show_thumbnail){
                        if (has_post_format('gallery')) {
                            do_action('templaza_gallery_post');
                        }
                        if(has_post_thumbnail() && empty(has_post_format('gallery')) && empty(has_post_format('audio'))
                        && empty(has_post_format('video')) && empty(has_post_format('quote'))&& empty(has_post_format('link'))){
                            do_action('templaza_image_post');
                        }
                        if (has_post_format('video')) {
                            if ($show_thumbnail_video){
                                do_action('templaza_image_post');
                            }else{
                                do_action('templaza_video_post');
                            }
                        }
                        if (has_post_format('audio')){
                            if ($show_thumbnail_audio){
                                do_action('templaza_image_post');
                            }else{
                                do_action('templaza_audio_post');
                            }
                        }
                        if (has_post_format('link')){
                            if ($show_thumbnail_link){
                                do_action('templaza_image_post');
                            }
                        }
                        if (has_post_format('quote')){
                            if ($show_thumbnail_quote){
                                do_action('templaza_image_post');
                            }
                        }
                    }
                    ?>
                    <div class="templaza-blog-item-content templaza-archive-item <?php echo esc_attr($wrap_lead_content);?>">
                        <?php
                        if ($show_title){
                            do_action('templaza_title_post');
                        }
                        do_action('templaza_meta_post');

                        if (has_post_format('link')){
                            do_action('templaza_link_post');
                        }
                        if (has_post_format('quote')){
                            do_action('templaza_quote_post');
                        }
                        if ($show_description){
                            do_action('templaza_excerpt_post');
                        }
                        if ($show_share) {
                            do_action('templaza_share_post');
                        }
                        if ($show_readmore) {
                            do_action('templaza_readmore_post');
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
            $d++;
        endwhile; // end while ( have_posts )

        endif; // end if ( have_posts )
        ?>
    </div>
    <?php if($show_pagination){?>
    <div class="templaza-blog-pagenavi">
        <?php
        do_action('templaza_pagination');
        ?>
    </div>
    <?php } ?>
</div>