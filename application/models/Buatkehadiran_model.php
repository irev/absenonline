<?php

use GuzzleHttp\Client;
class Buatkehadiran_model extends CI_model
{
    private $_client;
    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'https://simpel.pasamanbaratkab.go.id/api_android/simaya/'
        ]);
    }
 
    public function getDaftarUser($username_admin)
    { 
        $data = [
            "username" => $username_admin
        ];

        $response = $this->_client->request('POST', 'daftar_user.php', ['form_params' => $data]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result['data'];
    }


    public function getAdminOPD()
    {
        $response = $this->_client->request('GET', 'get_admin_opd.php');

        $result = json_decode($response->getBody()->getContents(), true);

        return $result['data'];
    }

    public function getNamaOPDbyIDAdmin($id)
    {
        $response = $this->_client->request('GET', "get_admin_opd_by_id.php?id_user=$id");

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;
    }
    
    public function getNamaOPDbyUsernameAdmin($id)
    {
        $response = $this->_client->request('GET', "get_instansi_by_admin.php?username=$id");

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;
    }

    public function save_batch($tabel=null, $data=null){ 
        if($tabel != null && $data != null){   
            return $this->db->insert_batch($tabel, $data);
        }
    }  

    public function updateStatus($tabel=null, $data=array()){
        $this->db->set('status',0);
        $this->db->where($data);
        return $this->db->update($tabel);
    }

    public function updateAbsenrequestStatusApprov($id=null){
        if($id != null){
            $this->db->set('approv', '1');
            $this->db->where('id', $id);
            return $this->db->update('absen_request');
        }
    }

    // Request absen manual Pegawai row
    public function getRequestrow($id_admin_instansi, $id){
        $array = array('id_admin_instansi' => $id_admin_instansi, 'parent' => $id );
        $this->db->order_by('tgl_absen', 'DESC');
        return $this->db->get_where('absen_request', $array);
    }
    // get list request absen by admin 
    public function getRequestListAdmin($admin_instansi, $id){
        $array = array('admin_instansi' => $admin_instansi, 'parent' => $id );
        $this->db->order_by('tgl_absen', 'DESC');
        return $this->db->get_where('absen_request', $array);
    }

    public function getRequestList($id){
        $array = array('admin_instansi' => $id_admin_instansi);
        $this->db->order_by('tgl', 'DESC');
        return $this->db->get_where('absen_request', $array)->result_array();
    }


    // Pengajuan
    public function getPengajuan($id_admin_instansi=null)
    {
        if($id_admin_instansi==null){
            return false;
        }
        $array = array('admin_instansi' => $id_admin_instansi);
        $this->db->order_by('tgl', 'DESC');
        return $this->db->get_where('absen_permohonan', $array)->result_array();
    }

    public function getPengajuanRow($id_admin_instansi=null)
    {
        $array = array('admin_instansi' => $id_admin_instansi, 'status'=> 1);
        $this->db->order_by('tgl', 'DESC');
        return $this->db->get_where('absen_permohonan', $array)->num_rows();
    }

    //save file pengajuan
    public function postPengajuan($data){
        $this->db->insert('absen_permohonan', $data);
    }
    // Show file blob 
    public function getFileBlob($id){
        $array = array('id' => $id);
        $data = $this->db->get_where('absen_permohonan', $array);
        return $data->row_array();
    }


    
} 
