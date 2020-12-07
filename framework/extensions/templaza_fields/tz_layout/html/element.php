<?php
?>
<!-- Element -->
<div class="fl_content_element" data-fl-element_type="image">
    <div class="fl_controls">
        <a href="#" class="fl_control fl_column-edit" data-fl-control="edit" title="<?php
        echo __('Edit Element', $this -> text_domain); ?>"><i class="far fa-edit"></i></a>
        <a href="#" class="fl_control fl_column-clone" data-fl-control="clone" title="<?php
        echo __('Duplicate Element', $this -> text_domain); ?>"><i class="far fa-copy"></i></a>
        <a href="#" class="fl_control fl_column-delete" data-fl-control="delete" title="<?php
        echo __('Delete Element', $this -> text_domain); ?>"><i class="far fa-trash-alt"></i></a>
    </div>
    <div class="fl_element-wrapper">
        <!-- Element Content -->
        <span class="fl_element-title">
            <i class="far fa-image"></i> <?php echo __('Image', $this -> text_domain);?>
        </span><!-- End Element Content -->
    </div>
</div><!-- End Element -->
