<?php
class Hitungterlambat
{
	//public $jam;
	//public $jam_masuk;
	//public $jam_pulang;
	// Jadwal dari database
	// private $jadwal=[
	// 	'cm'=>'07:30',
	// 	'cp'=>'16:00'
	// ];
	//" from database Cek telat by user";
	// private $telat=[
	// 				[
	// 					'm' => '07:40',
	// 					'p' => '16:00'
	// 				],
	// 				[
	// 					'm' => '07:10',
	// 					'p' => '07:00'
	// 				],
	// 				[
	// 					'm' => '08:10',
	// 					'p' => '07:00'
	// 				]
	// 			];
	//public $allKeys;

	function __construct()
	{
		$this->_ci = &get_instance();
	}

	//echo Hitung($telat, $jadwal);
	/**
	 * method masuk
	 * $telat array(m=>07:10,p=>07:10)
	 * $jadwal Array(cm=>07:30, cp=>16:30)
	 * return jumlah total jam telat 
	 */
	// SECTION PERHITUNGAN JAM
	function Hitung($time_log, $jadwal, $status = 'masuk')
	{
		//echo json_encode($jadwal);
		$jadwal_masuk = '';
		$jadwal_pulang = '';
		$jadwal_array = [];
		foreach ($jadwal as $jd) {
		    //echo $jd['hari'];
			$jadwal_array += [$jd['hari'] => [
				'masuk' => $jd['j_masuk'], 
				'pulang' => $jd['j_pulang'],
				'bts_awal_pulang' => $jd['bts_awal_pulang'],
				'bts_akhir_pulang' => $jd['bts_akhir_pulang'],
				'bts_awal_masuk' => $jd['bts_awal_masuk'],
				'bts_akhir_masuk' => $jd['bts_akhir_masuk'], 
			]];
			
		}
		if ($status == 'pulang_cepat') {
			// ANCHOR JAM PULANG CEPAT
			$selisih_time_log = 0;
			foreach ($time_log as $t) {
				//echo json_encode($time_log);
				$hari_log  = $this->str_indonamahari($t['hari']);
				
				//echo '<br><br><br>'.$t['p'].' {'.$jadwal_pulang.'} '.$jadwal_hari;
				
				if (array_key_exists($hari_log, $jadwal_array) ) {
					//echo $hari_log . $t['p'].'-'. $jadwal_array[$hari_log]['pulang'].' <br>';
					$jadwal_pulang = $jadwal_array[$hari_log]['pulang'];
					// CEK PULANG CEPAT
					if($t['p'] != null){ // jika absen pulang null atau belum ambil absen pulang
    					$cek = $this->_cekPulangCepat($t['p'], $jadwal_pulang);
    					if($cek){
    						// toleransi jampulang 
    						$batas_awal_pulang = $jadwal_array[$hari_log]['bts_awal_pulang'];
    						if ($this->_selisihJam($jadwal_pulang, $t['p']) >= $batas_awal_pulang) {
    							$selisih_time_log += $this->_selisihJam($t['p'], $jadwal_pulang);
    						}
    					}
					}
					//echo '<hr>';

				}
				
			}
		}
		else if($status == 'pulang_lama') 
		{
			// ANCHOR JAM PULANG LAMA / Lembur
			$selisih_time_log = 0;
			foreach ($time_log as $t) {
				//echo json_encode($time_log);
				$hari_log  = $this->str_indonamahari($t['hari']);
				//echo '<br><br><br>'.$t['p'].' {'.$jadwal_pulang.'} '.$jadwal_hari;

				if (array_key_exists($hari_log, $jadwal_array)) {
					//echo $hari_log .' pulang '. $t['p'] . '-' . $jadwal_array[$hari_log]['pulang'] . ' jadwal <br>';
					$jadwal_pulang = $jadwal_array[$hari_log]['pulang'];
					$batas_akhir_pulang = $jadwal_array[$hari_log]['bts_akhir_pulang'];
					// CEK PULANG LEMBUR LAMA
					if($t['p'] != null){ // jika absen pulang null atau belum ambil absen pulang
    					$cek = $this->_cekPulangLama($t['p'], $jadwal_pulang);
    					if ($cek) {
    						if($this->_selisihJam($jadwal_pulang, $t['p'])>= $batas_akhir_pulang){
    							$selisih_time_log += $this->_selisihJam($jadwal_pulang, $t['p']);
    						}
    					}
					}
					//echo '<hr>';
				}
			}
		} 
		else if ($status == 'masuk') 
		{
			// ANCHOR  JAM MASUK
			$selisih_time_log = 0;
			// ambil jadwal absen masuk dan pulang
			// hitung jam ceklog
			foreach ($time_log as $t) {
			$hari_log  = $this->str_indonamahari($t['hari']);
    			if(array_key_exists($hari_log, $jadwal_array)){ 
    			    $jadwal_masuk = $jadwal_array[$hari_log]['masuk'];
    				$cek = $this->_masuk($t['m'], $jadwal_masuk);
    				if ($cek) {
    					$batas_awal_masuk = $jadwal_array[$hari_log]['bts_awal_masuk'];
    					$batas_akhir_masuk = $jadwal_array[$hari_log]['bts_akhir_masuk'];
    					
    					if($this->_selisihJam($jadwal_masuk, $t['m']) > $batas_akhir_masuk){
    						//echo ' <br> jw ' . $this->_selisihJam($jadwal_masuk, $t['m']) . ' < batas ' . $batas_akhir_masuk . ' M ' . $jadwal_masuk . $t['m'] . '  <br> ';
    						$selisih_time_log += $this->_selisihJam($jadwal_masuk, $t['m']);
    					}
    				}
    			    
    			}
			}
		}

		//// hitung Jam
		if($selisih_time_log <= 0){
			$selisih_time_log = 0;
		}
	
			$jam   = floor($selisih_time_log / (60 * 60));
			$menit = $selisih_time_log - ($jam * (60 * 60));
			$detik = $selisih_time_log % 60;
			echo  sprintf("%'02d", $jam) . ':' . sprintf("%'02d", $menit / 60);
		
	}
	
	/**
	 * method TanpaKeterangan
	 */
	function TanpaKeterangan($time = '16:00', $scd = '16:00')
	{
		list($jam, $menit) = explode(':', $time);
		list($jam_scd, $menit_scd) = explode(':', $scd);
		if ($jam > $jam_scd) {
			//echo "<code>LEMBUR</code>";
			return true;
		} else if ($jam >= $jam_scd && $menit > $menit_scd) {
			//echo "<code>LEMBUR</code>";
			return true;
		} else {
			//echo "tidak";
			return false;
		}
		return false;
	}
	/**
	 * method _masuk
	 * Cek Keterlambatan
	 * $scd diambil dari database Jadwal
	 * $time diambil dari kumpulan absen masuk
	 *  return false
	 */
	private function _masuk($time = '07:00', $scd = '07:30')
	{
		list($j, $m) = explode(':', $time);
		list($j_scd, $m_scd) = explode(':', $scd);
		if ($j > $j_scd) {
			return true;
		} else if ($j >= $j_scd && $m > $m_scd) {
			return true;
		}
		return false;
	}

	private function _cekPulangCepat($time = '16:00', $scd = '16:00')
	{
    		list($jam, $menit) = explode(':', $time);
    		list($jam_scd, $menit_scd) = explode(':', $scd);
    		if ($jam < $jam_scd) {
    			//echo "<code>Cepat</code> ". $time.' '. $scd;
    			return true;
    		}else if($jam <= $jam_scd && $menit < $menit_scd){
    			//echo "<code>Cepat</code> ". $time.' '. $scd;
    			return true;
    		}else{
    			//echo "tidak ". $time.' '. $scd ;
    			return false;
    		} 
		return false;
	}
	private function _cekPulangLama($time = '16:00', $scd = '16:00')
	{
		list($jam, $menit) = explode(':', $time);
		list($jam_scd, $menit_scd) = explode(':', $scd);
		if ($jam > $jam_scd) {
			//echo "<code>LEMBUR</code>";
			return true;
		} else if ($jam >= $jam_scd && $menit > $menit_scd) {
			//echo "<code>LEMBUR</code>";
			return true;
		} else {
			//echo "tidak";
			return false;
		}
		return false;
	}
	


	 /* Method _selisihJam
	 *
	 * @param $a  Jam Awal
	 * @param $b  Jam Akhir
	 *
	 * @return void
	 */
	private function _selisihJam($a, $b)
	{
		$awal  = strtotime($a); // jadwal masuk
		$akhir = strtotime($b); // jam seklog
		$diff  = $akhir - $awal;

		$jam   = floor($diff / (60 * 60));
		$menit = $diff - ($jam * (60 * 60));
		$detik = $diff % 60;
		return $diff;
		//return ' Telat Anda : ' . $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit';
	}


	function str_indonamahari($day)
	{
		$nama_hari = "";
		$nama = $day;
		if ($nama == "Sunday") {
			$nama_hari = "Minggu";
		} else if ($nama == "Monday") {
			$nama_hari = "Senin";
		} else if ($nama == "Tuesday") {
			$nama_hari = "Selasa";
		} else if ($nama == "Wednesday") {
			$nama_hari = "Rabu";
		} else if ($nama == "Thursday") {
			$nama_hari = "Kamis";
		} else if ($nama == "Friday") {
			$nama_hari = "Jumat";
		} else if ($nama == "Saturday") {
			$nama_hari = "Sabtu";
		}
		return $nama_hari;
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
