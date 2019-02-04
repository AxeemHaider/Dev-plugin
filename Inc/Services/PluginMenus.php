<?php

namespace Inc\Services;

/**
 * Create Plugin Menus
 */

use Inc\Base\Service;
use Inc\Api\MenusApi;
use Inc\Api\CustomFields;
use Inc\Api\Callbacks\MenuCallback;
use Inc\Base\Menu;
use Inc\Base\OptionGroup;
use Inc\Base\OptionName;
use Inc\Base\SubMenu;
use Inc\Base\Section;

 class PluginMenus extends Service{

    private $menusApi;
    private $callbacks;
    private $customFields;

    public function __construct(){
        
        $this->menusApi = new MenusApi();

        $this->callbacks = new MenuCallback();

        $this->customFields = new CustomFields();

    }

    public function register(){

        $this->menusApi
                ->setMenus( $this->addMenus() )
                ->setSubMenus( $this->addSubMenus() )
                ->register();

        $this->customFields
                ->setSettings($this->addSettings())
                ->setSections($this->addSections())
                ->setFields($this->addFields())
                ->register();

    }

    private function addMenus(){
        $menus = [
            [
                'page_title' => 'DevPlugin',
                'menu_title' => 'DevPlugin',
                'capability' => 'manage_options',
                'menu_slug' => Menu::DASHBOARD,
                'callback' => array($this->callbacks, MenuCallback::AdminDashboard),
                'icon_url' => 'dashicons-store',
                'position' => 110
            ]
        ];

        return $menus;
    }

    private function addSubMenus(){
        $subMenus = [
            [
                'page_title' => 'CPT',
                'menu_title' => 'CPT',
                'capability' => 'manage_options',
                'menu_slug' => SubMenu::CPT,
                'callback' => function () { echo '<h1> CPT</h1>'; }
            ]
        ];

        return $subMenus;
    }

    private function addSettings(){
        $args = [
            [
                'option_group' => OptionGroup::DASHBOARD,
				'option_name' => OptionName::EXAMPLE,
				'callback' => array( $this->callbacks, MenuCallback::DevpluginOptionsGroup )
            ]
        ];

        return $args;
    }

    private function addSections(){
        $args = [
            [
                'id' => Section::DASHBOARD,
				'title' => 'Settings',
				'callback' => array( $this->callbacks, MenuCallback::DevpluginAdminSection ),
				'page' => Menu::DASHBOARD
            ]
        ];

        return $args;
    }

    private function addFields(){
        $args = [
            [
                'id' => 'text_example',
				'title' => 'Text Example',
				'callback' => array( $this->callbacks, MenuCallback::DevpluginTextExample ),
				'page' => Menu::DASHBOARD,
				'section' => Section::DASHBOARD,
				'args' => array(
					'label_for' => 'text_example',
					'class' => 'example-class'
				)
            ]
        ];

        return $args;
    }

 }

 