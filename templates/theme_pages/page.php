<?php

defined('TEMPLAZA_FRAMEWORK') or exit();


    $id             = isset($atts['id'])?$atts['id']:time();
    //$enable_title   = isset($atts['enable-header-title'])?(bool)$atts['enable-header-title']:true;
    //$enable_pags    = isset($atts['enable-pagination'])?(bool)$atts['enable-pagination']:true;
    $custom_class   = isset($atts['custom-container-class'])?' '.$atts['custom-container-class']:'';

    ?>
    <div id="templaza-page-<?php echo esc_attr($id); ?>" class="templaza-page templaza-page-<?php echo esc_attr(get_post_type().$custom_class);?>">
        <?php

        // Start the Loop.
        while ( have_posts() ) :
            the_post();

    //        if($enable_title){
    //            echo '<h1 class="title">'.the_title('', '', false).'</h1>';
    //        }

            get_template_part( 'template-parts/content/content', 'page' );

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }

    //        if($enable_pags){
    //            wp_link_pages();
    //        }

        endwhile; // End the loop.
        ?>

    </div><!-- #main -->
