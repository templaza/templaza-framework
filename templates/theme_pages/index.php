<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

$id             = isset($atts['id'])?$atts['id']:time();
$custom_class   = isset($atts['custom-container-class'])?' '.$atts['custom-container-class']:'';
?>
<main id="templaza-main-<?php echo $id; ?>" class="templaza-main<?php echo $custom_class; ?>">

    <?php
    if ( have_posts() ) {

        // Load posts loop.
        while ( have_posts() ) {
            the_post();
            get_template_part( 'template-parts/content/content' );
        }

    } else {

        // If no content, include the "No posts found" template.
        get_template_part( 'template-parts/content/content', 'none' );

    }
    ?>

</main><!-- .site-main -->