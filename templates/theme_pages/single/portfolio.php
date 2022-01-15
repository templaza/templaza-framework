<?php

defined('TEMPLAZA_FRAMEWORK') or exit();
use TemPlazaFramework\Functions;
$options            = Functions::get_theme_options();
$post_type          = get_post_type(get_the_ID());
$prefix             = $post_type.'-page';
$thumbnail_size     = $options[$prefix.'-image-size'];
$gallery_size       = $options[$prefix.'-gallery-size'];
?>
<div class="templaza-portfolio-single">
	<?php
	if(have_posts()):
		while(have_posts()):the_post();
			do_action('templaza_set_postviews',get_the_ID());
			?>
            <div class="templaza-portfolio-item-wrap uk-margin-large-top">
                <h1 class="templaza-portfolio-item-title title uk-heading-small uk-container-small uk-container uk-text-center">
					<?php the_title(); ?>
                </h1>
                <div class="templaza-blog-item-info templaza-post-meta uk-article-meta uk-text-center uk-margin-large-bottom">
                    <span><?php echo esc_html(get_the_date()); ?></span>
                    <span class="author">
                    <?php echo get_the_author_posts_link();?>
                    </span>
                    <span class="category">
                        <?php
                        $alita_cat_portfolio = get_the_terms( get_the_ID() , 'portfolio-category' );
                        // init counter
                        $i = 1;
                        if($alita_cat_portfolio){
	                        foreach ( $alita_cat_portfolio as $term ) {
		                        $alita_term_link = get_term_link( $term, 'portfolio-category');
		                        if( is_wp_error( $alita_term_link ) )
			                        continue;
		                        if($i < count($alita_cat_portfolio)){
			                        ?>
                                    <a href="<?php echo esc_url($alita_term_link);?>"><?php echo esc_html($term->name.',');?></a>
			                        <?php
		                        }else{
			                        ?>
                                    <a href="<?php echo esc_url($alita_term_link);?>"><?php echo esc_html($term->name);?></a>
			                        <?php
		                        }
		                        $i++;
	                        }
                        }
                        ?>
                    </span>

					<?php
					edit_post_link();
					?>
                </div>
                <div class="uk-container uk-container-large uk-margin-large">
                    <div class="uk-inline"><?php the_post_thumbnail($thumbnail_size,array( 'alt' => '' )); ?></div>
                </div>
                <div class="uk-container uk-container-small uk-margin-large uk-text-lead">
                    <?php the_excerpt(); ?>
                </div>
                <?php
                $alita_portfolio_gallery   = get_post_meta(get_the_ID(), 'gallery');
                if ($alita_portfolio_gallery && count($alita_portfolio_gallery)) {
                    if(count($alita_portfolio_gallery) == 1 && strpos($alita_portfolio_gallery[0], ',') != false){
                        $alita_portfolio_gallery    = explode(',', $alita_portfolio_gallery[0]);
                    }
                    ?>
                    <div class="templaza-portfolio-gallery uk-container uk-container-large uk-margin-large">
                        <div class="uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m uk-text-center uk-grid-small" data-uk-grid="masonry: true" data-uk-lightbox="animation: scale">
			                <?php
			                foreach ($alita_portfolio_gallery as $attach_id){
				                $item_url = wp_get_attachment_url( $attach_id );
				                $item_caption = wp_get_attachment_metadata( $attach_id );
				                $attachment = get_post($attach_id);
				                ?>
                                <div class="templaza-gallery-item">
                                    <div class="img-inner">
                                        <a class="uk-inline" href="<?php echo esc_url($item_url)?>" >
                                            <i class="fas fa-search"></i>
                                        </a>
						                <?php echo wp_get_attachment_image($attach_id, $gallery_size); ?>
                                        <div class="uk-overlay uk-light uk-position-bottom uk-position-z-index"><?php echo esc_html($attachment->post_excerpt); ?></div>
                                    </div>
                                </div>
				                <?php
			                }
			                ?>
                        </div>
                    </div>
                    <?php
                }
                ?>

                <div class="templaza-single-content uk-margin-large uk-container-small uk-container">
					<?php
					the_content();
					wp_link_pages();
					?>
                </div>

				<?php
				$alita_tag_portfolio = wp_get_post_terms( get_the_ID() , 'portfolio_tag' );
				// init counter
				if($alita_tag_portfolio){
					?>
                    <div class="tz-item-tags uk-margin-large uk-article-meta uk-container-small uk-container">
						<?php
						foreach ( $alita_tag_portfolio as $term ) {
							$alita_term_link = get_term_link( $term, array( 'portfolio_tag') );
							if( is_wp_error( $alita_term_link ) )
								continue;
							?>
                            <a href="<?php echo esc_url($alita_term_link);?>"><?php echo esc_html('#'.$term->name);?></a>
							<?php
						}
						?>
                    </div>
					<?php
				}
				?>
	            <?php
	            $alita_portfolio_embed = get_post_meta( get_the_ID(),'oembed', true );
	            if ($alita_portfolio_embed ) {
                    $video = parse_url($alita_portfolio_embed);
                    switch($video['host']) {
                        case 'youtu.be':
                            $id = trim($video['path'],'/');
                            $src = '//www.youtube.com/embed/' . $id .'?iv_load_policy=3';
                            break;

                        case 'www.youtube.com':
                        case 'youtube.com':
                            parse_str($video['query'], $query);
                            $id = $query['v'];
                            $src = '//www.youtube.com/embed/' . $id .'?iv_load_policy=3';
                            break;

                        case 'vimeo.com':
                        case 'www.vimeo.com':
                            $id = trim($video['path'],'/');
                            $src = "//player.vimeo.com/video/{$id}?autoplay=1&loop=1&muted=1&autopause=0&title=0&byline=0&portrait=0&controls=0";
                    }
                    echo '<div class="templaza-portfolio-embed uk-container uk-container-large uk-margin-large">';
                    echo '<div class="tz-embed-responsive tz-embed-responsive-16by9">';
	                echo '<iframe class="tz-embed-responsive-item" src="'.esc_url($src)
                        .'" webkitAllowFullScreen mozallowfullscreen allowFullScreen loading="lazy"></iframe>';
	                echo '</div>';
	                echo '</div>';
                }
                ?>
            </div>
            <div class="templaza-basic-nav-post uk-container uk-container-large uk-margin-large-top uk-margin-large-bottom">
				<?php
				// Previous/next post navigation.
				$alita_next =  '<span data-uk-icon="icon: arrow-right"></span>';
				$alita_prev =  '<span data-uk-icon="icon: arrow-left"></span>';

				$alita_next_label     = esc_html__( 'Next post', 'alita' );
				$alita_previous_label = esc_html__( 'Previous post', 'alita' );

				the_post_navigation(
					array(
						'next_text' => '<p class="meta-nav ">' . $alita_next_label . $alita_next . '</p><h5 class="post-title">%title</h5>',
						'prev_text' => '<p class="meta-nav">' . $alita_prev . $alita_previous_label . '</p><h5 class="post-title">%title</h5>',
					)
				);
				?>
            </div>
		<?php
		endwhile;
	endif;
	?>
</div>