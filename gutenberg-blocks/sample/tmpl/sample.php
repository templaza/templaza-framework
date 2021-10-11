<?php

defined( 'TEMPLAZA_FRAMEWORK' ) || exit;

$style  = 'background:'.$attributes['colorControl'].';';
$style .= 'color:#fff;';
$style .= 'padding:20px;';
?>
<p style="<?php echo $style; ?>"><?php echo __('Gutenberg Hello World, step 1 (from the frontend).', $this -> text_domain);?></p>
