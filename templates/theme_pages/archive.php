<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;

$id             = isset($atts['id'])?$atts['id']:time();
$custom_class   = isset($atts['custom-container-class'])?' '.$atts['custom-container-class']:'';

$options            = Functions::get_theme_options();
$post_type          = get_post_type(get_the_ID());
$prefix             = $post_type.'-page';


if($post_type == 'post'){
    $prefix = 'blog-page';
}

$show_tag           = isset($options[$prefix.'-tag'])?(bool) $options[$prefix.'-tag']:true;
$show_date          = isset($options[$prefix.'-date'])?(bool) $options[$prefix.'-date']:true;
$show_title         = isset($options[$prefix.'-title'])?(bool) $options[$prefix.'-title']:true;
$show_author        = isset($options[$prefix.'-author'])?(bool) $options[$prefix.'-author']:true;
$show_category      = isset($options[$prefix.'-category'])?(bool) $options[$prefix.'-category']:true;
$show_description   = isset($options[$prefix.'-description'])?(bool) $options[$prefix.'-description']:true;

?>
<div id="templaza-archive-<?php echo $id;
?>" class="templaza-archive templaza-recent-news templaza-archive-<?php echo get_post_type().$custom_class; ?>">
    <?php
    if (have_posts()) {
        // Start the Loop.
        while (have_posts()) :
            the_post();

            ?>
            <div class="templaza-news-item templaza-archive-item">
                <div class="templaza-news-image templaza-image-circle">
                    <a href="<?php the_permalink(); ?>">
                        <?php echo get_the_post_thumbnail(get_the_ID()); ?>
                    </a>
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
                            <?php echo sprintf(__('By %s'), get_the_author()); ?>
                        </span>
                        <?php } ?>
                    </div>
                    <?php } ?>
                    <?php if($show_title){ ?>
                    <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <?php } ?>
                    <?php if($show_description){ ?>
                    <p class="excerpt"><?php echo wp_strip_all_tags(get_the_excerpt(), true); ?></p>
                    <?php } ?>
                    <?php
                    echo '<div class="sub-info"><a class="readmore" href="' . get_the_permalink() . '">'
                        . esc_html__('Continue Reading', 'templaza-blank') . '</a></div>';
                    ?>
                </div>

<!--                --><?php //if($show_title){ ?>
<!--                    <h3 class="title"><a href="--><?php //the_permalink(); ?><!--">--><?php //the_title(); ?><!--</a></h3>-->
<!--                --><?php //} ?>
<!--                --><?php //if($show_description){ ?>
<!--                    <p class="excerpt">--><?php //echo wp_strip_all_tags(get_the_excerpt(), true); ?><!--</p>-->
<!--                --><?php //} ?>
<!--                --><?php
//                echo '<div class="sub-info"><a class="readmore" href="' . get_the_permalink() . '">'
//                    . esc_html__('Continue Reading', 'templaza-blank') . '</a></div>';
//                ?>
            </div>
    <?php

        endwhile; // End the loop.
    }
    ?>
</div>
