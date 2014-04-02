<?php // if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

class Translations extends REST_Controller {
    
    function __construct() {
        parent::__construct();
        // Autoloaded Config, Helpers, Models
        $this->load->model('language');
        $this->load->model('word');
        $this->load->model('translation');
    }

    // Used to create a new group in the DB
    public function index_post() {
        $data = $this->post();
        
        if ( isset($data['word_id']) && isset($data['language_id']) && isset($data['translation']) ){
            $word_id        = $data['word_id'];
            $language_id    = $data['language_id'];
            $translation    = $data['translation'];

            $availability = $this->translation->retrieve( 
                array(
                    'word_id' => $word_id,
                    'language_id' => $language_id
                )
            ); 
            
            if ( count($availability) > 0 ) {
                // Version already has a score. Do update
                $this->translation->update( 
                    array(
                        'word_id' => $word_id,
                        'language_id' => $language_id
                    ),
                    array(
                        'translation'  => $translation
                    )
                );

                echo json_encode( 
                    array(
                        'status'  => 'success',
                        'message' => 'Translation update successful'
                    )
                );  
            } else {
                // Version does not have a score yet. Do insert
                $new_translation = array( 
                    'word_id' => $word_id,
                    'language_id' => $language_id,
                    'translation' => $translation  
                );
                $translation_id = $this->translation->create( $new_translation );
                echo json_encode( 
                    array(
                        'status'  => 'success',
                        'message' => 'Translation insert successful',
                        'translation_id' => $translation
                    )
                );  
            }
        } else {
            echo json_encode( 
                array(
                    'status'  => 'fail',
                    'message' => 'Missing parameters'
                )
            );  
        }

        return;
    }
}