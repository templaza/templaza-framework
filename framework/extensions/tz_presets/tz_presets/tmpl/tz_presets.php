<?php

// Exit if accessed directly
defined( 'TEMPLAZA_FRAMEWORK' ) or exit;

$random_colors  = array('#ffcdd2', '#b2dfdb', '#ffcc80', '#e1bee7');



$presets    = $this -> get_presets();

$secret     = wp_create_nonce( 'templaza_save_presets_' . $this -> field['id'] );
$post_id    = (isset($_GET['post']) && !empty($_GET['post']))?$_GET['post']:'';

$cpost_type = isset($_GET['post_type'])?$_GET['post_type']:'';
$cpost      = (isset($_GET['post']) && !empty($_GET['post']))?get_post($_GET['post']):'';
$post_name  = (!empty($cpost) && isset($cpost -> post_name) && !empty($cpost -> post_name))? $cpost -> post_name:'';

if(!isset($_GET['post']) || ((isset($_GET['post']) && !empty($_GET['post']) || $cpost_type) && empty($post_name))){
    ?>
    <p class="uk-text-danger">
                    <span>
                        <?php // phpcs:ignore WordPress.NamingConventions.ValidHookName ?>
                        <?php
                        echo esc_html( apply_filters( 'redux-import-warning', esc_html__( 'WARNING! Please save add title and publish first!', 'redux-framework' ) ) ); ?>
                    </span>
    </p>
    <?php
    return;
}else{
?>
<div class="uk-child-width-1-3@m js-field-tz_presets" data-field-post-type="<?php echo get_post_type(); ?>"<?php echo !empty($post_id)?' data-field-post-id="'
    .$post_id.'"':'';?><?php echo !isset($_GET['page']) && !empty($_GET['page'])?' data-field-page="'
    .$_GET['page'].'"':'';?> data-uk-grid>
    <?php if($presets && count($presets)){
        foreach($presets as $preset){

            $words = preg_split("/[\s,_-]+/", $preset['title']);

            $first_letter   = '';
            foreach($words as $word){
                $first_letter   .= substr($word, 0 , 1);
            }

            $color_index    = rand(0, count($random_colors) - 1);
        ?>
    <div>
        <div class="uk-card uk-card-default uk-card-small uk-border-rounded">
            <button class="uk-drop-close uk-modal-close-default js-remove-preset" type="button" data-uk-close data-name="<?php
            echo $preset['name']; ?>"></button>
            <div class="uk-card-media-top uk-text-center uk-height-small uk-flex uk-flex-middle uk-flex-center uk-heading-small uk-light" style="background-color: <?php echo $random_colors[$color_index];?>;">
                <span><?php echo strtoupper($first_letter); ?></span>
            </div>
            <div class="uk-card-body">
                <h4 class="uk-card-title"><?php echo $preset['title'] ?></h4>
                <?php if(!empty($preset['description'])){ ?>
                <p><?php echo $preset['description']; ?></p>
                <?php } ?>
                <button type="button" class="uk-button uk-button-primary uk-margin-top uk-margin-bottom js-load-preset" data-name="<?php
                echo $preset['name']; ?>"><?php echo __('Load Preset', $this -> text_domain);?></button>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php } ?>
    <div>
        <div class="uk-card uk-card-default uk-card-small uk-border-rounded">
            <div class="uk-card-header">
                <h4 class="uk-card-title"><?php echo __('Create Preset', $this -> text_domain);?></h4>
            </div>
            <div class="uk-card-body uk-form-stacked">
                <label class="uk-form-label" for="form-stacked-text"><?php echo __('Title', $this -> text_domain); ?></label>
                <div class="uk-form-controls">
                    <input class="uk-input js-preset-title" id="form-stacked-text" type="text" placeholder="Some text...">
                </div>
                <label class="uk-form-label" for="form-stacked-textarea"><?php echo __('Description', $this -> text_domain); ?></label>
                <div class="uk-form-controls">
                    <textarea class="uk-textarea js-preset-description" name=""></textarea>
                </div>

                <button type="button" class="uk-button uk-button-primary uk-margin-top uk-margin-bottom js-save-preset" data-secret="<?php
                echo $secret; ?>"><?php
                    echo __('Save Preset', $this -> text_domain);?></button>
            </div>
        </div>
    </div>
</div>
<?php } ?>