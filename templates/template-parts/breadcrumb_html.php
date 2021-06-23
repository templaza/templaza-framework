<?php
defined('ABSPATH') or exit();
$templaza_breadcrums_id      = 'breadcrumb';
$templaza_breadcrums_class   = 'templaza-breadcrumb';
$templaza_blog_title         = esc_html__('Blog',$this -> text_domain);
$templaza_home_title         = esc_html__('Home',$this -> text_domain);

/* If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. produtemplaza_cat) */
$templaza_custom_taxonomy    = 'product_cat';
$templaza_custom_taxonomy_1  = 'classes_category';

/* Get the query & post information */
global $post,$wp_query;

/* Do not display on the homepage */
if ( !is_front_page() ) {
    /* Build the breadcrums */
    echo '<ul id="' . esc_attr($templaza_breadcrums_id) . '" class="' . esc_attr($templaza_breadcrums_class) . '">';

    /* Home page */
    echo '<li class="item-home-txt"><span>'.esc_html__('You are here: ',$this -> text_domain).'</span></li>';
    echo '<li class="item-home"><a href="' . get_home_url() . '" title="' . esc_attr($templaza_home_title) . '">' . esc_html($templaza_home_title) . '</a></li>';

    if ( is_archive() && !is_tax() && !is_category() && !is_tag() && !is_author() ) {

        /* Blog page */
        if( get_option( 'page_for_posts' ) != '0' ){
            echo '<li class="item-blog"><a href="' . get_permalink( get_option( 'page_for_posts' )) . '" title="' . esc_attr($templaza_blog_title) . '">' . esc_html($templaza_blog_title) . '</a></li>';
        }
        if(is_month()){
            ?>
            <li class="item-current item-archive monthly-archive"><span class="bread-current bread-archive"><?php  single_month_title('&nbsp;'); ?></span></li>
            <?php
        }else{
            echo '<li class="item-current item-archive"><span class="bread-current bread-archive">' . post_type_archive_title('', false) . '</span></li>';
        }

    } elseif ( is_archive() && is_tax() && !is_category() && !is_tag() ) {

        /* If post is a custom post type */
        $templaza_post_type = get_post_type();

        /* If it is a custom post type display name and link */
        if($templaza_post_type != 'post') {

            /* Blog page */
            if( get_option( 'page_for_posts' ) != '0' && $templaza_post_type == 'post' ){
                echo '<li class="item-blog"><a href="' . get_permalink( get_option( 'page_for_posts' )) . '" title="' . esc_attr($templaza_blog_title) . '">' . esc_html($templaza_blog_title) . '</a></li>';
            }

            $templaza_post_type_object = get_post_type_object($templaza_post_type);
            $templaza_post_type_archive = get_post_type_archive_link($templaza_post_type);

            echo '<li class="item-cat item-custom-post-type-' . esc_attr($templaza_post_type) . '"><a href="' . esc_url($templaza_post_type_archive) . '" title="' . esc_attr($templaza_post_type_object->labels->name) . '">' . esc_html($templaza_post_type_object->labels->name) . '</a></li>';

        }

        $templaza_custom_tax_name = get_queried_object()->name;
        echo '<li class="item-current item-archive"><span class="bread-current bread-archive">' . esc_html($templaza_custom_tax_name) . '</span></li>';

    }
    elseif ( is_single() ) {

        /* If post is a custom post type */
        $templaza_post_type = get_post_type();

        /* Blog page */
        if( get_option( 'page_for_posts' ) != '0' && $templaza_post_type == 'post' ){
            echo '<li class="item-blog"><a href="' . get_permalink( get_option( 'page_for_posts' )) . '" title="' . esc_attr($templaza_blog_title) . '">' . esc_html($templaza_blog_title) . '</a></li>';
        }

        /* If it is a custom post type display name and link */
        if($templaza_post_type != 'post') {

            $templaza_post_type_object = get_post_type_object($templaza_post_type);
            $templaza_post_type_archive = get_post_type_archive_link($templaza_post_type);
            if($templaza_post_type_archive != false){
                echo '<li class="item-cat item-custom-post-type-' . esc_attr($templaza_post_type) . '"><a href="' . esc_url($templaza_post_type_archive) . '" title="' . esc_attr($templaza_post_type_object->labels->name) . '">' . esc_html($templaza_post_type_object->labels->name) . '</a></li>';
            }

        }

        /* Get post category info */
        $templaza_category = get_the_category();

        if(!empty($templaza_category)) {

            /* Get last category post is in */
            $templaza_category_array = array_values($templaza_category);
            $templaza_last_category = end($templaza_category_array);

            /* Get parent any categories and create array */
            $templaza_get_cat_parents = rtrim(get_category_parents($templaza_last_category->term_id, true, ','),',');
            $templaza_cat_parents = explode(',',$templaza_get_cat_parents);

            /* Loop through parent categories and store in variable $templaza_cat_display */
            $templaza_cat_display = '';
            foreach($templaza_cat_parents as $templaza_parents) {
                $templaza_cat_display .= '<li class="item-cat">'.ent2ncr($templaza_parents).'</li>';
            }

        }

        /* If it's a custom post type within a custom taxonomy */
        $templaza_taxonomy_exists = taxonomy_exists($templaza_custom_taxonomy);
        if(empty($templaza_last_category) && !empty($templaza_custom_taxonomy) && $templaza_taxonomy_exists) {

            $templaza_taxonomy_terms = get_the_terms( $post->ID, $templaza_custom_taxonomy );
            $templaza_cat_id         = $templaza_taxonomy_terms[0]->term_id;
            $templaza_cat_nicename   = $templaza_taxonomy_terms[0]->slug;
            $templaza_cat_link       = get_term_link($templaza_taxonomy_terms[0]->term_id, $templaza_custom_taxonomy);
            $templaza_cat_name       = $templaza_taxonomy_terms[0]->name;

        }

        /* If it's a custom post type within a custom taxonomy */
        $templaza_taxonomy_exists_1 = taxonomy_exists($templaza_custom_taxonomy_1);
        if(empty($templaza_last_category) && !empty($templaza_custom_taxonomy_1) && $templaza_taxonomy_exists_1) {

            $templaza_taxonomy_terms_1 = get_the_terms( $post->ID, $templaza_custom_taxonomy_1 );
            $templaza_cat_id_1         = $templaza_taxonomy_terms_1[0]->term_id;
            $templaza_cat_nicename_1   = $templaza_taxonomy_terms_1[0]->slug;
            $templaza_cat_link_1       = get_term_link($templaza_taxonomy_terms_1[0]->term_id, $templaza_custom_taxonomy_1);
            $templaza_cat_name_1       = $templaza_taxonomy_terms_1[0]->name;

        }

        /* Check if the post is in a category */
        if(!empty($templaza_last_category)) {
            if( !empty($templaza_cat_display) ){
                echo ent2ncr($templaza_cat_display);
            }

            /* Else if post is in a custom taxonomy */
        } elseif(!empty($templaza_cat_id)) {

            echo '<li class="item-cat item-cat-' . esc_attr($templaza_cat_id) . ' item-cat-' . esc_attr($templaza_cat_nicename) . '"><a href="' . esc_url($templaza_cat_link) . '" title="' . esc_attr($templaza_cat_name) . '">' . esc_html($templaza_cat_name) . '</a></li>';

        } elseif(!empty($templaza_cat_id_1)) {

            echo '<li class="item-cat item-cat-' . esc_attr($templaza_cat_id_1) . ' item-cat-' . esc_attr($templaza_cat_nicename_1) . '"><a href="' . esc_url($templaza_cat_link_1) . '" title="' . esc_attr($templaza_cat_name_1) . '">' . esc_html($templaza_cat_name_1) . '</a></li>';

        }
        echo '<li class="item-current item-' . esc_attr($post->ID) . '"><span class="bread-current bread-' . esc_attr($post->ID) . '"> ' . get_the_title() . '</span></li>';

    } elseif ( is_category() ) {
        /* Blog page */
        if( get_option( 'page_for_posts' ) != '0' ){
            echo '<li class="item-blog"><a href="' . get_permalink( get_option( 'page_for_posts' )) . '" title="' . esc_attr($templaza_blog_title) . '">' . esc_html($templaza_blog_title) . '</a></li>';
        }
        /* Category page */
        echo '<li class="item-current item-cat"><span class="bread-current bread-cat">' . single_cat_title('', false) . '</span></li>';

    } elseif ( is_page() ) {

        /* Standard page */
        if( $post->post_parent ){

            /* If child page, get parents */
            $templaza_anc = get_post_ancestors( $post->ID );

            /* Get parents in the right order */
            $templaza_anc = array_reverse($templaza_anc);

            /* Parent page loop */
            if ( !isset( $templaza_parents ) ) $templaza_parents = null;
            foreach ( $templaza_anc as $templaza_ancestor ) {
                $templaza_parents .= '<li class="item-parent item-parent-' . esc_attr($templaza_ancestor) . '"><a href="' . get_permalink($templaza_ancestor) . '" title="' . get_the_title($templaza_ancestor) . '">' . get_the_title($templaza_ancestor) . '</a></li>';
            }

            /* Display parent pages */
            echo ent2ncr($templaza_parents);

            /* Current page */
            echo '<li class="item-current item-' . esc_attr($post->ID) . '"><span title="' . get_the_title() . '"> ' . get_the_title() . '</span></li>';

        } else {

            /* Just display current page if not parents */
            echo '<li class="item-current item-' . esc_attr($post->ID) . '"><span class="bread-current bread-' . esc_attr($post->ID) . '"> ' . get_the_title() . '</span></li>';

        }

    } elseif ( is_tag() ) {

        /* Get tag information */
        $templaza_term_id        = get_query_var('tag_id');
        $templaza_taxonomy       = 'post_tag';
        $templaza_args           = 'include=' . $templaza_term_id;
        $templaza_terms          = get_terms( $templaza_taxonomy, $templaza_args );
        $templaza_get_term_id    = $templaza_terms[0]->term_id;
        $templaza_get_term_slug  = $templaza_terms[0]->slug;
        $templaza_get_term_name  = $templaza_terms[0]->name;

        /* Display the tag name */
        echo '<li class="item-current item-tag-' . esc_attr($templaza_get_term_id) . ' item-tag-' . esc_attr($templaza_get_term_slug) . '"><span class="bread-current bread-tag-' . esc_attr($templaza_get_term_id) . ' bread-tag-' . esc_attr($templaza_get_term_slug) . '">' . esc_html($templaza_get_term_name) . '</span></li>';

    } elseif ( is_day() ) {

        /* Day archive */

        /* Year link */
        echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . esc_html__(' Archives',$this -> text_domain) . '</a></li>';

        /* Month link */
        echo '<li class="item-month item-month-' . get_the_time('m') . '"><a href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . esc_html__(' Archives',$this -> text_domain) . '</a></li>';

        /* Day display */
        echo '<li class="item-current item-' . get_the_time('j') . '"><span class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . esc_html__(' Archives',$this -> text_domain) . '</span></li>';

    } elseif ( is_month() ) {

        /* Month Archive */

        /* Year link */
        echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . esc_html__(' Archives',$this -> text_domain) . '</a></li>';

        /* Month display */
        echo '<li class="item-month item-month-' . get_the_time('m') . '"><span class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . esc_html__(' Archives',$this -> text_domain) . '</span></li>';

    } elseif ( is_year() ) {

        /* Display year archive */
        echo '<li class="item-current item-current-' . get_the_time('Y') . '"><span class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . esc_html__(' Archives',$this -> text_domain) . '</span></li>';

    } elseif ( is_author() ) {

        /* Auhor archive */

        /* Get the author information */
        global $author;
        $templaza_userdata = get_userdata( $author );

        /* Display author name */
        echo '<li class="item-current item-current-' . esc_attr($templaza_userdata->user_nicename) . '"><span class="bread-current bread-current-' . $templaza_userdata->user_nicename . '" title="' . $templaza_userdata->display_name . '">' . esc_html__('Author: ',$this -> text_domain) . $templaza_userdata->display_name . '</span></li>';

    } elseif ( get_query_var('paged') ) {

        /* Paginated archives */
        echo '<li class="item-current item-current-' . get_query_var('paged') . '"><span class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.esc_html__('Page',$this -> text_domain) . ' ' . get_query_var('paged') . '</span></li>';

    } elseif ( is_search() ) {

        /* Search results page */
        echo '<li class="item-current item-current-' . get_search_query() . '"><span class="bread-current bread-current-' . get_search_query() . '" title="' . esc_html__('Search results for: ',$this -> text_domain) . get_search_query() . '">' . esc_html__('Search results for: ',$this -> text_domain) . get_search_query() . '</span></li>';

    } elseif ( is_404() ) {

        /* 404 page */
        echo '<li>' . esc_html__('Error 404',$this -> text_domain) . '</li>';
    }

    echo '</ul>';
}