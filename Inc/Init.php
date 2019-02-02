<?php

namespace Inc;

/**
 * Responsible to initialize all the services classes
 */

 use Inc\Utils\DirectoryScanner;

 final class Init{

    private static $serviceClass = 'Inc\Base\Service';
    private static $waitingQueue = [];
    private static $completedServices = [];
    
    public static function registerServices(){

        $services = self::getServices();

        // instantiate all the services
        foreach ($services as $service) {
            // Check runAfter method is specified in this service
            if ($service::runAfter() == self::$serviceClass){
                
                // instantiate this service
                self::instantiate($service);

            }else{

                // check other service is completed
                if ( in_array($service::runAfter(), self::$completedServices) ){

                    // instantiate this service
                    self::instantiate($service);

                }else{

                    // Add this service in waiting queue
                    self::waitingQueue($service); 

                }

            } // end if else

        } // end foreach
        
    }

    public static function waitingQueue($service){

        // Check runAfter service is not added for this service
        // In this case it will create dead lock
        if ( ($serviceClass = array_search($service, self::$waitingQueue)) !== false ){

            if ( self::$waitingQueue[$serviceClass] == $service ) {

                // Dead lock both services waiting each other
                die("Dead lock <b>" . $serviceClass . "</b> and <b>". $service . "</b> waiting each other");

            }else{

                // Add this into waiting queue
                self::$waitingQueue[$service] = $service::runAfter();

            }

        }else{

            // Add this into waiting queue
            self::$waitingQueue[$service] = $service::runAfter();

        }

    }
    
    public static function runWaitingQueue($service){

        if ( ($serviceClass = array_search($service, self::$waitingQueue)) !== false ){

            // instantiate this service
            self::instantiate($serviceClass);

        }

    }

    public static function instantiate($serviceClass){
    
        $service = new $serviceClass();
        $service->register();

        // Add into completed list
        self::$completedServices[] = $serviceClass;

        // Run waiting queue
        self::runWaitingQueue($serviceClass);

    }

    public static function getServices(){

        $services = [];

        // Get All classes
        $classes = DirectoryScanner::getAllClasses();

        // Get only services classes
        foreach ($classes as $class) {
            if (is_subclass_of($class, self::$serviceClass)){
                $services[] = $class;
            }
        }

        return $services;

    }

 }