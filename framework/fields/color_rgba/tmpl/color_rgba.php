<?php

/*
 * Acceptable values checks.  If the passed variable doesn't pass muster, we unset them
 * and reset them with default values to avoid errors.
 */

defined('TEMPLAZA_FRAMEWORK') or exit;

use \TemPlazaFramework\Functions;

$field_id = $this->field['id'];

$allow_global   = true;
if(isset($this -> field['options']['allow_global'])){
    $allow_global   = $this -> field['options']['allow_global'];
}

if(preg_match('/^(<div)([^>]*)(>)/', $_render)){

    $value          = $this -> value;
    $before_html    = '';
    $gbDataColor    = array();
    $gbValue        = isset($value['_global'])?$value['_global']:'';

    $list_colors    = Functions::get_global_colors();

    if(empty($list_colors)){
        $allow_global   = false;
    }

    if($allow_global){
    ob_start();
    ?>
    <div class="uk-button-group">
        <div class="uk-inline" data-tzfrm-global-color>
            <button type="button" class="uk-button uk-button-default uk-button-small" data-uk-tooltip="<?php
            _e('Global Color', 'templaza-framework'); ?>" style="margin-right: -1px">
                <span data-uk-icon="icon: world;ratio: 0.8"></span>
            </button>
            <div class="uk-width-medium uk-padding-small uk-height-max-medium uk-overflow-auto" data-uk-dropdown="mode: click; target: !.uk-button-group;">
                <ul class="uk-nav uk-dropdown-nav">
                <?php
                if(!empty($list_colors)){
                    foreach ($list_colors as $key => $colour){
                        $is_active  = false;
                        if(isset($colour['id']) && $colour['id'] == $gbValue){
                            $gbDataColor    = $colour;
                            $is_active      = true;
                        }
                ?>
                    <li<?php echo $is_active?' class="uk-active"':'';?>>
                        <a href="javascript:" class="uk-flex" data-tzfrm-global-color-theme="<?php
                        echo esc_attr(json_encode($colour)); ?>">
                            <div class="uk-width-expand">
                                <div class="sp-preview">
                                    <div class="sp-preview-inner uk-flex uk-flex-center uk-flex-middle" style="background-color: <?php
                                    echo $colour['color']['rgba']; ?>;">
                                        <span data-uk-icon="icon: check; ratio: 0.7"<?php
                                         echo !$is_active?' class="uk-hidden"':'';?> style="text-shadow: 0 0 1px #000"></span>
                                    </div>
                                </div>
                                <div><?php echo $colour['title']; ?></div>
                            </div>
                            <div class="uk-width-auto"><?php
                                if($colour['color']['alpha'] != 1){
                                echo $colour['color']['rgba'];
                             }else{
                                echo $colour['color']['color'];
                             }
                             ?></div>
                        </a>
                    </li>
                <?php }
                } ?>
                </ul>
            </div>
        </div>
        <div class="uk-inline">
    <?php
    $before_html    = ob_get_contents();
    ob_end_clean();
    }

    $_render    = preg_replace('/^(<div[^>]*)(>)/','$1data-choose-color="'
        .esc_attr($this -> field['options']['choose_color']).'"$2'.$before_html, $_render);

    if(preg_match('/(<\/div>)$/i', $_render, $match)){
        if($allow_global){
            ob_start();

            ?>
            <?php // Hidden input for global. ?>
            <input type="hidden" class="redux-hidden-_global"
                   data-id="<?php echo esc_attr( $field_id );?>-_global"
                   data-color="<?php //echo esc_attr(json_encode($gbDataColor)); ?>"
                   name="<?php echo esc_attr( $this->field['name'] . $this->field['name_suffix'] );?>[_global]"
                   id="<?php echo esc_attr( $field_id );?>-_global"
                   value="<?php echo isset($this->value['_global'])?esc_attr( $this->value['_global'] ):'';?>"/>

            <?php
            $global_html    = ob_get_contents();
            ob_end_clean();

            $_render    .= $global_html;
            $_render    .= '</div>';
            $_render    .= '</div>';
        }

    }

}
echo $_render;
?>