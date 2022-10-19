<?php
/**
 * 
 * 
 * 
 */
class Dashboard_controller extends CI_Controller{
    function __construct(){
        parent::__construct();
        if($this->session->userdata('masuk') != TRUE){
                redirect('/login_controller');
            }
            $this->load->model('Dashboard_model');
            $this->load->model('Absen_model');
      } 
      /**
         * Hitung Absen Keterangan Status :
         * 	1.Hadir 2.DL 3.IZIN 4.SAKIT 5.TK	
         */
    public function index(){
        // Ambil semua data user
        $jumlah_user = 0;
        $username = $this->session->userdata('username'); // $this->uri->segment('2');
        $alluser = $this->Absen_model->getDaftarUser($username);
        $hadir =  $this->Dashboard_model->getTotalRiwayatAbsenHariIni();
        $data['riwayat_absen'] = $this->Dashboard_model->getRiwayatAbsenHariIni();
        $data['total_riwayat_absen'] = $hadir;
        $data['total_riwayat_absen_dl'] = $this->Dashboard_model->getTotalRiwayatAbsenHariIni(2);
        $data['total_riwayat_absen_izin'] = $this->Dashboard_model->getTotalRiwayatAbsenHariIni(3);
        $data['total_riwayat_absen_sakit'] = $this->Dashboard_model->getTotalRiwayatAbsenHariIni(4);
        $data['total_riwayat_absen_pulang'] = $this->Dashboard_model->getTotalRiwayatAbsenHariIniPulang();
        $data['adminOPD'] = $this->Absen_model->getAdminOPD(); 
        //echo json_encode($alluser );
        foreach ($alluser as $u) {
            // hitung jika user aktif dan id gurp tidak sama dengan 2 (admin)
            if($u['status'] == 1 && $u['id_group'] != 2){
                //echo "<br>". $u['status'].$u['username'];
                $jumlah_user++; 
            }
        }
        $data['alluser'] = $jumlah_user;
        //echo $jumlah_user;
        if($jumlah_user > 0){        
            $data['persen_hadir'] = round(($hadir/$jumlah_user)*100);
        }else{
            $data['persen_hadir'] = 0;
        }
        $this->load->view('_partials/head');
        $this->load->view('_partials/sidebar', $data);
		$this->load->view('_partials/header');
		$this->load->view('v_dashboard', $data);
		$this->load->view('_partials/js');
    }
}