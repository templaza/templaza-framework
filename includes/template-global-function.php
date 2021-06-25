<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function templaza_comment( $templaza_comment, $templaza_args, $templaza_depth ) {
    switch ( $templaza_comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
            ?>
            <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <p class="templaza-comment-item-content uk-margin-small-top"><?php  esc_html_e( 'Pingback:', 'martha'); ?> <?php comment_author_link(); ?> <?php edit_comment_link(  esc_html__( '(Edit)', 'martha'), '<span class="edit-link">', '</span>' ); ?></p>
            <?php
            break;
        default :
            // Proceed with normal comments.
            ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <article id="comment-<?php comment_ID(); ?>" class="comments">
                <div class="comment-meta comment-author vcard">
                    <?php
                    echo balanceTags(get_avatar( $templaza_comment, 75 ));
                    ?>
                </div>
                <?php if ( '0' == $templaza_comment->comment_approved ) : ?>
                    <p class="comment-awaiting-moderation"><?php  esc_html_e( 'Your comment is awaiting moderation.', 'martha'); ?></p>
                <?php endif; ?>
                <div class="comment-content">
                    <div class="comment-head">
                        <?php
                        printf( '<h5 class="fn">%1$s</h5>',
                            get_comment_author_link()
                        );
                        ?>
                        <div class="comment-info">
                            <span class="time"><?php comment_time(); ?></span>
                            <span class="sp"> <?php esc_html_e('-','martha'); ?></span>
                            <span class="date"><?php comment_date(); ?></span>
                        </div>
                    </div>
                    <div class="templaza-comment-item-content uk-margin-small-top">
                        <?php comment_text(); ?>
                    </div>
                    <div class="edit-reply">
                        <?php if ( current_user_can( 'edit_comment', $templaza_comment->comment_ID ) ) {
                            edit_comment_link( esc_html__( 'Edit', 'martha' ) );
                            comment_reply_link( array_merge( $templaza_args, array( 'reply_text' => esc_html__('Reply','martha'), 'depth' => $templaza_depth, 'max_depth' => $templaza_args['max_depth'], 'before' => '<span class="sp"> '.esc_html__('/','martha').' </span>' ) ) );
                        }else{

                            comment_reply_link( array_merge( $templaza_args, array( 'reply_text' => esc_html__('Reply','martha'), 'depth' => $templaza_depth, 'max_depth' => $templaza_args['max_depth'] ) ) );
                        } ?>
                    </div>
                </div><!-- .comment-content -->
                <div class="clearfix"></div>
            </article><!-- #comment-## -->
            <?php
            break;
    endswitch;
}