<?php
defined('ABSPATH') or exit();
$templaza_link = get_post_meta(get_the_ID(), '_format_link_url', true);
if($templaza_link){
?>
<div class="templaza-blog-item-link uk-padding-small uk-margin-top uk-margin-bottom">
    <a target="_blank" title="<?php the_title(); ?>"
       href="<?php echo esc_url($templaza_link); ?>">
        <?php echo esc_html($templaza_link); ?>
    </a>
</div>
<?php
}