<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControllerGlobal extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('security','string','url','download','form'));
		$status = $this->session->userdata('Status');
		if (!(($status == "Mahasiswa") OR ($status == "TugasAkhir") OR ($status == "Dosen") OR ($status == "Admin"))) {
			redirect(base_url("Home"));
		}
	}

	function myProfil()
	{
		$where = array('ID' => $this->session->userdata('ID'));
		$data['users'] = $this->M_data->find('users', $where, '', '', 'programstudi', 'programstudi.IDProgramStudi = users.IDProgramStudiUser', 'bidangminat', 'bidangminat.IDBidangMinat = users.IDBidangMinatUser');
		$this->load->view('template/myProfil', $data);
        // $this->load->view('template/jquery/formSubmit');
	}

	function notifikasi()
	{
		if ($this->session->userdata('IDProdiUser') == 1) {
			$kond_penerima = 'Mahasiswa Kamsib';
		} else {
			$kond_penerima = 'Mahasiswa Kriptografi';
		}
		$where = array('Penerima' => $kond_penerima);
		$data['Notifikasi'] = $this->M_data->find('pengumuman', $where);
		$this->load->view('template/notifikasi', $data);
	}

	function ubahPasswordDefault($id, $user)
	{
		if ($user === 'admin') {
			$key = 'id_admin';
		} else {
			$key = 'ID';
		}

		$where = array($key => $id);
		$pass_lama = $this->input->post('pass_lama');
		$pass_baru = $this->input->post('pass_baru');
		//$pass_lama = md5($this->input->post('pass_lama'));
		$regex_lowercase = '/[a-z]/';
		$regex_uppercase = '/[A-Z]/';
		$regex_number = '/[0-9]/';
		$regex_special = '/[!@#$%^&*()\-_=+{};:,<.>ยง~]/';
		$uppercase = preg_match_all($regex_uppercase, $pass_baru);
		$lowercase = preg_match_all($regex_lowercase, $pass_baru);
		$number    = preg_match_all($regex_number, $pass_baru);
		$specialChars = preg_match_all($regex_special, $pass_baru);

	    $data['Password'] = password_hash($this->input->post('pass_baru'), PASSWORD_DEFAULT);

		if (!(empty($this->input->post('username')))) {
			$data['username'] = $this->input->post('username');
		};

		$cek = $this->M_data->find($user, $where);

		$result = $cek->row();
		
		if (password_verify($pass_lama, $result->Password)) {
			if($uppercase < 1 || $lowercase < 1 || $number < 1 || $specialChars < 1 || strlen($pass_baru) < 8) {
			    $_SESSION["gagal"] = 'Password harus minimal 8 karakter dan harus mengandung sedikitnya satu huruf besar, satu huruf kecil, satu angka, dan satu karakter spesial.';
			    redirect('ControllerGlobal/loadChangePassword/');
			}else{
				$this->M_data->update($key, $id, $user, $data);
				if($this->db->affected_rows() > 0){
					$_SESSION["sukses"] = 'Password baru Anda berhasil disimpan!';
	            	redirect('Home');
				} else {
					$_SESSION["gagal"] = 'Gagal menyimpan password!';
	            	redirect('ControllerGlobal/loadChangePassword/');
				}
			}
			
		} else {
			$_SESSION["gagal"] = 'Password lama Anda salah!';
            redirect('ControllerGlobal/loadChangePassword/');
		}
	}

	function ubahPassword($id, $user)
	{
		if ($user === 'admin') {
			$key = 'id_admin';
		} else {
			$key = 'ID';
		}

		$where = array($key => $id);
		$pass_lama = $this->input->post('pass_lama');
		$pass_baru = $this->input->post('pass_baru');
		//$pass_lama = md5($this->input->post('pass_lama'));
		$regex_lowercase = '/[a-z]/';
		$regex_uppercase = '/[A-Z]/';
		$regex_number = '/[0-9]/';
		$regex_special = '/[!@#$%^&*()\-_=+{};:,<.>ยง~]/';
		$uppercase = preg_match_all($regex_uppercase, $pass_baru);
		$lowercase = preg_match_all($regex_lowercase, $pass_baru);
		$number    = preg_match_all($regex_number, $pass_baru);
		$specialChars = preg_match_all($regex_special, $pass_baru);

	    $data['Password'] = password_hash($this->input->post('pass_baru'), PASSWORD_DEFAULT);

		if (!(empty($this->input->post('username')))) {
			$data['username'] = $this->input->post('username');
		};

		$cek = $this->M_data->find($user, $where);

		$result = $cek->row();
		
		if (password_verify($pass_lama, $result->Password)) {
			if($uppercase < 1 || $lowercase < 1 || $number < 1 || $specialChars < 1 || strlen($pass_baru) < 8) {
			    $_SESSION["gagal"] = 'Password harus minimal 8 karakter dan harus mengandung sedikitnya satu huruf besar, satu huruf kecil, satu angka, dan satu karakter spesial.';
			    redirect('home');
			}else{
				$this->M_data->update($key, $id, $user, $data);
				if($this->db->affected_rows() > 0){
					$_SESSION["sukses"] = 'Password baru Anda berhasil disimpan!';
	            	redirect('home');
				} else {
					$_SESSION["gagal"] = 'Gagal menyimpan password!';
	            	redirect('home');
				}
			}
			
		} else {
			$_SESSION["gagal"] = 'Password lama Anda salah!';
            redirect('home');
		}
	}

	function loadChangePassword()
    {
        $this->load->view('change_password');
    }
	
	function downloadFile($status, $filename)
	{
		$this->load->helper('download');
		force_download('assets/'.$status.'/'.$filename, NULL);
	}

	function uploadFoto()
	{
		if (!is_dir('./assets/images/users')) {
			mkdir('./assets/images');
            mkdir('./assets/images/users');			
		}
		
		$id= $_SESSION['ID'];
		
		$config['upload_path'] = './assets/images/users';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['overwrite'] = true;
		$config['file_name']	= $id;
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('upload')){
			
			$error = $this->upload->display_errors();

			$notif = array(
				'head' => "Maaf Terjadi Kesalahan",
				'isi' => $error,
				'sukses' => 0
			);

		} else {
	

			$foto = $this->upload->data();

			$query = $this->db->query("SELECT Foto FROM users WHERE ID=$id");

			$data['Foto'] = $foto['file_name'];

			$this->M_data->update('ID', $id, 'users', $data);

			$notif = array(
				'head' => "Upload Berhasil",
				'isi' => 'Berhasil',
				'sukses' => 1
			);
		}

		echo json_encode($notif);
		
	}

	function deleteNotifikasi($id)
	{
		$where = array('IDNotifikasi' => $id);
		$this->M_data->delete($where, 'notifikasi');

        redirect('Dosen');
	}

	function update(){
		if ($_SESSION['Status'] === 'Admin') {
			$id = $this->input->post('id');
		} else {
			$id = $_SESSION['ID'];
		}

		$value= $this->input->post("value");
		$modul= $this->input->post("modul");
		$data[$modul] = $value;

		$this->M_data->update('ID', $id, 'users', $data);
		echo "{}";
	}

	function deleteUsers(){
		if ($_SESSION['Status'] === 'Admin') {
			$id = $this->input->post('id');
		} else {
			$id = $_SESSION['ID'];
		}

		$this->M_data->delete('ID', $id);
	}

	function panduan()
	{
		$where = array('ID' => $this->session->userdata('ID'));
		$data['users'] = $this->M_data->find('users', $where, '', '', 'programstudi', 'programstudi.IDProgramStudi = users.IDProgramStudiUser', 'bidangminat', 'bidangminat.IDBidangMinat = users.IDBidangMinatUser');
		$this->load->view('template/panduan', $data);
       
		// $where = array('IDPenerima' => $this->session->userdata('ID'));
		// $data['Notifikasi'] = $this->M_data->find('notifikasi', $where,  'IDNotifikasi', 'DESC', 'users', 'users.ID = notifikasi.IDPengirim');
		// $this->load->view('template/panduan',$data);
		
	}
	function get_detail_pum_by_id($id)
	{
		$status = '';
            $datapum = $this->M_data->get_detail_pum($id)[0];
            $data['show_detil'] = '
                <div>
                    <table  style="margin-left: auto; margin-right: auto;">
                        <tr style="height:35px;">
                            <td style="width:100px;"><strong>Judul</strong></td>
                            <td style="width:80px;">:&nbsp&nbsp</td>
                            <td style="width:400px;">'.$datapum->Judul.'</td>
                        </tr>
                        <tr style="height:35px;">
                            <td><strong>File</strong></td>
                            <td>:</td>
                            <td>
                                <a href="'. base_url('assets/ICP/'.$datapum->FilePengumuman).'" target="_BLANK">
                                    
                                    <small>'.$datapum->FilePengumuman.'</small>
                                </a>
                            </td>
                        </tr>
                        <tr style="height:35px;">
                            <td><strong>Isi Pesan</strong></td>
                            <td>:</td>
                            <td>'.$datapum->Pesan.'</td>
                        </tr>
                        <tr style="height:35px;">
                            <td><strong>Tanggal</strong></td>
                            <td>:</td>
                            <td>'.$datapum->TanggalPengumuman.'</td>
                        </tr>
                    </table>
                </div>
            ';
            echo json_encode($data);
	}

}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */