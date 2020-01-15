<?php

//Exit if accessed directly.
defined('ABSPATH') or exit;

class Admin_Menu {

    public function __construct(){

        //Add submenu to WooCommerce
        add_action('admin_menu', array( $this, 'render_settings' ) );

    }

    /**
     * Method to render the settings page
     */
    public function render_settings(){

        //Add it inside the Media Library menu
        add_media_page(
            'Sync All FTP Files',
            'Sync All FTP Files',
            'read',
            'mlfp-sync-all-files',
            function(){

                //Include the template file
                include_once NPD_GST_DIR_PATH . 'views/admin-sync.php';

            }
        );

    }

}
new Admin_Menu();