<?php

//Exit if accessed directly.
defined('ABSPATH') or exit;

class SAF_Admin_Menu extends SAF_Main {

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

                //Handle the post request
                $this->handle_post('submit_dir_sync');

                //Include the template file
                include_once SAF_DIR_PATH . 'views/admin-sync.php';

            }
        );

    }

    /**
     * Method to handle post request
     * @param string the submit name field
     */
    public function handle_post($submit_handle = ''){

        //Quick check on the submit handle
        if(
            isset($_POST[$submit_handle]) &&
            !empty($submit_handle)
            ){

            //Update options in a loop
            foreach($_POST as $name => $value){

                //Do not include the submit name field
                if($name !== $submit_handle){
                    $this->set_value($name, $value);
                }

            }

            //Print success notice
            echo '<div class="notice notice-success"><p>Options Saved!</p></div>';

        }

    }

}
new SAF_Admin_Menu();