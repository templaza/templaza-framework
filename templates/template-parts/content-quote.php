<?php
defined('ABSPATH') or exit();
$templaza_quote_name = get_post_meta(get_the_ID(), '_format_quote_source_name', true);
$templaza_quote_url = get_post_meta(get_the_ID(), '_format_quote_source_url', true);
$templaza_quote_content = get_post_meta(get_the_ID(), '_format_quote_source_content', true);
?>

<?php if($templaza_quote_content){ ?>
<div class="templaza-blog-item-quote uk-margin-top uk-margin-bottom">
    <blockquote>
        <p><?php
            echo esc_html($templaza_quote_content);
            ?>
        </p>
        <?php
        if($templaza_quote_name && $templaza_quote_url==''){
            ?>
            <cite><?php echo esc_attr($templaza_quote_name);?></cite>
            <?php
        }
        if($templaza_quote_name && $templaza_quote_url){
            ?>
            <cite><a href="<?php echo esc_url($templaza_quote_url);?>"><?php echo esc_attr($templaza_quote_name);?></a></cite>
            <?php
        }
        ?>
    </blockquote>
</div>
    <?php
}
?>