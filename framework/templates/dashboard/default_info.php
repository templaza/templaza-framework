<?php
defined( 'TEMPLAZA_FRAMEWORK' ) || exit;

use \TemPlazaFramework\Functions;

$plugin = Functions::get_my_data();

?>
<div class="information">
    <h6 class="border-bottom border-gray pb-2 mb-3"><?php echo __('Plugin Information', 'templaza-framework'); ?></h6>
    <div class="title">
        <?php echo $plugin['Name'];?> - <span><?php echo $plugin['Description'];?></span>
    </div>
    <ul class="">
        <li class="">
            <div class="key"><?php echo __('Version', 'templaza-framework');?>:</div>
            <div><?php echo $plugin['Version'];?></div>
        </li>
        <li class="">
            <div class="key"><?php echo __('FanPage', 'templaza-framework');?>:</div>
            <div><a href="<?php echo $plugin['FanPage'];?>" target="_blank"><?php echo $plugin['FanPage'];?></a></div>
        </li>
        <li class="">
            <div class="key"><?php echo __('Twitter', 'templaza-framework');?>:</div>
            <div><a href="<?php echo $plugin['Twitter'];?>" target="_blank"><?php echo $plugin['Twitter'];?></a></div>
        </li>
        <li class="">
            <div class="key"><?php echo __('Google', 'templaza-framework');?>:</div>
            <div><a href="<?php echo $plugin['Google'];?>" target="_blank"><?php echo $plugin['Google'];?></a></div>
        </li>
    </ul>
</div>

