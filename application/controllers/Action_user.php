<?php


class Action_user extends CI_Controller{


    function __construct(){
        parent::__construct();

        if($this->session->userdata('masuk') != TRUE){
           
            redirect('/login_controller');
        }
        $this->load->model('Absen_model');
       
    }

    public function hapus_device_id(){
        header('Content-Type: application/json; charset=utf-8');
        if ($this->input->post('id', true)) {
          $id = $this->input->post('id', true);
          $this->session->set_flashdata('success', 'device id' . " " . 'sukses');
          
          if($this->Absen_model->hapusDeviceID($id)){
              echo json_encode(['status'=>'true','code'=>1, 'message'=>'delete success']);
          }else{
              $this->session->set_flashdata('error', 'gagal');
              echo json_encode(['status'=>'false','code'=>0, 'message'=>'delete error']);
          }
          //echo $this->db->last_query();
          //return reset_cache_data_on_change();
        } else {
            $this->session->set_flashdata('error', 'gagal');
            echo json_encode(['status'=>'false', 'message'=>'server error']);
        }

    } 

   

   

}