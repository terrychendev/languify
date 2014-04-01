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
        // Preparing the languages 
        // Defaults to all languages
        $languages = array();
        $all_languages = $this->language->retrieve();
        $user_languages = $this->input->get('languages');
        if ( $user_languages !== false ) {
            // URL has some custom specified languages
            // Parse, then query database, then send to view
            $user_languages = explode(',', $user_languages);
            foreach($user_languages as $key => $user_language){
                $user_languages[$key] = 'code = "'.$user_language.'"';
            }
            $user_languages = implode(' OR ', $user_languages);
            $languages = $this->language->retrieve($user_languages);
        
        } else {
            $languages = $all_languages;    
        }

        // Prepares the words
        // Defaults to all words
        $words = $this->word->retrieve();
        
        // Prepares the translations
        // Each combination of word-language IDs as array keys link to a translated word 
        $temp = array();
        $translations = $this->translation->retrieve();
        foreach( $translations as $translation ){
            $temp[$translation->word_id][$translation->language_id] = $translation->translation;
        }
        $translations = $temp;
        
        // Send the resulting data array into the view
        $this->blade->render('main', 
            array(
                'languages' => $languages,
                'all_languages' => $all_languages,
                'words'     => $words,
                'translations' => $translations
            )
        );
    }
}