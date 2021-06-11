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
$show_tag           = isset($options[$prefix.'-tag'])?(bool) $options[$prefix.'-tag']:true;
$show_comment_count = isset($options[$prefix.'-comment-count'])?(bool) $options[$prefix.'-comment-count']:true;
$show_date          = isset($options[$prefix.'-date'])?(bool) $options[$prefix.'-date']:true;
$show_thumbnail     = isset($options[$prefix.'-thumbnail'])?(bool) $options[$prefix.'-thumbnail']:true;
$show_title         = isset($options[$prefix.'-title'])?(bool) $options[$prefix.'-title']:true;
$show_author        = isset($options[$prefix.'-author'])?(bool) $options[$prefix.'-author']:true;
$show_post_view     = isset($options[$prefix.'-post-view'])?(bool) $options[$prefix.'-post-view']:true;
$show_category      = isset($options[$prefix.'-category'])?(bool) $options[$prefix.'-category']:true;
$show_description   = isset($options[$prefix.'-description'])?(bool) $options[$prefix.'-description']:true;
$show_readmore      = isset($options[$prefix.'-readmore'])?(bool) $options[$prefix.'-readmore']:true;
$show_share         = isset($options[$prefix.'-share'])?(bool) $options[$prefix.'-share']:true;
$show_thumbnail_audio = isset($options[$prefix.'-thumb-audio'])?(bool) $options[$prefix.'-thumb-audio']:true;
$show_thumbnail_video = isset($options[$prefix.'-thumb-video'])?(bool) $options[$prefix.'-thumb-video']:true;
$show_thumbnail_link = isset($options[$prefix.'-thumb-link'])?(bool) $options[$prefix.'-thumb-link']:true;
$show_thumbnail_quote = isset($options[$prefix.'-thumb-quote'])?(bool) $options[$prefix.'-thumb-quote']:true;
$blog_cl = '';
$blog_slider_autoplay = isset($options['blog-slider-autoplay'])?(bool) $options['blog-slider-autoplay']:true;
$blog_slider_animation = $options['blog-slider-animation'];
$blog_slider_nav = isset($options['blog-slider-nav'])?(bool) $options['blog-slider-nav']:true;
if($blog_slider_autoplay==true){
    $blog_slider_autoplay='true';
}else{
    $blog_slider_autoplay = 'false';
}
if($blog_slider_nav==true){
    $blog_slider_nav='true';
}else{
    $blog_slider_nav = 'false';
}
if ($blog_layout == 'grid') {
    $bl_layout_cl = 'templaza-blog-grid row';
    $blog_cl = 'col';
}else{
    $bl_layout_cl = 'templaza-blog-list';
    $blog_cl = '';
}

?>
<div id="templaza-archive-<?php echo $id;?>" class="templaza-blog templaza-archive templaza-archive-<?php echo get_post_type().$custom_class; ?>">
    <div class="templaza-blog-body <?php echo esc_attr($bl_layout_cl);?>">
        <?php
        $d = 1;
        if (have_posts()) : while (have_posts()) : the_post();
            if(is_sticky(get_the_ID())){
                $stky_cl = 'templaza-sticky';
            }else{
                $stky_cl = '';
            }
            $templaza_comment_count = wp_count_comments(get_the_ID());
            $templaza_class_icon = '';
            if (has_post_format('gallery')) {
                $templaza_class_icon = 'fas fa-images';
            } elseif (has_post_format('video')) {
                $templaza_class_icon = 'fas fa-play';
            } elseif (has_post_format('audio')) {
                $templaza_class_icon = 'fab fa-soundcloud';
            } elseif (has_post_format('link')) {
                $templaza_class_icon = 'fas fa-link';
            } elseif (has_post_format('quote')) {
                $templaza_class_icon = 'fas fa-quote-left';
            } else {
                $templaza_class_icon = 'fas fa-image';
            }
            ?>
            <div id='post-<?php the_ID(); ?>' class="<?php echo esc_attr($blog_cl. ' '.$stky_cl); ?> templaza-blog-item ">
                <div class="templaza-blog-item-wrap">
                    <?php
                    if(is_sticky(get_the_ID()) && has_post_thumbnail()){
                        ?>
                        <span class="templaza-sticky-post" title="<?php echo esc_html__('Sticky Post','templaza-framework');?>"><i class="fas fa-thumbtack"></i></span>
                    <?php
                    }
                    if (has_post_format('gallery')) :?>
                        <?php if ($show_thumbnail): ?>
                            <?php $templaza_gallery = get_post_meta(get_the_ID(), '_format_gallery_images', true);
                            $tinyid = uniqid('tiny_');
                            if ($templaza_gallery) : ?>
                                <div id ="<?php echo esc_attr($tinyid);?>" class="templaza-blog-slider templaza-archive-gallery">
                                        <?php foreach ($templaza_gallery as $templaza_image) : ?>
                                            <?php $templaza_image_src = wp_get_attachment_image_src($templaza_image,$blog_thumbnail_size );?>
                                            <?php $templaza_caption = get_post_field('post_excerpt', $templaza_image); ?>
                                        <div class="blog-gallery-img-item">
                                            <div class="templaza-thumbnail-effect templaza-<?php echo esc_attr($blog_thumbnail_effect);?>">
                                                <a href="<?php the_permalink() ?>">
                                                    <img src="<?php echo esc_url($templaza_image_src[0]); ?>"
                                                         <?php if ($templaza_caption) : ?>title="<?php echo esc_attr($templaza_caption); ?>"<?php endif; ?> />
                                                </a>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                </div>
                            <?php
                                echo templaza_blog_get_tinyslider($tinyid);
                            else: ?>
                                <div class="templaza-blog-item-img templaza-thumbnail-effect templaza-<?php echo esc_attr($blog_thumbnail_effect);?>">
                                    <a href="<?php the_permalink() ?>">
                                        <?php the_post_thumbnail($blog_thumbnail_size); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php  endif; ?>
                    <?php if(has_post_thumbnail() && empty(has_post_format('gallery')) && empty(has_post_format('audio'))
                        && empty(has_post_format('video')) && empty(has_post_format('quote'))&& empty(has_post_format('link'))){
                        if ($show_thumbnail): ?>
                            <div class="templaza-blog-item-img templaza-thumbnail-effect templaza-<?php echo esc_attr($blog_thumbnail_effect);?>">
                                <a href="<?php the_permalink() ?>">
                                    <?php the_post_thumbnail($blog_thumbnail_size); ?>
                                </a>
                            </div>
                        <?php endif;
                    }
                    ?>
                    <?php if (has_post_format('video')) : ?>
                        <?php if ($show_thumbnail_video): ?>
                            <div class="templaza-blog-item-img templaza-thumbnail-effect templaza-<?php echo esc_attr($blog_thumbnail_effect);?>">
                                <a href="<?php the_permalink() ?>">
                                    <?php the_post_thumbnail($blog_thumbnail_size); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if ($show_thumbnail): ?>
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
                    <?php endif; ?>
                    <?php if (has_post_format('audio')) : ?>
                        <?php if ($show_thumbnail_audio): ?>
                            <div class="templaza-blog-item-img templaza-thumbnail-effect templaza-<?php echo esc_attr($blog_thumbnail_effect);?>">
                                <a href="<?php the_permalink() ?>">
                                    <?php the_post_thumbnail($blog_thumbnail_size); ?>
                                </a>
                            </div>
                        <?php else: ?>
                            <?php if ($show_thumbnail): ?>
                                <?php $templaza_audio = get_post_meta(get_the_ID(), '_format_audio_embed', true); ?>
                                <?php if ($templaza_audio != ''): ?>
                                    <div class="templaza-blog-item-audio">
                                        <?php if (wp_oembed_get($templaza_audio)) : ?>
                                            <?php echo wp_oembed_get($templaza_audio); ?>
                                        <?php else : ?>
                                            <?php echo balanceTags($templaza_audio); ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if (has_post_format('link')) : ?>
                        <?php if ($show_thumbnail_link): ?>
                            <div class="templaza-blog-item-img templaza-thumbnail-effect templaza-<?php echo esc_attr($blog_thumbnail_effect);?>">
                                <a href="<?php the_permalink() ?>">
                                    <?php the_post_thumbnail($blog_thumbnail_size); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if (has_post_format('quote')) : ?>
                        <?php if ($show_thumbnail_quote): ?>
                            <div class="templaza-blog-item-img templaza-thumbnail-effect templaza-<?php echo esc_attr($blog_thumbnail_effect);?>">
                                <a href="<?php the_permalink() ?>">
                                    <?php the_post_thumbnail($blog_thumbnail_size); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="templaza-blog-item-content templaza-archive-item">
                        <?php if ($show_title): ?>
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
                            <?php if($show_tag && has_tag()){ ?>
                                <span class="tag">
                                <i class="fas fa-tags"></i> <?php the_tags(); ?>
                                </span>
                            <?php } ?>
                            <?php
                            edit_post_link();
                            ?>
                        </div>

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
                        if ($show_description):
                            ?>
                        <div class="templaza-blog-desc uk-margin-top uk-margin-medium-bottom">
                        <?php
                            if (!has_excerpt()) {
                                the_content( __( 'Continue reading', 'templaza-framework' ) );
                            } else {
                                the_excerpt();
                            }
                            ?>
                            <div class="clr"></div>
                        </div>
                        <?php
                        endif;
                        if ($show_readmore) {
                            ?>
                            <a class="uk-button uk-margin-remove uk-button-text uk-icon-link  uk-icon" data-uk-icon="arrow-right" href="<?php the_permalink(); ?>">
                                <?php echo esc_html_e('Read more','martha');?>
                            </a>
                        <?php }
                        ?>
                        <?php if ($show_share):
                            do_action('templaza_share_social');
                        endif; ?>
                    </div>
                </div>
            </div>
            <?php
            if($d%$blog_grid_col==0 && $blog_layout == 'grid'){
                ?><div class="w-100"></div><?php
            }
            $d++;
        endwhile; // end while ( have_posts )
        endif; // end if ( have_posts )
        ?>
        <div class="templaza-blog-pagenavi">
            <?php
            if (function_exists('wp_pagenavi')):
                wp_pagenavi();
            else:
                templaza_pagination();
            endif;
            ?>
        </div>
    </div>
</div>