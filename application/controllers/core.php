<?php // if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Core extends CI_Controller {

    function __construct() {
        parent::__construct();
        // Autoloaded Config, Helpers, Models 
    }
    
    public function compile() {
        $key = $this->input->get('secret');
        
        if ( $key !== false ) {
            // Build CSS for english
            $words = $this->word->retrieve();
            $english_css = '';
            foreach ($words as $key => $word) {
                $english_css .= "span.fy-".$word->tag.":before{content:'".$word->word."';}
";
            }
            $this->_write_to_library( 'en', $english_css );
            echo "<p>" . $english_css . "</p>";

            // Build CSS for non-english translations
            $languages = $this->language->retrieve( 'id !="1"' );
            $translations = $this->translation->retrieve_assoc();
            foreach ($languages as $language) {
                $translation_css = '';
                foreach ($words as $word) {
                    if ( isset($translations[$word->id][$language->id]) ) {
                        $translation_css .= "span.fy-".$word->tag.":before{content:'".$translations[$word->id][$language->id]."';}
";
                    
                    } else {
                        $translation_css .= "span.fy-".$word->tag.":before{content:'".$word->word."';}
";
                    }
                }
                $this->_write_to_library( $language->code, $translation_css );
                echo "<p>" . $translation_css . "</p>";
            }
            echo 'OK';
        } else {
            echo 'Compile error';
        }

        return;
    }

    private function _write_to_library( $language_code = '', $content = '' ) {
        $handle = fopen( FCPATH . 'library/'. $language_code . '.css', 'w' );
        fwrite($handle, $content); 
        fclose($handle);
        return;
    }        
}


