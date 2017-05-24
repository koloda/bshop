<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

$com_info = [
             'menu_name'   => lang('Basic Shop', 'bshop'), // Menu name
             'description' => lang('Allows you to create online store', 'bshop'), // Module Description
             'admin_type'  => 'inside', // Open admin class in new window or not. Possible values window/inside
             'window_type' => 'xhr', // Load method. Possible values xhr/iframe
             'w'           => 600, // Window width
             'h'           => 550, // Window height
             'version'     => '1.1', // Module version
             'author'      => 'l.andriy@siteimage.com.ua', // Author info Andriy Leshko
             'type'        => 'shop', // CMS version
             'icon_class'  => 'icon-picture',
            ];

/* End of file module_info.php */
