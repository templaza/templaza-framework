<?php
defined('TEMPLAZA_FRAMEWORK') or exit();

extract(shortcode_atts(array(
    'width'                  => '',
    'tz_id'                  => '',
    'height'                 => 'none',
    'tz_class'               => '',
    'match_height'           => '',
    '_tz_outer_class'        => '',
    'match_height_selector'  => '',
), $atts));

$match_height   = filter_var($match_height, FILTER_VALIDATE_BOOLEAN);

$_attributes = ' data-uk-grid';
if($width != 'none'){
    $_tz_outer_class .= '';
}
$has_outer  = false;
if(!empty($_tz_outer_class)){
    $has_outer  = true;
}
// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
$_height_viewport   = '';
if(!empty($height) && $height != 'none'){
    $_height_viewport   = ' data-uk-height-viewport="offset-top: true;';
    $_height_viewport  .= $height == 'percent'?' offset-bottom:20;':'';
    $_height_viewport  .= '"';
}
$_attributes    .= $_height_viewport;
if($match_height){
//    $match_height_selector  = !empty($match_height_selector)?$match_height_selector:'>.templaza-column>*';
    $match_height_selector  = '.templaza-column > *';
    $_attributes    .= ' data-uk-height-match="target: '.$match_height_selector.'"';
}
?>

<?php if($has_outer){?>
<div<?php echo isset($tz_id)?' id="'.esc_attr($tz_id).'"':''; ?> class="<?php echo esc_attr($_tz_outer_class); ?>">
<?php } ?>
<div<?php echo isset($tz_id) && !$has_outer?' id="'.esc_attr($tz_id).'"':''; ?> class="uk-grid <?php echo isset($tz_class)?esc_attr($tz_class):'';
?>"<?php echo !empty($_attributes)?$_attributes:''; ?>><?php echo $content; ?></div>
<?php if($has_outer){ ?></div><?php } ?>