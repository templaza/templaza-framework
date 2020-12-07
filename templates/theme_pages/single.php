<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

$id             = isset($atts['id'])?$atts['id']:time();
$custom_class   = isset($atts['custom-container-class'])?' '.$atts['custom-container-class']:'';

$options            = Functions::get_theme_options();
$post_type          = get_post_type(get_the_ID());
$prefix             = $post_type.'-single';

if($post_type == 'post'){
    $prefix = 'blog-single';
}

$show_tag           = isset($options[$prefix.'-tag'])?(bool) $options[$prefix.'-tag']:true;
$show_date          = isset($options[$prefix.'-date'])?(bool) $options[$prefix.'-date']:true;
$show_share         = isset($options[$prefix.'-share'])?(bool) $options[$prefix.'-share']:true;
$show_title         = isset($options[$prefix.'-title'])?(bool) $options[$prefix.'-title']:true;
$show_author        = isset($options[$prefix.'-author'])?(bool) $options[$prefix.'-author']:true;
$show_related       = isset($options[$prefix.'-related'])?(bool) $options[$prefix.'-related']:true;
$show_comment       = isset($options[$prefix.'-comment'])?(bool) $options[$prefix.'-comment']:true;
$show_category      = isset($options[$prefix.'-category'])?(bool) $options[$prefix.'-category']:true;
$show_description   = isset($options[$prefix.'-description'])?(bool) $options[$prefix.'-description']:true;
?>
<div id="templaza-single-<?php echo $id; ?>" class="templaza-single templaza-single-<?php echo get_post_type().$custom_class; ?>">
    <?php
    if(have_posts()):
        while(have_posts()):the_post();
            ?>
            <div class="templaza-news-item templaza-archive-item">
                <div class="templaza-news-image templaza-image-circle">
                    <?php echo get_the_post_thumbnail(get_the_ID()); ?>
                </div>
                <div class="templaza-news-info">

                    <?php if($show_date || $show_author){ ?>
                    <div class="info">
                        <?php if($show_date){ ?>
                        <span class="date">
                            <?php echo get_the_date(); ?>
                        </span>
                        <?php } ?>
                        <?php if($show_author){ ?>
                        <span class="author">
                            <?php echo sprintf(esc_html__('By %s', $this -> text_domain), get_the_author()); ?>
                        </span>
                        <?php } ?>
                    </div>
                    <?php } ?>
                    <?php if($show_title){ ?>
                    <h1 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                    <?php } ?>
                    <?php
                    if($show_description) {
                        the_content();
                    }
                    ?>
                    <?php if($show_share){ ?>
                    <div class="templaza-share">
                        <strong><?php echo esc_html_e('Share: ','templaza-blank');?></strong>
                        <div class="socials">
                            <!-- Facebook Button -->
                            <a href="javascript: void(0)" onclick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php
                            echo get_the_title(get_the_ID()); ?>&amp;p[url]=<?php echo get_the_permalink(get_the_ID());
                            ?>','sharer','toolbar=0,status=0,width=580,height=325');" class="share-link facebook"><i class="fab fa-facebook-f"></i><?php
                                echo esc_html_e(' Facebook','templaza-blank');?></a>

                            <!-- Twitter Button -->
                            <?php
                            $url    = 'http://twitter.com/share?text='.esc_url(get_the_title(get_the_ID()))
                                .'&amp;url='.esc_url(get_the_permalink(get_the_ID()));
                            ?>
                            <a href="javascript: void(0)" onclick="window.open(<?php echo '\''.$url.'\'';
                            ?>,'sharer','toolbar=0,status=0,width=580,height=325');" class="share-link twitter"><i class="fab fa-twitter"></i><?php
                                echo esc_html_e(' Twitter','templaza-blank');?></a>

                            <!-- Pinterest Button -->
                            <?php
                            $url    = 'http://pinterest.com/pin/create/button/?url='
                                .esc_url(get_the_permalink(get_the_ID())).'&amp;description='.esc_url(get_the_title(get_the_ID()));
                            ?>
                            <a href="javascript: void(0)" onclick="window.open(<?php echo '\''.$url.'\'';
                            ?>,'sharer','toolbar=0,status=0,width=580,height=325');" class="share-link linkedin"><i class="fab fa-linkedin"></i><?php
                                echo esc_html_e(' Linkedin','templaza-blank');?></a>
                        </div>
                    </div>
                    <?php } ?>
                    <?php
                    if($show_tag && has_term('', 'post_tag')){ ?>
                        <div class="templaza-tag">
                            <strong><?php echo esc_html_e('Tags: ','templaza-blank');?></strong>
                            <span><?php the_terms(get_the_ID(), 'post_tag', '', ', '); ?></span>
                        </div>
                    <?php } ?>
                    <?php
//                    do_action('templaza_related_posts');

                    if($show_related){
                        Functions::get_related_posts();
                    }
                    if ($show_comment && ( comments_open() || get_comments_number() )) {
                        comments_template();
                    }
                    ?>
                </div>
            </div>
        <?php
        endwhile;
    endif;
    ?>
</div>