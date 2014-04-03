<?php // if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Core extends CI_Controller {

    function __construct() {
        parent::__construct();
        // Autoloaded Config, Helpers, Models 
    }
    
    public function compile() {
        // Retrieves false if no secret is specified
        $key = $this->input->get('secret');
        
        //   $key == 'supersecretpassword' before production
        if ( $key !== false ) {
            // Build CSS for english
            $words = $this->word->retrieve();
            $english_css = '';
            foreach ($words as $key => $word) {
                $english_css .= $this->_make_css_property( $word->tag, $word->word );
                $english_css .= "\n";
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
                        $translation_css .= $this->_make_css_property( $word->tag, $translations[$word->id][$language->id] ); 
                        $translation_css .= "\n";
                    } else {
                        $translation_css .= $this->_make_css_property( $word->tag, $word->word, $language->code );
                        $translation_css .= "\n";
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

    private function _make_css_property( $tag = '', $word = 'NIL', $translation_for = false ) {
        if ( $translation_for === false ) {
            // simple wrapper for making this word a css property 
            return "span.fy-".$tag.":before{content:'".$word."';}";
        } else {
            // user has specified a language that this was supposed to convert into.
            // maybe we can hyperlink the word into something that prompts the user to enter the languified version?
            return "span.fy-".$tag.":before{content:'".$word." to ".$translation_for."';}"; 
        }
    }

    private function _write_to_library( $language_code = '', $content = '' ) {
        $handle = fopen( FCPATH . 'library/'. $language_code . '.css', 'w' );
        fwrite($handle, $content); 
        fclose($handle);
        return;
    }        
}


