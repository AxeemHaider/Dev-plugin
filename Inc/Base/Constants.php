<?php

namespace Inc\Base;

/**
 * Hold all the Constants Variables
 */

define('BASE_URL', 'dev_plugin');
define('BASE_NAME', 'devplugin');

class Menu{
    const DASHBOARD = BASE_URL . '_dashboard';
}

class SubMenu{
    const CPT = BASE_URL . '_cpt';
}

class OptionGroup{
    const DASHBOARD = BASE_NAME . '_options_group';
}

class OptionName{
    const EXAMPLE = BASE_NAME . '_example';
}

class Section{
    const DASHBOARD = BASE_NAME . '_admin_index';
}