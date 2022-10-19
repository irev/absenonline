<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kehadiran_controllers extends CI_Controller{

    function __construct(){
        parent::__construct();

        if($this->session->userdata('masuk') != TRUE){
           
            redirect('/login_controller');
        }
        $this->load->model('Absen_model');
       
    }

    function _remap($param) {
        if($param == 'empList'){
            return $this->empList();
        }
        $this->index($param);
    }

    public function index(){
        $id = $this->uri->segment('2');

        $data['kehadiran'] = $this->Absen_model->getKehadiran($id);
        $data['adminOPD'] = $this->Absen_model->getAdminOPD();
        
        $this->load->view('_partials/head');
		$this->load->view('_partials/sidebar', $data);
		$this->load->view('_partials/header');
		$this->load->view('v_kehadirans', $data);
		$this->load->view('_partials/js');
    }
    
    public function empList(){
     
     // POST data
     $postData = $this->input->post();
     // Get data
     $data = $this->Absen_model->getAbsen($postData);

     echo json_encode($data);
    }

}