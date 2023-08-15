<?php defined('BASEPATH') or exit('No direct script access allowed');

class Adminprodi extends CI_Controller
{
    public $emailHost   ="irfancahyanto87@yahoo.co.id";
    public $passHost    ="dcoowwtfpqqlodie";
    public $smptHost    ="smtp.mail.yahoo.com";
    public $smtpPort    = 465;

    public function __construct()
    {
        parent::__construct();
        $where = array('IDDosen' => $_SESSION['ID']);
        $dosen = $this->M_data->find('bidangminat', $where);
        if (!$dosen) {
            redirect(base_url("Home"));
        }

        $this->load->library('Ajax_pagination');
        $this->perPage = 15;
        $this->load->model('IdeModel');
        $this->load->helper(array('security','string','url','download','form'));
        
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
        $data['ide_load'] = 0;
        $data['ta_load'] = 0;
        $data['pum_load'] = 0;
        $data['berkas_load'] = 0;

        $id = array('ID' => $_SESSION['ID']);

        $Penerima = array('IDPenerima' => $_SESSION['ID']);

        $data['Notifikasi'] = $this->M_data->find('notifikasi', $Penerima, '', '', 'users', 'users.ID = notifikasi.IDPengirim');

        $data['users'] = $this->M_data->find('users', $id, '', '', 'programstudi', 'programstudi.IDProgramStudi = users.IDProgramStudiUser');

        $result = $data['users']->row();
        $where = array('IDBidangMinatUser' => $result->IDBidangMinatUser);

        $data['idetugasakhir'] = $this->M_data->find('idetugasakhir', $where, 'IDIde', 'DESC', 'users', 'users.ID = idetugasakhir.IDIdeMahasiswa');
        if ($cond == 'loadide') {
            $data['ide_load'] = 1;
        } else if($cond == 'loadta'){
            $data['ta_load'] = 1;
        } else if($cond == 'loadpum'){
            $data['pum_load'] = 1;
        } else if($cond == 'loadberkas'){
            $data['berkas_load'] = 1;
        }

        $this->load->view('template/navbar');
        $this->load->view('dosen/home', $data);
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

                redirect('Adminprodi/dashboard');  
            }

        }else{
            $this->session->set_flashdata('gagal', "Kode OTP tidak valid");
            redirect('Home');
        }
    }

    /* END OTP */

    public function filterPembimbing()
    {

        $pmb1 = $this->input->post('pmb1');
        $id = array('ID' => $_SESSION['ID']);
        $adminprodi = $this->M_data->find('users', $id);

        $result = $adminprodi->row();

        $where = array(
            'IDBidangMinatUser' => $result->IDBidangMinatUser,
            'Status' => 'Dosen',
            'ID <>' => $pmb1,
        );

        $data = $this->M_data->find('users', $where);

        $lists = "<option value=''>Pilih</option>";

        foreach ($data->result() as $u) {
            $lists .= "<option value='" . $u->ID . "'>" . $u->Nama . "</option>";
        }

        $callback = array('list' => $lists);
        echo json_encode($callback);
    }

    public function nilai()
    {
        $id = $this->input->post("id");
        $value = $this->input->post("value");
        $modul = $this->input->post("modul");

        $where = array('IDTugasAkhir' => $id);

        $tugasakhir = $this->M_data->find('tugasakhir', $where);
        foreach ($tugasakhir->result() as $m) {
            $ID = $m->IDMahasiswaTugasAkhir;
            $status = array('status' => 'Alumni');
            $this->M_data->update('ID', $ID, 'users', $status);
        }
        $data[$modul] = $value;
        $this->M_data->update('IDTugasAkhir', $id, 'tugasakhir', $data);
        echo "{}";
    }

    public function formKegiatan()
    {
        $data = array('ID' => $_SESSION['ID']);
        $users = $this->M_data->find('users', $data);

        $result = $users->row();

        $where = array(
            'IDBidangMinatUser' => $result->IDBidangMinatUser,
            'Status' => 'TugasAkhir'
        );

        $data['users'] = $this->M_data->find('users', $where);
        $this->load->view('adminprodi/formKegiatan', $data);
    }

    public function formPengumuman()
    {

        $data = array('ID' => $_SESSION['ID']);
        $users = $this->M_data->find('users', $data);

        $result = $users->row();

        $where = array(
            'IDBidangMinatUser' => $result->IDBidangMinatUser,
            'Status' => 'TugasAkhir'
        );

        $data['user_admin'] = $users;
        $data['users'] = $this->M_data->find('users', $where);
        $this->load->view('adminprodi/formPengumuman', $data);
    }

    public function ideTugasAkhir()
    {

        $id = array('ID' => $_SESSION['ID']);
        $adminprodi = $this->M_data->find('users', $id);
        $data['id_prodi_user'] = $_SESSION['IDProdiUser'];
        $result = $adminprodi->row();
        $where = array('IDBidangMinatUser' => $result->IDBidangMinatUser);
        $dosen = array('IDBidangMinatUser' => $result->IDBidangMinatUser, 'Status' => 'Dosen');

        $data['dosen'] = $this->M_data->find(
            'users', $dosen
        );
        $data['list_dosen'] = $this->M_data->get_dosen();
        // mengambil ide tugas akhir pernama
        $data['mahasiswagroup'] = $this->M_data->get_mhs_ide($_SESSION['IDProdiUser']);
        $data['idetugasakhir'] = $this->M_data->find('idetugasakhir', $where, 'IDIde', 'DESC', 'users', 'users.ID = idetugasakhir.IDIdeMahasiswa','','','','',array(),'',$id);
        // mengambil ide tugas akhir per ide
        $data['idetugasakhirpernama'] = $this->M_data->find('idetugasakhir', $where, 'IDIde', 'DESC', 'users', 'users.ID = idetugasakhir.IDIdeMahasiswa');
        $this->load->view('adminprodi/ideTugasAkhir2', $data);
    }

    public function linkPengumpulan()
    {

        $data['kegiatan'] = $this->M_data->find('berkaspelengkap');

        //$id = array('ID' => $_SESSION['ID']);
        // $adminprodi = $this->M_data->find('users', $id);

        // $result = $adminprodi->row();
        // $where = array('IDBidangMinatUser' => $result->IDBidangMinatUser);
        // $dosen = array('IDBidangMinatUser' => $result->IDBidangMinatUser, 'Status' => 'Dosen');

        // $data['dosen'] = $this->M_data->find(
        //     'users', $dosen
        // );
        // // mengambil ide tugas akhir pernama
        // $data['idetugasakhir'] = $this->M_data->find('idetugasakhir', $where, 'IDIde', 'DESC', 'users', 'users.ID = idetugasakhir.IDIdeMahasiswa','','','','',array(),'',$id);
        // // mengambil ide tugas akhir per ide
        // $data['idetugasakhirpernama'] = $this->M_data->find('idetugasakhir', $where, 'IDIde', 'DESC', 'users', 'users.ID = idetugasakhir.IDIdeMahasiswa');
        $this->load->view('adminprodi/formPengumpulan', $data);
    }

    public function acceptTugasAkhir($idTugasAkhir, $sta)
    {
        $note = $this->input->post('catatan');
        $where['IDIde'] = $idTugasAkhir;

        $pengirim = $_SESSION['ID'];
        $tanggal = date('Y-m-d');

        $ideTugasAkhir = $this->M_data->find('idetugasakhir', $where, '', '', 'users', 'users.ID = idetugasakhir.IDIdeMahasiswa');

        foreach ($ideTugasAkhir->result() as $d) {
            $IDIde = $d->IDIde;
            $judul = $d->JudulIde;
            $fileicp = $d->FileICP;
            $ID = $d->ID;
            $nama = $d->Nama;
        }

        if (!is_dir('./assets/images/QRCode')) {
            mkdir('./assets/images/QRCode');
        }

        if ($sta === 'true') {

            $hasil = 'Ditolak';

            $whereIde = array('IDIde' => $IDIde);

            $this->M_data->delete($whereIde, 'idetugasakhir');

        } else {

            $this->load->library('ciqrcode');

            $config['cacheable'] = true;
            $config['cachedir'] = './assets/';
            $config['errorlog'] = './assets/';
            $config['imagedir'] = './assets/images/QRCode/';
            $config['quality'] = true;
            $config['size'] = '1024';
            $config['black'] = array(224, 255, 255);
            $config['white'] = array(70, 130, 180);
            $this->ciqrcode->initialize($config);

            $params['data'] = base_url('Cetak/kartu/' . $ID);
            $params['level'] = 'H';
            $params['size'] = 10;
            $params['savename'] = FCPATH . $config['imagedir'] . $ID . '.png';

            $this->ciqrcode->generate($params);

            $sh = array('IDTugasAkhir' => $IDIde, 'JudulTugasAkhir' => $judul, 'QRCode' => $ID . '.png', 'FileICP' => $fileicp, 'IDMahasiswaTugasAkhir' => $ID, 'Tanggal' => $tanggal);
            $this->M_data->save($sh, 'tugasakhir');

            for ($i = 1; $i < 2; $i++){

                $pmb = $this->input->post('pmb' . $i);

                // Memasukan Dosen Pembimbing Ke Database
                $dosen = array('IDDosenPmb' => $pmb, 'IDTugasAkhirPmb' => $IDIde, 'StatusProposal' => 0, 'StatusTugasAkhir' => 0, 'StatusPembimbing' => $i);
                $this->M_data->save($dosen, 'pembimbing');

                // Mengirim Pemberitahuan Ke Dosen Pembimbing
                $Catatan = 'Anda Di Tetapkan Sebagai Dosen Pembimbing ' . $nama . ' Anda sekarang bisa menyetujui proposal maupun tugas akhir ' . $nama . 'dan juga menambah kartu bimbingan ';

                $NotifDosen = array('Notifikasi' => $judul, 'Catatan' => $Catatan, 'TanggalNotifikasi' => $tanggal, 'IDPengirim' => $pengirim, 'IDPenerima' => $pmb, 'StatusNotifikasi' => 'Informasi');
                $this->M_data->save($NotifDosen, 'notifikasi');
            }

            $whereIde = array('IDIdeMahasiswa' => $ID);

            $this->M_data->delete($whereIde, 'idetugasakhir');

            $hasil = 'Diterima';

        }

        echo $sta;

        $NotifMhs = array('Notifikasi' => $judul, 'Catatan' => $note, 'TanggalNotifikasi' => $tanggal, 'IDPengirim' => $pengirim, 'IDPenerima' => $ID, 'StatusNotifikasi' => $hasil);
        $this->M_data->save($NotifMhs, 'notifikasi');

    }

    public function aksiKegiatan()
    {
        $kegiatan = $this->input->post('kegiatan');
        $penerima = $this->input->post('penerima');
        $catatan = $this->input->post('catatan');

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
        $this->email->from($this->emailHost, "Sistem E-Control Tugas Akhir");

        // Email penerima
        //$this->email->to($u->Email); // Ganti dengan email tujuan

        // Lampiran email, isi dengan url/path file
        //$this->email->attach('');

        // Subject email
        $this->email->subject($kegiatan);

        // Isi email
        $this->email->message($catatan);

        foreach ($penerima as $p) {
            if ($p == 0 || (!$p)) {
                continue;
            } else{
                $data = array(
                'Notifikasi' => $kegiatan,
                'Catatan' => $catatan,
                'IDPengirim' => $_SESSION['ID'],
                'IDPenerima' => $p,
                'TanggalNotifikasi' => date('Y-m-d'),
                'StatusNotifikasi' => $kegiatan,
                );

                $this->M_data->save($data, 'notifikasi');
                $this->email->to($p->Email);
                if($this->email->send()){
                    echo "BERHASIL";
                };
            }
            
        }


    }

    public function adminUpdateIde()
    {
        $id_icp = $this->input->post('edit_id_icp');
        $dosen = $this->input->post('edit_pilihan_dosen');
        $data = array(
                'IDDosen' => $dosen
            );
        $this->db->where('IDIde', $id_icp)
                 ->update('idetugasakhir', $data);
        if($this->db->affected_rows() > 0){
            $_SESSION["sukses"] = 'Dosen Pembimbing Berhasil Diupdate!';
        }else{
            $_SESSION["gagal"] = 'Terjadi Kesalahan!';
        }
        redirect('Adminprodi/Dashboard/loadide');
    }

    public function updateBerkas()
    {
        $id = $this->input->post('edit_id');
        $nama = $this->input->post('edit_nama_giat');
        $link = $this->input->post('edit_link');

        $where = array('NamaBerkas' => $nama);
        $kegiatan = $this->M_data->find('berkaspelengkap', $where);

            $sesi='Berkas Pelengkap';
            $config['upload_path'] = './assets/'.$sesi;
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $config['max_size'] = 0;
            $config['file_name'] = $_FILES['edit_filegiat']['name'];

            if (!is_dir('./assets/' . $sesi)) {
                mkdir('./assets/' . $sesi);
            }

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('edit_filegiat')) {
                $_SESSION["gagal"] = 'Maaf Terjadi Kesalahan, '.$this->upload->display_errors();
                redirect('Adminprodi/Dashboard/loadberkas');

            } else{
                $file = $this->upload->data();

                $data = array(
                    'NamaBerkas' => $nama,
                    'LinkPengumpulan' => $link,
                    'FileKegiatan' => $file['file_name']
                );

                $this->db->where('ID', $id)
                    ->update('berkaspelengkap', $data);
                if($this->db->affected_rows() > 0){
                    $_SESSION["sukses"] = 'Sukses Memperbarui Berkas!';
                }else{
                    $_SESSION["gagal"] = 'Maaf Terjadi Kesalahan!';
                }
                redirect('Adminprodi/Dashboard/loadberkas');
            } 
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

    public function get_berkas_by_id($id)
    {
            $dataide = $this->M_data->get_berkas_by_id($id);
            echo json_encode($dataide);
    }

    public function get_data_ta_by_id($id)
    {
            $dataide = $this->M_data->get_data_ta_by_id($id);
            echo json_encode($dataide);
    }

    public function acceptIde($id,$pesan='')
    {

        if ($pesan == '') {
           $data = array(
                'StatusIde' => 'ICP Diterima'
            );
        } else{
            $data = array(
                'StatusIde' => 'ICP Diterima',
                'CatatanICP'   => $pesan
            );
        }
        
        $this->db->where('IDIde', $id)
                 ->update('idetugasakhir', $data);
        if($this->db->affected_rows() > 0){
            $_SESSION["sukses"] = 'ICP Diterima!';
        }else{
            $_SESSION["gagal"] = 'Terjadi Kesalahan!';
        }
        redirect('Adminprodi/Dashboard/loadide');
        // header('Location: /');   
    }

    public function rejectIde($id,$pesan='')
    {
        if ($pesan == '') {
           $data = array(
                'StatusIde' => 'ICP Ditolak'
            );
        } else{
            $data = array(
                'StatusIde' => 'ICP Ditolak',
                'CatatanICP'   => $pesan
            );
        }

        $this->db->where('IDIde', $id)
                 ->update('idetugasakhir', $data);
        if($this->db->affected_rows() > 0){
            $_SESSION["sukses"] = 'ICP Ditolak!';
        }else{
            $_SESSION["gagal"] = 'Terjadi Kesalahan!';
        }
        redirect('Adminprodi/Dashboard/loadide');
        // header('Location: /');   
    }

    function tabelTugasAkhir()
    {

        $ID = $_SESSION['ID'];

        $where = array('ID' => $ID);

        $users = $this->M_data->find('users', $where);

        foreach ($users->result() as $u) {
            $IDBidangMinat = $u->IDBidangMinatUser;
            
        }

        $whereID = array(
                'users.IDBidangMinatUser' => $u->IDBidangMinatUser,
                'tugasakhirmhs.IDKetuaPenguji' => 0,
                'tugasakhirmhs.IDPenguji2' => 0
            );
        $whereID2 = array(
                'users.IDBidangMinatUser' => $u->IDBidangMinatUser,
                'tugasakhirmhs.IDKetuaPenguji IS NOT NULL',
                'tugasakhirmhs.IDPenguji2 IS NOT NULL'
            );

        $data['ta'] = $this->M_data->find('tugasakhirmhs', $whereID, '', '', 'idetugasakhir', 'tugasakhirmhs.IDIcp = idetugasakhir.IDIde', 'users', 'users.ID = idetugasakhir.IDIdeMahasiswa', 'dosen', 'dosen.IDDosen = idetugasakhir.IDDosen');

        //$data['ta2'] = $this->M_data->find('tugasakhirmhs', $whereID2, '', '', 'idetugasakhir', 'tugasakhirmhs.IDIcp = idetugasakhir.IDIde', 'users', 'users.ID = idetugasakhir.IDIdeMahasiswa', 'dosen', 'dosen.IDDosen = idetugasakhir.IDDosen');
        $data['ta2'] = $this->M_data->get_mhs_ta_prodi($u->IDBidangMinatUser);
        $data['ta3'] = $this->M_data->get_mhs_belum_nilai($u->IDBidangMinatUser);

        $data['dosen'] = $this->M_data->find('dosen');
        $data['kegiatan'] = $this->M_data->find('kegiatan');

        $this->load->view('adminprodi/tabelTugasAkhir', $data, false);
    }

    function getPengujiByID($id)
    {
        $where = array('IDDosen' => $id);
        $dosenpenguji = $this->M_data->find('dosen', $where);
        if ($dosenpenguji) {
            $penguji = $dosenpenguji->result()[0]->NamaDosen;
        }
        return $penguji;
    }

    function get_dosen_penguji($id){
        return $this->db->where('IDDosen !=', $id)
                        ->get('dosen')
                        ->result();
    }

    function tambahPengujiTA($kondisi){
        if ($kondisi == 1) {
            $id_ta = $this->input->post('tambah_id_ta');
            $dosen = $this->input->post('tambah_pmb');
            $dosen1 = $this->input->post('tambah_pilihan_penguji');
            $dosen2 = $this->input->post('tambah_pilihan_penguji2');
        } else if ($kondisi == 2) {
            $id_ta = $this->input->post('edit_id_ta');
            $dosen = $this->input->post('edit_pmb');
            $dosen1 = $this->input->post('edit_pilihan_penguji');
            $dosen2 = $this->input->post('edit_pilihan_penguji2');
        }
        
        if ($dosen1 != $dosen && $dosen2 != $dosen) {
            $data = array(
                'IDKetuaPenguji' => $dosen1,
                'IDPenguji2' => $dosen2
            );
            $this->db->where('IDTugasAkhir', $id_ta)
                     ->update('tugasakhirmhs', $data);
            if($this->db->affected_rows() > 0){
                $_SESSION["sukses"] = 'Penguji Berhasil Ditambahkan!';

            }else{
                $_SESSION["gagal"] = 'Terjadi Kesalahan!';
            }
        } else{
            $_SESSION["gagal"] = 'Dosen Tidak Boleh Sama!';
        }

        redirect('Adminprodi/Dashboard/loadta');
        
    }

    public function tambahBerkas()
    {
        $nama = $this->input->post('nama_giat');
        $link = $this->input->post('link');

        $where = array('NamaBerkas' => $nama);
        $kegiatan = $this->M_data->find('berkaspelengkap', $where);

        if ($kegiatan) {
            $notif = array(
                'head' => 'Kegiatan Gagal Ditambahkan!',
                'isi' => 'Kegiatan yang sama telah ada.',
                'sukses' => 0,
            );
        } else {
            $sesi='Berkas Pelengkap';
            $config['upload_path'] = './assets/'.$sesi;
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $config['max_size'] = 0;
            $config['file_name'] = $_FILES['filegiat']['name'];

            if (!is_dir('./assets/' . $sesi)) {
                mkdir('./assets/' . $sesi);
            }

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('filegiat')) {
                $_SESSION["gagal"] = 'Maaf Terjadi Kesalahan, '.$this->upload->display_errors();
                redirect('Adminprodi/Dashboard/loadberkas');

            } else{
                $file = $this->upload->data();

                $data = array(
                    'NamaBerkas' => $nama,
                    'LinkPengumpulan' => $link,
                    'FileKegiatan' => $file['file_name']
                );

                if (!$this->M_data->save($data, 'berkaspelengkap')) {
                    
                    $_SESSION["sukses"] = 'Sukses Menambahkan Berkas!';
                    redirect('Adminprodi/Dashboard/loadberkas');

                } else {
                    $_SESSION["gagal"] = 'Maaf Terjadi Kesalahan!';
                    redirect('Adminprodi/Dashboard/loadberkas');
                }
            } 
        }
    }

    public function tambahPengumuman()
    {
        $judul = $this->input->post('judul');
        $pesan = $this->input->post('pesan');
        $penerima = $this->input->post('penerima');
        $tgl = date("Y-m-d h:i:sa");

        if ($penerima == 'Mahasiswa Kamsib') {
            $emails = $this->M_data->get_email_mhs_jur1();
        } else {
            $emails = $this->M_data->get_email_mhs_jur2();
        }

        $where = array('Judul' => $judul);
        $pum = $this->M_data->find('pengumuman', $where);

        if ($pum) {
            $_SESSION["gagal"] = 'Terjadi Kesalahan! Judul pengumuman sudah pernah ada.';
            redirect('Mahasiswa/Dashboard/loadpum');
        } else {
            $sesi='Pengumuman';
            $config['upload_path'] = './assets/Pengumuman/';
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = false;
            $config['max_size'] = 0;
            $config['file_name'] = $_FILES['filegiat']['name'];

            if (!is_dir('./assets/' . $sesi)) {
                mkdir('./assets/' . $sesi);
            }

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('filegiat')) {
                $_SESSION["gagal"] = 'Maaf Terjadi Kesalahan, '.$this->upload->display_errors();
                redirect('Adminprodi/Dashboard/loadpum');

            } else{
                $file = $this->upload->data();

                $data = array(
                    'Judul' => $judul,
                    'Pesan' => $pesan,
                    'TanggalPengumuman' => $tgl,
                    'Penerima' => $penerima,
                    'FilePengumuman' => $file['file_name']
                );

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
                $this->email->from($this->emailHost, 'Admin Jurusan');

                // Subject email
                $this->email->subject($judul);

                // Isi email
                $this->email->message($pesan);
                $this->email->attach($file['full_path']);
                $this->email->to($emails);

                
                if (!$this->M_data->save($data, 'pengumuman') && $this->email->send()) {
                    
                    $_SESSION["sukses"] = 'Sukses menambahkan pengumuman!';
                    redirect('Adminprodi/Dashboard/loadpum');

                } else {
                    $_SESSION["gagal"] = 'Gagal menambahkan pengumuman!';
                    redirect('Adminprodi/Dashboard/loadpum');
                }
            } 
        }
    }

    public function tambahNilai()
    {
        $giat = $this->input->post('giat');
        $ID = $this->input->post('nilai_id_ta');
        $kp_dokumen = $this->input->post('kp_dokumen');
        $kp_penulisan = $this->input->post('kp_penulisan');
        $kp_penyajian = $this->input->post('kp_penyajian');
        $kp_pengetahuan = $this->input->post('kp_pengetahuan');
        $p1_dokumen = $this->input->post('p1_dokumen');
        $p1_penulisan = $this->input->post('p1_penulisan');
        $p1_penyajian = $this->input->post('p1_penyajian');
        $p1_pengetahuan = $this->input->post('p1_pengetahuan');
        $p2_dokumen = $this->input->post('p2_dokumen');
        $p2_penulisan = $this->input->post('p2_penulisan');
        $p2_penyajian = $this->input->post('p2_penyajian');
        $p2_pengetahuan = $this->input->post('p2_pengetahuan');

        $where = array('IDTA' => $ID, 'Kegiatan' => $giat);
        $check_nilai = $this->M_data->find('nilaisidang', $where);

        if ($check_nilai) {
            $_SESSION["gagal"] = 'Nilai sudah ada!';
            redirect('Adminprodi/Dashboard/loadta');
        } else {
            $data = array(
                'ID' => time(),
                'Kegiatan' => $giat,
                'IDTA' => $ID,
                'KPDokumen' => $kp_dokumen,
                'KPPenulisan' => $kp_penulisan,
                'KPPenyajian' => $kp_penyajian,
                'KPPengetahuan' => $kp_pengetahuan,
                'P1Dokumen' => $p1_dokumen,
                'P1Penulisan' => $p1_penulisan,
                'P1Penyajian' => $p1_penyajian,
                'P1Pengetahuan' => $p1_pengetahuan,
                'P2Dokumen' => $p2_dokumen,
                'P2Penulisan' => $p2_penulisan,
                'P2Penyajian' => $p2_penyajian,
                'P2Pengetahuan' => $p2_pengetahuan,
                'NilaiAkhir' => ((30/100)*(((30/100)*$kp_dokumen)+((40/100)*$p1_dokumen)+((30/100)*$p2_dokumen))) + ((20/100)*(((30/100)*$kp_penulisan)+((40/100)*$p1_penulisan)+((30/100)*$p2_penulisan))) + ((25/100)*(((30/100)*$kp_penyajian)+((40/100)*$p1_penyajian)+((30/100)*$p2_penyajian))) + ((25/100)*(((30/100)*$kp_pengetahuan)+((40/100)*$p1_pengetahuan)+((30/100)*$p2_pengetahuan)))
            );
            if ($giat == 1) {
               $data_ta = array(
                    'NilaiProposal' => $data['ID']
                );
            } else if($giat == 2){
                $data_ta = array(
                    'Nilai70' => $data['ID']
                );
            } else if($giat == 3){
                $data_ta = array(
                    'Nilai100' => $data['ID']
                );
            }
            $this->db->where('IDTugasAkhir', $ID)
                    ->update('tugasakhirmhs', $data_ta);
            if (!$this->M_data->save($data, 'nilaisidang') && $this->db->affected_rows() > 0) {
                $_SESSION["sukses"] = 'Sukses Menambahkan Nilai!';
                redirect('Adminprodi/Dashboard/loadta');

            } else {
                $_SESSION["gagal"] = 'Maaf Terjadi Kesalahan!';
                redirect('Adminprodi/Dashboard/loadta');
            }
        }
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


    public function hapusIde($id,$table)
    {
        $where = array('IDIde'=>$id);
        if ($this->M_data->delete($where, $table)) {
                $_SESSION["sukses"] = 'Sukses Menghapus Ide Tugas Akhir!';
                redirect('Adminprodi/Dashboard/loadide');
            } else {
                $_SESSION["gagal"] = 'Terjadi Kesalahan saat Menghapus Data!';
                redirect('Adminprodi/Dashboard/loadide');
            }
    }
    public function hapusBerkas($id)
    {
        $where = array('ID'=>$id);
        if ($this->M_data->delete($where, 'berkaspelengkap')) {
                $_SESSION["sukses"] = 'Sukses Menghapus Berkas!';
                redirect('Adminprodi/Dashboard/loadberkas');
            } else {
                $_SESSION["gagal"] = 'Terjadi Kesalahan saat Menghapus Berkas!';
                redirect('Adminprodi/Dashboard/loadberkas');
            }
    }
    public function hapusNotif($id)
    {
        $where = array('ID'=>$id);
        if ($this->M_data->delete($where, 'pengumuman')) {
                $_SESSION["sukses"] = 'Sukses Menghapus Pengumuman!';
                redirect('Adminprodi/Dashboard/');
            } else {
                $_SESSION["gagal"] = 'Terjadi Kesalahan saat Menghapus Pengumuman!';
                redirect('Adminprodi/Dashboard/');
            }
    }
}
