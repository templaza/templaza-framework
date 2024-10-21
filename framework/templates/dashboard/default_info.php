<?php
defined( 'TEMPLAZA_FRAMEWORK' ) || exit;

use \TemPlazaFramework\Functions;

$plugin = Functions::get_my_data();

?>
<div class="information">
    <h6 class="border-bottom border-gray pb-2 mb-3"><?php echo esc_html__('Plugin Information', 'templaza-framework'); ?></h6>
    <div class="title">
        <?php echo esc_html($plugin['Name']);?> - <span><?php echo esc_html($plugin['Description']);?></span>
    </div>
    <ul class="">
        <li class="">
            <div class="key"><?php echo esc_html__('Version', 'templaza-framework');?>:</div>
            <div><?php echo esc_html($plugin['Version']);?></div>
        </li>
        <li class="">
            <div class="key"><?php echo esc_html__('FanPage', 'templaza-framework');?>:</div>
            <div><a href="<?php echo esc_url($plugin['FanPage']);?>" target="_blank"><?php echo esc_html($plugin['FanPage']);?></a></div>
        </li>
        <li class="">
            <div class="key"><?php echo esc_html__('Twitter', 'templaza-framework');?>:</div>
            <div><a href="<?php echo esc_url($plugin['Twitter']);?>" target="_blank"><?php echo esc_html($plugin['Twitter']);?></a></div>
        </li>
        <li class="">
            <div class="key"><?php echo esc_html__('Google', 'templaza-framework');?>:</div>
            <div><a href="<?php echo esc_url($plugin['Google']);?>" target="_blank"><?php echo esc_html($plugin['Google']);?></a></div>
        </li>
    </ul>
</div>

