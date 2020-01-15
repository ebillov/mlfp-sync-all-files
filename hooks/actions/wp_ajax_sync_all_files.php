<?php

//Exit if accessed directly.
defined('ABSPATH') or exit;

//Define our ajax action hook
add_action('wp_ajax_sync_all_files', function(){

    if($_POST['sync_all'] == true){

        //Run code execution time limit to unlimited
        set_time_limit(0);

        //Instatiate the file info class
        $file_info = new SAF_File_Info();

        //Get the sync directory path
        $sync_path = $this->get_sync_path();

        //Find pathnames matching a pattern
        $results = glob( $sync_path . '/*' );

        //Initialize the file paths
        $file_info->init_files($results);

        return json_encode($file_info->get_files());

    }

    wp_die(); //Terminates the code and returns the appropriate response

});