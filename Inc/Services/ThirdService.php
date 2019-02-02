<?php

namespace Inc\Services;

/**
 * This is just a test class
 */

 use Inc\Base\Service;

 class ThirdService extends Service{

    public function register()
    {
        echo 'Third Service <br>';
    }

    public static function runAfter()
    {
        return SecondService::class;
    }

 }