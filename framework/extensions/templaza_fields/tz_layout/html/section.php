<?php
//fl_collapsed-row
?>

<!-- Section -->
<div class="fl_row fl_section" data-fl-element_type="section">

    <!-- Row controls -->
    <div class="fl_controls fl_controls-row clearfix">
        <div class="fl_controls-row-left">
            <a href="#" class="fl_control fl_column-move" title="<?php
            echo __('Drag section to reorder', $this -> text_domain);?>" data-fl-control="move"><i class="fas fa-arrows-alt"></i></a>
            <span class="fl_control fl_control-title"><?php echo __('Section', $this -> text_domain);?></span>
        </div>
        <div class="fl_controls-row-right">
            <a href="#" class="fl_control fl_column-delete" data-fl-control="delete" title="<?php
            echo __('Remove Section', $this -> text_domain);?>"><i class="far fa-trash-alt"></i></a>
            <a href="#" class="fl_control fl_column-clone" data-fl-control="clone" title="<?php
            echo __('Duplicate Section', $this -> text_domain);?>"><i class="far fa-copy"></i></a>
            <a href="#" class="fl_control fl_column-edit" data-fl-control="edit" title="<?php
            echo __('Edit Section', $this -> text_domain);?>"><i class="far fa-edit"></i></a>
            <a href="#" class="fl_control fl_column-add-section" data-fl-control="add-section" title="<?php
            echo __('New Section', $this -> text_domain);?>"><i class="fas fa-plus"></i> <?php
                echo __('Section', $this -> text_domain);?></a>
            <a href="#" class="fl_control fl_column-add-row" data-fl-control="add-row" title="<?php
            echo __('Add Row', $this -> text_domain);?>"><i class="fas fa-plus"></i> <?php
                echo __('Row', $this -> text_domain);?></a>
            <a href="#" class="fl_control fl_column-toggle" data-fl-control="toggle" title="<?php
            echo __('Toggle Section', $this -> text_domain);?>"><i class="fas fa-chevron-down"></i></a>
        </div>
    </div><!-- End row controls -->
    <!-- Row element wrapper -->
    <div class="fl_element-wrapper">
        <div class="row fl_row_container">
            <!-- Column -->
            <div class="col-12 fl_column">

                <!-- Column Top control -->
                <!--                                <div class="fl_controls fl_controls-column">-->
                <!--                                    <a href="#" class="fl_control fl_column-add"><i class="fas fa-plus"></i></a>-->
                <!--                                    <a href="#" class="fl_control fl_column-edit"><i class="far fa-edit"></i></a>-->
                <!--                                    <a href="#" class="fl_control fl_column-delete"><i class="far fa-trash-alt"></i></a>-->
                <!--                                </div>-->
                <!-- End Column Top control -->

                <!-- Column Element Wrapper -->
                <div class="fl_element-wrapper">
                    <!-- Column Container -->
                    <div class="fl_column-container">
                        <?php require __DIR__.'/row.php'; ?>
                        <?php require __DIR__.'/row-2.php'; ?>
                    </div><!-- End Column Container -->
                </div><!-- End column element wrapper -->

                <!-- Column controls bottom -->
                <div class="fl_controls fl_controls-column bottom-controls">
                    <a href="#" class="fl_control fl_column-add" title="<?php
                    echo __('Add Row', $this -> text_domain);?>"><i class="far fa-plus-square"></i> <?php echo __('Add Row', $this -> text_domain); ?></a>
                </div><!-- End Column controls bottom -->
            </div><!-- End column -->
        </div>
    </div><!-- End row element wrapper -->
</div><!-- End section -->
