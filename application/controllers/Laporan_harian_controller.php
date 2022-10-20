<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_harian_controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // if ($this->session->userdata('masuk') != TRUE) {
        //     redirect('/login_controller');
        // }
        $this->load->helper('form');
        $this->load->helper('date');
        $this->load->helper('tglindo');
        $this->load->helper('debug');
        $this->load->library('Durasiwaktu');
        $this->load->library('Hitungterlambat');
        $this->load->model('Rekap_model');
        $this->load->model('Absen_model');
        $this->load->model('Model_LaporanHarian');
        date_default_timezone_set('Asia/Jakarta');
    }

    function _remap($param,$x=null,$y=null)
    {
        if($param==='view')
        {
            $this->view($param);
        }else{
            $this->index($param);
        }
    }

    /**
     * Method index
     * FROM pemilihan Bulan Laporan_harian
     * @return void
     */
    function  index()
    {
        $id = $this->uri->segment('3');
        $data['daftar_user'] = $this->Absen_model->getDaftarUser($id);
        $data['adminOPD'] = $this->Absen_model->getAdminOPD();
        $data['laporan'] =$this->Model_LaporanHarian->get_by_id();
        $this->load->view('_partials/head');
        $this->load->view('_partials/sidebar', $data);
        $this->load->view('_partials/header');
        $this->load->view('v_lap_harian', $data);
        $this->load->view('_partials/js');
    }

    /**
     * Method view
     * Terima POST data dari index Laporan_harian
     * @data POST: tahun dan bulan 
     * Tampil Tabel Rekap Absen
     * @return void
     */
    public function view()
    {
        $id = $this->uri->segment('4');
        $id_user = $this->session->userdata('id_user');
        $username = $this->session->userdata('username');
        $data['daftar_user'] = $this->Absen_model->getDaftarUser($id);
        $data['adminOPD'] = $this->Absen_model->getAdminOPD();
        //echo $id_decrypt = $this->secure->decrypt_url($id);
        $inputBulan =  $this->input->post('bulan');
        $inputTahun =  $this->input->post('tahun');
        $data['laporan'] = $this->Model_LaporanHarian->get_by_id($id, $inputBulan , $inputTahun);
        $this->load->view('v_lap_harian_user_legal', $data);
    }

    /**
     * Method getData
     *
     * @return void
     */
    private function  getData()
    {
        //$data = array();
        $data['data'] = $this->Rekap_model->getRekap(4393);
        $data['nama'] = $this->Rekap_model->getRekap_nama(4393);
        $data['jam'] = $this->Rekap_model->getRekap_jam(4393);
        echo json_encode($data);
        // foreach ($data as $key => $value) {
        //     echo $key;
        // }
    }


    function range()
    {
        echo "<html><head><title>Laporan Harian</title>
        <!-- Favicon icon -->
        <link rel='icon' href=" . base_url() . "/assets/images/favicon.ico' type='image/x-icon'>
        </head><body><center>";
        echo "<h5>Laporan Harian</h5>";
        $nowYear = '2021';
        echo form_open(base_url('Rekap_controller/view'), 'target="_blank"', 'hidden');
        echo "Rentang Waktu : <select name='tahun'>";
        echo "<option value=" . date('Y') . ">" . date('Y') . "</option>";
        for ($y = 2020; $y <= $nowYear; $y++) {
            echo "<option value=" . $y . ">" . $y . "</option>";
        }
        echo "</select> ";
        echo "<select name='bulan'>";
        echo "<option value=" . date('Y-m-d') . ">" . date('d F Y ') . "</option>";
        for ($y = 1; $y <= 12; $y++) {

            switch ($y) {
                case '1':
                    $bln = 'Januari';
                    break;
                case '2':
                    $bln = 'Februari';
                    break;
                case '3':
                    $bln = 'Maret';
                    break;
                case '4':
                    $bln = 'April';
                    break;
                case '5':
                    $bln = 'Mei';
                    break;
                case '6':
                    $bln = 'Juni';
                    break;
                case '7':
                    $bln = 'Juli';
                    break;
                case '8':
                    $bln = 'Agustur';
                    break;
                case '9':
                    $bln = 'September';
                    break;
                case '10':
                    $bln = 'Oktober';
                    break;
                case '11':
                    $bln = 'November';
                    break;
                case '12':
                    $bln = 'Desember';
                    break;

                default:
                    $bln = date('M');
                    break;
            }

            echo "<option value=" . $y . ">" . $bln . "</option>";
        }
        echo "</select> ";
        echo "<button type='submit'>Tampil</button>";
        echo form_close();
        echo "</center><body></html>";
    }

    //Durasi
    /*
        07:30
        16:00 or 16:30
    INPUT   function durasi(tanggal awal, akhir format 2021-08-01)
    */
    
    function durasi($s= '2021-08-01', $e='2021-08-01', $tanggal='2021-08-09')
    {
        $this->durasiwaktu->durasi('2021-08-09');
        $f =  $this->durasiwaktu->_alldurasi('4908', '4908', 1);
        dd($f);
    
        ////////////////
        exit;
        $id_user = $this->session->userdata('id_user');
        $id_user = '4908';
        //Ambil SEMUA id_user, jam masuk dan pulang dan tanggal bY id_user dan status
        $qry = $this->db->query("SELECT id_user, CONCAT(tanggal_absen,' ',jam_masuk) as masuk, CONCAT(tanggal_absen,' ',jam_pulang) as pulang, tanggal_absen as tanggal FROM `absen` WHERE status='1' AND id_user='{$id_user}' ;");

        // Ambil SATU jam masuk dan pulang dan tanggal bY id_user,tanggal dan status
        $qry = $this->db->query("SELECT id_user, CONCAT(tanggal_absen,' ',jam_masuk) as masuk, CONCAT(tanggal_absen,' ',jam_pulang) as pulang, tanggal_absen as tanggal FROM `absen` WHERE status='1' AND id_user='{$id_user}' AND tanggal_absen='{$tanggal}';");
        
    
        echo $str =  $qry->row('masuk');
        echo $end =  $qry->row('pulang');

        $strl =  new DateTime($str);
        $endl =  new DateTime($end);
        $dteDiff  = $strl->diff($endl);
        echo "  durasi " .  $dteDiff->format("%H:%I");


        echo "\n".$this->db->last_query();
        $this->load->helper('tglindo');
        $hari_nm = date_name_indo($s);
        //echo 'hari '.$hari_nm;
        $_pulang = '00:00';
        switch ($hari_nm) {
            case 'Jumat':
                $_pulang = '16:30';
                break;
            case 'Minggu':
                $_pulang = '00:00';
                break;
            default:
                $_pulang = '16:00';
                break;
        }
        //echo $_pulang;

    }
}