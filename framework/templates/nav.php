<?php
/**
 * Base layout for all admin pages
 */

if(isset($nav_tabs) && $nav_tabs){
?>
<nav class="templaza-framework__navbar mb-5">
    <ul>
        <?php foreach( $nav_tabs as $tab_id => $tab_info ) {
            $feature_tab_class  = $this -> get_current_page() === $tab_id ? 'nav-item active' : 'nav-item';
            $feature_tab_class .= ' nav-item-' . $tab_id;
            $target = ! empty( $tab_info['target'] ) ? $tab_info['target'] : '_self';
            ?>
            <li class="<?php echo esc_attr( $feature_tab_class )?>">
                <a href="<?php echo esc_url( $tab_info['url'] ); ?>" target="<?php echo esc_attr( $target ); ?>">
                    <?php echo $tab_info['label']; ?>
                </a>
            </li>
        <?php } ?>
    </ul>
</nav>
<?php } ?>