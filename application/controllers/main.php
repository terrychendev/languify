<?php // if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

    function __construct() {
        parent::__construct();
        // Autoloaded Config, Helpers, Models 
    }
    
	public function index() {
        $data = array();
        $user_email = $this->session->userdata('email');
        
        // Send the resulting data array into the view
        $this->blade->render('main', 
            array(
                'user_email' => $user_email
            )
        );
    }
}