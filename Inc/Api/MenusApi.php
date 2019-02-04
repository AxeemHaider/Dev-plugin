<?php

namespace Inc\Api;

/**
 * Create menus and sub menus for this plugin
 */

 class MenusApi{

    public $adminMenus;
    public $adminSubMenus;
    private $parentSlug;

    public function register(){
        
        if ( !empty( $this->adminMenus ) ){
            add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
        }

        if ( !empty( $this->adminSubMenus ) ){
            add_action( 'admin_menu', array( $this, 'add_admin_sub_menu' ) );
        }

    }

    public function setMenus(array $menus){

        $this->adminMenus = $menus;

        // Set parent slug by default for sub pages
        $this->parentSlug = $menus[0]['menu_slug'];

        return $this;

    }

    public function setSubMenus(array $subMenus){

        $this->adminSubMenus = $subMenus;

        return $this;

    }

    public function at(int $position){

        $this->parentSlug = $this->adminMenus[$position]['menu_slug'];

        return $this;
    }

    public function add_admin_menu(){

        foreach ( $this->adminMenus as $menu ){

            add_menu_page( 
                $menu['page_title'], 
                $menu['menu_title'], 
                $menu['capability'],
                $menu['menu_slug'],
                $menu['callback'],
                $menu['icon_url'],
                $menu['position']
            );

        }
        
    }

    public function add_admin_sub_menu(){

        foreach ( $this->adminSubMenus as $menu ){

             add_submenu_page( 
                $this->parentSlug, 
                $menu['page_title'], 
                $menu['menu_title'], 
                $menu['capability'],
                $menu['menu_slug'],
                $menu['callback']
            );

        }
        
    }

 }