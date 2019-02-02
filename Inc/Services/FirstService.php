<?php

namespace Inc\Services;

/**
 * This is just a test class
 */

 use Inc\Base\Service;

 class FirstService extends Service{

    public function register()
    {
        echo 'First Service <br>';
    }

    
    public static function runAfter()
    {
       return ThirdService::class;
    }

 }