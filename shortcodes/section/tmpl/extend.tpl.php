<?php
defined('TEMPLAZA_FRAMEWORK') or exit();
?>
<script type="text/html" id="tmpl-field-tz_layout-template-<?php echo $this -> element['id']; ?>">
    <div class="fl_row fl_section" data-fl-element_type="<?php echo $this -> element['id']; ?>">
        <!-- Row controls -->
        <div class="fl_controls fl_controls-row uk-clearfix">
            <div class="fl_controls-row-left">
                <a href="#" class="fl_control fl_column-move" data-uk-tooltip="<?php
                echo __('Drag section to reorder', 'templaza-framework');?>" data-fl-control="move"><i class="fas fa-arrows-alt"></i></a>
                <span class="fl_control fl_control-title"><# if(data.admin_label && data.admin_label.length){ #>
                                {{{data.admin_label}}}<# }else{ #><?php echo __('Section', 'templaza-framework');
                    ?> <# } #></span>
            </div>
            <div class="fl_controls-row-right">
                <a href="#" class="fl_control fl_column-delete" data-fl-control="delete" data-uk-tooltip="<?php
                echo __('Remove Section', 'templaza-framework');?>"><i class="far fa-trash-alt"></i></a>
                <a href="javascript:" class="fl_control fl_column-save" data-fl-control="save" data-uk-tooltip="<?php
                echo __('Save Section', 'templaza-framework');?>"><i class="far fa-save"></i></a>
                <a href="#" class="fl_control fl_column-clone" data-fl-control="clone" data-uk-tooltip="<?php
                echo __('Duplicate Section', 'templaza-framework');?>"><i class="far fa-copy"></i></a>
                <a href="#" class="fl_control fl_column-edit" data-fl-control="edit" data-uk-tooltip="<?php
                echo __('Edit Section', 'templaza-framework');?>"><i class="far fa-edit"></i></a>
                <a href="#" class="fl_control fl_column-add-section" data-fl-control="add-section" data-uk-tooltip="<?php
                echo __('New Section', 'templaza-framework');?>"><i class="fas fa-plus"></i> <?php
                    echo __('Section', 'templaza-framework');?></a>
                <a href="#" class="fl_control fl_column-add-row" data-fl-control="add-row" data-uk-tooltip="<?php
                echo __('Add Row', 'templaza-framework');?>"><i class="fas fa-plus"></i> <?php
                    echo __('Row', 'templaza-framework');?></a>
                <a href="#" class="fl_control fl_column-toggle" data-fl-control="toggle" data-uk-tooltip="<?php
                echo __('Toggle Section', 'templaza-framework');?>"><i class="fas fa-chevron-down"></i></a>
            </div>
        </div><!-- End row controls -->
        <!-- Row element wrapper -->
        <div class="fl_element-wrapper">
            <div class="fl_row_container uk-child-width" data-uk-grid>
                <!-- Column -->
                <div class="fl_column">
                    <!-- Column Element Wrapper -->
                    <div class="fl_element-wrapper">
                        <!-- Column Container -->
                        <div class="fl_column-container fl_column-section-container">
                            {{{data.element}}}
                        </div><!-- End Column Container -->
                    </div><!-- End column element wrapper -->

                    <!-- Column controls bottom -->
                    <div class="fl_controls fl_controls-column bottom-controls">
                        <a href="#" class="fl_control fl_column-add" data-fl-control="add-row" data-uk-tooltip="<?php
                        echo __('Add Row', 'templaza-framework');?>"><i class="far fa-plus-square"></i> <?php echo __('Add Row', 'templaza-framework'); ?></a>
                    </div><!-- End Column controls bottom -->
                </div><!-- End column -->
            </div>
        </div><!-- End row element wrapper -->
    </div>
</script>