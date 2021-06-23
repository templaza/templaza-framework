<?php
defined('ABSPATH') or exit();
$templaza_audio = get_post_meta(get_the_ID(), '_format_audio_embed', true);
if ($templaza_audio != ''):
    ?>
    <div class="templaza-blog-item-audio">
        <?php
        if (wp_oembed_get($templaza_audio)) :
            echo wp_kses_post(wp_oembed_get($templaza_audio));
        endif;
        ?>
    </div>
<?php endif; ?>