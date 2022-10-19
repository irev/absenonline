<?php


class Ijin_controller extends CI_Controller{


    function __construct(){
        parent::__construct();

        if($this->session->userdata('masuk') != TRUE){
           
            redirect('/login_controller');
        }
        $this->load->model('Absen_model');
       
    }

    function _remap($param) {
        $this->index($param);
    }


    public function index(){
        $id = $this->uri->segment('2');

        $data['ijin'] = $this->Absen_model->getIjin($id);
        $data['adminOPD'] = $this->Absen_model->getAdminOPD();
     
        
        $this->load->view('_partials/head');
        $this->load->view('_partials/sidebar', $data);
		$this->load->view('_partials/header');
		$this->load->view('v_ijin', $data);
		$this->load->view('_partials/sidebar', $data);
		$this->load->view('_partials/js');
    }

}