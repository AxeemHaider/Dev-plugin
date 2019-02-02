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

define('APP_PATH', dirname(__FILE__));

 /**
  * Code run when the plugin activate
  */
  function dev_plugin_activation(){
      Inc\Base\Activate::activate();
  }
  //register_activation_hook( __FILE__, 'dev_plugin_activation' );

  /**
   * This code run when the plugin deactivate
   */
  function dev_plugin_deactivate(){
      Inc\Base\Deactivate::deactivate();
  }
  //register_activation_hook( __FILE__, 'dev_plugin_deactivate' );

  /**
   * Run all the services classes
   */
  if (class_exists('Inc\\Init')){
      Inc\Init::registerServices();
  }