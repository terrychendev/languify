<?php // if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

    function __construct() {
        parent::__construct();
        // Autoloaded Config, Helpers, Models 
        $this->load->model('language');
        $this->load->model('word');
        $this->load->model('translation');
    }
    
	public function index() {
        $data = array();
        $user_email = $this->session->userdata('email');
        
        $languages = $this->language->retrieve();
        $words = $this->word->retrieve();
        
        foreach( $words as $key => $word ){
            $words[$key] = (array) $word;
            $words[$key]['translations'] = $this->translation->retrieve( array('word_id'=>$word->id) );
        }
        
        // Send the resulting data array into the view
        $this->blade->render('main', 
            array(
                'languages' => $languages,
                'words'     => $words
            )
        );
    }
}