<?php // if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

class Words extends REST_Controller {
    
    function __construct() {
        parent::__construct();
        // Autoloaded Config, Helpers, Models
    }

    // Used to create a new group in the DB
    public function index_post() {
        $data = $this->post();
        
        if ( isset($data['word']) ){
            $word    = $data['word']; 
            
            $availability = $this->word->retrieve( 
                array(
                    'tag' => url_title( $word )
                )
            ); 

            if ( count($availability) == 0 ) {                        
                $new_word = array( 
                    'tag'  => url_title( $word ),
                    'word' => $word
                );
            
                $word_id = $this->word->create( $new_word );
                echo json_encode( 
                    array(
                        'status'  => 'success',
                        'message' => 'Word insert successful',
                        'word_id' => $word_id
                    )
                );

            } else {                    
                echo json_encode( 
                    array(
                        'status'  => 'fail',
                        'message' => 'Tag already exists'
                    )
                );
            }

        } else {
            echo json_encode( 
                array(
                    'status'  => 'fail',
                    'message' => 'Missing word parameter'
                )
            );
        }

        return;
    }

    // Used to create a new group in the DB
    public function index_put() {
        $data = $this->put( );
        
        if ( isset($data['word_id']) && isset($data['word']) ){
            $word_id = $data['word_id'];
            $word    = $data['word'];

            $availability = $this->word->retrieve( 
                array(
                    'id' => $word_id
                )
            );

            if ( count($availability) > 0 ) {
                $word_id = $this->word->update( 
                    array(
                        'id' => $word_id
                    ),
                    array(

                        'word' => $word
                    ) 
                );
                echo json_encode( 
                    array(
                        'status'  => 'success',
                        'message' => 'Word update successful'
                    )
                );  
            
            } else {
                echo json_encode( 
                    array(
                        'status'  => 'fail',
                        'message' => 'Nothing to update'
                    )
                );
            }

        } else {
            echo json_encode( 
                array(
                    'status'  => 'fail',
                    'message' => 'Missing word_id or word parameters'
                )
            );
        }

        return;
    }
}