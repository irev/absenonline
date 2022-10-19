<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use GuzzleHttp\Client;

class Absen_model extends CI_model
{
    private $_client;
    private $_tabel = "absen5";
    
    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'https://simpel.pasamanbaratkab.go.id/api_android/simaya/'
        ]);
    }

    public function getKehadiran($id_admin_instansi)
    { 
        $sql = "SELECT * from absen5 WHERE  EXISTS (SELECT * FROM approval_ijin WHERE absen5.id_absen = approval_ijin.id_absen and approval_ijin.id_admin='$id_admin_instansi' and approval_ijin.status_approval <> '3') or absen5.id_admin_instansi = '$id_admin_instansi' and absen5.status ='1' order by tgl_absen asc";
        $query = $this->db->query($sql);
        return $query->result_array();
        //return $this->db->get('absen5')->result_array();
    }

    public function getIjin($id_admin_instansi)
    {
        //  $id_admin_instansi = $this->session->userdata('id_user');
        $array = array('id_admin_instansi' => $id_admin_instansi, 'status' => '3');
        $this->db->order_by('tgl_absen', 'DESC');
        return $this->db->get_where('absen5', $array)->result_array();
        //return $this->db->get('absen5')->result_array();

    }

    public function getDinasLuar($id_admin_instansi)
    { 
        $array = array('id_admin_instansi' => $id_admin_instansi, 'status' => '2');
        $this->db->order_by('tgl_absen', 'DESC');
        return $this->db->get_where('absen5', $array)->result_array(); 

    }


    public function getDaftarUser($username_admin)
    {
        // $username_admin = $this->session->userdata('username');
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

    public function getDeviceID($id_user)
    {
        return $this->db->get_where('auth', ['id_user' => $id_user]);
    }

    public function hapusDeviceID($id_user)
    {
        $row = $this->db->query("SELECT * FROM auth WHERE id_user='$id_user'")->num_rows();
        if (!empty($id_user) && $row > 0) {
            $this->db->where('id_user', $id_user);
           return $this->db->delete('auth');
           // return true;
        } else {
            return false;
        }
    }

    public function kehadiranByUser($id_user)
    {
        return $this->db->get_where('absen5', ['id_user' => $id_user, 'status' => '1'])->result_array();
    }

    public function dinasLuarByUser($id_user)
    {
        return $this->db->get_where('absen5', ['id_user' => $id_user, 'status' => '2'])->result_array();
    }

    public function ijinByUser($id_user)
    {
        return $this->db->get_where('absen5', ['id_user' => $id_user, 'status' => '3'])->result_array();
    }

    public function getPengaturanWifi($username_admin)
    {

        return $this->db->get_where('data_wifi', ['username_admin' => $username_admin])->row();
    }

    /**
     *  author refyandra agus 2021
     * 
     */

    public function getJadwalbyInstansi($instansi)
    {
        $sql = "SELECT * FROM `jam_kerja` WHERE `instansi` = '{$instansi}'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getJadwalDetailbyInstansi($instansi)
    {
        $sql = "SELECT * FROM `jam_kerja` as jk LEFT JOIN jam as j on jk.id_jamkerja=j.id_jam_kerja WHERE `instansi` = '{$instansi}'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    public function getRekap($starDay, $endDay = null)
    {
        if ($endDay === null) {
            $endDay = date('Y-m-d');
        }
        //$sql = "SELECT  nama_lengkap, jam_masuk, jam_pulang, tgl_absen from absen  WHERE   EXISTS (SELECT *  FROM approval_ijin WHERE absen5.id_absen = approval_ijin.id_absen and approval_ijin.status_approval <> '3')  or absen5.status ='1' between $starDay AND $endDay   order by tgl_absen asc ";
        $sql = "SELECT nama_lengkap, jam_masuk, jam_pulang, tgl_absen, status from absen WHERE EXISTS (SELECT * FROM approval_ijin WHERE absen5.id_absen = approval_ijin.id_absen and approval_ijin.status_approval <> '3') or absen5.status ='1' AND tgl_absen between '2021-01-01' AND '2021-08-01'";
        //$sql = "SELECT * from absen  WHERE   EXISTS (SELECT * FROM approval_ijin WHERE absen5.id_absen = approval_ijin.id_absen and approval_ijin.status_approval <> '3') and  absen5.id_admin_instansi = '$id_admin_instansi' or absen5.status ='1'  order by tgl_absen asc ";
        //$sql = "SELECT * from absen  WHERE  EXISTS (SELECT * FROM approval_ijin WHERE absen5.id_absen = approval_ijin.id_absen and approval_ijin.status_approval = '1') and  absen5.id_admin_instansi = '$id_admin_instansi'  and (absen5.status ='4') ";

        $query = $this->db->query($sql);
        return $query->result_array();
    }
     public function getStatusAuth($id){
         return $this->db->query("SELECT * FROM auth WHERE id_user='$id'")->num_rows();
     }
     
     
    function getAbsen($postData=null){
        if(!$this->input->post('draw')):
            $response = array(
                "draw" => '',
                "iTotalRecords" => '',
                "iTotalDisplayRecords" => '',
                "aaData" => ''
             );
             return $response;  
        endif;     
        
        
         $response = array();
    
         ## Read value
         $draw = $postData['draw'];
         $start = $postData['start'];
         $rowperpage = $postData['length']; // Rows display per page
         $columnIndex = $postData['order'][0]['column']; // Column index
         $columnName = $postData['columns'][$columnIndex]['data']; // Column name
         $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
         $searchValue = $postData['search']['value']; // Search value
         $id_admin_istansi =  $this->uri->segment('2');
    
         ## Search 
         $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (nama_lengkap like '%".$searchValue."%' or tgl_absen = '".$searchValue."' or status like'%".$searchValue."%' ) ";
         }
    
         ## Total number of records without filtering
         $this->db->select('count(*) as allcount');
         $this->db->where('id_admin_instansi', 4381);
         if($searchQuery != '')
            $this->db->where($searchQuery);
         $records = $this->db->get($this->_tabel)->result();
         $totalRecords = $records[0]->allcount;
    
         ## Total number of record with filtering
         $this->db->select('count(*) as allcount');
         $this->db->where('id_admin_instansi', 4381);
         if($searchQuery != '')
            $this->db->where($searchQuery);
         $records = $this->db->get($this->_tabel)->result();
         $totalRecordwithFilter = $records[0]->allcount;
    
         ## Fetch records
         $this->db->select('*');
         $this->db->where('id_admin_instansi', 4381);
         if($searchQuery != '')
            $this->db->where($searchQuery);
         $this->db->order_by($columnName, $columnSortOrder);
         $this->db->limit($rowperpage, $start);
         $records = $this->db->get($this->_tabel)->result();
    
         $data = array();
    
         foreach($records as $record ){
    
            $data[] = array( 
               "nama_lengkap"=>$record->nama_lengkap,
               "tgl_absen"=>$record->tgl_absen,
               "timestamp_masuk"=>$record->timestamp_masuk,
               "timestamp_pulang"=>$record->timestamp_pulang,
               "status"=>$record->status
            ); 
         }
    
         ## Response
         $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
         );
    
         return $response; 
    } 
     
     
     
    
} //END
