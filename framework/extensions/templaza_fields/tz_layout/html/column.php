<!-- Column -->
<div class="col-12 fl_column" data-fl-element_type="column">

    <!-- Column Top control -->
    <div class="fl_controls fl_controls-column">
        <a href="#" class="fl_control fl_column-add" title="<?php
        echo __('Add Element', $this -> text_domain); ?>"><i class="fas fa-plus"></i></a>
        <a href="#" class="fl_control fl_column-edit" data-fl-control="edit" title="<?php
        echo __('Edit Column', $this -> text_domain);?>"><i class="far fa-edit"></i></a>
        <a href="#" class="fl_control fl_column-delete" data-fl-control="delete" title="<?php
        echo __('Delete Column', $this -> text_domain);?>"><i class="far fa-trash-alt"></i></a>
    </div><!-- End Column Top control -->

    <!-- Column Element Wrapper -->
    <div class="fl_element-wrapper">
        <!-- Column Container -->
        <div class="fl_column-container fl_container_for_children">
            <!-- Content of column here -->
            <?php require __DIR__.'/element.php'; ?>
            <?php require __DIR__.'/element.php'; ?>
            <?php require __DIR__.'/row-3.php'; ?>
        </div><!-- End Column Container -->
    </div><!-- End column element wrapper -->

    <!-- Column controls bottom -->
    <div class="fl_controls fl_controls-column bottom-controls">
        <a href="#" class="fl_control fl_column-add"><i class="far fa-plus-square"></i> <?php echo __('Add Element', $this -> text_domain); ?></a>
    </div><!-- End Column controls bottom -->
</div><!-- End column -->