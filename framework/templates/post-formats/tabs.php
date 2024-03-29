<?php
defined( 'TEMPLAZA_FRAMEWORK' ) || exit;

?>
<div id="vp-post-formats-ui-tabs" class="vp-pfui-nav" style="display: none;">
	<ul class="clearfix">
<?php

foreach ($post_formats as $format) {
	$class = ($format == $current_post_format || (empty($current_post_format) && $format == 'standard') ? 'current' : '');
	
	if ($format == 'standard') {
		$format_string = __('Standard', 'templaza-framework');
		$format_hash = 'post-format-0';
	}
	else {
		$format_string = get_post_format_string($format);
		$format_hash = 'post-format-'.$format;
	}
	
	echo '<li><a '.(!empty($class) ? 'class="'.esc_attr($class).'"' : '').' href="#'.esc_attr($format_hash).'">'.esc_html($format_string).'</a></li>';
}

?>
	</ul>
</div>