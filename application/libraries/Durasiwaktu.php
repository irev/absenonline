<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Durasiwaktu
{

    /** SECTION class Durasiwaktu
     * Method __construct
     *
     * @param $url $url [explicite description]
     *
     * @return void
     */
    function __construct($url = '')
    {
        $this->_ci = &get_instance();
    }

       
    /** TODO Ambil semua jam [masuk, keluar] dalam satu bulan by user
     * Method get_Absen_Sebulan_ByUser
     *
     * @param $bulan $bulan [explicite description]
     * @param $iduser $iduser [explicite description]
     *
     * @return void
     */
    function get_Absen_Sebulan_ByUser($bulan, $iduser)
    {
        // FIXME explode tanggal jadi "0000-00"
        $qry = $this->_ci->db->query("SELECT `jam_masuk`,`jam_pulang` from absen WHERE `id_user`='{$iduser}' AND tanggal_absen LIKE '{$bulan}%'");
        return $qry->result();
        
    }


    /** ANCHOR DONE (libraries) Durasiwaktu  Durasi masuk dan pulang
     * Method Durasi_Masuk_Pulang
     *
     * @param $str $str [Jam Masuk]
     * @param $end $end [Jam Keluar]
     *
     * @return void
     */
    function Durasi_Masuk_Pulang($str, $end)
    {
        if(strtotime($str) && strtotime($end)){
        //TODO HITUNG DURASI MASUK DAN PULANG 
            if ($str != '-' && $end != '-') {
                $strl = new DateTime($str);
                $endl = new DateTime($end);
                $dteDiff = $strl->diff($endl);
                return $dteDiff->format("%H:%I");
            }
             echo $str.$end;
             return 'null';
        }
        return 'null';
    }

    function Terlambat_Masuk($str, $end, $def,$TOLERANSImenit=0)
    {
        if(strtotime($str) && strtotime($end)){
            //TODO HITUNG DURASI TERLAMBAT 
            if ($str != '-' && $end != '-') {
              //menghitung selisih dengan hasil detik
                $diff    =strtotime($end) - strtotime($str);
                //membagi detik menjadi jam
                $jam    = floor($diff / (60 * 60));
                //membagi sisa detik setelah dikurangi $jam menjadi menit
                $menit    =$diff - $jam * (60 * 60);
                //menampilkan / print hasil
                $detik = number_format($diff,0,",",".");
                if($diff < 0 ){
                    if($jam <= -1 AND (floor($menit/60)+1) >= 60 ){
                        $diffToleran = strtotime($str) - strtotime($def);
                        $jamToleran = floor($diffToleran / (60 * 60));
                        $unixTolerans = $diffToleran - $jamToleran * (60 * 60);
                        $menitToleran = floor($unixTolerans / (60-1));
                        $kurang = (floor($unixTolerans / (60)) <= 10 )? floor($unixTolerans / (60))*60:0;
                        return '<b>'.date( 'H:i' ,strtotime($str)-$kurang).'</br>';
                        //return (floor($unixTolerans / (60)) <= 10 )? floor($unixTolerans / (60)):0;
                        //return ' OK <b style="color:blue;"> toleran1 '.floor($unixTolerans / (60)).'</b>';
                    }else{
                        return '<b style="color:red;">'.substr($str,10,6).'</b>';
                        //return $jam .':'.(floor($menit/60)+1).  ' Telat <b style="color:red;">'. substr($str,10,6).'</b>' ;
                    }    
                }else{
                    if((floor($menit/60)+1) <= 60 ){
                        $diffToleran = strtotime($str) - strtotime($def);
                        $jamToleran = floor($diffToleran / (60 * 60));
                        $unixTolerans = $diffToleran - $jamToleran * (60 * 60);
                        $menitToleran = floor($unixTolerans / (60-1));
                        //return $jam .':'.(floor($menit/60)+1). ' OK <b style="color:blue;"> toleran2 '.floor($unixTolerans / (60)).'</b>';
                        $kurang = (floor($unixTolerans / (60)) <= 10 )? floor($unixTolerans / (60))*60:0;
                        return '<b>'.date( 'H:i' ,strtotime($str)-$kurang).'</br>';
                         
                    }
                        $diffToleran =  strtotime($str) - strtotime($def);
                        $jamToleran = floor($diffToleran / (60 * 60));
                        $unixTolerans = $diffToleran - $jamToleran * (60 * 60);
                        $menitToleran = floor($unixTolerans / (60-1));
                        $kurang = (floor($unixTolerans / (60)) <= 10 )? floor($unixTolerans / (60))*60:0;
                        return '<b>'.date( 'H:i' ,strtotime($str)-$kurang).'</br>';
                }
            }
             echo $str.$end;
             return 'null';
        }
        return 'null';
    }

    function Pulang_Cepat($str, $end, $def,$TOLERANSImenit=0)
    {
        if(strtotime($str) && strtotime($end)){
            //TODO HITUNG DURASI TERLAMBAT 
            if ($str != '-' && $end != '-') {
              //menghitung selisih dengan hasil detik
                $diff    =strtotime($end) - strtotime($str);
                //membagi detik menjadi jam
               echo $jam    = floor($diff / (60 * 60));
                //membagi sisa detik setelah dikurangi $jam menjadi menit
                $menit    =$diff - $jam * (60 * 60);
                //menampilkan / print hasil
                $detik = number_format($diff,0,",",".");
                if($diff < 0 ){
                    if($jam <= -1 AND (floor($menit/60)+1) <= 60 ){
                        $diffToleran = strtotime($str) - strtotime($def);
                        $jamToleran = floor($diffToleran / (60 * 60));
                        $unixTolerans = $diffToleran - $jamToleran * (60 * 60);
                        $menitToleran = floor($unixTolerans / (60-1));
                        echo "\n". $kurang = (floor($unixTolerans / (60)) >= 10 )? floor($unixTolerans / (60))*60:0;
                        return "\n".'<b>'.date( 'H:i' ,strtotime($str)-$kurang).'</br>';
                        //return (floor($unixTolerans / (60)) <= 10 )? floor($unixTolerans / (60)):0;
                        //return ' OK <b style="color:blue;"> toleran1 '.floor($unixTolerans / (60)).'</b>';
                    }else{
                        return '<b style="color:red;">'.substr($str,10,6).'</b>';
                        //return $jam .':'.(floor($menit/60)+1).  ' Telat <b style="color:red;">'. substr($str,10,6).'</b>' ;
                    }    
                }else{
                    if((floor($menit/60)+1) <= 60 ){
                        $diffToleran = strtotime($str) - strtotime($def);
                        $jamToleran = floor($diffToleran / (60 * 60));
                        $unixTolerans = $diffToleran - $jamToleran * (60 * 60);
                        $menitToleran = floor($unixTolerans / (60-1));
                        //return $jam .':'.(floor($menit/60)+1). ' OK <b style="color:blue;"> toleran2 '.floor($unixTolerans / (60)).'</b>';
                        echo $kurang = (floor($unixTolerans / (60)) >= 10 )? floor($unixTolerans / (60))*60:0;
                        return '<b>'.date( 'H:i' ,strtotime($str)+$kurang).'</br>';
                         
                    }
                        $diffToleran =  strtotime($str) - strtotime($def);
                        $jamToleran = floor($diffToleran / (60 * 60));
                        $unixTolerans = $diffToleran - $jamToleran * (60 * 60);
                        $menitToleran = floor($unixTolerans / (60-1));
                        echo $kurang = (floor($unixTolerans / (60)) >= 10 )? floor($unixTolerans / (60))*60:0;
                        return '<b>'.date( 'H:i' ,strtotime($str)-$kurang).'</br>';
                }
            }
             echo $str.$end;
             return 'null';
        }
        return 'null';
    }

    private function UnixToTime($str,$end)
    {
        if ($str != '-' && $end != '-') {
              //menghitung selisih dengan hasil detik
                $diff    =strtotime($end) - strtotime($str);
                //membagi detik menjadi jam
                $jam    = floor($diff / (60 * 60));
                //membagi sisa detik setelah dikurangi $jam menjadi menit
                $menit    =$diff - $jam * (60 * 60);
                //menampilkan / print hasil
                $detik = number_format($diff,0,",",".");
            return  $jam.':'.floor( $menit / 60 );
            }
    }

    /** TODO HITUNG JUMLAH TOTAL JAM
     * Method TotalDurasi
     *
     * @param $times=array( $times [explicite description])
     * 
     * @return void Total Jam kerja
     */
    function Total_Durasi_Jam_Kerja($times = array())
    {
        $minutes = 0; //declare minutes either it gives Notice: Undefined variable
        // loop throught all the times
        foreach ($times as $time) {
            list($hour, $minute) = explode(':', $time);
            $minutes += $hour * 60;
            $minutes += $minute;
        }
        $hours = floor($minutes / 60);
        $minutes -= $hours * 60;

        // returns the time already formatted
        return sprintf('%02d:%02d', $hours, $minutes);
    }

    

    /**
     * Method _alldurasi
     *  Cari semua waktu absen [masuk , pulang]
     * @param $id_admin_instansi $id_admin_instansi [explicite description]
     * @param $id_user $id_user [explicite description]
     * @param $row $row [1: masuk 0 pulang]
     *
     * @return Array
     */
    function _alldurasi($id_admin_instansi, $id_user, $row = TRUE)
    {
        //Ambil SEMUA id_user, jam masuk dan pulang dan tanggal bY id_user dan status
        $qry = $this->_ci->db->query("SELECT id_user, CONCAT(tanggal_absen,' ',jam_masuk) as masuk, CONCAT(tanggal_absen,' ',jam_pulang) as pulang, tanggal_absen as tanggal FROM `absen` WHERE status='1' AND id_user='{$id_user}';");
        echo $this->_ci->db->last_query();
        if ($row) {
            return $qry->result();
        }
        return $qry->result();
    }
    
    /**
     * Method GetAbsenJam
     *
     * @param $id_user $id_user [explicite description]
     * @param $tgl $tgl [explicite description]
     *
     * @return void
     */
    function GetAbsenJam($id_user, $tgl){
        $qry = $this->_ci->db->query("SELECT jam_masuk,jam_pulang from absen WHERE id_admin_instansi = '4393' AND id_user='{$id_user}' AND status='1' AND tanggal_absen LIKE '2021-08%';");
        dd( $qry->result());
    }



    /**
     * Method cek_hari_absen
     *
     * @param $s [tanggal yyyy-mm-dd]
     *
     * @return void
     */
    function cek_hari_absen($s = null)
    {
        if ($s) {

            $this->_ci->load->helper('tglindo');
            $hari_nm = date_name_indo($s);
            //echo 'hari '.$hari_nm;
            $_pulang = '00:00';
            switch ($hari_nm) {
                case 'Jumat':
                    $_pulang = '16:30';
                    break;
                case 'Minggu':
                    $_pulang = '00:00';
                    break;
                default:
                    $_pulang = '16:00';
                    break;
            }
            return $_pulang;
        }
    }
    function selisihWaktu($awal,$akhir){
        //$awal = "2012-05-21 22:02:00";
        //$akhir= "2012-05-22 05:02:00";   
        
        $d1 = new DateTime($awal);
        $d2 = new DateTime($akhir);
        $interval = $d2->diff($d1);
        //return $interval->format('%d days, %H hours, %I minutes, %S seconds');
        return $interval->format('%H:%I');
    }
    
    function SumWaktu($times) {
    $minutes = 0; //declare minutes either it gives Notice: Undefined variable
    // loop throught all the times
        foreach ($times as $time) {
            list($hour, $minute) = explode(':', $time);
            $minutes += $hour * 60;
            $minutes += $minute;
        }
    
        $hours = floor($minutes / 60);
        $minutes -= $hours * 60;
    
        // returns the time already formatted
        return sprintf('%02d:%02d', $hours, $minutes);
    }
    function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahkan 0 = tahun
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tanggal

	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
}
