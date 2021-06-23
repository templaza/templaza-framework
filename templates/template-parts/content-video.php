<?php
defined('ABSPATH') or exit();
$templaza_video = get_post_meta(get_the_ID(), '_format_video_embed', true);
if ($templaza_video != ''):
    ?>
    <div class="templaza-blog-item-video">
        <?php
        if (wp_oembed_get($templaza_video)) :
             echo wp_kses_post(wp_oembed_get($templaza_video));
         else :
             echo wp_kses_post($templaza_video);
        endif;
        ?>
    </div>
<?php endif; ?>