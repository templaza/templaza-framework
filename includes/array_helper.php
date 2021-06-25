<?php

namespace TemPlazaFramework;

defined( 'ABSPATH' ) || exit;

use ScssPhp\ScssPhp\Compiler;

if(!class_exists('TemPlazaFramework\Array_Helper')){

    class Array_Helper{
        protected static $cache         = array();

        /**
         * Merge a Registry object into this one
         *
         * @param   array  $source          Source array to merge.
         * @param   array  $destination     Destination array to merge.
         * @param   boolean   $recursive    True to support recursive merge the children values.
         *
         * @return  array|false  Return array merged or false if source and destination are empty.
         *
         * @since   1.0
         */
        public static function merge($source, $destination, $recursive = false)
        {
            $storeId    = __METHOD__;
            $storeId   .= ':'.serialize($source);
            $storeId   .= ':'.serialize($destination);
            $storeId   .= ':'.serialize($recursive);
            $storeId    = md5($storeId);

            if(isset(self::$cache[$storeId])){
                return self::$cache[$storeId];
            }

            if(!$destination && $source){
                return (array) $source;
            }elseif(!$destination && !$source){
                return false;
            }

            $new_data   = $destination;

            self::bindData($new_data, $source, $recursive, false);

            if(count($new_data)){
                self::$cache[$storeId]  = $new_data;
                return $new_data;
            }
            return false;
        }

        public static function bindData(&$parent, $data, $recursive = true, $allowNull = true)
        {
//            // The data object is now initialized
//            $this->initialized = true;

            // Ensure the input data is an array.
            $data = \is_object($data) ? get_object_vars($data) : $data;

            foreach ($data as $k => $v)
            {
                if (!$allowNull && !(($v !== null) && ($v !== '')))
                {
                    continue;
                }

//                if ($recursive && ((\is_array($v) && self::isAssociative($v)) || \is_object($v)))
//                if ($recursive && (\is_array($v) || \is_object($v)))
//                {
//                    if (is_object($parent) && !isset($parent->$k))
//                    {
//                        $parent->$k = new \stdClass;
//                    }elseif(is_array($parent) && !isset($parent[$k])){
//                        $parent[$k] = array();
//                    }
//
//                    if(is_array($parent)){
//                        self::bindData($parent[$k], $v);
//                    }else {
//                        self::bindData($parent->$k, $v);
//                    }
//
//                    continue;
//                }


                if ($recursive && ((\is_array($v) && self::isAssociative($v)) || \is_object($v)))
                {
                    if (is_object($parent) && !isset($parent->$k))
                    {
                        $parent->$k = new \stdClass;
                    }elseif(is_array($parent) && !isset($parent[$k])){
                        $parent[$k] = array();
                    }

                    if(is_array($parent)){
                        self::bindData($parent[$k], $v,$recursive, $allowNull);
                    }else {
                        self::bindData($parent->$k, $v,$recursive, $allowNull);
                    }

                    continue;
                }

                if(is_array($parent)){
                    $parent[$k] = $v;
                }else {
                    $parent->$k = $v;
                }
            }
        }
        /**
         * Method to determine if an array is an associative array.
         *
         * @param   array  $array  An array to test.
         *
         * @return  boolean
         *
         * @since   1.0
         */
        public static function isAssociative($array)
        {
            if (\is_array($array))
            {
                foreach (array_keys($array) as $k => $v)
                {
                    if ($k !== $v)
                    {
                        return true;
                    }
                }
            }

            return false;
        }
    }
}