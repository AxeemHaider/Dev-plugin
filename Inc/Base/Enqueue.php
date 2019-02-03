<?php

namespace Inc\Base;

/**
 * Add style and scripts for us
 */

 class Enqueue extends Service{

    public function register(){
        add_action( 'admin_enqueue_scripts', array($this, 'enqueue') );
    }

    public function enqueue(){
        
        // Add the styles
        wp_enqueue_style( 'devPluginStyle', \Config::PLUGIN_URL . 'assets/style.min.css');

        // Add the scripts
        wp_enqueue_script( 'devPluginScript', \Config::PLUGIN_URL . 'assets/script.min.js' );

    }

 }