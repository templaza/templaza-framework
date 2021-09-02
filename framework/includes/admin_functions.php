<?php

namespace TemPlazaFramework;

defined( 'ABSPATH' ) || exit;

if(!class_exists('TemPlazaFramework\Admin_Functions')){

    class Admin_Functions extends Functions {

        /**
         * Increment styles.
         *
         * @var    array
         * @since  1.0.1
         */
        protected static $incrementStyles = [
            'dash'    => [
                '#-(\d+)$#',
                '-%d',
            ],
            'default' => [
                ['#\((\d+)\)$#', '#\(\d+\)$#'],
                [' (%d)', '(%d)'],
            ],
        ];

        public static function is_post_type($post_type){
            $is_post_type = false;
            if((isset($_GET['post_type']) && $_GET['post_type'] == $post_type)
                || (isset($_GET['post']) && get_post_type( $_GET['post'] ) == $post_type)) {
                $is_post_type = true;
            }
            return $is_post_type;
        }

        public static function is_home($post_id){
            if(!$post_id){
                return false;
            }
            $is_home = (bool) get_post_meta($post_id, 'home', true);
            return $is_home;
        }


        /**
         * Filters the post title before it is generated to be unique.
         *
         * Returning a non-null value will short-circuit the
         * unique slug generation, returning the passed value instead.
         *
         * @since 1.0.1
         *
         * @param string|null $override_title Short-circuit return value.
         * @param string      $title          The desired slug (post_name).
         * @param int         $post_ID       Post ID.
         * @param string      $post_status   The post status.
         * @param string      $post_type     Post type.
         * @param int         $post_parent   Post parent ID.
         */
        public static function unique_post_title($title, $post_ID, $post_status, $post_type, $post_parent){
            if ( in_array( $post_status, array( 'draft', 'pending', 'auto-draft' ), true )
                || ( 'inherit' === $post_status && 'revision' === $post_type ) || 'user_request' === $post_type
            ) {
                return $title;
            }

            $override_title = apply_filters( 'templaza-framework/pre_unique_post_title', null, $title, $post_ID, $post_status, $post_type, $post_parent );
            if ( null !== $override_title ) {
                return $override_title;
            }

            global $wpdb;

            $original_title = $title;

            // Post slugs must be unique across all posts.
            $check_sql       = "SELECT post_title FROM $wpdb->posts WHERE post_title = %s AND post_type = %s AND ID != %d LIMIT 1";
            $post_title_check = $wpdb->get_var( $wpdb->prepare( $check_sql, $title, $post_type, $post_ID ) );

            if($post_title_check) {
                do {
                    $alt_post_title = static::increment($post_title_check);
                    $post_title_check = $wpdb->get_var($wpdb->prepare($check_sql, $alt_post_title, $post_type, $post_ID));
                } while ($post_title_check);

                $title  = $alt_post_title;
            }

            return apply_filters( 'templaza-framework/unique_post_title', $title, $post_ID, $post_status, $post_type, $post_parent, $original_title );
        }

        /**
         * Increments a trailing number in a string.
         *
         * Used to easily create distinct labels when copying objects. The method has the following styles:
         *
         * default: "Label" becomes "Label (2)"
         * dash:    "Label" becomes "Label-2"
         *
         * @param   string       $string  The source string.
         * @param   string|null  $style   The the style (default|dash).
         * @param   integer      $n       If supplied, this number is used for the copy, otherwise it is the 'next' number.
         *
         * @return  string  The incremented string.
         *
         * @since   1.0.1
         */
        public static function increment($string, $style = 'default', $n = 0)
        {
            $styleSpec = static::$incrementStyles[$style] ?? static::$incrementStyles['default'];

            // Regular expression search and replace patterns.
            if (\is_array($styleSpec[0]))
            {
                $rxSearch  = $styleSpec[0][0];
                $rxReplace = $styleSpec[0][1];
            }
            else
            {
                $rxSearch = $rxReplace = $styleSpec[0];
            }

            // New and old (existing) sprintf formats.
            if (\is_array($styleSpec[1]))
            {
                $newFormat = $styleSpec[1][0];
                $oldFormat = $styleSpec[1][1];
            }
            else
            {
                $newFormat = $oldFormat = $styleSpec[1];
            }

            // Check if we are incrementing an existing pattern, or appending a new one.
            if (preg_match($rxSearch, $string, $matches))
            {
                $n      = empty($n) ? ($matches[1] + 1) : $n;
                $string = preg_replace($rxReplace, sprintf($oldFormat, $n), $string);
            }
            else
            {
                $n = empty($n) ? 2 : $n;
                $string .= sprintf($newFormat, $n);
            }

            return $string;
        }
    }
}