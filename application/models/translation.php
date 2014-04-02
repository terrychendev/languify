<?php

class translation extends CI_Model{
    
    function retrieve_assoc( $data = array() ){
        $temp = array();
        $translations = $this->retrieve( $data );
        foreach( $translations as $translation ){
            $temp[$translation->word_id][$translation->language_id] = $translation->translation;
        }
        return $temp;
    }

    // BEGIN BASIC CRUD FUNCTIONALITY

    function create( $data = array() ){
        $this->db->insert('translation', $data);    
        return $this->db->insert_id();
    }

    function retrieve( $data = array() ){
        $this->db->where($data);
        $query = $this->db->get('translation');
        return $query->result();
    }
    
    function update( $criteria = array(), $new_data = array() ){
        $this->db->where($criteria);
        $this->db->update('translation', $new_data);
    }
    
    function delete( $data = array() ){
        $this->db->where($data);
        $this->db->delete('translation');
    }

}

?>