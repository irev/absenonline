<?php


class Pengaturan_absen_controller extends CI_Controller
{


    function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != TRUE) {

            redirect('/login_controller');
        }
        $this->load->helper('debug'); // DEBUG Show
        $this->load->model('Absen_model');
    }

    function _remap($param) {
        if($this->uri->segment('2') === "jam_masuk"){
            $this->jam_masuk($param);
        }else{
            $this->index($param);
        }

    }


    /**
     * Method index
     *
     * @return void
     */
    public function index()
    {
        $id = $this->uri->segment('2');

        $data['pengaturan'] = $this->Absen_model->getPengaturanWifi($id);
        $id_instansi = $this->Absen_model->getPengaturanWifi($id)->id_instansi;
        // smbil data id_instansi
        $data['jadwal'] = $this->Absen_model->getJadwalbyInstansi($id_instansi); 
        if ($this->Absen_model->getPengaturanWifi($id)) {
            $this->load->view('_partials/head');
            $this->load->view('_partials/header');
            $this->load->view('v_pengaturan', $data);
            $this->load->view('_partials/sidebar', $data);
            $this->load->view('_partials/js');
        } else {
             redirect(site_url(),'refresh');

        }
    }
}
