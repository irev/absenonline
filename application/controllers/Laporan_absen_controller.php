<?php


class Laporan_absen_controller extends CI_Controller{

    function __construct(){
        parent::__construct();
       
      }

    public function index(){
      $data['adminOPD'] = $this->Absen_model->getAdminOPD();
    $this->load->view('_partials/head');
    $this->load->view('_partials/sidebar', $data);
		$this->load->view('_partials/header');
		$this->load->view('v_dashboard');
		
		$this->load->view('_partials/js');
    }
}