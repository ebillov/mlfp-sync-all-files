<?php

//Exit if accessed directly.
defined('ABSPATH') or exit;

class SAF_Main {

    //Version
    public $version = '0.0.1a';

    //Default option string
    private $option_prefix = 'saf_';

	//A single instance of the class
	protected static $_instance = null;
	
	/**
     * Main Instance ensuring that only 1 instance of the class is loaded
     */
	final public static function instance(){
		if(is_null(self::$_instance)){
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	/**
     * Cloning is forbidden
     */
	public function __clone() {
		$error = new WP_Error('forbidden', 'Cloning is forbidden.');
		return $error->get_error_message();
	}
	
	/**
     * Unserializing instances of this class is forbidden
     */
	public function __wakeup() {
		$error = new WP_Error('forbidden', 'Unserializing instances of this class is forbidden.');
		return $error->get_error_message();
	}

    /**
     * Our constructor
     */
    public function __construct(){
        $this->includes();
    }

    /**
     * Method to define included files
     */
    public function includes(){

        //Classes
        include SAF_DIR_PATH . 'classes/Admin_Menu.php';
        
    }

    /**
     * Method to get the option data
     * @param string the name field
     * @return mixed value that was set
     */
    public function get_value(string $name){
        return get_option($this->option_prefix . $name);
    }

    /**
     * Method to set the option data
     * @param string the name field
     * @param mixed the value
     * @return void
     */
    public function set_value(string $name, $value){
        update_option($this->option_prefix . $name, $value);
    }

}