<?php
class Admin_absen_manual_controller extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->API="https://simpel.pasamanbaratkab.go.id/api_android/simaya/";
        // https://simpel.pasamanbaratkab.go.id/api_android/simaya/daftar_user.php?username=
        if(($this->session->userdata('masuk') != TRUE) || ($this->session->userdata('id_user') != '4373')){
            redirect('/login_controller');
        }
        $this->load->model('Absen_model');
        $this->load->model('Buatkehadiran_model');
        
    }

    function index(){ 
        $id = $this->session->userdata('username');
        $data['daftar_user'] = $this->Absen_model->getDaftarUser($id);
        $data['adminOPD'] = $this->Absen_model->getAdminOPD();
        $data['nama_instansi']= $this->Absen_model->getNamaOPDbyUsernameAdmin($id);
        $data['pengajuan']= $this->Buatkehadiran_model->getPengajuan($id);
      
        $this->load->view('_partials/head');
        $this->load->view('_partials/sidebar', $data);
		$this->load->view('_partials/header');
		$this->load->view('admin/absen_manual/v_dashboard_absen_manual', $data);
		$this->load->view('_partials/js');
    }

    function view($username=null){
        echo $username;
        if(! $this->input->post('idx')){
           //redirect('/buatabsen_controller');
        }
        $id = $this->session->userdata('username');
        $data['daftar_user'] = $this->Absen_model->getDaftarUser($username);
        $data['adminOPD'] = $this->Absen_model->getAdminOPD();
        $data['nama_instansi']= $this->Absen_model->getNamaOPDbyUsernameAdmin($id);
        $data['pengajuan']= $this->Buatkehadiran_model->getPengajuan($username);
        $jumlah_user = 0;
        $username = $this->session->userdata('username');  
        $alluser = $this->Absen_model->getDaftarUser($username);
        foreach ($alluser as $u) { 
            if($u['status'] == 1 && $u['id_group'] != 2){ 
                $jumlah_user++; 
            }
        }
        //var_dump( $this->session->userdata());
        $admin_id = $this->session->userdata('id_instansi');
        $data['alluser'] = $jumlah_user;

        // view file
        $this->load->view('_partials/head');
        $this->load->view('_partials/sidebar', $data);
		$this->load->view('_partials/header');
        $this->load->view('admin/absen_manual/v_absen_manual', $data);
		$this->load->view('_partials/js');
    }

    function viewlist($admin_username=null,$idx=null){
        $id = $this->session->userdata('username');
        $data['daftar_user'] = $this->Absen_model->getDaftarUser($admin_username);
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
        $data['pegawai'] = $this->Buatkehadiran_model->getRequestListAdmin($admin_username,$idx)->result_array();
        
        // view file
        $this->load->view('_partials/head');
        $this->load->view('_partials/sidebar', $data);
		$this->load->view('_partials/header');
        $this->load->view('admin/absen_manual/v_buat_absen_userlist', $data);
		$this->load->view('_partials/js');
    }
    
    function AbsenManualCreate(){
            //echo 'create' dapatkan data dari ajax post; 
            $idx = $this->input->post('idx');
            $idDB = $this->input->post('id'); //id pada tabel absen_request
            $iduser = $this->input->post('id_user');
            $username = $this->input->post('username');
            $nama_lengkap = $this->input->post('nama_lengkap');
            $instansi = $this->input->post('instansi');
            $id_admin_instansi = $this->input->post('id_admin_instansi');
            $tanggal = $this->input->post('tgl_absen');
            $masuk = $this->input->post('timestamp_masuk');
            $checkbox = $this->input->post('checkbox');

            $data = array();
            $dataID = array();
            //$index = 0; 
            //  var_dump($iduser);
            //  die;
            // Set index array awal dengan 0
            foreach($iduser as $datauser =>  $key){
                if(isset($checkbox[$key])=='on'){ 
                    //$masuk = $tanggal[$index].' '.$time[$index];
                    // perulangan berdasarkan sampai data terakhir
                    array_push($data, array(
                        'id_user' =>$iduser[$key],
                        'id_admin_instansi'=>$id_admin_instansi[$key],
                        'username'=>$username[$key],
                        'nama_lengkap'=>$nama_lengkap[$key],
                        'instansi'=>$instansi[$key],
                        'timestamp_masuk'=>$masuk[$key],
                        'tgl_absen'=>$tanggal[$key],
                        'keterangan'=> 'Disetujui BKPSDM',
                        'status'=>1
                    ));
                    // set id untuk update status approv
                    array_push($dataID, $idDB[$key]);
                    //$index++;
                }
            }
            $sql = $this->Buatkehadiran_model->save_batch('absen5',$data);
            if($sql){
                // update status pengajuan user 
                foreach ($dataID as $val => $ID) {
                    if(isset($ID)){
                       $changeStatusList = $this->Buatkehadiran_model->updateAbsenrequestStatusApprov($ID);
                        if($changeStatusList){
                            $changeStatus = $this->Buatkehadiran_model->updateStatus('absen_permohonan',['id'=>$idx]);
                        }
                    }
                }
            }
            if($changeStatus){
                echo  json_encode(['success'=>true]);
            }else{
                echo  json_encode(['success'=>false]);
            }
    }
}