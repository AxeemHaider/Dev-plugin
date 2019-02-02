<?php

namespace Inc\Base;

/**
 * Base service class Any file which is extend from this class 
 * act as a service. Register function will be automatically 
 * called.
 */

 abstract class Service{

    public abstract function register();

    public static function runAfter(){
        return Service::class;
    }

 }