<?php
defined( 'TEMPLAZA_FRAMEWORK' ) || exit;

?>
<div class="vp-pfui-elm-block vp-pfui-format-wrap" id="vp-pfui-format-link-url" style="display: none;">
	<?php do_action( 'vp_pfui_before_link_meta' ); ?>
    <div class="vp-pfui-elm-block">
        <label for="vp-pfui-format-link-url-field"><?php _e('URL', $this -> text_domain); ?></label>
        <input type="text" name="_format_link_url" value="<?php echo esc_attr(get_post_meta($post->ID, '_format_link_url', true)); ?>" id="vp-pfui-format-link-url-field" tabindex="1" />
    </div>
    <div>
        <label for="vp-pfui-format-link-title-field"><?php _e('Title', $this -> text_domain); ?></label>
        <input type="text" name="_format_link_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_format_link_title', true)); ?>" id="vp-pfui-format-link-title-field" tabindex="1" />
    </div>
	<?php do_action( 'vp_pfui_after_link_meta' ); ?>
</div>	
