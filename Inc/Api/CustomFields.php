<?php

namespace Inc\Api;

/**
 * Create Custom fields
 */

class CustomFields {

    private $settings;
    private $sections;
    private $fields;

    public function register(){
       
        add_action( 'admin_init', array( $this, 'addCustomFields' ) );
    }

    public function addCustomFields(){

        // register settings
        foreach( $this->settings as $settings ){
            register_setting( 
                $setting["option_group"],
                $setting["option_name"],
                ( isset($setting["callbacks"]) ? $setting["callbacks"] : '') );
        }

        // add setting section
        foreach( $this->sections as $section ){
            add_settings_section( 
                $section["id"], 
                $section["title"], 
                ( isset($section["callbacks"]) ? $section["callbacks"] : ''),
                $section["page"] );
        }

        // add settings fields
        foreach ( $this->fields as $field ) {
			add_settings_field( 
                $field["id"], 
                $field["title"], 
                ( isset( $field["callback"] ) ? $field["callback"] : '' ), 
                $field["page"], 
                $field["section"], 
                ( isset( $field["args"] ) ? $field["args"] : '' ) );
		}

    }    

    public function setSettings(array $settings){
        $this->settings = $settings;

        return $this;
    }

    public function setSections(array $sections){
        $this->sections = $sections;

        return $this;
    }

    public function setFields(array $fields){
        $this->fields = $fields;

        return $this;
    }    

}