<?php

namespace Inc\Services;

/**
 * This is just a test class
 */

 use Inc\Base\Service;

 class SecondService extends Service{

    public function register()
    {
        echo 'Second Service <br>';
    }


 }