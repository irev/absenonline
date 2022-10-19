<?php
class Hitungterlambat{
	public $jam;
	public $jam_masuk;
	public $jam_pulang;
	// Jadwal dari database
	private $jadwal=[
		'cm'=>'07:30',
		'cp'=>'16:00'
	];
	//" from database Cek telat by user";
	private $telat=[
					[
						'm' => '08:00',
						'p' => '16:00'
					],
					[
						'm' => '09:52',
						'p' => '07:00'
					],[
						'm' => '07:30',
						'p' => '07:00'
					]
				];
    public $allKeys;
	function _construct($jam, $jadwal)
	{
		
		$this->jam = $jam;
		$this->masuk = $jam_masuk;
		$this->pulang = $jam_pulang;
		$allKeys = array_keys($jam);
		foreach ($allKeys as $key => $value) 
		{ 
			echo $key . ':' . $value . "\n"; 
		}
	}

	
	//echo Hitung($telat, $jadwal);
	/**
	 * method masuk
	 * $telat array(m=>07:10,p=>07:10)
	 * $jadwal Array(cm=>07:30, cp=>16:30)
	 * return jumlah total jam telat 
	 */
	public function Hitung($telat, $jadwal){
		$selisih_telat = 0;
		foreach($telat as $t){
			list($j,$m) = explode(':',$t['m']);
			//cektelat _telat
			$cek = $this->_telat($t['m'], $jadwal['cm']);
			if($cek){
				// jika telat hitung lama telat
				//panggil method hitung telat
				//echo '<br>telat '.$t['m'].' - '.$jadwal['cm'].'<br>';
				$selisih_telat +=  $this->_selisihtelat($jadwal['cm'],$t['m']);
				//echo '<br>'.date('H:i', $selisih_telat);
			}
		}
		return $selisih_telat.' - '.date('H:i', $selisih_telat);
	}
	
	/**
	 * method _telat
	 * Cek Keterlambatan
	 * $scd diambil dari database Jadwal
	 * $time diambil dari kumpulan absen masuk
	 *  return false
	 */
	private function _telat($time ='07:31', $scd='07:30')
	{
		list($j,$m) = explode(':',$time);
		list($j_scd,$m_scd) = explode(':',$scd);
			if($j > $j_scd){
				return true;    
			}else if($j >= $j_scd && $m > $m_scd){
				return true;      
			}
		return false;    
	}
	
	/**
	 * method _selisihtelat
	 * Hitung selisih telat
	 */
	private function _selisihtelat($a,$b){
		$awal  = strtotime($a);
		$akhir = strtotime($b);
		$diff  = $akhir - $awal;
	
		$jam   = floor($diff / (60 * 60));
		$menit = $diff - ( $jam * (60 * 60) );
		$detik = $diff % 60;
		return $diff;
		//echo ' Telat Anda : ' . $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit';
	}
}