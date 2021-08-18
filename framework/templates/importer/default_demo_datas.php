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

        <div class="js-tzinst-demoitem uk-padding-small uk-margin-small uk-margin-remove-vertical uk-padding-remove-top">
            <label class="uk-text-secondary">
                <input class="uk-checkbox" type="checkbox"
                       data-demo-title="<?php echo $data['title']; ?>"
                       data-pack-type="<?php echo $data['slug']?>"<?php
                echo isset($data['parent_slug'])?' data-parent-slug="'.$data['parent_slug'].'"':'';
                echo isset($data['demo_type'])?' data-demo-type="'.$data['demo_type'].'"':'';
                echo isset($data['file_name'])?' data-file-name="'.$data['file_name'].'"':'';
                echo isset($data['options'])?' data-demo-key="'.$i.'"':'';
                echo isset($data['checked']) && $data['checked']?' checked':'';?>>
                <span class="title"><?php echo $data['title']; ?></span>
                <small class="uk-display-block uk-text-muted"><?php echo $data['desc']; ?></small>
            </label>
        </div>
    <?php } ?>
    </form>
<?php } ?>