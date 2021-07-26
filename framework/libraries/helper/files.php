<?php

namespace TemPlazaFramework\Helpers;

defined( 'TEMPLAZA_FRAMEWORK' ) || exit;

if(!class_exists('TemPlazaFramework\Helpers\Files')){
    class Files{
        public static function get_files_of_folder($folder_path, $filter = '.', $recurse = false, $full = false, $exclude = array('.svn', 'CVS', '.DS_Store', '__MACOSX'),
                                            $excludefilter = array('^\..*', '.*~'), $naturalSort = false){
            if(!$folder_path || ($folder_path && !is_dir($folder_path))){
                return array();
            }

            // Compute the excludefilter string
            if (count($excludefilter))
            {
                $excludefilter_string = '/(' . implode('|', $excludefilter) . ')/';
            }
            else
            {
                $excludefilter_string = '';
            }

            // Get the files
            $arr = self::_items($folder_path, $filter, $recurse, $full, $exclude, $excludefilter_string, true);

            // Sort the files based on either natural or alpha method
            if ($naturalSort)
            {
                natsort($arr);
            }
            else
            {
                asort($arr);
            }

            return array_values($arr);
        }

        protected static function _items($path, $filter, $recurse, $full, $exclude, $excludefilter_string, $findfiles)
        {
            @set_time_limit(ini_get('max_execution_time'));

            $arr = array();

            // Read the source directory
            if (!($handle = @opendir($path)))
            {
                return $arr;
            }

            while (($file = readdir($handle)) !== false)
            {
                if ($file != '.' && $file != '..' && !in_array($file, $exclude)
                    && (empty($excludefilter_string) || !preg_match($excludefilter_string, $file)))
                {
                    // Compute the fullpath
                    $fullpath = $path . '/' . $file;

                    // Compute the isDir flag
                    $isDir = is_dir($fullpath);

                    if (($isDir xor $findfiles) && preg_match("/$filter/", $file))
                    {
                        // (fullpath is dir and folders are searched or fullpath is not dir and files are searched) and file matches the filter
                        if ($full)
                        {
                            // Full path is requested
                            $arr[] = $fullpath;
                        }
                        else
                        {
                            // Filename is requested
                            $arr[] = $file;
                        }
                    }

                    if ($isDir && $recurse)
                    {
                        // Search recursively
                        if (is_int($recurse))
                        {
                            // Until depth 0 is reached
                            $arr = array_merge($arr, self::_items($fullpath, $filter, $recurse - 1, $full, $exclude, $excludefilter_string, $findfiles));
                        }
                        else
                        {
                            $arr = array_merge($arr, self::_items($fullpath, $filter, $recurse, $full, $exclude, $excludefilter_string, $findfiles));
                        }
                    }
                }
            }

            closedir($handle);

            return $arr;
        }
    }
}