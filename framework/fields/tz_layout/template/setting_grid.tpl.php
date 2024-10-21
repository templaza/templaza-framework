<?php
defined('TEMPLAZA_FRAMEWORK') or exit();
?>
<script type="text/html" id="tmpl-field-tz_layout-settings__grid">
    <?php
    // phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
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
    $grids  = array(
        array('1-1'),
        array('1-2','1-2'),
        array('1-3','1-3','1-3'),
        array('1-4','1-4','1-4','1-4'),
        array('1-5','1-5','1-5','1-5','1-5'),
        array('2-3','1-3'),
        array('1-3','2-3'),
        array('3-4','1-4'),
        array('1-4','3-4'),
        array('1-2','1-4','1-4'),
        array('1-4','1-4','1-2'),
        array('1-4','1-2','1-4'),
        array('2-5','3-5'),
        array('3-5','2-5'),
        array('1-5','4-5'),
        array('4-5','1-5'),
        array('3-5','1-5','1-5'),
        array('1-5','1-5','3-5'),
        array('1-5','3-5','1-5'),
        array('2-5','1-5','1-5','1-5'),
        array('1-5','1-5','1-5','2-5'),
        array('medium' => __('Fixed', 'templaza-framework'),'expand' => __('Expand', 'templaza-framework')),
        array('expand' => __('Expand', 'templaza-framework'),'medium' => __('Fixed', 'templaza-framework')),
        array(
            array('width' => 'expand', 'title' => __('Expand', 'templaza-framework')),
            array('width' => 'medium', 'title' => __('Fixed', 'templaza-framework')),
            array('width' => 'expand', 'title' => __('Expand', 'templaza-framework')),
        ),
        array(
            array('width' => 'medium', 'title' => __('Fixed', 'templaza-framework')),
            array('width' => 'expand', 'title' => __('Expand', 'templaza-framework')),
            array('width' => 'medium', 'title' => __('Fixed', 'templaza-framework')),
        ),
        array('auto' => __('Auto', 'templaza-framework'),'expand' => __('Expand', 'templaza-framework')),
        array('expand' => __('Expand', 'templaza-framework'), 'auto' => __('Auto', 'templaza-framework')),
        array('auto' => __('Auto', 'templaza-framework'),'1-3','expand' => __('Expand', 'templaza-framework')),
    );
    ?>
    <div class="fl-grid-items" data-fl-setting-title="<?php
    echo esc_html__('Select a grid layout'); ?>">
        <div class="uk-child-width-1-1@s uk-child-width-1-3@m uk-grid-medium" data-uk-grid>
            <?php foreach($grids as $grid){ ?>
                <?php
                $grid_cells = [];
                $grid_html  = '';
                ob_start();
                foreach ($grid as $key => $col){
                    $col_w      = $col;
                    $col_label  = $col;

                    if(is_array($col)){
                        $col_w          = isset($col['width'])?$col['width']:'';
                        $col_label      = isset($col['title'])?$col['title']:'';
                        $grid_cells[]   = $col_w;
                    }elseif(!is_numeric($key)){
                        $col_w    = $key;
                        $grid_cells[]= $key;
                    }else{
                        $grid_cells[]= $col;
                    }
                    ?>
                    <div class="<?php echo (is_numeric($col_w)?'col-':'uk-width-').($col_w == 'medium'?'small':$col_w); ?> fl-grid-item-col">
                        <span<?php echo $col_w == 'auto'?' class="uk-padding-small uk-padding-remove-vertical"':''?>>
                            <?php if($col_w == 'expand'){ ?>
                                <i class="uk-position-small uk-position-center-left" data-uk-icon="icon: arrow-left"></i>
                            <?php } ?>
                            <?php echo $col_label; ?>
                            <?php if($col_w == 'expand'){ ?>
                                <i class="uk-position-small uk-position-center-right" data-uk-icon="icon: arrow-right"></i>
                            <?php } ?>
                        </span>
                    </div>
                <?php }
                $grid_html  = ob_get_contents();
                ob_end_clean();

                ?>
                <div class="fl-grid-item" data-cells="<?php echo implode(";",$grid_cells); ?>">
                    <div class="m-0" data-uk-grid>
                        <?php echo $grid_html; ?>
                    </div>
                </div>
            <?php } ?>

            <div class="fl-grid-item" data-cells="custom">
                <div class="m-0 uk-child-width-1-1" data-uk-grid>
                    <div class="fl-grid-item-col">
                        <span><?php echo esc_html__('Custom', 'templaza-framework'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>
