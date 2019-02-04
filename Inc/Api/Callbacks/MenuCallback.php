<?php

namespace Inc\Api\Callbacks;

/**
 * Templates of the Plugin Pages
 */

use Inc\Base\OptionName;


class MenuCallback {

    /**
     * Create these constants to avoid the type mistake and easy to remember 
     * all callbacks name.
     */
    const AdminDashboard        = 'adminDashboard';
    const DevpluginOptionsGroup = 'devpluginOptionsGroup';
    const DevpluginAdminSection = 'devpluginAdminSection';
    const DevpluginTextExample  = 'devpluginTextExample';

    public function adminDashboard(){
        return require_once \Config::PLUGIN_PATH . 'Templates/menu-page.php';
    }

    public function devpluginOptionsGroup($input){
        return $input;
    }

    public function devpluginAdminSection(){
        echo 'Check this beautiful section!';
    }

    public function devpluginTextExample(){
		$value = esc_attr( get_option( OptionName::EXAMPLE ) );
        echo '<input type="text" class="regular-text" name="text_example" value="' . $value . '" 
                placeholder="Write Something Here!">';
	}

}