<?php

defined( 'ABSPATH' ) || exit;

?>
<div id="tzinst-dashboard-widgets-wrap">

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="p-3 bg-white box-shadow h-100 rounded-3"><?php echo $this -> load_template('theme');?></div>
        </div>
        <?php if(isset($this -> theme_config_registered) && !empty($this -> theme_config_registered)){ ?>
            <div id="tzinst-license" class="col-md-8 mb-4">
                <div class="p-4 bg-white box-shadow h-100 rounded-3"><?php echo $this -> load_template('license');?></div>
            </div>
        <?php } ?>
        <div class="col-md-4 mb-4">
            <div class="p-4 bg-white box-shadow h-100 rounded-3"><?php echo $this -> load_template('support');?></div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="p-4 bg-white box-shadow h-100 rounded-3"><?php echo $this -> load_template('social');?></div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="p-4 bg-white box-shadow h-100 rounded-3"><?php echo $this -> load_template('feed');?></div>
        </div>
    </div>


</div>
