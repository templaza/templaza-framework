<?php
defined('ABSPATH') or exit();
if($args){
    $terms = get_terms( array(
        'taxonomy' => ''.$args['taxonomy'].'',
        'hide_empty'   => $args['empty']
    ) );
    if($terms){
        ?>
        <ul class="uk-list">

        <?php
        foreach ($terms as $item){
            ?>
            <li>
                <a href="<?php echo esc_url(get_term_link($item->term_id));?>">
                    <?php echo esc_attr($item->name);?>
                </a>
            </li>
            <?php
        }
        ?>
        </ul>
<?php
    }
}


?>