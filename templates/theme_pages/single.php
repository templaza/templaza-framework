<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\CSS;
use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$id             = isset($atts['id'])?$atts['id']:time();
$custom_class   = isset($atts['custom-container-class'])?' '.$atts['custom-container-class']:'';

$options            = Functions::get_theme_options();
$post_type          = get_post_type(get_the_ID());
$prefix             = 'blog-single';

$show_thumbnail         = isset($options[$prefix.'-thumbnail'])?filter_var($options[$prefix.'-thumbnail'], FILTER_VALIDATE_BOOLEAN):true;
$show_tag               = isset($options[$prefix.'-tag'])?filter_var($options[$prefix.'-tag'], FILTER_VALIDATE_BOOLEAN):true;
$show_date              = isset($options[$prefix.'-date'])?filter_var($options[$prefix.'-date'], FILTER_VALIDATE_BOOLEAN):true;
$show_share             = isset($options[$prefix.'-share'])?filter_var($options[$prefix.'-share'], FILTER_VALIDATE_BOOLEAN):true;
$show_title             = isset($options[$prefix.'-title'])?filter_var($options[$prefix.'-title'], FILTER_VALIDATE_BOOLEAN):true;
$show_author            = isset($options[$prefix.'-author'])?filter_var($options[$prefix.'-author'], FILTER_VALIDATE_BOOLEAN):true;
$show_related           = isset($options[$prefix.'-related'])?filter_var($options[$prefix.'-related'], FILTER_VALIDATE_BOOLEAN):true;
$show_comment           = isset($options[$prefix.'-comment'])?filter_var($options[$prefix.'-comment'], FILTER_VALIDATE_BOOLEAN):true;
$show_category          = isset($options[$prefix.'-category'])?filter_var($options[$prefix.'-category'], FILTER_VALIDATE_BOOLEAN):true;
$show_description       = isset($options[$prefix.'-description'])?filter_var($options[$prefix.'-description'], FILTER_VALIDATE_BOOLEAN):true;
$show_comment_count     = isset($options[$prefix.'-comment-count'])?filter_var($options[$prefix.'-comment-count'], FILTER_VALIDATE_BOOLEAN):true;
$show_post_view         = isset($options[$prefix.'-post-view'])?filter_var($options[$prefix.'-post-view'], FILTER_VALIDATE_BOOLEAN):true;
$show_post_next_preview = isset($options[$prefix.'-next-preview'])?filter_var($options[$prefix.'-next-preview'], FILTER_VALIDATE_BOOLEAN):true;

$blog_slider_autoplay   = isset($options['blog-slider-autoplay'])?filter_var($options['blog-slider-autoplay'], FILTER_VALIDATE_BOOLEAN):true;
$blog_thumbnail_size    = $options[$prefix.'-thumbnail-size'];
$blog_thumbnail_effect  = $options[$prefix.'-thumbnail-effect'];

$blog_slider_animation  = $options['blog-slider-animation'];
$blog_slider_nav        = isset($options['blog-slider-nav'])?filter_var($options['blog-slider-nav'], FILTER_VALIDATE_BOOLEAN):true;
$blog_slider_kenburns        = isset($options['blog-slider-kenburns'])?filter_var($options['blog-slider-kenburns'], FILTER_VALIDATE_BOOLEAN):true;

$blog_slider_options = '';
if($blog_slider_autoplay == true){
    $blog_slider_options .='autoplay: true; ';
}
if($blog_slider_animation != ''){
    $blog_slider_options .='animation: '.$blog_slider_animation. '';
}
?>
<div class="templaza-blog">
    <div id="templaza-single-<?php echo esc_attr($id); ?>" class="templaza-single templaza-single-<?php
    echo esc_attr($post_type.' '.$custom_class); ?> templaza-blog-body">
        <?php
        if ( have_posts() ) : while (have_posts()) : the_post() ;
            do_action('templaza_set_postviews',get_the_ID());
            ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class('templaza-blog-item'); ?>>
                <div class="templaza-blog-item-wrap">
                    <div class="templaza-blog-item-content templaza-archive-item  templaza-single-box">
                        <?php if ($show_title){
                            do_action('templaza_single_title_post');
                        }?>
                        <div class="uk-text-center">
                            <?php
                            do_action('templaza_single_meta_post');
                            ?>
                        </div>
                        <?php
                        if ($show_thumbnail):?>
                        <div class="uk-margin-large templaza-single-feature">
                            <?php
                            if (has_post_format('gallery')){
                                do_action('templaza_gallery_post');
                            }

                            if(has_post_thumbnail() && empty(has_post_format('gallery')) && empty(has_post_format('audio'))
                                && empty(has_post_format('video')) && empty(has_post_format('quote'))&& empty(has_post_format('link'))){
                                do_action('templaza_image_post');
                            }
                            if (has_post_format('video')){
                                do_action('templaza_video_post');
                            }
                            if (has_post_format('audio')){
                                do_action('templaza_audio_post');
                            }
                            if (has_post_format('link') || has_post_format('quote')){
                                do_action('templaza_image_post');
                            }
                            ?>

                        </div>
                        <?php
                        endif;
                        ?>
                        <div class="uk-container-small uk-container">
                            <div class="templaza-single-content uk-margin-medium-bottom">
                                <?php
                                if (has_post_format('link')){
                                    do_action('templaza_link_post');
                                }
                                if (has_post_format('quote')){
                                    do_action('templaza_quote_post');
                                }
                                the_content();
                                wp_link_pages();
                                ?>
                            </div>
                            <?php
                            if($show_tag && has_tag() && get_the_tag_list()){
                                do_action('templaza_single_tag_post');
                            }
                            if($show_share){
                                ?>
                                <div class="templaza-single-share uk-margin-large-bottom">
                                    <?php do_action('templaza_share_post'); ?>
                                </div>
                            <?php }
                            $post_nav = posts_nav_link();
                            if($show_post_next_preview){
                                do_action('templaza_single_next_post');
                            }
                            if($show_author){
                                do_action('templaza_single_author_post');
                            }
                            if($show_related){
                                do_action('templaza_single_related_post');
                            }
                            if($show_comment){ ?>
                                <div class="templaza-single-comment">
                                    <?php comments_template( '', true ); ?>
                                </div><!-- end comments -->
                                <?php
                            }
                            ?>
                        </div>

                    </div>

                </div>
            </div>
        <?php
        endwhile; // end while ( have_posts )
        endif; // end if ( have_posts )
        ?>
    </div>
</div>