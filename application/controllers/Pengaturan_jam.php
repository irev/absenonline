<?php


class Pengaturan_jam extends CI_Controller
{


    function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != TRUE) {

            redirect('/login_controller');
        }
        $this->load->helper('debug'); // DEBUG Show
        $this->load->helper('url');
        $this->load->library('durasiwaktu');
        $this->load->model('Absen_model');
        $this->load->model('Jamkerja_model');

    }

    function _remap($param)
    {
        if ($this->uri->segment('2') == "setting") {
            $this->setting($param);
        } else if ($this->uri->segment('2') == "settingadd") {
            $this->settingadd($param);
        } else if ($this->uri->segment('2') == "act_add_jadwal") {
            $this->act_add_jadwal($param);
        } else if ($this->uri->segment('2') == "act_add_jam") {
            $this->act_add_jam($param);
        } else {
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
        // Ambil data instansi
        $data['pengaturan'] = $this->Absen_model->getPengaturanWifi($id);
        $id_instansi = $this->Absen_model->getPengaturanWifi($id)->id_instansi;
        // smbil data id_instansi
        $data['jadwal'] = $this->Absen_model->getJadwalbyInstansi($id_instansi);
        //dd($this->Absen_model->getJadwalbyInstansi($id_instansi));
        //echo $this->db->last_query();
        $this->load->view('_partials/head');
        $this->load->view('_partials/header');
        $this->load->view('v_pengaturan', $data);
        $this->load->view('_partials/sidebar', $data);
        $this->load->view('_partials/js');
    }

    ////////////////////////////////////////////////////

    
    /**
     * TODO Form jam kerja
     * Method settingAdd
     *
     * @param $instansi $instansi [explicite description]
     *
     * @return void
     */
    public function settingAdd($instansi)
    {
        $id = $this->uri->segment('3');
        $data = [
            "title" => "Tambah",
            "act" => "Simpan",
            "action" => "/",
            "pengaturan" => $this->Absen_model->getPengaturanWifi($id),
            "id_instansi" => $this->session->userdata('id_instansi'),
            "nama_jamkerja" => "",
            "status_jamkerja" => ""
        ];
        $this->load->view('_partials/head');
        $this->load->view('_partials/header');
        echo 'Add';
        $this->load->view('setting/v_jamsetting', $data);
        $this->load->view('_partials/sidebar', $data);
        $this->load->view('_partials/js');
    }


    public function setting($instansi)
    {
        $id = $this->uri->segment('3');
        $data = [
            "title" => "Tambah",
            "act" => "Simpan",
            "action" => "/",
            "pengaturan" => $this->Absen_model->getPengaturanWifi($id)
        ];
        $this->load->view('_partials/head');
        $this->load->view('_partials/header');
        echo 'setting';
        $this->load->view('setting/v_jam', $data);
        $this->load->view('_partials/sidebar', $data);
        $this->load->view('_partials/js');
    }

    public function add_jam($instansi)
    {
        $id = $this->uri->segment('3');
        $data = [
            "title" => "Tambah",
            "act" => "Simpan",
            "action" => "/",
            "pengaturan" => $this->Absen_model->getPengaturanWifi($id)
        ];
        $this->load->view('_partials/head');
        $this->load->view('_partials/header');
        echo 'setting';
        $this->load->view('setting/v_jam', $data);
        $this->load->view('_partials/sidebar', $data);
        $this->load->view('_partials/js');
    }
    
    public function setting_edit($instansi)
    {
        $id = $this->uri->segment('3');
        $data = [
            "title" => "Edit",
            "act" => "Simpan",
            "action" => "/",
            "pengaturan" => $this->Absen_model->getPengaturanWifi($id)
        ];
        $this->load->view('_partials/head');
        $this->load->view('_partials/header');
        $this->load->view('setting/v_jam', $data);
        $this->load->view('_partials/sidebar', $data);
        $this->load->view('_partials/js');
    }


    public function act_add_jadwal($instansi)
    {
        echo "Setting jadwal";
        $id_instansi = $this->session->userdata('id_instansi');
        $id_admin = $this->session->userdata('id_user');
        $data = [
            "id_jamkerja" => '0',
            "jam_kerja" => $this->input->post('jam_kerja'),
            "instansi" => $id_instansi,
            "admin" => $id_admin,
            "status" => $this->input->post('status'),
        ];
        $this->Jamkerja_model->add($data);
        $insert = $this->db->insert_id();
        if($insert != null){
            //redirect('pengaturan_jam/act_add_jam/'.$insert,'refresh');
            redirect('/login_controller','refresh');
        }
    }

    public function act_add_jam($instansi)
    {
        echo "Setting act_add_jam";
        $id_instansi = $this->session->userdata('id_instansi');
        $id_admin = $this->session->userdata('id_user');
        $data = [
            "id_jamkerja" => '0',
            "jam_kerja" => $this->input->post('jam_kerja'),
            "instansi" => $id_instansi,
            "admin" => $id_admin,
            "status" => $this->input->post('status'),
        ];
        $this->Jamkerja_model->add($data);
    }
}
