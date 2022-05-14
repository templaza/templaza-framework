<script type="text/html" id="tmpl-field-tz_layout-template-<?php echo $this -> element['id']; ?>">
    <div class="uk-width-{{{data.size}}} fl_column <# if(!data.element || (data.element && !data.element.length)){ #> fl_empty-column<# } #>" data-fl-element_type="<?php
    echo $this -> element['id']; ?>" data-column-width="<# if(data.size){ #>{{{data.size}}}<# }else{ #>1-1<# } #>">

        <!-- Column Top control -->
        <div class="fl_controls fl_controls-column">
            <a href="#" class="fl_control fl_column-add" data-fl-control="add" data-uk-tooltip="<?php
            echo __('Add Element', $this -> text_domain); ?>"><i class="fas fa-plus"></i></a>
            <a href="#" class="fl_control fl_column-edit" data-fl-control="edit" data-uk-tooltip="<?php
            echo __('Edit Column', $this -> text_domain);?>"><i class="far fa-edit"></i></a>
            <a href="#" class="fl_control fl_column-delete" data-fl-control="delete" data-uk-tooltip="<?php
            echo __('Delete Column', $this -> text_domain);?>"><i class="far fa-trash-alt"></i></a>
        </div><!-- End Column Top control -->

        <!-- Column Element Wrapper -->
        <div class="fl_element-wrapper">
            <div class="fl_column-container fl_container_for_children<# if(!data.element || (data.element && !data.element.length)){ #> fl_empty-container<# } #>">
                {{{data.element}}}
            </div>
        </div>

        <div class="fl_controls fl_controls-column bottom-controls">
            <a href="#" class="fl_control fl_column-add" data-fl-control="add"><i class="far fa-plus-square"></i> <?php
                echo __('Add Element', $this -> text_domain); ?></a>
        </div>
    </div>
</script>