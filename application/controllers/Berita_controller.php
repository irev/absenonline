<?php


class Berita_controller extends CI_Controller{


    function __construct(){
        parent::__construct();

        if($this->session->userdata('masuk') != TRUE){
           
            redirect('/login_controller');
        }
        $this->load->model('Berita_model','Absen_model');
       
    }

    function _remap($param) {
        $this->index($param);
    } 

    public function index(){
        // echo "sdsdsds";
        $data['adminOPD'] = $this->Absen_model->getAdminOPD();
        $this->load->view('_partials/head');
        $this->load->view('_partials/sidebar', $data);
		$this->load->view('_partials/header');
		$this->load->view('berita/bindex'); 
		$this->load->view('_partials/js');
    }  

}