<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IdeModel extends CI_Model {

    public function __construct()
	{
		$this->load->database();	
	}

    public function getIde($id_idemahasiswa)
    {
         $this->db->where('IDIdeMahasiswa',$id_idemahasiswa);
         return $this->db->get('idetugasakhir')->result_array();  
    }

}





    