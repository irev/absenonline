<?php


class Absen_user_controller extends CI_Controller{


    function __construct(){
        parent::__construct();

        if($this->session->userdata('masuk') != TRUE){
           
            redirect('/login_controller');
        }
        $this->load->model('Absen_model');
       
    }

    function _remap($param) {
        $this->index($param);
        //$this->dl($param);
        //$this->izin($param);
        //$this->sakit($param);
    }

    public function index($id){
         error_reporting(0);
         
         $id = $this->uri->segment('2');
         $data['kehadiran'] = $this->Absen_model->kehadiranByUser($id);
         $data['ijin'] = $this->Absen_model->ijinByUser($id);
         $data['dinas_luar'] = $this->Absen_model->dinasLuarByUser($id);
         $data['adminOPD'] = $this->Absen_model->getAdminOPD();
         $data['total_riwayat_absen'] = 0;
         $data['riwayat_absen']= $this->Absen_model->kehadiranByUser($id);
        
        $this->load->view('_partials/head');
        $this->load->view('_partials/sidebar', $data);
		$this->load->view('_partials/header');
		$this->load->view('v_dashboard', $data);
		$this->load->view('_partials/js');
    } 

}