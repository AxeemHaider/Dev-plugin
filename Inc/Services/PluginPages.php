<?php

namespace Inc\Services;

/**
 * Create Plugin Pages
 */

use Inc\Base\Service;
use Inc\Api\SettingsApi;

 class PluginPages extends Service{

    public $settingsApi;

    public function __construct(){
        
        $this->settingsApi = new SettingsApi();

    }

    public function register(){

        $pages = [
            [
                'page_title' => 'DevPlugin',
                'menu_title' => 'DevPlugin',
                'capability' => 'manage_options',
                'menu_slug' => 'dev_plugin',
                'callback' => function() { echo '<h1>Dev Plugin</h1>'; },
                'icon_url' => 'dashicons-store',
                'position' => 110
            ]
        ];

        $subPages = [
            [
                'page_title' => 'CPT',
                'menu_title' => 'CPT',
                'capability' => 'manage_options',
                'menu_slug' => 'dev_plugin_cpt',
                'callback' => function() { echo '<h1>CPT Page</h1>'; }
            ]
        ];

        $this->settingsApi->addPages( $pages )->addSubPages( $subPages )->register();

    }




 }

 