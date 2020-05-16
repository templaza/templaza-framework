<?php
/**
 * The template for the menu container of the panel.
 *
 * Override this template by specifying the path where it is stored (templates_path) in your Redux config.
 *
 * @author 	Redux Framework
 * @package 	ReduxFramework/Templates
 * @version:    3.5.4
 */

?>
<ul class="nav">
<?php
        foreach ( $this->parent->sections as $k => $section ) {
            $title = isset ( $section[ 'title' ] ) ? $section[ 'title' ] : '';

            $skip_sec = false;
            foreach ( $this->parent->hidden_perm_sections as $num => $section_title ) {
                if ( $section_title == $title ) {
                    $skip_sec = true;
                }
            }

            if ( isset ( $section[ 'customizer_only' ] ) && $section[ 'customizer_only' ] == true ) {
                continue;
            }

            if ( false == $skip_sec ) {
                $li = $this->parent->section_menu ( $k, $section );
//                if(preg_match('/(class=\")/i', $li)) {
////                    preg_match('/(<ul.*?class=")(.*?<\/ul>)/i', $li, $match);
////                    var_dump($match); die();
////                    $li = preg_replace('/(^<li.*?class=\")(.*>$)/i', '$1nav $2', $li);
//                    $li = preg_replace('/(class=\")/i', '$1nav-item ', $li);
//                    if(preg_match('/(<ul.*?class=")(.*?<\/ul>)/i', $li, $match)) {
//                        $li = preg_replace('/(<ul.*?class=")(.*?<\/ul>)/i', '<div class="collapse">$1nav sub-menu $2</div>', $li) ;
//                    }
//                }

                if(preg_match('/(redux-group-tab-link-li)/i', $li)){
                    $li = preg_replace('/(redux-group-tab-link-li)/i','nav-item $1', $li);

                    if(preg_match('/(<ul.*?class=".*?)(subsection?)(.*?<\/ul>)/', $li)) {
//                        $li = preg_replace('/(^<li.*?<a)/','$1 data-toggle="collapse"', $li);
                        $li = preg_replace('/(<ul.*?class=".*?)(subsection?.*?<\/ul>)/', '$1nav sub-menu $2', $li) ;
//                        $li = preg_replace('/(<ul.*?(id=".*?").*?class=".*?)(subsection?)(.*?<\/ul>)/', '<div $2 class="collapse">$1nav sub-menu $4</div>', $li) ;
//                        $li = preg_replace('/(<ul.*?class=".*?)(subsection?)(.*?<\/ul>)/', '<div class="collapse">$1nav sub-menu $3</div>', $li) ;
                    }
                }
                if(preg_match('/(redux-group-tab-link-a)/i', $li)){
                    $li = preg_replace('/(redux-group-tab-link-a)/i','nav-link $1', $li);
                }
                echo $li;
                $skip_sec = false;
            }
        }

        /**
         * action 'redux-page-after-sections-menu-{opt_name}'
         *
         * @param object $this ReduxFramework
         */
        do_action ( "redux-page-after-sections-menu-{$this->parent->args[ 'opt_name' ]}", $this );

        /**
         * action 'redux/page/{opt_name}/menu/after'
         *
         * @param object $this ReduxFramework
         */
        do_action ( "redux/page/{$this->parent->args[ 'opt_name' ]}/menu/after", $this );
?>
</ul>