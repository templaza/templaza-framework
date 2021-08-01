<?php
/**
 * Base layout for all admin pages
 */

if(isset($nav_tabs) && $nav_tabs){
?>
        <div class="uk-width-expand@s">
            <nav class="uk-navbar-container uk-navbar-transparent" data-uk-navbar>
                <div class="uk-margin-auto-left@m uk-margin-remove-right@m uk-margin-auto">
                    <ul class="uk-navbar-nav uk-margin-remove">
				        <?php foreach( $nav_tabs as $tab_id => $tab_info ) {
					        $feature_tab_class  = $this -> get_current_page() === $tab_id ? 'nav-item uk-active' : 'nav-item';
					        $feature_tab_class .= ' nav-item-' . $tab_id;
					        $target = ! empty( $tab_info['target'] ) ? $tab_info['target'] : '_self';
					        ?>
                            <li class="<?php echo esc_attr( $feature_tab_class )?> uk-margin-remove">
                                <a href="<?php echo esc_url( $tab_info['url'] ); ?>" target="<?php echo esc_attr( $target ); ?>">
							        <?php echo $tab_info['label']; ?>
                                </a>
                            </li>
				        <?php } ?>
                    </ul>
                </div>
            </nav>
        </div>
<?php } ?>