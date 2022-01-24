<?php
defined( 'TEMPLAZA_FRAMEWORK' ) || exit;

?>
<div id="vp-pfui-format-quote-fields" style="display: none;" class="vp-pfui-format-wrap">
	<?php do_action( 'vp_pfui_before_quote_meta' ); ?>
	<div class="vp-pfui-elm-block">
		<label for="vp-pfui-format-quote-source-content"><?php _e('Quote Content', $this -> text_domain); ?></label>
        <textarea name="_format_quote_source_content" id="vp-pfui-format-quote-source-content" tabindex="1"><?php echo esc_textarea(get_post_meta($post->ID, '_format_quote_source_content', true)); ?></textarea>
	</div>
	<div class="vp-pfui-elm-block">
		<label for="vp-pfui-format-quote-source-author"><?php _e('Quote Author', $this -> text_domain); ?></label>
		<input type="text" name="_format_quote_source_author" value="<?php echo esc_attr(get_post_meta($post->ID, '_format_quote_source_author', true)); ?>" id="vp-pfui-format-quote-source-author" tabindex="1" />
	</div>
    <div class="vp-pfui-elm-block">
        <label for="vp-pfui-format-quote-source-url"><?php _e('Quote Author URL', $this -> text_domain); ?></label>
        <input type="text" name="_format_quote_source_url" value="<?php echo esc_attr(get_post_meta($post->ID, '_format_quote_source_url', true)); ?>" id="vp-pfui-format-quote-source-url" tabindex="1" />
    </div>
	<?php do_action( 'vp_pfui_after_quote_meta' ); ?>
</div>
