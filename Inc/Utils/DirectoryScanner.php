<?php

namespace Inc\Utils;

/**
 * Find all the classes in this package
 */

 class DirectoryScanner{

    private static $classes = [];
    private static $files = [];

    public static function getAllClasses($searchDir = 'Inc'){

        // Get all Files
        self::getAllFiles($searchDir);

        // Loop each file and check class exist or not
        foreach (self::$files as $file) {
            if (class_exists($file)){
                self::$classes[] = $file;
            }
        }

        return self::$classes;

    }

    public static function getAllFiles($searchDir){

        $appRoot = \Config::APP_PATH . '/' . $searchDir;

        // Scan the base directory
        $baseDir = scandir($appRoot);

        // Remove the parent directories
        if (($key = array_search('..', $baseDir)) !== false) {
            unset($baseDir[$key]);
        }
        if (($key = array_search('.', $baseDir)) !== false) {
            unset($baseDir[$key]);
        }

        foreach ($baseDir as $scanItem) {

            $itemPath = $appRoot . '/'. $scanItem;

            if (!is_dir($itemPath)){
                $classPath = $searchDir . '\\' . basename($itemPath, '.php');
                self::$files[] = str_replace('/', '\\', $classPath);
            }else{
                self::getAllFiles($searchDir . '/' . $scanItem);
            }
        }

        return self::$files;
    }

 }