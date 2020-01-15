<?php

//Exit if accessed directly.
defined('ABSPATH') or exit;

class SAF_File_Info {

    //Define the properties
    public $files = [];
    public $prev_directories = [];

    /**
     * Our constructor
     * @param string the root path to query the files
     */
    public function __construct(string $root_path){
        $this->root_path = $root_path;
        $this->first_query = true;
    }

    /**
     * Find pathnames matching a pattern
     * @return array array of pathnames
     */
    public function get_pathnames(string $path){
        //Find pathnames matching a pattern
        return glob( $path . '/*' );
    }

    /**
     * Method to get the file information based on the given array of file paths
     * @param array filepath
     * @return void
     */
    public function init_files(){

        //Do this for the root query
        if($this->first_query){

            //Loop through each file paths
            foreach($this->get_pathnames($this->root_path) as $path){

                //Check if path is a directory
                if(is_dir($path)){
                    $this->prev_directories[] = $path;
                }

                //Check if path is a file
                if(is_file($path)){
                    $this->files[] = [
                        'path' => dirname($path),
                        'file' => basename($path)
                    ];
                }

            }

            $this->first_query = false;

        }

        //Do this for sub directory queries
        if(!$this->first_query){

            //Redefine the dir paths
            $prev_dir_paths = $this->prev_directories;
            $this->prev_directories = [];

            //Begin looping on each dir paths
            foreach($prev_dir_paths as $path){

                foreach($this->get_pathnames($path) as $_path){

                    //Check if path is a directory
                    if(is_dir($path)){
                        $this->prev_directories[] = $path;
                    }

                    //Check if path is a file
                    if(is_file($path)){
                        $this->files[] = [
                            'path' => dirname($path),
                            'file' => basename($path)
                        ];
                    }

                }

            }

        }

    }

    /**
     * Method to get all the files that was loaded
     * @return array the associative array containg the file path and filename
     */
    public function get_files(){
        return $this->files;
    }
    
}