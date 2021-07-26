<?php
/* Base importer layout */

if(isset($this -> item) && isset($this -> item['demo-datas']) && count($this -> item['demo-datas'])){
    $item   = $this -> item;
    $code   = $this -> product_code;
    ?>
    <h5><?php echo sprintf(__('Import Demo Content %s', $this -> text_domain), $item['title']);?></h5>
    <p class="text-muted"><?php echo __('Select what type of content do you want to import:', $this -> text_domain); ?></p>
    <form id="tzinst-import__<?php echo $code; ?>" data-demo-id="<?php echo $code; ?>">
    <?php foreach($item['demo-datas'] as $i => $data){?>
        <div class="js-tzinst-demoitem custom-checkbox pt-2 pb-2 ml-n3 mr-n3 pl-5">
            <input type="checkbox" class="custom-control-input" id="tzinst-checkbox__<?php
            echo $code;?>-<?php echo $data['slug'];?>"
                   data-demo-title="<?php echo $data['title']; ?>"
                   data-pack-type="<?php echo $data['slug']?>"<?php
            echo isset($data['parent_slug'])?' data-parent-slug="'.$data['parent_slug'].'"':'';
            echo isset($data['demo_type'])?' data-demo-type="'.$data['demo_type'].'"':'';
            echo isset($data['file_name'])?' data-file-name="'.$data['file_name'].'"':'';
//            echo isset($data['options'])?' data-demo-options="'.$data['options'].'"':'';
            echo isset($data['options'])?' data-demo-key="'.$i.'"':'';
            echo isset($data['checked']) && $data['checked']?' checked':'';?>>
            <label class="custom-control-label" for="tzinst-checkbox__<?php echo $code;?>-<?php echo $data['slug'];?>">
                <span class="title"><?php echo $data['title']; ?></span>
                <small class="d-block text-muted"><?php echo $data['desc']; ?></small>
            </label>
        </div>
    <?php } ?>
    </form>
<?php } ?>