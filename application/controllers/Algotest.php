<?php


class Algotest extends CI_Controller
{


    function __construct()
    {
        parent::__construct();

        // if ($this->session->userdata('masuk') != TRUE) {

        //     redirect('/login_controller');
        // }
        $this->load->helper('debug'); // DEBUG Show
        $this->load->library('durasiwaktu');
        $this->load->model('Absen_model');
    }


    public function index()
    {
        $masuk = "07:30";
        $keluar = "16:00";

        $times = [
            "00:45",
            "01:00",
        ];
        if (07)

            dd($times);
        //echo   $this->durasiwaktu->Total_Durasi_Jam_Kerja($times);
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
        echo sprintf(' %02d:%02d', $hours, $minutes);

        ///////////////////////////////
        $waktu_awal        = strtotime("0000-00-00 07:30");
        $waktu_akhir    = strtotime("0000-00-00 07:00"); // bisa juga waktu sekarang now()

        //menghitung selisih dengan hasil detik
        echo $diff    = $waktu_akhir - $waktu_awal;

        //membagi detik menjadi jam
        $jam    = floor($diff / (60 * 60));

        //membagi sisa detik setelah dikurangi $jam menjadi menit
        $menit    = $diff - $jam * (60 * 60);

        //menampilkan / print hasil
        echo '<br/><br/> Hasilnya adalah  ' . number_format($diff, 0, ",", ".") . '  detik <br /><br />';
        echo 'Sehingga Anda memiliki sisa waktu promosi selama: ' . $jam .  ' jam dan ' . floor($menit / 60) . ' menit';
    }
/////////////////////////////////////////////////////////////////////////////////////////




}