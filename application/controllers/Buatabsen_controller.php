<?php
class Buatabsen_controller extends CI_Controller{
    function __construct(){
        parent::__construct();
        if($this->session->userdata('masuk') != TRUE){
           // redirect('/login_controller');
        }
        $this->load->model('Absen_model');
        $this->load->model('Buatkehadiran_model');
    }

    function _remap($param, $paramTwo){
        if($param === 'PengajuanCreate'){
            $this->PengajuanCreate();
        }elseif($param === 'RequestForm'){
            $this->RequestForm();
        }elseif($param === 'RequestCreate'){
            $this->RequestCreate();
        }elseif($param === 'RequestList'){
            $this->RequestList();
        }elseif($param === 'RequestItemForm'){
            $this->RequestItemForm();
        }elseif($param === 'fileblob'){
            $this->fileblob();
        }
        else{
            $this->index($param);
        }
    }

     function index(){ 
        $id = $this->session->userdata('username');
        $data['daftar_user'] = $this->Absen_model->getDaftarUser($id);
        $data['adminOPD'] = $this->Absen_model->getAdminOPD();
        $data['nama_instansi']= $this->Absen_model->getNamaOPDbyUsernameAdmin($id);
        $data['pengajuan']= $this->Buatkehadiran_model->getPengajuan($id);
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
		$this->load->view('v_daftar_perngajuan_absen', $data);
		$this->load->view('_partials/js');
    }

    function fileblob(){
        $id = $this->uri->segment('3');
        if( ! is_numeric($id)){
            echo "No file faund.";
        }else{
            $data = $this->Buatkehadiran_model->getFileBlob($id);
            if($data){
                echo "<title>File</title>";
                header("Content-type: application/pdf");
                //header('Content-Disposition: attachment; filename="File Permohonan.pdf"');
                
                echo base64_decode($data['file']);
            }
            //var_dump($data);
        }
         
    }

     function PengajuanCreate(){
        //echo 'create'; 
            $username = $this->session->userdata('username');
            $pernyataan = $this->input->post('pernyataan');
            $parent = $this->uri->segment('3');
            $instansi = $this->session->userdata();
            $iduser = $this->input->post('nama');
            $nama_panjang = $this->input->post('nama_panjang');
            $tanggal = $this->input->post('tanggal');
            $time = $this->input->post('jam');
            $status = $this->input->post('status');
            $data = array();
            $index = 0; 
            //  var_dump($iduser);
            //  die;
            // Set index array awal dengan 0
            foreach($iduser as $datauser){ 
               // $masuk = $tanggal[$index].' '.$time[$index];
                //  perulangan berdasarkan sampai data terakhir
                array_push($data, array(

                    //'id'=>$nama[$index], // Ambil dan set data nama sesuai index array dari $index        
                    'id_admin_instansi'=> $instansi['id_instansi'],  // Ambil dan set data telepon sesuai index array dari $index        
                    'admin_instansi'=> $username,  // Ambil dan set data telepon sesuai index array dari $index
                    'id_user'=> $iduser[$index],  // Ambil dan set data alamat sesuai index array dari $index      
                    'nama_panjang'=> $nama_panjang[$index],
                    'tgl_absen'=> $tanggal[$index],
                    'masuk'=> $tanggal[$index].' '.$time[$index],
                    'pulang'=> $tanggal[$index].' '.$time[$index],
                    'status_absen'=> $status[$index],
                    'parent' => $parent
                ));
                $index++;
            }
            //var_dump($data);
            $sql = $this->Buatkehadiran_model->save_batch('absen_request',$data);
            if($sql){
                echo  json_encode(['success'=>true]);
            }else{
                echo  json_encode(['success'=>false]);
            }
    }

    function RequestForm($id_request=null){
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
		$this->load->view('v_buat_absen_request_form', $data);
		$this->load->view('_partials/js');
        //var_dump($this->session->userdata()); 
    }

    function RequestCreate($id_request=null){
        if(
            $this->input->post('nomor') != '' ||
            $this->input->post('ttd') != '' ||
            $this->input->post('nip') != '' ||
            $this->input->post('file') != ''
        ){
            $config['upload_path']          = $_SERVER['DOCUMENT_ROOT'].'/file_absen/';
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 1024;
            //$config['max_width']            = 1024;
            //$config['max_height']           = 768;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('file'))
            {
                    $id = $this->session->userdata('username');
                    $data['daftar_user'] = $this->Absen_model->getDaftarUser($id);
                    $data['adminOPD'] = $this->Absen_model->getAdminOPD();
                    $data['nama_instansi']= $this->Absen_model->getNamaOPDbyUsernameAdmin($id);
                    $jumlah_user = 0;
                    $username = $this->session->userdata('username');  
                    $alluser = $this->Absen_model->getDaftarUser($username);
                    $error = array('error' => $this->upload->display_errors());
                    // view file
                    $this->load->view('_partials/head');
                    $this->load->view('_partials/sidebar', $data);
                    $this->load->view('_partials/header');
                    $this->load->view('v_buat_absen_request_form', $error);
                    $this->load->view('_partials/js');
            }else{
                $file_data = $this->upload->data();
                $imgdata = file_get_contents($file_data['full_path']);
                $file_encode=base64_encode($imgdata);
                $data = [
                    'nomor_surat' => $this->input->post('nomor'),
                    'ttd' => $this->input->post('ttd'),
                    'nip' => $this->input->post('nip'),
                    'status' => 1,
                    'file' => $file_encode,
                    'tgl' => $this->input->post('tgl'),
                    'keterangan' => $this->input->post('ket'),
                    'admin_instansi' => $this->session->userdata('username')
                ];
                unlink($file_data['full_path']);
                $this->Buatkehadiran_model->postPengajuan($data);
                redirect('/buatabsen_controller');
            }
        }else{
            redirect('/buatabsen_controller/RequestForm');
        }

    }

    function RequestList($id_request=null){
        echo "RequestList";
    }

    function RequestItemForm(){
        if(! $this->input->post('idx')){
           redirect('/buatabsen_controller');
        }
        $id = $this->session->userdata('username');
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
        //var_dump( $this->session->userdata());
        $admin_id = $this->session->userdata('id_instansi');
        $idx = $this->input->post('idx');
        $data_count = $this->Buatkehadiran_model->getRequestrow($admin_id,$idx)->num_rows();
        $data['alluser'] = $jumlah_user;

        // view file
        $this->load->view('_partials/head');
        $this->load->view('_partials/sidebar', $data);
		$this->load->view('_partials/header');
		
		if($data_count < 1){
            $this->load->view('v_buat_absen', $data);
        }else{
            $data['pegawai'] = $this->Buatkehadiran_model->getRequestrow($admin_id,$idx)->result_array();
            $this->load->view('v_buat_absen_userlist', $data);
        }
        
		$this->load->view('_partials/js');
    }





}