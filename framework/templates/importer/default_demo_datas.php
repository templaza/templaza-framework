<?php
/* Base importer layout */

if(isset($this -> item) && isset($this -> item['demo-datas']) && count($this -> item['demo-datas'])){
    $item   = $this -> item;
    $code   = $this -> product_code;
    ?>
    <h5><?php  /* translators: %s - Import. */ echo sprintf(esc_html__('Import Demo Content %s', 'templaza-framework'), esc_html($item['title']));?></h5>
    <p class="text-muted"><?php echo esc_html__('Select what type of content do you want to import:', 'templaza-framework'); ?></p>
    <form id="tzinst-import__<?php echo esc_attr($code); ?>" data-demo-id="<?php echo esc_attr($code); ?>">
    <?php foreach($item['demo-datas'] as $i => $data){?>

        <div class="js-tzinst-demoitem uk-padding-small uk-margin-small uk-margin-remove-vertical uk-padding-remove-top">
            <label class="uk-text-secondary">
                <input class="uk-checkbox" type="checkbox"
                       data-demo-title="<?php echo esc_attr($data['title']); ?>"
                       data-pack-type="<?php echo esc_attr($data['slug'])?>"<?php
                echo isset($data['parent_slug'])?' data-parent-slug="'.esc_attr($data['parent_slug']).'"':'';
                echo isset($data['demo_type'])?' data-demo-type="'.esc_attr($data['demo_type']).'"':'';
                echo isset($data['file_name'])?' data-file-name="'.esc_attr($data['file_name']).'"':'';
                echo isset($data['options'])?' data-demo-key="'.esc_attr($i).'"':'';
                echo isset($data['checked']) && $data['checked']?' checked':'';?>>
                <span class="title"><?php echo esc_html($data['title']); ?></span>
                <small class="uk-display-block uk-text-muted"><?php echo esc_html($data['desc']); ?></small>
            </label>
        </div>
    <?php } ?>
    </form>
<?php } ?>