<?php
defined('TEMPLAZA_FRAMEWORK') or exit();
?>
<script type="text/html" id="tmpl-field-tz_layout-template-<?php echo esc_attr($this -> element['id']); ?>">
    <div class="fl_row fl_row_inner" data-fl-element_type="<?php echo esc_attr($this -> element['id']); ?>">
        <div class="fl_controls fl_controls-row uk-clearfix">
            <div class="fl_controls-row-left">
                <a href="#" class="fl_control fl_column-move" data-fl-control="move" title="<?php
                echo esc_html__('Drag to reorder', 'templaza-framework'); ?>"><i class="fas fa-arrows-alt"></i></a>
                <span class="fl_control fl_control-title"><?php echo esc_html__('Row', 'templaza-framework'); ?></span>
            </div>
            <div class="fl_controls-row-right">
                <a href="#" class="fl_control fl_column-delete" data-fl-control="delete" title="<?php
                echo esc_html__('Delete Row', 'templaza-framework'); ?>"><i class="far fa-trash-alt"></i></a>
                <a href="#" class="fl_control fl_column-clone" data-fl-control="clone" title="<?php
                echo esc_html__('Duplicate Row', 'templaza-framework'); ?>"><i class="far fa-copy"></i></a>
                <a href="#" class="fl_control fl_column-edit" data-fl-control="edit" title="<?php
                echo esc_html__('Edit Row', 'templaza-framework'); ?>"><i class="far fa-edit"></i></a>
                <a href="#" class="fl_control fl_column-edit-grid" data-fl-control="edit-grid" title="<?php
                echo esc_html__('Edit Grid', 'templaza-framework'); ?>"><i class="fas fa-columns"></i></a>
                <a href="#" class="fl_control fl_column-add" title="<?php echo esc_html__('Add Column', 'templaza-framework');
                ?>" data-fl-control="add"><i class="fas fa-plus"></i> <?php echo esc_html__('Column', 'templaza-framework');?></a>
                <a href="#" class="fl_control fl_column-toggle" title="<?php echo esc_html__('Toggle Row', 'templaza-framework');
                ?>" data-fl-control="toggle"><i class="fas fa-chevron-down"></i></a>
            </div>
        </div>

        <div class="fl_element-wrapper">
            <div class="row fl_row_container fl_container_for_children">
                {{{data.element}}}
            </div>
        </div>
    </div>
</script>