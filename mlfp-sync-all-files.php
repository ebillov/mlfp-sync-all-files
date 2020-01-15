<?php
/**
* Plugin Name: Sync All Files - Media Library Folders
* Plugin URI: https://virson.wordpress.com/
* Description: An extension plugin to the Media Libraries Folder plugin (including the Pro version) to sync all files that are added via FTP or files that are not fully synced yet.
* Version: 0.0.1a
* Author: Virson Ebillo
* Author URI: https://virson.wordpress.com/
*/

//Exit if accessed directly.
defined('ABSPATH') or exit;

//Quick check
if(function_exists('is_plugin_active')){

	//Check if Media Library Folder plugin (including the Pro version) is not activated
    if(
        !is_plugin_active('media-library-plus/maxgalleria-media-library.php') &&
        !is_plugin_active('media-library-plus-pro/maxgalleria-media-library.php')
        ){
		deactivate_plugins( plugin_basename( __FILE__ ) );
		wp_die('Error on activating <b>Sync All Files - Media Library Folders</b> plugin. <br />Please enable/activate <b>Media Library Folders</b> or <b>Media Library Folders Pro</b> plugin before using this plugin. <a href="' . admin_url() . '">Go back.</a>');
    }
    
}

//Define our constants
define('SAF_DIR_URL', preg_replace('/\s+/', '', plugin_dir_url(__FILE__)));
define('SAF_DIR_PATH', preg_replace('/\s+/', '', plugin_dir_path(__FILE__)));

//Include the main class.
if( !class_exists( 'SAF_Main', false ) ) {
	include_once SAF_DIR_PATH . 'classes/Main.php';
}

SAF_Main::instance();