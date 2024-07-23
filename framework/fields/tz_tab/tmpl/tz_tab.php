<?php

defined('TEMPLAZA_FRAMEWORK') or exit;

use TemPlazaFramework\Enqueue;

if(isset($this->field) &&  !empty($this->field)){

    // No errors please
    $defaults    = array(
        'indent'   => '',
        'style'    => '',
        'class'    => '',
        'title'    => '',
        'subtitle' => '',
    );
    $this->field = wp_parse_args( $this->field, $defaults );

    $tab_titles     = '';
    $tab_contents   = '';

    if(isset($this -> field['tabs']) && count($this -> field['tabs'])){

        $redux      = $this -> redux;
        $args       = $redux -> args;
        $opt_name   = $args['opt_name'];

//        $redux      = Redux::instance($opt_name);
        if(\version_compare(\Redux_Core::$version, '4.3.7', '<=')) {
            $redux->_register_settings();
//            $enqueue    = new Enqueue($redux);
//            $enqueue -> init();
        }else{
            $redux -> options_class -> register();
//            $my_enqueue = new Enqueue($redux);
//            $my_enqueue ->init();
        }
        $my_enqueue = new Enqueue($redux);
        $my_enqueue ->framework_init();

        foreach($redux -> sections as $k => $tab){

            $tab_titles     .= '<li><a href="#tz_tab-'.$tab['id'].'">'.$tab['title'].'</a></li>';

            $tab_contents   .= '<div id="tz_tab-'.$tab['id'].'">';

            if(isset($tab['fields']) && count($tab['fields'])){
                foreach ($tab['fields'] as $field) {
                    add_filter("redux/options/{$opt_name}/field/{$field['id']}", function($_field)use($field){
                        $_field['name'] = $_field['id'];
                        return $_field;
                    });
                }
            }

            $tab['class'] = isset($tab['class']) ? ' ' . $tab['class'] : '';
            $tab_contents .= '<div id="'.$this -> field['type'].'_' . $k . '_section_group' . '" class="uk-display-block uk-padding-remove-horizontal redux-group-tab' . esc_attr($tab['class']) . '" data-rel="'.$this -> field['type'].'_' . $k . '">';
            $tab_contents .= '<div class="redux-container"  data-opt-name="'.$opt_name.'">';

            ob_start();
            do_settings_sections( $redux->args['opt_name'] . $k . '_section_group' );
            $tab_contents   .= ob_get_contents();
            ob_end_clean();

            $tab_contents .= '</div>';
            $tab_contents .= '</div>';
            $tab_contents   .= '</div>';
        }
    }
    // phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped

    echo '<div id="tz_tab-'.esc_attr($this -> field['id']).'-tab" class="tzfrm-ui-tab" data-fl-tz_layout-tab>
                    <ul>'.$tab_titles.'</ul>
                    '.$tab_contents.'
                </div>';
}
