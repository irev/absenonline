<?php

use GuzzleHttp\Client;

class Rekap_model extends CI_model
{
    private $_client;


    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'https://simpel.pasamanbaratkab.go.id/api_android/simaya/'
        ]);
    }

    ///////////ANCHOR getRekap 
    public function getRekap($id_admin_instansi)
    {
        //$sql = "SELECT * from absen5  WHERE NOT EXISTS (SELECT * FROM approval_ijin WHERE absen5.id_absen = approval_ijin.id_absen and (approval_ijin.status_approval = '1' or approval_ijin.status_approval = '3') ) and  absen5.id_user = '$id_admin_instansi' ";
        $sql = "SELECT * from absen5  WHERE   EXISTS (SELECT * FROM approval_ijin WHERE absen5.id_absen = approval_ijin.id_absen and approval_ijin.status_approval <> '3') and  absen5.id_admin_instansi = '$id_admin_instansi' or absen5.status ='1'  order by tgl_absen asc ";
        //$sql = "SELECT * from absen5  WHERE  EXISTS (SELECT * FROM approval_ijin WHERE absen5.id_absen = approval_ijin.id_absen and approval_ijin.status_approval = '1') and  absen5.id_admin_instansi = '$id_admin_instansi'  and (absen5.status ='4') ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    ///////////ANCHOR getRekap_nama Daparkan nama pegawai
    public function getRekap_nama($id_instansi)
    {
        //$sql = "SELECT * from absen5  WHERE NOT EXISTS (SELECT * FROM approval_ijin WHERE absen5.id_absen = approval_ijin.id_absen and (approval_ijin.status_approval = '1' or approval_ijin.status_approval = '3') ) and  absen5.id_user = '$id_admin_instansi' ";
        //$sql = "SELECT id_user, nama_lengkap from absen5 GROUP BY id_user";
        $sql = "SELECT DISTINCT id_user, nama_lengkap from  absen5 WHERE id_admin_instansi='$id_instansi'";
        //$sql = "SELECT * from absen5  WHERE  EXISTS (SELECT * FROM approval_ijin WHERE absen5.id_absen = approval_ijin.id_absen and approval_ijin.status_approval = '1') and  absen5.id_admin_instansi = '$id_admin_instansi'  and (absen5.status ='4') ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getRekapNamaApiByIdIstansi($id){
        $response = $this->_client->request('GET', "get_data_all_user_by_admin.php?id_instansi=$id");
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }


    public function getRekap_jam($id_admin_instansi)
    {
        //$sql = "SELECT * from absen5  WHERE NOT EXISTS (SELECT * FROM approval_ijin WHERE absen5.id_absen = approval_ijin.id_absen and (approval_ijin.status_approval = '1' or approval_ijin.status_approval = '3') ) and  absen5.id_user = '$id_admin_instansi' ";
        $sql = "SELECT timestamp_masuk, timestamp_pulang, tgl_absen from absen5  WHERE   EXISTS (SELECT * FROM approval_ijin WHERE absen5.id_absen = approval_ijin.id_absen and approval_ijin.status_approval <> '3') and  absen5.id_admin_instansi = '$id_admin_instansi' or absen5.status ='1' Order by tgl_absen asc ";
        //$sql = "SELECT * from absen5  WHERE  EXISTS (SELECT * FROM approval_ijin WHERE absen5.id_absen = approval_ijin.id_absen and approval_ijin.status_approval = '1') and  absen5.id_admin_instansi = '$id_admin_instansi'  and (absen5.status ='4') ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getRekap_time($id_admin_instansi, $id_user, $date, $stat = 'in')
    {
        $jam = 'timestamp_masuk';
        // $jam = date('h:i:s', strtotime('timestamp_masuk'));
        
        if ($stat === 'out') {
            $jam =  'timestamp_pulang';
        }
        //$sql = "SELECT {$jam},status, tgl_absen from absen5  WHERE id_admin_instansi = '$id_admin_instansi' AND status='1' AND id_user='{$id_user}' AND tgl_absen='{$date}'";
        $sql = "SELECT {$jam},status, tgl_absen from absen5  WHERE id_admin_instansi = '$id_admin_instansi' AND id_user='{$id_user}' AND tgl_absen='{$date}'";
        $query = $this->db->query($sql);
        if ($query->row($jam) and $query->row('status')==1) {
            return $query->row($jam);
        }else if($query->row('status')==2){
            return 'DL';
        }else if($query->row('status')==3){
            return 'i';
        }else if($query->row('status')==4){
            return 'S';
        }else if($query->row('status')==6){
            return 'C';
        }else{
            return 'TK';
        }
        return '-';
    }
    
    public function getRekap_status($id_admin_instansi, $id_user, $date, $stat = 'NULL'){
        $sql = "SELECT count(*) as hitung from absen5  WHERE id_admin_instansi = '$id_admin_instansi' AND status='{$stat}' AND id_user='{$id_user}' AND tgl_absen LIKE '{$date}'";
        $query = $this->db->query($sql);
        if($query->row('hitung')){
            return $query->row('hitung');
        }
        return $query->row('hitung');
    }
    
    public function getRekap_hariterakhir($date='date(Y-m-%)', $id_admin_instansi=null){
        $sql = "SELECT max(tgl_absen) as tgl from absen5  WHERE id_admin_instansi='$id_admin_instansi' and tgl_absen LIKE '$date'";
        $query = $this->db->query($sql);
        if($query->row('tgl')){
            return $query->row('tgl');
        }
        return $query->row('tgl');
    }
    
    public function Durasi()
    {
        $sql =  "SELECT CAST(SUM(time_duration) AS TIME) AS total_time_duration FROM (
            SELECT CAST('01:08' AS TIME) time_duration 
            UNION
            SELECT CAST('00:39' AS TIME)
            ) date_range_results";
    }
}
