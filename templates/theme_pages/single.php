<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\CSS;
use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$id             = isset($atts['id'])?$atts['id']:time();
$custom_class   = isset($atts['custom-container-class'])?' '.$atts['custom-container-class']:'';

$options            = Functions::get_theme_options();
$post_type          = get_post_type(get_the_ID());
$prefix             = $post_type.'-single';

if($post_type == 'post'){
    $prefix = 'blog-single';
}
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
$blog_slider_autoplay   = isset($options['blog-slider-autoplay'])?filter_var($options['blog-slider-autoplay'], FILTER_VALIDATE_BOOLEAN):true;
$blog_thumbnail_size    = $options[$prefix.'-thumbnail-size'];
$blog_thumbnail_effect  = $options[$prefix.'-thumbnail-effect'];

$blog_slider_animation  = $options['blog-slider-animation'];
$blog_slider_nav        = isset($options['blog-slider-nav'])?filter_var($options['blog-slider-nav'], FILTER_VALIDATE_BOOLEAN):true;

$blog_slider_autoplay   = $blog_slider_autoplay?'true':'false';
$blog_slider_nav        = $blog_slider_nav?'true':'false';

?>
<div class="templaza-blog">
    <div id="templaza-single-<?php echo $id; ?>" class="templaza-single templaza-single-<?php
    echo get_post_type().$custom_class; ?> templaza-blog-body">
        <?php
        if ( have_posts() ) : while (have_posts()) : the_post() ;
            do_action('templaza_set_postviews',get_the_ID());
            $templaza_comment_count  = wp_count_comments(get_the_ID());
            $templaza_class_icon = '';
            if(has_post_format('gallery')){
                $templaza_class_icon = 'fas fa-images';
            }elseif(has_post_format('video')){
                $templaza_class_icon = 'fas fa-play';
            }elseif(has_post_format('audio')){
                $templaza_class_icon = 'fab fa-soundcloud';
            }elseif(has_post_format('link')){
                $templaza_class_icon = 'fas fa-link';
            }elseif(has_post_format('quote')){
                $templaza_class_icon = 'fas fa-quote-left';
            }else{
                $templaza_class_icon = 'fas fa-image';
            }
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('templaza-blog-item'); ?>>
                <div class="templaza-blog-item-wrap">
                    <div class="templaza-blog-item-content templaza-archive-item  templaza-single-box">
                        <?php if ($show_title): ?>
                            <h1 class="templaza-blog-item-title title">
                                <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                                <?php
                                if(is_sticky(get_the_ID()) && has_post_thumbnail()==false){
                                    ?>
                                    <span class="templaza-sticky-post" title="<?php echo esc_html__('Sticky Post','templaza-framework');?>"><i class="fas fa-thumbtack"></i></span>
                                    <?php
                                }
                                ?>
                            </h1>
                        <?php endif; ?>
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
                                <span><i class="fas fa-comment"></i><?php echo esc_html__('Comments','templaza-framework'); ?> <?php echo esc_html($templaza_comment_count->total_comments)?></span>
                            <?php } ?>
                            <?php if($show_post_view):?>
                                <span class="views"><i class="fas fa-eye"></i>
                                    <?php do_action('templaza_get_postviews',get_the_ID()); ?></span>
                            <?php endif; ?>
                            <?php if($show_category){ ?>
                                <span class="category">
                                <i class="fas fa-folder"></i> <?php the_category(', '); ?>
                                </span>
                            <?php } ?>

                            <?php
                            edit_post_link();
                            ?>
                        </div>
                        <?php
                        if ($show_thumbnail):?>
                        <div class="uk-margin-large templaza-single-feature">
                            <?php if (has_post_format('link')) : ?>
                                <?php if ($show_description): ?>
                                    <div class="templaza-blog-item-link uk-margin-top uk-margin-bottom">
                                        <?php $templaza_link = get_post_meta(get_the_ID(), '_format_link_url', true); ?>
                                        <a target="_blank" title="<?php the_title(); ?>"
                                           href="<?php echo esc_url($templaza_link); ?>">
                                            <?php echo esc_html($templaza_link); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php elseif (has_post_format('quote')):
                                $templaza_quote_name = get_post_meta(get_the_ID(), '_format_quote_source_name', true);
                                $templaza_quote_url = get_post_meta(get_the_ID(), '_format_quote_source_url', true);
                                $templaza_quote_content = get_post_meta(get_the_ID(), '_format_quote_source_content', true);
                                ?>
                                <?php if ($show_description): ?>
                                <div class="templaza-blog-item-quote uk-margin-top uk-margin-bottom">
                                    <?php
                                    echo esc_html($templaza_quote_content);
                                    ?>
                                </div>
                            <?php endif; ?>
                            <?php endif; ?>
                            <?php
                            if (has_post_format('gallery')) :?>
                                <?php $templaza_gallery = get_post_meta(get_the_ID(), '_format_gallery_images', true);
                                $tinyid = uniqid('tiny_');
                                if ($templaza_gallery) : ?>
                                    <div id ="<?php echo esc_attr($tinyid);?>" class="templaza-blog-slider templaza-archive-gallery">
                                        <?php foreach ($templaza_gallery as $templaza_image) : ?>
                                            <?php $templaza_image_src = wp_get_attachment_image_src($templaza_image,$blog_thumbnail_size );?>
                                            <?php $templaza_caption = get_post_field('post_excerpt', $templaza_image); ?>
                                            <div class="blog-gallery-img-item">
                                                <div class="templaza-thumbnail-effect templaza-<?php echo esc_attr($blog_thumbnail_effect);?>">
                                                        <img src="<?php echo esc_url($templaza_image_src[0]); ?>"
                                                             <?php if ($templaza_caption) : ?>title="<?php echo esc_attr($templaza_caption); ?>"<?php endif; ?> />
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php
                                    echo templaza_blog_get_tinyslider($tinyid);
                                else: ?>
                                    <div class="templaza-blog-item-img templaza-thumbnail-effect templaza-<?php echo esc_attr($blog_thumbnail_effect);?>">
                                            <?php the_post_thumbnail($blog_thumbnail_size); ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(has_post_thumbnail() && empty(has_post_format('gallery')) && empty(has_post_format('audio'))
                                && empty(has_post_format('video')) && empty(has_post_format('quote'))&& empty(has_post_format('link'))){
                                ?>
                                    <div class="templaza-blog-item-img templaza-thumbnail-effect templaza-<?php echo esc_attr($blog_thumbnail_effect);?>">
                                            <?php the_post_thumbnail($blog_thumbnail_size); ?>
                                    </div>
                            <?php
                            }
                            ?>
                            <?php if (has_post_format('video')) : ?>
                                <?php $templaza_video = get_post_meta(get_the_ID(), '_format_video_embed', true); ?>
                                <?php
                                if ($templaza_video != ''):
                                    ?>
                                    <div class="templaza-blog-item-video">
                                        <?php if (wp_oembed_get($templaza_video)) : ?>
                                            <?php echo wp_oembed_get($templaza_video); ?>
                                        <?php else : ?>
                                            <?php echo wp_oembed_get($templaza_video); ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if (has_post_format('audio')) : ?>
                                <?php $templaza_audio = get_post_meta(get_the_ID(), '_format_audio_embed', true); ?>
                                <?php if ($templaza_audio != ''): ?>
                                    <div class="templaza-blog-item-audio">
                                        <?php if (wp_oembed_get($templaza_audio)) : ?>
                                            <?php echo wp_oembed_get($templaza_audio); ?>
                                        <?php else : ?>
                                            <?php echo wp_oembed_get($templaza_audio); ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if (has_post_format('link')) : ?>
                                <?php if ($show_thumbnail_link): ?>
                                    <div class="templaza-blog-item-img templaza-thumbnail-effect templaza-<?php echo esc_attr($blog_thumbnail_effect);?>">
                                            <?php the_post_thumbnail($blog_thumbnail_size); ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if (has_post_format('quote')) : ?>
                                <?php if ($show_thumbnail_quote): ?>
                                    <div class="templaza-blog-item-img templaza-thumbnail-effect templaza-<?php echo esc_attr($blog_thumbnail_effect);?>">
                                            <?php the_post_thumbnail($blog_thumbnail_size); ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <?php
                        endif;
                        ?>
                        <div class="templaza-single-content uk-margin-large-bottom">
                            <?php
                            the_content();
                            wp_link_pages();
                            ?>
                        </div>

                        <?php if($show_tag && has_tag()){ ?>
                            <div class="templaza-single-tags uk-margin-large-bottom">
                                <i class="fas fa-tags"></i> <?php the_tags(); ?>
                            </div>
                        <?php } ?>
                        <?php if($show_share){
                            ?>
                            <div class="templaza-single-share uk-margin-large-bottom">
                                <?php do_action('templaza_share_social'); ?>
                            </div>
                        <?php }
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
                                    <span class="arrow" aria-hidden="true">&larr;</span>
                                    <span class="title"><span class="title-inner"><?php echo wp_kses_post( get_the_title( $prev_post->ID ) ); ?></span></span>
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
                                        <span class="arrow" aria-hidden="true">&rarr;</span>
                                        <span class="title"><span class="title-inner"><?php echo wp_kses_post( get_the_title( $next_post->ID ) ); ?></span></span>
                                    </a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                            }
                         if($show_author){?>
                            <div class="templaza-single-author uk-margin-large-bottom">
                                <div class="templaza-block-author" uk-grid>
                                    <div class="uk-width-auto templaza-block-author-avata">
                                        <a href="<?php echo balanceTags(get_author_posts_url(get_the_author_meta('ID')));?>">
                                        <?php echo balanceTags(get_avatar( get_the_author_meta('ID'),120)); ?>
                                        </a>
                                    </div>
                                    <div class="uk-width-expand templaza-block-author-info">
                                        <h3 class="templaza-block-author-name">
                                            <a href="<?php echo balanceTags(get_author_posts_url(get_the_author_meta('ID')));?>">
                                                <?php the_author();?>
                                            </a>
                                        </h3>
                                        <p class="templaza-block-author-desc">
                                            <?php the_author_meta('description'); ?>
                                        </p>
                                        <div class="templaza-block-author-social">
                                            <?php do_action('templaza-author-social');?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if($show_comment){ ?>
                            <div class="templaza-single-comment ">
                                 <?php comments_template( '', true ); ?>
                            </div><!-- end comments -->
                        <?php } ?>
                    </div>

                </div>
            </article>
        <?php
        endwhile; // end while ( have_posts )
        endif; // end if ( have_posts )
        ?>
    </div>
</div>