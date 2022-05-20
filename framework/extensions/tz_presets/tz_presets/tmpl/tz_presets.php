<?php

// Exit if accessed directly
defined( 'TEMPLAZA_FRAMEWORK' ) or exit;

use TemPlazaFramework\Functions;

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
            <?php
            global $post_type;

            $image = isset($preset['image'])?$preset['image']:'';

            $image_url = !empty($image)?get_template_directory_uri().'/templaza-framework/images/presets'
                .'/'.$post_type.'/'.$image:'';
            $image_path = !empty($image)?TEMPLAZA_FRAMEWORK_THEME_PATH.'/images/presets'
                .'/'.$post_type.'/'.$image:'';

            $has_image  = (!empty($image_path) && file_exists($image_path));
            ?>
            <div class="uk-card-media-top uk-text-center<?php echo !$has_image?' uk-height-small':'';
            ?> uk-flex uk-flex-middle uk-flex-center uk-heading-small uk-light" style="background-color: <?php
            echo $random_colors[$color_index];?>;">
                <?php
                if($has_image){
                ?>
                    <img src="<?php echo $image_url; ?>" alt="<?php echo $preset['name']; ?>"/>
                <?php }else{?>
                    <span><?php echo strtoupper($first_letter); ?></span>
                <?php } ?>
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
    <div class="uk-width-2-5@m">
        <div class="uk-card uk-card-default uk-card-small uk-border-rounded">
            <div class="uk-card-header">
                <h4 class="uk-card-title"><?php echo __('Create Preset', $this -> text_domain);?></h4>
            </div>
            <div class="uk-card-body uk-form-stacked">
                <?php
//                $redux = \Redux::instance($this -> opt_name);
                $redux  = $this -> redux;

                if($redux && !empty($redux -> field_sections)){

//                    if (\version_compare(\Redux_Core::$version, '4.3.7', '<=')) {
//                        $redux->_register_settings();
//                    } elseif(isset($redux -> options_class) && !empty($redux -> options_class)) {
//                        $redux->options_class->register();
//                    }
//
////                    if(!empty($redux -> fields)) {
//                        $my_enqueue = new \TemPlazaFramework\Enqueue($redux);
//                        $my_enqueue->framework_init();
////                    }

//                if($redux = $this -> redux){

                    foreach ($redux -> sections as $k => $section) {
                        echo '<div class="field-tz_presets-group">';
//                        echo '<fieldset class="redux-field">';
//                        echo '<div>';

                        $section['class'] = isset($section['class']) ? ' ' . $section['class'] : '';

                        do_action("redux/page/{$redux->args['opt_name']}/section/before", $section);
                        do_settings_sections( $redux->args['opt_name'] . $k . '_section_group' );
                        do_action("redux/page/{$redux->args['opt_name']}/section/after", $section);

//                        echo '</div>';
//                        echo '</fieldset>';
                        echo '</div>';
                    }

//                    if(\version_compare(\Redux_Core::$version, '4.3.7', '<=')) {
//                        $redux->generate_panel();
//                    }else{
//                        $redux -> render_class -> generate_panel();
//                    }

                }
                ?>

                <button type="button" class="uk-button uk-button-primary uk-margin-top uk-margin-bottom js-save-preset" data-secret="<?php
                echo $secret; ?>"><?php
                    echo __('Save Preset', $this -> text_domain);?></button>
            </div>
        </div>
    </div>
</div>
<?php } ?>