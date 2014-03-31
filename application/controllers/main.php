<?php // if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

    function __construct() {
        parent::__construct();
        // Autoloaded Config, Helpers, Models 
    }
    
	public function index() {
        $data = array();
        $user_email = $this->session->userdata('email');
        
        $this->db->where( 
            array( 
                'language_id'   => '2',
                'word_id'       => '1'
            )
        );
        $test = $this->db->get('translation');
        $test = $test->result();
        var_dump( $test[0]->translation );

        // Send the resulting data array into the view
        $this->blade->render('main', 
            array(
                'user_email' => $user_email
            )
        );
    }
}