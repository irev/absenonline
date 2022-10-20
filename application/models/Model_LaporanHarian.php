<?php

use GuzzleHttp\Client;

class Model_LaporanHarian extends CI_model
{
    private $_table;
    public function __construct()
    {
       $this->_table = 'laphar';
    }
    function get_all(){
        return $this->db->get($table)->result_array();
    }
    
    function get_by_id($id_user=0000, $bulan=null, $tahun=null){
        $setTahun = ($tahun == null)? date('Y'): $tahun;
        $setBulan   = ($bulan ==null)? date('m'): $bulan;
        if($setTahun != null and $setBulan != null){
            $bln = sprintf("%02d", $setBulan);
            $query = $this->db->query("SELECT laphar.*, (SELECT absen5.nama_lengkap FROM absen5 WHERE absen5.id_user=laphar.id_user LIMIT 1) as nama_pegawai, (SELECT absen5.nama_lengkap FROM absen5 WHERE absen5.id_user=laphar.id_atasan LIMIT 1) AS nama_atasan FROM `laphar`  WHERE MONTH(tgl)= '$bln' AND laphar.id_user ='$id_user' ORDER BY `laphar`.`jammulai` ASC;");
        }else{ 
            $bln = sprintf("%02d", $setBulan);
            //$query = $this->db->query("SELECT * FROM `laphar` WHERE tgl >= LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH AND tgl < LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY AND id_user = '$id_user' ORDER BY `laphar`.`jammulai` ASC");
            $query = $this->db->query("SELECT laphar.*, (SELECT absen5.nama_lengkap FROM absen5 WHERE absen5.id_user=laphar.id_user LIMIT 1) as nama_pegawai, (SELECT absen5.nama_lengkap FROM absen5 WHERE absen5.id_user=laphar.id_atasan LIMIT 1) AS nama_atasan FROM `laphar`  WHERE tgl >= LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH AND tgl < LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY AND laphar.id_user ='$id_user' ORDER BY `laphar`.`jammulai` ASC;");
            //$query = $this->db->query("SELECT laphar.*, (SELECT absen5.nama_lengkap FROM absen5 WHERE absen5.id_user=laphar.id_user LIMIT 1) as nama_pegawai, (SELECT absen5.nama_lengkap FROM absen5 WHERE absen5.id_user=laphar.id_atasan LIMIT 1) AS nama_atasan FROM `laphar`  WHERE tgl LIKE '%-09-%'AND laphar.id_user ='6327' ORDER BY `laphar`.`jammulai` ASC;");
        }   
            return $query->result_array();
    }
}