<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data extends CI_Model {

	public function __construct()
	{
		$this->load->database();	
	}

	public function get_dosen(){
		return $this->db->get('dosen')
						->result();
	}

	public function get_detail_ide($id)
	{

		return $this->db->select('idetugasakhir.*, dosen.*')
                   ->where('IDIde', $id)
                   ->join('dosen', 'dosen.IDDosen = idetugasakhir.IDDosen')
                   ->get('idetugasakhir')
                   ->result();
	}

	public function get_detail_pum($id)
	{

		return $this->db->select('pengumuman.*')
                   ->where('ID', $id)
                   ->get('pengumuman')
                   ->result();
	}

	public function get_data_ide_by_id($id)
	{
		return $this->db->where('IDIde', $id)
						->get('idetugasakhir')
						->row();
	}

	public function get_data_ta_by_id($id)
	{
		return $this->db->where('IDTugasAkhir', $id)
						->get('tugasakhirmhs')
						->row();
	}

	public function get_berkas_by_id($id)
	{
		return $this->db->where('ID', $id)
						->get('berkaspelengkap')
						->row();
	}

	public function get_ide_per_mhs_delete($idide, $idmhs){
		$sql = "SELECT IDIde FROM idetugasakhir WHERE IDIdeMahasiswa = ". $idmhs ." AND IDIde != ". $idide;
		$query  = $this->db->query($sql);

		//$result = $query->result();
		return ($query->num_rows() > 0)?$query:FALSE;
	}

	public function find($table, $where = '', $order_by = '', $order_type = '', $join = '', $id = '', $join2 = '', $id2 = '', $join3 = '', $id3 = '', $params = array(), $search = '',$groupby='') {
		
		if ($order_by != '') {
			if ($order_type != '') {
				$this->db->order_by( $order_by, $order_type);
			} else {
				$this->db->order_by($order_by, 'ASC');
			}
		}
		if ($join != '') {
			$this->db->join($join, $id, 'left');
			if ($join2 != '') {
				$this->db->join($join2, $id2, 'left');
				if ($join3 != '') {
					$this->db->join($join3, $id3, 'left');
				}
			}
		}

		if ($groupby != '') {
			$this->db->group_by($groupby);
		}

		if(!empty($params['search']['keywords'])){
			$this->db->like($search ,$params['search']['keywords']);
		}
        //sort data by ascending or desceding order
		if(!empty($params['search']['sortBy'])){
			$this->db->order_by($search ,$params['search']['sortBy']);
		}else{
			$this->db->order_by($order_by,'desc');
		}

		if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
			$this->db->limit($params['limit'],$params['start']);
		} elseif (!array_key_exists("start",$params) && array_key_exists("limit",$params)){
			$this->db->limit($params['limit']);
		}


		if ($where != '') {
			$query = $this->db->get_where($table, $where);
		} else {
			$query = $this->db->get($table);
		}
		return ($query->num_rows() > 0)?$query:FALSE;
	}

	function save($data,$table){
		$this->db->insert($table, $data);
	}

	function update($field, $value, $table, $data)
	{
		return $this->db->where($field, $value)->update($table, $data);
	}

	function delete($where,$table){
		$this->db->where($where);
		if ($this->db->delete($table)) {
			return true;
		}
	}

	public function getUserInfo($id)  
	{  
		$q = $this->db->get_where('mahasiswa', array('nim' => $id), 1);   
		if($this->db->affected_rows() > 0){  
			$row = $q->row();  
			return $row;  
		}else{  
			error_log('no user found getUserInfo('.$id.')');  
			return false;  
		}  
	}  

	public function getUserInfoByEmail($table, $email){  
		$q = $this->db->get_where($table, $email, 1);   
		if($this->db->affected_rows() > 0){  
			$row = $q->row();  
			return $row;  
		}  
	}  

	public function insertToken($user_id)  
	{    
		$token = substr(sha1(rand()), 0, 30);   
		$date = date('Y-m-d');  

		$string = array(  
			'token'=> $token,  
			'user_id'=>$user_id,  
			'created'=>$date  
		);  
		$query = $this->db->insert_string('tokens',$string);  
		$this->db->query($query);  
		return $token . $user_id;  

	}  

	public function isTokenValid($token)  
	{  
		$tkn = substr($token,0,30);  
		$uid = substr($token,30);     

		$q = $this->db->get_where('tokens', array(  
			'tokens.token' => $tkn,   
			'tokens.user_id' => $uid), 1);               

		if($this->db->affected_rows() > 0){  
			$row = $q->row();         

			$created = $row->created;  
			$createdTS = strtotime($created);  
			$today = date('Y-m-d');   
			$todayTS = strtotime($today);  

			if($createdTS != $todayTS){  
				return false;  
			}  

			$user_info = $this->getUserInfo($row->user_id);  
			return $user_info;  

		}else{  
			return false;  
		}  

	}

	public function ambil()
	{
		$query = $this->db->get('ide_tugasakhir')->result_array();
		return $query;
	}

	public function get_mhs_ide($id){
		$sql = "SELECT * FROM idetugasakhir LEFT JOIN users ON idetugasakhir.IDIdeMahasiswa = users.ID JOIN dosen ON idetugasakhir.IDDosen = dosen.IDDosen JOIN programstudi ON users.IDProgramStudiUser =  programstudi.IDProgramStudi WHERE users.IDProgramStudiUser = ". $id ." ORDER BY users.ID ASC";
		$query  = $this->db->query($sql);

		//$result = $query->result();
		return ($query->num_rows() > 0)?$query:FALSE;
	}

	public function get_mhs_ta($id){
		$sql = "SELECT * FROM tugasakhirmhs LEFT JOIN idetugasakhir ON tugasakhirmhs.IDIcp = idetugasakhir.IDIde WHERE idetugasakhir.IDIdeMahasiswa = ". $id ;
		$query  = $this->db->query($sql);

		//$result = $query->result();
		return ($query->num_rows() > 0)?$query:FALSE;
	}

	public function get_mhs_ta_prodi($idprodi){
		$sql = "SELECT 
				ta.*, ide.*, u.*, 
				n1.NilaiAkhir AS nilai1,
				n2.NilaiAkhir AS nilai2,
				n3.NilaiAkhir AS nilai3,
				d1.NamaDosen AS NamaKetuaPenguji, 
				d2.NamaDosen AS NamaPenguji2, 
				d3.NamaDosen AS NamaPenguji1

				FROM tugasakhirmhs ta 
				LEFT JOIN idetugasakhir ide ON ta.IDIcp = ide.IDIde 
				JOIN users u ON ide.IDIdeMahasiswa = u.ID 
				JOIN nilaisidang n1 ON ta.NilaiProposal = n1.ID 
				JOIN nilaisidang n2 ON ta.Nilai70 = n2.ID
				JOIN nilaisidang n3 ON ta.Nilai100 = n3.ID
				LEFT JOIN dosen d1 ON ta.IDKetuaPenguji = d1.IDDosen 
				LEFT JOIN dosen d2 ON ta.IDPenguji2 = d2.IDDosen 
				LEFT JOIN dosen d3 ON ide.IDDosen = d3.IDDosen 
				WHERE u.IDProgramStudiUser = " . $idprodi ." AND ta.IDKetuaPenguji IS NOT NULL AND ta.IDKetuaPenguji != '' AND ta.IDKetuaPenguji != 0 AND ta.IDPenguji2 IS NOT NULL AND ta.IDPenguji2 != '' AND ta.IDPenguji2 != 0 AND ta.NilaiProposal != 0 AND ta.Nilai70 != 0 AND ta.Nilai100 != 0";


		$query  = $this->db->query($sql);

		//$result = $query->result();
		return ($query->num_rows() > 0)?$query:FALSE;


	}

	public function get_mhs_belum_nilai($idprodi){
		$sql = "SELECT 
				ta.*, ide.*, u.*, 
				n1.NilaiAkhir AS nilai1,
				n2.NilaiAkhir AS nilai2,
				n3.NilaiAkhir AS nilai3,
				d1.NamaDosen AS NamaKetuaPenguji, 
				d2.NamaDosen AS NamaPenguji2, 
				d3.NamaDosen AS NamaPenguji1

				FROM tugasakhirmhs ta 
				LEFT JOIN idetugasakhir ide ON ta.IDIcp = ide.IDIde 
				JOIN users u ON ide.IDIdeMahasiswa = u.ID 
				LEFT JOIN nilaisidang n1 ON ta.NilaiProposal = n1.ID 
				LEFT JOIN nilaisidang n2 ON ta.Nilai70 = n2.ID
				LEFT JOIN nilaisidang n3 ON ta.Nilai100 = n3.ID
				LEFT JOIN dosen d1 ON ta.IDKetuaPenguji = d1.IDDosen 
				LEFT JOIN dosen d2 ON ta.IDPenguji2 = d2.IDDosen 
				LEFT JOIN dosen d3 ON ide.IDDosen = d3.IDDosen 
				WHERE u.IDProgramStudiUser = " . $idprodi;


		$query  = $this->db->query($sql);

		//$result = $query->result();
		return ($query->num_rows() > 0)?$query:FALSE;


	}

	public function get_email_mhs_jur1(){
		$sql = "SELECT
				Email FROM users
				WHERE IDProgramStudiUser = 1 AND
				Status = 'TugasAkhir'";

		$query  = $this->db->query($sql);
		$array = $query->result_array();
		$arr = array_column($array,"Email");

		//$result = $query->result();
		return ($query->num_rows() > 0)?$arr:FALSE;
	}

	public function get_email_mhs_jur2(){
		$sql = "SELECT
				Email FROM users
				WHERE IDProgramStudiUser != 1 AND
				Status = 'TugasAkhir'";

		$query  = $this->db->query($sql);
		$array = $query->result_array();
		$arr = array_column($array,"Email");

		//$result = $query->result();
		return ($query->num_rows() > 0)?$arr:FALSE;
	}

}