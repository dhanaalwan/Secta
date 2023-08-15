<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    public $emailHost   ="irfancahyanto87@yahoo.co.id";
    public $passHost    ="dcoowwtfpqqlodie";
    public $smptHost    ="smtp.mail.yahoo.com";
    public $smtpPort    = 465;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('security','string','url','download','form'));
        $this->load->library('form_validation');
        $status = $this->session->userdata('Status');
        if (!(($status == "Mahasiswa") or ($status == "TugasAkhir"))) {
            redirect(base_url("Home"));
        }
    }

    public function index()
    {
        if ($this->session->userdata('statusloginaplikasiotp') != 'sukseslogin') {
            $this->load->view('validasi');
        } else{
            $this->dashboard();
        }
    }

    /* OTP */

    public function dashboard($cond='')
    {
        $this->session1();
        $this->session2();
        $data['load'] = 0;
        $where = array('IDPenerima' => $_SESSION['ID']);
        $skrip = array('IDMahasiswaTugasAkhir' => $_SESSION['ID']);
        $data['pemberitahuan'] = $this->M_data->find('notifikasi', $where, 'IDNotifikasi', 'DESC', 'users', 'users.ID = notifikasi.IDPengirim');
        $whereUsers = array('ID' => $_SESSION['ID']);
        $data['users'] = $this->M_data->find('users', $whereUsers, '', '', 'programstudi', 'programstudi.IDProgramStudi = users.IDProgramStudiUser');
        $data['tugasakhir'] = $this->M_data->get_mhs_ta($_SESSION['ID']);
        $pw_user = $data['users']->row()->Password;
        
        if (password_verify('12345678', $pw_user)) {
            redirect('controllerglobal/loadChangePassword');
        }

        if ($cond == 'loadide') {
            $data['load'] = 1;
        } else if($cond == 'loadta'){
            $data['load'] = 2;
        } else if($cond == 'loadtte'){
            $data['load'] = 3;
        }

        $this->load->view('template/navbar')->view('mahasiswa/home', $data);
    }

    function session1(){
        if($this->session->userdata('statusloginaplikasiotp')=="pendinglogin"){
            redirect('welcome/validasi');
        }
    }

    function session2(){
        if($this->session->userdata('statusloginaplikasiotp')!="pendinglogin" && $this->session->userdata('statusloginaplikasiotp')!="sukseslogin"){
            redirect('welcome');
        }
    }

    public function validasiproses()
    {
        date_default_timezone_set('Asia/Jakarta');
        $user = $this->session->userdata('email');
        $kode = $this->input->post('kodeotp',TRUE);
        $waktuSekarang=date('Y-m-d H:i:s');

        $cek = $this->db->get_where('kodeotp', array('email' => $user,'kode'=>$kode,'status'=>'Y'));
        if ($cek->num_rows()>0) {
            $cek=$cek->row();

            if ($waktuSekarang>$cek->tanggal_kadaluarsa) {
                $this->session->set_flashdata('gagal', "Kode OTP tidak valid");
                redirect('Home');   
            }else{

                $datasession=array(
                    'statusloginaplikasiotp'    => 'sukseslogin',
                );

                $this->session->set_userdata($datasession);

                $this->db->set('status', 'N');
                $this->db->where('email', $user);
                $this->db->update('kodeotp');

                redirect('Mahasiswa/dashboard');  
            }

        }else{
            $this->session->set_flashdata('gagal', "Kode OTP tidak valid");
            redirect('Home');
        }
    }

    /* END OTP */

    public function sendIde2()
    {
        $id_ide = time();
        $judul = $this->input->post('judul');
        $deskripsi = $this->input->post('deskripsi');
        $tanggal = longdate_indo(date('Y-m-d'));
        $nim = $_SESSION['ID'];

        $ide = array('IDIde' => $id_ide, 'IDIdeMahasiswa' => $nim, 'JudulIde' => $judul, 'DeskripsiIde' => $deskripsi, 'Tanggalide' => $tanggal);

        $where = array('JudulTugasAkhir' => $judul);

        $tugasakhir = $this->M_data->find('tugasakhir', $where);

        if ($tugasakhir) {
            $notif = array(
                'head' => 'Idea Concept Paper gagal diajukan!',
                'isi' => 'Judul Tugas Akhir yang sama sudah pernah ada',
                'sukses' => 0,
            );
        } else {
            $this->M_data->save($ide, 'idetugasakhir');
            $notif = array(
                'head' => 'Idea Concept Paper berhasil diajukan!',
                'isi' => 'Silahkan tunggu validasi dari Prodi/Pokil',
                'ID' => 'ideTugasAkhir',
                'func' => 'Mahasiswa/ideTugasAkhir',
                'sukses' => 1,
            );
        }

        echo json_encode($notif);
    }

    public function sendIcpEmail()
    {
        // $this->form_validation->set_rules('ICP', 'File ICP', 'required');
        $this->form_validation->set_rules('judul', 'Judul ICP', 'required');
        $this->form_validation->set_rules('pesan', 'Pesan', 'required');
        $this->form_validation->set_rules('dosen1', 'Dosen Pembimbing', 'required');

        if ($this->form_validation->run() == TRUE) {
            $id_ide = time();
            $judul = $this->input->post('judul');
            $tanggal = longdate_indo(date('Y-m-d'));
            $nim = $_SESSION['ID'];
            $dosen = $this->input->post('dosen1');
            $pesan = $this->input->post('pesan');
            
            $where = array('JudulTugasAkhir' => $judul);
            $where_ide = array('JudulIde' => $judul);
            $where_dosen = array('IDDosen' => $dosen);
            $where_email_mhs = array('ID' => $nim);

            $email = $this->M_data->find('dosen', $where_dosen);
            $tugasakhir = $this->M_data->find('tugasakhir', $where);
            $idetugasakhir = $this->M_data->find('idetugasakhir', $where_ide);
            $mhs = $this->M_data->find('users', $where_email_mhs);

            if ($tugasakhir) {
                $_SESSION["gagal"] = 'Gagal Mengajukan ICP! Judul yang diajukan sudah ada.';
                redirect('Mahasiswa/Dashboard/loadide');
            }
            elseif($idetugasakhir){
                $_SESSION["gagal"] = 'Gagal Mengajukan ICP! Judul yang diajukan sudah ada.';
                redirect('Mahasiswa/Dashboard/loadide');
            } else {
                $ID = $this->session->userdata('ID');
                $sesi='ICP';
                $config['upload_path'] = './assets/ICP/';
                $config['allowed_types'] = 'pdf|PDF';
                $config['overwrite'] = true;
                $config['max_size'] = 0;
                $config['file_name'] = $ID;

                if (!is_dir('./assets/' . $sesi)) {
                    mkdir('./assets/' . $sesi);
                }

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload($sesi)) {
                    $_SESSION["gagal"] = 'Maaf Terjadi Kesalahan, '.$this->upload->display_errors();
                    redirect('Mahasiswa/Dashboard/loadide');

                } else {
                
                    $file = $this->upload->data();

                    $ide = array('IDIde' => $id_ide, 'IDIdeMahasiswa' => $nim, 'IDDosen' => $dosen, 'JudulIde' => $judul, 'FileICP' => $file['file_name'], 'TanggalIde' => $tanggal, 'StatusIde' => 'ICP Diajukan');

                    $config = [
                        'mailtype'  =>'html',
                        'charset'   =>'utf-8',
                        'protocol'  =>'smtp',
                        'smtp_host' =>$this->smptHost,
                        'smtp_user' =>$this->emailHost,
                        'smtp_pass' =>$this->passHost,
                        'smtp_crypto'=>'ssl',
                        'smtp_port' =>$this->smtpPort,
                        'crlf'      =>"\r\n",
                        'newline'   =>"\r\n"
                    ];

                    // Load library email dan konfigurasinya
                    $this->load->library('email');
                     
                    $this->email->initialize($config);

                    // Email dan nama pengirim
                    //$this->email->from($mhs->result()[0]->Email);
                    $this->email->from($this->emailHost, $mhs->result()[0]->Email);

                    // Email penerima
                    $this->email->to($email->result()[0]->Email); // Ganti dengan email tujuan

                    //$isipesan="Mohon izin untuk mengajukan ";

                    // Subject email
                    $this->email->subject("Pengajuan ICP ".$mhs->result()[0]->Nama);

                    // Isi email
                    $this->email->message($pesan);
                    $this->email->attach($file['full_path']);

                    // if ($this->email->send()){
                    //     echo "berhasil";
                    // } else{
                    //     echo "gagal";
                    // }
                    if (!$this->M_data->save($ide, 'idetugasakhir') && $this->email->send()) {
                        
                        $_SESSION["sukses"] = 'Sukses Menambahkan dan Mengirimkan ICP pada Dosen!';
                        redirect('Mahasiswa/Dashboard/loadide');

                    } else {
                        $_SESSION["gagal"] = 'File ICP Gagal Diupload!';
                        redirect('Mahasiswa/Dashboard/loadide');
                    }
                }
            }
        } else{
            $this->session->set_flashdata('notif', validation_errors());
            redirect('Mahasiswa/Dashboard/loadide');
        }

    }

    public function sendLinkICP()
    {
        $id_icp = $this->input->post('id_icp');
        $link = $this->input->post('link');
        $data = array(
                'LinkICP' => $link,
            );
        $this->db->where('IDIde', $id_icp)
                 ->update('idetugasakhir', $data);
        if($this->db->affected_rows() > 0)
        {
            $_SESSION["sukses"] = 'Sukses Menambahkan Link Dokumen ICP!';
            redirect('Mahasiswa/Dashboard/loadide');
        }else {
            $_SESSION["gagal"] = 'Terjadi Kesalahan saat Menyimpan!';
            redirect('Mahasiswa/Dashboard/loadide');
        }
    }

    public function updateIde()
    {
        $id_icp = $this->input->post('edit_id_icp');
        $judul_icp = $this->input->post('edit_judul_icp');
        $dosen = $this->input->post('edit_dosen');
        $data = array(
                'IDDosen' => $dosen,
                'JudulIde' => $judul_icp
            );
        $this->db->where('IDIde', $id_icp)
                 ->update('idetugasakhir', $data);
        if($this->db->affected_rows() > 0)
        {
            $_SESSION["sukses"] = 'Sukses Mengupdate Ide Tugas Akhir!';
            redirect('Mahasiswa/Dashboard/loadide');
        }else {
            $_SESSION["gagal"] = 'Gagal Mengupdate Ide Tugas Akhir!';
            redirect('Mahasiswa/Dashboard/loadide');
        }
    }

    public function hapusIde($id)
    {
        $where = array('IDIde'=>$id);

        if ($this->M_data->delete($where, 'idetugasakhir')) {
                $_SESSION["sukses"] = 'Sukses Menghapus Ide Tugas Akhir!';
                redirect('Mahasiswa/Dashboard/loadide');
            } else {
                $_SESSION["gagal"] = 'Terjadi Kesalahan saat Menghapus Data!';
                redirect('Mahasiswa/Dashboard/loadide');
            }
    }

    public function form_ide()
    {
        $data['list_dosen'] = $this->M_data->get_dosen();
        //$email = $this->M_data->find('dosen', $where_dosen)->result()[0]->Email;
        $this->load->view('mahasiswa/formIde',$data);
    }

    public function get_detail_ide_by_id($id)
    {
        // if($this->session->userdata('logged_in') == TRUE){
            $status = '';
            $dataide = $this->M_data->get_detail_ide($id)[0];
            if($dataide->StatusIde == 'ICP Diajukan'){
                $status = '<span class="badge badge-warning rounded-pill d-inline" style="margin-left:10px;">ICP Diajukan</span>';
            } else if ($dataide->StatusIde == 'ICP Diterima') {
               $status =  '<span class="badge badge-success rounded-pill d-inline" style="margin-left:10px;">ICP Diterima</span>';
            } else if ($dataide->StatusIde == 'ICP Ditolak') {
                $status = '<span class="badge badge-danger rounded-pill d-inline" style="margin-left:10px;">ICP Ditolak</span>';
            }
            $data['show_detil'] = '
                <div>
                    <table  style="margin-left: auto; margin-right: auto;">
                        <tr style="height:35px;">
                            <td>Judul</td>
                            <td>:&nbsp&nbsp</td>
                            <td style="width:240px;">'.$dataide->JudulIde.'</td>
                        </tr>
                        <tr style="height:35px;">
                            <td>File</td>
                            <td>:</td>
                            <td>
                                <a href="'. base_url('assets/ICP/'.$dataide->FileICP).'" target="_BLANK">
                                    <img src="'. base_url('assets/images/logo/pdf.png').'" alt="Download ICP" style="width:30px;">
                                    <small>'.$dataide->FileICP.'</small>
                                </a>
                            </td>
                        </tr>
                        <tr style="height:35px;">
                            <td>Tanggal Diajukan</td>
                            <td>:</td>
                            <td>'.$dataide->TanggalIde.'</td>
                        </tr>
                        <tr style="height:35px;">
                            <td>Dosen Pembimbing</td>
                            <td>:</td>
                            <td>'.$dataide->NamaDosen.'</td>
                        </tr>
                        <tr style="height:35px;">
                            <td>Status</td>
                            <td>:</td>
                            <td>'.$status.'</td>
                        </tr>
                        <tr style="height:35px;">
                            <td>Catatan</td>
                            <td>:</td>
                            <td>'.str_replace('%20', ' ', $dataide->CatatanICP).'</td>
                        </tr>
                    </table>
                </div>
            ';
            echo json_encode($data);

        // } else {
        //     redirect('login/index');
        // }
    }

    public function get_data_ide_by_id($id)
    {
        // if($this->session->userdata('logged_in') == TRUE){

            $dataide = $this->M_data->get_data_ide_by_id($id);
            echo json_encode($dataide);

        // } else {
        //     redirect('login/index');
        // }
    }

    public function form_tte()
    {
        $this->load->view('mahasiswa/formTTE');
    }

    public function list_tte()
    {
        $this->load->view('mahasiswa/listSignedFile');
    }

    public function signFile()
    {
        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('passphrase', 'Passphrase', 'required');
        // $this->form_validation->set_rules('TTE', 'File', 'required');
        if ($this->form_validation->run() == TRUE) {
            $url = 'https://esign-dev.layanan.go.id/api/sign/pdf';

            // Data autentikasi
            $username = 'esign';
            $password = 'wrjcgX6526A2dCYSAV6u';
            $filename = $_FILES['TTE']['name'];

            $ID = $this->session->userdata('ID');
            $sesi='DokumenTTE';
            $config['upload_path'] = './assets/DokumenTTE/';
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $config['max_size'] = 0;
            $config['file_name'] = $filename;
            // Path file yang akan diupload
            $dir = './assets/DokumenTTE/160.pdf';

            if (!is_dir('./assets/' . $sesi)) {
                mkdir('./assets/' . $sesi);
            }

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('TTE')) {
                $_SESSION["gagal"] = 'Maaf Terjadi Kesalahan, '.$this->upload->display_errors();
                redirect('Mahasiswa/Dashboard/loadtte');

            } else{
                $nik = $this->input->post('nik');
                $pw = $this->input->post('passphrase');

                // Create a CURLFile object
                $file = curl_file_create('./assets/DokumenTTE/'.$filename, 'application/pdf', 'MyFile');

                // Konfigurasi permintaan
                $options = array(
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: multipart/form-data'
                    ),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_SSL_VERIFYPEER => false, // mengabaikan validasi sertifikat SSL
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => array(
                        'file' => $file,
                        'nik' => $nik,
                        'passphrase' => $pw,
                        'tampilan' => 'INVISIBLE'
                    ),
                    CURLOPT_USERPWD => "$username:$password",
                    CURLOPT_TIMEOUT => 60,
                    CURLOPT_BINARYTRANSFER => true // mengembalikan response sebagai file biner
                );

                // Inisialisasi CURL
                $curl = curl_init($url);

                // Konfigurasi opsi permintaan
                curl_setopt_array($curl, $options);

                // Kirim permintaan ke API endpoint
                $result = curl_exec($curl);

                // Tampilkan informasi permintaan
                $info = curl_getinfo($curl);
                $responseHeader = curl_getinfo($curl, CURLINFO_HEADER_OUT);

                $values = array_values($info);

                if ($info['http_code'] != 200) {
                    $_SESSION["gagal"] = 'Proses TTE Gagal!';
                    redirect('Mahasiswa/Dashboard/loadtte');
                } else{
                    $data = array(
                        'IDUsers' => $_SESSION['ID'],
                        'SignedFile' => substr($filename, 0, -4) .'_signed.pdf',
                        'Time' => date('Y-m-d H:i:s')
                    );    

                    // Simpan response sebagai file PDF
                    $fp = fopen('./assets/DokumenTTE/'. substr($filename, 0, -4) .'_signed.pdf', 'w');
                    if(fwrite($fp, $result)){
                        // if(!$this->M_data->save($data, 'tte')){
                            $_SESSION["sukses"] = 'Proses Tanda Tangan Elektronik dokumen berhasil!';
                            redirect('Mahasiswa/Dashboard/loadtte','refresh');
                        // }
                    } else{
                        $_SESSION["gagal"] = 'Proses Tanda Tangan Elektronik Gagal!';
                        redirect('Mahasiswa/Dashboard/loadtte');
                    }
                    fclose($fp);

                }

                // Tutup CURL
                curl_close($curl);
            }
        } else{
            $this->session->set_flashdata('notif', validation_errors());
            redirect('Mahasiswa/Dashboard/loadtte');
        }
    }

    function ideTugasAkhir()
    {
        $data['list_dosen'] = $this->M_data->get_dosen();
        $where = array('IDIdeMahasiswa' => $_SESSION['ID']);
        $data['ide_tugasakhir'] = $this->M_data->find('idetugasakhir', $where, 'IDIde', 'DESC');
        $this->load->view('mahasiswa/ideTugasAkhir', $data);
    }

    public function myTugasAkhir()
    {
        $whereSK = array('IDIdeMahasiswa' => $_SESSION['ID']);
        $whereWK = array('NamaKegiatan' => 'Proposal');
        $whereWK70 = array('NamaKegiatan' => 'TA 70%');
        $whereWK100 = array('NamaKegiatan' => 'TA 100%');
        $data['tugasakhir2'] = $this->M_data->find('tugasakhirmhs', $whereSK, '', '', 'idetugasakhir', 'idetugasakhir.IDIde = tugasakhirmhs.IDIcp', 'users', 'users.ID = idetugasakhir.IDIdeMahasiswa');
        $whereKB = array('IDKartuMahasiswa' => $_SESSION['ID']);
        $data['konsultasi'] = $this->M_data->find('kartubimbingan', $whereKB, '', '', 'users', 'users.ID = kartubimbingan.IDKartuMahasiswa');
        $data['dosenpembimbing'] = $this->M_data->find('tugasakhirmhs', $whereSK, '', '', 'idetugasakhir', 'idetugasakhir.IDIde = tugasakhirmhs.IDIcp', 'dosen', 'dosen.IDDosen = idetugasakhir.IDDosen');
        $data['ketuapenguji'] = $this->M_data->find('tugasakhirmhs', $whereSK, '', '', 'idetugasakhir', 'idetugasakhir.IDIde = tugasakhirmhs.IDIcp', 'dosen', 'dosen.IDDosen = tugasakhirmhs.IDKetuaPenguji');
        $data['penguji2'] = $this->M_data->find('tugasakhirmhs', $whereSK, '', '', 'idetugasakhir', 'idetugasakhir.IDIde = tugasakhirmhs.IDIcp', 'dosen', 'dosen.IDDosen = tugasakhirmhs.IDPenguji2');
        $data['list_berkas'] = $this->M_data->find('berkaspelengkap');

        $nim = $_SESSION['ID'];

        foreach ($data['tugasakhir2']->result() as $s) {
            $proposal = true;
            $ID = $s->IDTugasAkhir;
            $where = array(
                'IDTugasAkhirPmb' => $ID,
                'StatusProposal' => $proposal,
            );
            $data['pmb'] = $this->M_data->find('pembimbing', $where);

        }

        foreach ($data['tugasakhir2']->result() as $m) {
            $wherePmb = array('IDTugasAkhirPmb' => $m->IDTugasAkhir);
            $data['pembimbing'] = $this->M_data->find('pembimbing', $wherePmb, '', '', 'users', 'users.ID = pembimbing.IDDosenPmb');
        }

        // $this->load->view('template/jquery/formSubmit');
        $this->load->view('mahasiswa/myTugasAkhir', $data);
    }

    public function uploadData($sesi, $ID, $state, $kp, $p1, $p2)
    {
        $where = array('IDTugasAkhir' => $ID);
        $nama_mhs = $this->M_data->find('tugasakhirmhs', $where, '','','idetugasakhir', 'tugasakhirmhs.IDIcp = idetugasakhir.IDIde', 'users', 'idetugasakhir.IDIdeMahasiswa = users.ID');
		$config['upload_path'] = './assets/' . $sesi . '/';
		$config['allowed_types'] = 'pdf|PDF';
		$config['overwrite'] = true;
		$config['max_size'] = 0;
        $config['file_name'] = $ID;
        $emails = [$kp,$p1,$p2];
        if ($sesi == "Proposal") {
            $print_sesi = "Proposal";
        } else if ($sesi == "TugasAkhir30"){
            $print_sesi = "Tugas Akhir 30%";
        } else if ($sesi == "TugasAkhir70"){
            $print_sesi = "Tugas Akhir 70%";
        } else if ($sesi == "TugasAkhir100"){
            $print_sesi = "Tugas Akhir 100%";
        }

        if (!is_dir('./assets/' . $sesi)) {
            mkdir('./assets/' . $sesi);
        }

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($sesi)) {
            $_SESSION["gagal"] = 'Maaf Terjadi Kesalahan, '.$this->upload->display_errors();
            redirect('Mahasiswa/Dashboard/loadta');

        } else {
        
            $file = $this->upload->data();
            if ($sesi == 'TugasAkhir100'||$sesi == 'TugasAkhir70'||$sesi == 'TugasAkhir30') {
                $data = array(
                    'FileTugasAkhir' => $file['file_name'],
                    'StatusTA' => $state
                );
            } else{
                $data = array(
                    'File'.$sesi => $file['file_name'],
                    'StatusTA' => $state
                );
            }

            $config = [
                    'mailtype'  =>'html',
                    'charset'   =>'utf-8',
                    'protocol'  =>'smtp',
                    'smtp_host' =>$this->smptHost,
                    'smtp_user' =>$this->emailHost,
                    'smtp_pass' =>$this->passHost,
                    'smtp_crypto'=>'ssl',
                    'smtp_port' =>$this->smtpPort,
                    'crlf'      =>"\r\n",
                    'newline'   =>"\r\n"
                ];

                // Load library email dan konfigurasinya
                $this->load->library('email');
                 
                $this->email->initialize($config);

                // Email dan nama pengirim
                //$this->email->from($mhs->result()[0]->Email);
                $this->email->from($this->emailHost, $nama_mhs->result()[0]->Email);

                // Email penerima
                $this->email->to($emails); // Ganti dengan email tujuan

                $pesan="Berikut dikirimkan dokumen ".$print_sesi." mahasiswa ".$nama_mhs->result()[0]->Nama.", Terima kasih.";

                // Subject email
                $this->email->subject("Dokumen ".$print_sesi." ".$nama_mhs->result()[0]->Nama);

                // Isi email
                $this->email->message($pesan);
                $this->email->attach($file['full_path']);

                // if ($this->email->send()){
                //     echo "berhasil";
                // } else{
                //     echo "gagal";
                // }
                if ($this->M_data->update('IDTugasAkhir', $ID, 'tugasakhirmhs', $data) && $this->email->send()) {
                    $_SESSION["sukses"] = 'Upload Dokumen '.$sesi.' Berhasil!';
                    redirect('Mahasiswa/Dashboard/loadta');

                } else {
                    $_SESSION["gagal"] = 'Upload Dokumen '.$sesi.' Gagal!';
                    redirect('Mahasiswa/Dashboard/loadta');
                }
        }
    }

    public function uploadICP($sesi, $ID)
    {
        $config['upload_path'] = './assets/' . $sesi . '/';
        $config['allowed_types'] = 'pdf';
        $config['overwrite'] = true;
        $config['max_size'] = 0;
        $config['file_name'] = $ID;

        if (!is_dir('./assets/' . $sesi)) {
            mkdir('./assets/' . $sesi);
        }

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($sesi)) {
            $notif = array('head' => "Maaf Terjadi Kesalahan",
                'isi' => $this->upload->display_errors(),
                'sukses' => 0);

        } else {
        
            $file = $this->upload->data();

            $data = array(
                'file' . $sesi => $file['file_name'],
                'Uploader' => $_SESSION['ID']
            );
            
            if ($this->M_data->update('IDIde', $ID, 'idetugasakhir', $data)) {

                $notif = array(
                    'head' => "File " . $sesi . " Berhasil di Upload",
                    'isi' => "Silahkan Minta Dosen Untuk Mengecek",
                    'ID' => "FormIde",
                    'func' => "/Mahasiswa/form_ide",
                    'sukses' => 1,

                );
            } else {
                $notif = array(
                    'head' => "File " . $sesi . " Tidak Berhasil di Upload",
                    'isi' => "Maaf Terjadi Kesahalah Teknis",
                    'sukses' => 0);
            }
        }
        echo json_encode($notif);
    }

    public function ajukanTA(){
        $idide =  $this->uri->segment(3);
        $idmhs =  $this->uri->segment(4);
        
        $IDTa = time();
        $berhasil = 1;
        $ide_delete = $this->M_data->get_ide_per_mhs_delete($idide, $idmhs);
        $data = array(
            'IDTugasAkhir' => $IDTa,
            'IDIcp' => $idide,
            'StatusTA' => 'Kosong'
        );    
        
        if(!$this->M_data->save($data, 'tugasakhirmhs'))
        {

            if ($ide_delete) {
                    foreach ($ide_delete->result() as $d) {
                    $where = array('IDIde' => $d->IDIde,);
                    if(!$this->M_data->delete($where,'idetugasakhir')){
                        $berhasil = 0;
                    }
                }
            }
            
            if ($berhasil == 1) {
                $_SESSION["sukses"] = 'ICP Diajukan menjadi Tugas Akhir!';
                redirect('Mahasiswa/Dashboard/loadta');
            } elseif(!$ide_delete) {
                $_SESSION["sukses"] = 'ICP Diajukan menjadi Tugas Akhir!';
                redirect('Mahasiswa/Dashboard/loadta');
            } else {
                $_SESSION["gagal"] = 'Terjadi Kesalahan!';
                redirect('Mahasiswa/Dashboard/loadide');
            }
            
        }
    }

    public function sendLink($id,$sesi,$state)
    {
        $link = $this->input->post('link');
        $data = array(
                'Link'.$sesi => $link,
                'StatusTA' => $state
            );
        $this->db->where('IDTugasAkhir', $id)
                 ->update('tugasakhirmhs', $data);
        if($this->db->affected_rows() > 0)
        {
            $_SESSION["sukses"] = 'Sukses Menambahkan Link Dokumen '.$state.'!';
            redirect('Mahasiswa/Dashboard/loadta');
        }else {
            $_SESSION["gagal"] = 'Terjadi Kesalahan saat Menyimpan!';
            redirect('Mahasiswa/Dashboard/loadta');
        }
    }

}
