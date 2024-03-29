<?php
defined('TEMPLAZA_FRAMEWORK') or exit();

$field_parent   = isset($this -> field_parent)?$this -> field_parent:array();
$one_row        = (isset($field_parent['one_row']) && $field_parent['one_row'])?filter_var($field_parent['one_row'], FILTER_VALIDATE_BOOLEAN):false;
?>
<script type="text/html" id="tmpl-field-tz_layout-template-<?php echo $this -> element['id']; ?>">
    <div class="fl_row" data-fl-element_type="<?php echo $this -> element['id']; ?>">
        <div class="fl_controls fl_controls-row uk-clearfix">
            <?php if(!$one_row){ ?>
            <div class="fl_controls-row-left">
                <a href="#" class="fl_control fl_column-move" data-fl-control="move" data-uk-tooltip="<?php
                echo __('Drag to reorder', 'templaza-framework'); ?>"><i class="fas fa-arrows-alt"></i></a>
                <span class="fl_control fl_control-title"><?php echo __('Row', 'templaza-framework'); ?></span>
            </div>
            <?php } ?>
            <div class="fl_controls-row-right">
                <?php
                if(!$one_row){
                ?>
                <a href="#" class="fl_control fl_column-delete" data-fl-control="delete" data-uk-tooltip="<?php
                echo __('Delete Row', 'templaza-framework'); ?>"><i class="far fa-trash-alt"></i></a>
                <a href="#" class="fl_control fl_column-clone" data-fl-control="clone" data-uk-tooltip="<?php
                echo __('Duplicate Row', 'templaza-framework'); ?>"><i class="far fa-copy"></i></a>
                <?php } ?>
                <a href="#" class="fl_control fl_column-edit" data-fl-control="edit" data-uk-tooltip="<?php
                echo __('Edit Row', 'templaza-framework'); ?>"><i class="far fa-edit"></i></a>
                <a href="#" class="fl_control fl_column-edit-grid" data-fl-control="edit-grid" data-uk-tooltip="<?php
                echo __('Edit Grid', 'templaza-framework'); ?>"><i class="fas fa-columns"></i></a>
                <!--                            <a href="#" class="fl_control fl_column-add-row" title="--><?php //echo __('Add Row', 'templaza-framework');
                //                            ?><!--" data-fl-control="add-row"><i class="fas fa-plus"></i> --><?php //echo __('Row', 'templaza-framework'); ?><!--</a>-->
                <a href="#" class="fl_control fl_column-add" data-uk-tooltip="<?php echo __('Add Column', 'templaza-framework');
                ?>" data-fl-control="add"><i class="fas fa-plus"></i> <?php echo __('Column', 'templaza-framework');?></a>
                <a href="#" class="fl_control fl_column-toggle" data-uk-tooltip="<?php echo __('Toggle Row', 'templaza-framework');
                ?>" data-fl-control="toggle"><i class="fas fa-chevron-down"></i></a>
            </div>
        </div>

        <div class="fl_element-wrapper">
            <div class="fl_row_container fl_container_for_children uk-grid-small uk-grid" data-uk-grid>
                {{{data.element}}}
            </div>
        </div>
    </div>
</script>