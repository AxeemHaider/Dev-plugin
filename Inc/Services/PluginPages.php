<?php

namespace Inc\Services;

/**
 * Create Plugin Pages
 */

use Inc\Base\Service;

 class PluginPages extends Service{

    public function register(){

        add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );

        add_filter( 'plugin_action_links_'.\Config::PLUGIN_NAME, array($this, 'setting_link'));
    }

    public function setting_link($links){
        $setting_link = '<a href="admin.php?page=dev_plugin">Settings</a>';
        array_push($links, $setting_link);
        return $links;
    }

    public function add_admin_menu(){

        add_menu_page( 'DevPlugin', 'DevPlugin', 'manage_options', 'dev_plugin',
         array($this, 'menu_template'), 'dashicons-store', 110 );

    }

    public function menu_template(){
        require_once \Config::APP_PATH . 'Inc/Templates/menu-page.php';
    }


 }

 