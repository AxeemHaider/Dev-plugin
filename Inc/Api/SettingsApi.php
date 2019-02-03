<?php

namespace Inc\Api;

/**
 * Create pages and sub pages for this plugin
 */

 class SettingsApi{

    public $adminPages;
    public $adminSubPages;
    private $parentSlug;

    public function register(){
        
        if ( !empty( $this->adminPages ) ){
            add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
        }

        if ( !empty( $this->adminSubPages ) ){
            add_action( 'admin_menu', array( $this, 'add_admin_sub_menu' ) );
        }

    }

    public function addPages(array $pages){

        $this->adminPages = $pages;

        // Set parent slug by default for sub pages
        $this->parentSlug = $pages[0]['menu_slug'];

        return $this;

    }

    public function addSubPages(array $subPages){

        $this->adminSubPages = $subPages;

        return $this;

    }

    public function at(int $position){

        $this->parentSlug = $this->adminPages[$position]['menu_slug'];

        return $this;
    }

    public function add_admin_menu(){

        foreach ( $this->adminPages as $page ){

            add_menu_page( 
                $page['page_title'], 
                $page['menu_title'], 
                $page['capability'],
                $page['menu_slug'],
                $page['callback'],
                $page['icon_url'],
                $page['position']
            );

        }
        
    }

    public function add_admin_sub_menu(){

        foreach ( $this->adminSubPages as $page ){

             add_submenu_page( 
                $this->parentSlug, 
                $page['page_title'], 
                $page['menu_title'], 
                $page['capability'],
                $page['menu_slug'],
                $page['callback']
            );

        }
        
    }

 }