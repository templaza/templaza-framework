<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Enqueue;
use TemPlazaFramework\Functions;

$redux  = $this -> redux;
if($redux){
$enqueue    = new Enqueue($redux);
$enqueue -> init();
?>

<script type="text/html" id="tmpl-templaza-metabox-megamenu-template">
    <div class="templaza-mega-menu-options">
        <div class="fl_column-container">
            <?php
            ob_start();
            $redux -> generate_panel();
//            foreach($redux -> sections as $k => $tab){
//
//            }
            $content = ob_get_contents();
            ob_end_clean();

            if(preg_match('/(<sc)(ript\s+type=[\'|"]text\/javascript[\'|"]?)(>)/', $content, $match)){
                $content    = preg_replace('/(<sc)(ript\s+type=[\'|"]text\/javascript[\'|"]>)/', '<# print(\'$1\' + \'$2\');#>', $content);
                $content = preg_replace('/(<\/sc)(ript>)/','<# print(\'$1\'+\'$2\');#>', $content);
            }
            echo $content;
                ?>
        </div>
    </div>
</script>

<?php } ?>