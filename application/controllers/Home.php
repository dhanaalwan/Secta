<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public $emailHost	="irfancahyanto87@yahoo.co.id";
	public $passHost 	="dcoowwtfpqqlodie";
	public $smptHost 	="smtp.mail.yahoo.com";
	public $smtpPort 	= 465;


	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
		$this->load->helper('string');
		$this->load->helper('form');
		$this->load->library('form_validation');
	}
	
	function index()
	{
		if($this->session->userdata('statusloginaplikasiotp') != 'sukseslogin'){
			$this->load->view('home');

		} else {
			if($this->session->userdata('keterangan') == 'Adminprodi'){
				redirect('Adminprodi');
			} else if ($this->session->userdata('keterangan') == 'Mahasiswa') {
				redirect('Mahasiswa');
			}
		}
		
	}

	function formDaftar()
	{
		$data['bidangminat'] = $this->M_data->find('bidangminat');
		$data['programstudi'] = $this->M_data->find('programstudi');

		$this->load->view('formDaftar', $data);
		$this->load->view('template/jquery/formSubmit');
		
	}

	function filterBidangMinat(){

		$IDProgramStudi = $this->input->post('IDProgramStudi');
		$where = array('IDProgramStudiKsn' => $IDProgramStudi );
		$data = $this->M_data->find('bidangminat', $where);
		
		if ($data) {
			$lists = "<option value=''>Pilih</option>";
			foreach($data->result() as $u){
				$lists .= "<option value='".$u->IDBidangMinat."'>".$u->BidangMinat."</option>"; 
			}
		} else {
			$lists = "<option disabled> Belum Ada Bidang Minat </option>";
		}

		$callback = array('list'=> $lists); 
		echo json_encode($callback);
	}

	function daftarMahasiswa()
	{
		$ID = $this->input->post('nim');
		$Nama = $this->input->post('nama');
		$ProgramStudi = $this->input->post('programstudi');
		$BidangMinat = $this->input->post('bidangminat');
		$NoHP = $this->input->post('nohp');
		$Email = $this->input->post('email');

		$filename = "file_".time('upload');

		$config['upload_path'] = './assets/images/User/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['file_name']	= $filename;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('foto'))
		{
			$error = array('error' => $this->upload->display_errors());
			$notif = array(
				'head' => "Maaf Terjadi Kesalahan",
				'isi' => "Terjadi Kesalahan Saat Mengupload Gambar",
				'sukses' => 0
			);

			print_r($error);

		}
		else {

			$foto = $this->upload->data();
			
			$data = array(
				'ID' => $ID,
				'Nama' => $Nama,
				'IDProgramStudiUser' => $ProgramStudi,
				'IDBidangMinatUser' => $BidangMinat,
				'NoHP' => $NoHP,
				'Email' => $Email, 
				'Foto' => $foto['file_name'],
				'Status' => 'Daftar'
			);
			$this->M_data->save($data, 'users');
			$notif = array(
				'head' => "Pendaftaran Berhasil",
				'isi' => "Mohon Tunggu Validasi Dari Jurusan",
				'user' => "Daftar",
				'func' => "Home/daftarMahasiswa",
				'sukses' => 1
			);
		}
		echo json_encode($notif);

	}

	function session()
	{
		if($this->session->userdata('statusloginaplikasiotp') != 'sukseslogin'){
			$this->form_validation->set_rules('nim', 'NPM/NIP', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if ($this->form_validation->run() == TRUE) {
				date_default_timezone_set('Asia/Jakarta');

				$username = str_replace("'", "", htmlspecialchars($this->input->post('nim'), ENT_QUOTES));
				//$password = password_verify($hash, PASSWORD_BCRYPT);

				$password = $this->input->post('password');
				//$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
				//$password = password_verify('password', $hash_default_salt);

				$where = "ID='$username'";

				$where_admin = "username='$username'";

				$users = $this->M_data->find('users', $where, '', '', 'bidangminat','bidangminat.IDBidangMinat = users.IDBidangMinatUser');

				$admin = $this->M_data->find('admin', $where_admin);

				if ($users) {
					if(password_verify($password, $users->result()[0]->Password)) {
					foreach ($users->result() as $u) {

						$data1 = array(
							'ID' => $u->ID,
							'Status' => $u->Status,
							'Nama' => $u->Nama,
							'BidangMinat' => $u->BidangMinat,
							'IDProdiUser' => $u->IDProgramStudiUser,
							'email' => $u->Email,
							'statusloginaplikasiotp' 	=> 'pendinglogin'
						);


						/* OTP */

						$kodeOtp =  random_string('numeric', 6);
						$tanggalSekarang=date('Y-m-d H:i:s');
						$datetime = new DateTime($tanggalSekarang);
						$datetime->modify('+10 minute');
						$tanggalKadaluarsa=$datetime->format('Y-m-d H:i:s');

						$data = array(
						        'email' 				=> $u->Email,
						        'kode' 					=> $kodeOtp,
						        'tanggal_kadaluarsa' 	=> $tanggalKadaluarsa,
						        'status' 				=> 'Y'
						);

						$this->db->insert('kodeotp', $data);

						// Konfigurasi email
						$config = [
							'mailtype'	=>'html',
							'charset'	=>'utf-8',
							'protocol'	=>'smtp',
							'smtp_host'	=>$this->smptHost,
							'smtp_user'	=>$this->emailHost,
							'smtp_pass'	=>$this->passHost,
							'smtp_crypto'=>'ssl',
							'smtp_port'	=>$this->smtpPort,
							'crlf'		=>"\r\n",
							'newline'	=>"\r\n"
						];

						// Load library email dan konfigurasinya
						$this->load->library('email');
						 
						$this->email->initialize($config);

					    // Email dan nama pengirim
						$this->email->from($this->emailHost, "Sistem E-Control Tugas Akhir");

				        // Email penerima
				        $this->email->to($u->Email); // Ganti dengan email tujuan

				        $isipesan="Kode OTP : ".$kodeOtp;

				        // Subject email
				        $this->email->subject("Kode OTP anda");

				        // Isi email
				        $this->email->message($isipesan);

				        if ($this->email->send()) {

				            $status = $u->Status;
							if ($u->ID === $u->IDDosen) {
								$data1['Adminprodi'] = 1;
								$data1['keterangan'] = 'Adminprodi';
								echo 3;
							} elseif($status === 'Dosen') {
								$data1['Adminprodi'] = 0;
								$data1['keterangan'] = 'Dosen';
								echo 1;
							} else {
								$data1['keterangan'] = 'Mahasiswa';
								echo 2;
								$data1['Adminprodi'] = 0;
							}

							$this->session->set_userdata($data1);

				        } else {
				           	$this->db->set('status', 'N');
							$this->db->where('email', $u->Email);
							$this->db->update('kodeotp');
				        }

						/* END OTP */
					}
				}else{
					redirect('Home');
				}

				} elseif ($admin) {
					if(password_verify($password, $admin->result()[0]->Password)) {
						foreach ($admin->result() as $b) {

							$data = array(
								'id_admin' => $b->id_admin,
								'username' => $b->username,
								'password' => $b->Password,
								'Status' => 'Admin',
							);

							$this->session->set_userdata($data);
							echo 4;
						}
					} else{
						redirect('Home');
					}
				} else {
					redirect('Home');
				}
			} else{
				$this->session->set_flashdata('notif', validation_errors());
				redirect('Home');
			}

		} else {
			if($this->session->userdata('keterangan') == 'Adminprodi'){
				redirect('Adminprodi');
			} else if ($this->session->userdata('keterangan') == 'Mahasiswa') {
				redirect('Mahasiswa');
			}
		}
	}

	public function Logout()
	{
		$this->session->sess_destroy();
		redirect('Home');
	}
}