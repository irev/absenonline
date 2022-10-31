<?php
class Dashboard_model extends CI_model{

    public function getRiwayatAbsenHariIni(){
        $id_admin_instansi = $this->session->userdata('id_user');
        $array = array('tgl_absen' => date("Y-m-d"),'id_admin_instansi' => $id_admin_instansi);
        $this->db->select('*,(TIMEDIFF(timestamp_masuk,timestamp_pulang)) as `jam_kerja`');
        return $this->db->get_where('absen5',$array)->result_array();
        //return $this->db->get('absen')->result_array();
    }
        /**
         * Hitung Absen Keterangan Status :
         * 	1.Hadir 2.DL 3.IZIN 4.SAKIT 5.TK 6. CUTI	
         */
    public function getTotalRiwayatAbsenHariIni($status = 1){
        
        $id_admin_instansi = $this->session->userdata('id_user');
        $array = array('tgl_absen' => date("Y-m-d"),'id_admin_instansi' => $id_admin_instansi, 'status' => $status);
        return  $this->db->get_where('absen5', $array)->num_rows();
        //return $this->db->get('absen')->result_array();
    }
    
    public function getTotalRiwayatAbsenHariIniPulang(){
        $id_admin_instansi = $this->session->userdata('id_user');
        $array = ['tgl_absen' => date("Y-m-d"),'id_admin_instansi' => $id_admin_instansi];
        $this->db->where('timestamp_pulang !=', '');
        $this->db->where('status <>', 3);
         
        return  $this->db->get_where('absen5', $array)->num_rows();
        //return $this->db->get('absen')->result_array();
    }
}