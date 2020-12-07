<?php
defined('TEMPLAZA_FRAMEWORK') or exit();
?>
<script type="text/html" id="tmpl-field-tz_layout-settings__grid">
    <?php
    $grids  = array(
        array(12),
        array(10, 2),
        array(9, 3),
        array(8, 4),
        array(7, 5),
        array(6, 6),
        array(4, 4, 4),
        array(3, 6, 3),
        array(2, 6, 4),
        array(3, 3, 3, 3),
        array(2, 2, 2, 2, 2, 2),
    );
    ?>
    <div class="fl-grid-items" data-fl-setting-title="<?php
    echo esc_html__('Select a grid layout'); ?>">
        <div class="row pt-3">
            <?php foreach($grids as $grid){ ?>
                <div class="col-3 fl-grid-item" data-cells="<?php echo implode("+",$grid); ?>">
                    <div class="row m-0">
                        <?php foreach ($grid as $col){ ?>
                            <div class="col-<?php echo $col; ?> fl-grid-item-col">
                                <span><?php echo $col; ?></span>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>

            <div class="col-3 fl-grid-item" data-cells="custom">
                <div class="row m-0">
                    <div class="col-12 fl-grid-item-col">
                        <span><?php echo esc_html__('Custom', $this -> text_domain); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>
