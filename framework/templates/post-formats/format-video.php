<?php
defined( 'TEMPLAZA_FRAMEWORK' ) || exit;

?>
<div class="vp-pfui-elm-block vp-pfui-format-wrap" id="vp-pfui-format-video-fields" style="display: none;">
	<?php do_action( 'vp_pfui_before_video_meta' ); ?>
    <?php
    $video_embed        =   get_post_meta($post->ID, '_format_video_embed', true);
    $video_autoplay     =   get_post_meta($post->ID, '_format_video_autoplay', true);
    $video_loop         =   get_post_meta($post->ID, '_format_video_loop', true);
    $video_muted        =   get_post_meta($post->ID, '_format_video_muted', true);
    $video_autopause    =   get_post_meta($post->ID, '_format_video_autopause', true);
    $video_byline       =   get_post_meta($post->ID, '_format_video_byline', true);
    $video_title        =   get_post_meta($post->ID, '_format_video_title', true);
    $video_portrait     =   get_post_meta($post->ID, '_format_video_portrait', true);
    $video_controls     =   get_post_meta($post->ID, '_format_video_controls', true);
    $video_related      =   get_post_meta($post->ID, '_format_video_related', true);
    $video_cookie       =   get_post_meta($post->ID, '_format_video_cookie', true);
    ?>
    <div class="vp-pfui-elm-block">
        <label for="vp-pfui-format-video-embed"><?php esc_html_e('Video URL (oEmbed) or Embed Code', $this -> text_domain); ?></label>
        <textarea name="_format_video_embed" id="vp-pfui-format-video-embed" tabindex="1"><?php echo esc_textarea($video_embed); ?></textarea>
    </div>
    <div class="vp-pfui-elm-block">
        <label for="vp-pfui-format-video-option-autoplay"><?php esc_html_e('Auto Play', $this -> text_domain); ?></label>
        <select name="_format_video_autoplay" id="vp-pfui-format-video-option-autoplay">
            <option value="0"<?php if ($video_autoplay == 0) echo 'selected'; ?>><?php echo esc_html__('No', $this -> text_domain); ?></option>
            <option value="1"<?php if ($video_autoplay == 1) echo 'selected'; ?>><?php echo esc_html__('Yes', $this -> text_domain); ?></option>
        </select>
    </div>
    <div class="vp-pfui-elm-block">
        <label for="vp-pfui-format-video-option-loop"><?php esc_html_e('Loop', $this -> text_domain); ?></label>
        <select name="_format_video_loop" id="vp-pfui-format-video-option-loop">
            <option value="0"<?php if ($video_loop == 0) echo 'selected'; ?>><?php echo esc_html__('No', $this -> text_domain); ?></option>
            <option value="1"<?php if ($video_loop == 1) echo 'selected'; ?>><?php echo esc_html__('Yes', $this -> text_domain); ?></option>
        </select>
    </div>
    <div class="vp-pfui-elm-block">
        <label for="vp-pfui-format-video-option-muted"><?php esc_html_e('Muted', $this -> text_domain); ?></label>
        <select name="_format_video_muted" id="vp-pfui-format-video-option-muted">
            <option value="0"<?php if ($video_muted == 0) echo 'selected'; ?>><?php echo esc_html__('No', $this -> text_domain); ?></option>
            <option value="1"<?php if ($video_muted == 1) echo 'selected'; ?>><?php echo esc_html__('Yes', $this -> text_domain); ?></option>
        </select>
    </div>
    <div class="vp-pfui-elm-block">
        <label for="vp-pfui-format-video-option-autopause"><?php esc_html_e('Auto Pause', $this -> text_domain); ?></label>
        <select name="_format_video_autopause" id="vp-pfui-format-video-option-autopause">
            <option value="1"<?php if ($video_autopause == 1) echo 'selected'; ?>><?php echo esc_html__('Yes', $this -> text_domain); ?></option>
            <option value="0"<?php if ($video_autopause == 0) echo 'selected'; ?>><?php echo esc_html__('No', $this -> text_domain); ?></option>
        </select>
    </div>
    <div class="vp-pfui-elm-block">
        <label for="vp-pfui-format-video-option-byline"><?php esc_html_e('By Line', $this -> text_domain); ?></label>
        <select name="_format_video_byline" id="vp-pfui-format-video-option-byline">
            <option value="0"<?php if ($video_byline == 0) echo 'selected'; ?>><?php echo esc_html__('No', $this -> text_domain); ?></option>
            <option value="1"<?php if ($video_byline == 1) echo 'selected'; ?>><?php echo esc_html__('Yes', $this -> text_domain); ?></option>
        </select>
    </div>
    <div class="vp-pfui-elm-block">
        <label for="vp-pfui-format-video-option-title"><?php esc_html_e('Video Title', $this -> text_domain); ?></label>
        <select name="_format_video_title" id="vp-pfui-format-video-option-title">
            <option value="1"<?php if ($video_title == 1) echo 'selected'; ?>><?php echo esc_html__('Yes', $this -> text_domain); ?></option>
            <option value="0"<?php if ($video_title == 0) echo 'selected'; ?>><?php echo esc_html__('No', $this -> text_domain); ?></option>
        </select>
    </div>
    <div class="vp-pfui-elm-block">
        <label for="vp-pfui-format-video-option-portrait"><?php esc_html_e('Portrait', $this -> text_domain); ?></label>
        <select name="_format_video_portrait" id="vp-pfui-format-video-option-portrait">
            <option value="0"<?php if ($video_portrait == 0) echo 'selected'; ?>><?php echo esc_html__('No', $this -> text_domain); ?></option>
            <option value="1"<?php if ($video_portrait == 1) echo 'selected'; ?>><?php echo esc_html__('Yes', $this -> text_domain); ?></option>
        </select>
    </div>
    <div class="vp-pfui-elm-block">
        <label for="vp-pfui-format-video-option-controls"><?php esc_html_e('Controls', $this -> text_domain); ?></label>
        <select name="_format_video_controls" id="vp-pfui-format-video-option-controls">
            <option value="1"<?php if ($video_controls == 1) echo 'selected'; ?>><?php echo esc_html__('Yes', $this -> text_domain); ?></option>
            <option value="0"<?php if ($video_controls == 0) echo 'selected'; ?>><?php echo esc_html__('No', $this -> text_domain); ?></option>
        </select>
    </div>
    <div class="vp-pfui-elm-block">
        <label for="vp-pfui-format-video-option-related"><?php esc_html_e('Related Video on Youtube', $this -> text_domain); ?></label>
        <select name="_format_video_related" id="vp-pfui-format-video-option-related">
            <option value="1"<?php if ($video_related == 1) echo 'selected'; ?>><?php echo esc_html__('Yes', $this -> text_domain); ?></option>
            <option value="0"<?php if ($video_related == 0) echo 'selected'; ?>><?php echo esc_html__('No', $this -> text_domain); ?></option>
        </select>
    </div>
    <div class="vp-pfui-elm-block">
        <label for="vp-pfui-format-video-option-cookie"><?php esc_html_e('Turn off Youtube Cookie', $this -> text_domain); ?></label>
        <select name="_format_video_cookie" id="vp-pfui-format-video-option-cookie">
            <option value="0"<?php if ($video_cookie == 0) echo 'selected'; ?>><?php echo esc_html__('No', $this -> text_domain); ?></option>
            <option value="1"<?php if ($video_cookie == 1) echo 'selected'; ?>><?php echo esc_html__('Yes', $this -> text_domain); ?></option>
        </select>
    </div>
	<?php do_action( 'vp_pfui_after_video_meta' ); ?>
</div>	
