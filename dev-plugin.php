<?php

/*
 * Plugin Name: Dev Plugin
 * Plugin URI: http://localhost/wordpress
 * Description: This plugin is used just for development process
 * Version: 1.0
 * Licence: GPLv2 or later
 * Author: Azeem Haider 
 */

 //defined("ABSPATH") or die("Forbidden access, you don't have permission to access this plugin");

 // specify the auto load feature
 if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ){
     require_once dirname( __FILE__ ) . '/vendor/autoload.php';
 }

/**
 * Define plugin constant
 */
define('APP_PATH', dirname(__FILE__));
define('PLUGIN_PATH', plugin_dir_path( __FILE__ ));
define('PLUGIN_NAME', plugin_basename( __FILE__ ));
define('PLUGIN_URL', plugin_dir_url( __FILE__ ));

/**
 * Save these constant into Config class
 */
class Config{
    const APP_PATH      = APP_PATH;
    const PLUGIN_PATH   = PLUGIN_PATH;
    const PLUGIN_NAME   = PLUGIN_NAME;
    const PLUGIN_URL    = PLUGIN_URL;
}


 /**
  * Code run when the plugin activate
  */
  function dev_plugin_activation(){
      Inc\Base\Activate::activate();
  }
  register_activation_hook( __FILE__, 'dev_plugin_activation' );

  /**
   * This code run when the plugin deactivate
   */
  function dev_plugin_deactivate(){
      Inc\Base\Deactivate::deactivate();
  }
  register_activation_hook( __FILE__, 'dev_plugin_deactivate' );

  /**
   * Run all the services classes
   */
  if (class_exists('Inc\\Init')){
      Inc\Init::registerServices();
  }