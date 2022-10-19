<?php
class Daftar_user_controller extends CI_Controller{
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
        $data['daftar_user'] = $this->Absen_model->getDaftarUser($id);
        $data['adminOPD'] = $this->Absen_model->getAdminOPD();
        $data['nama_instansi']= $this->Absen_model->getNamaOPDbyUsernameAdmin($id);
        $jumlah_user = 0;
        $username = $this->session->userdata('username');  
        $alluser = $this->Absen_model->getDaftarUser($username);
        foreach ($alluser as $u) { 
            if($u['status'] == 1 && $u['id_group'] != 2){ 
                $jumlah_user++; 
            }
        }
        $data['alluser'] = $jumlah_user;
        
        $this->load->view('_partials/head');
        $this->load->view('_partials/sidebar', $data);
		$this->load->view('_partials/header');
		$this->load->view('v_daftar_user', $data);
		$this->load->view('_partials/js');
    }
}