<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DataAbsenController extends Controller
{
    public function server1(){
        $data_absen = Http::get('https://mobileabsensi.pasamanbaratkab.go.id/api_android/ambilabsen.php');
        $absen = $data_absen->json();
        $x=array();$y=array();$a=array();$b=array();
        foreach($absen as $data){
            $x[] = $data['tgl_absen'];
            $y[] = $data['timestamp_pulang'];  
             
            if(!empty($data['timestamp_pulang'])){
                $a[] = $data['timestamp_pulang'];
            }
            if(empty($data['timestamp_pulang'])){
                $b[] = $data['timestamp_pulang'];
            }
        }  
        $tot_absen = count($x);
        $tot_sudah_pulang = count($a);
        $tot_belum_pulang = count($b); 
        $persen = $tot_absen/795*100;
        return view('server1', compact('absen','tot_absen','tot_sudah_pulang','tot_belum_pulang','persen'));
    }

    public function server2(){
        $data_absen = Http::get('http://mobileabsensi3.pasamanbaratkab.go.id/api_android/ambilabsen.php');
        $absen = $data_absen->json();
        $x=array();$y=array();$a=array();$b=array();
        foreach($absen as $data){
            $x[] = $data['tgl_absen'];
            $y[] = $data['timestamp_pulang'];  
             
            if(!empty($data['timestamp_pulang'])){
                $a[] = $data['timestamp_pulang'];
            }
            if(empty($data['timestamp_pulang'])){
                $b[] = $data['timestamp_pulang'];
            }
        }  
        $tot_absen = count($x);
        $tot_sudah_pulang = count($a);
        $tot_belum_pulang = count($b);
        $absen = $data_absen->json();
        $persen = $tot_absen/790*100;
        return view('server2', compact('absen','tot_absen','tot_sudah_pulang','tot_belum_pulang','persen'));
        
    }

    public function server3(){
        $data_absen = Http::get('http://mobileabsensi4.pasamanbaratkab.go.id/api_android/ambilabsen.php');
        $absen = $data_absen->json();
        $x=array();$y=array();$a=array();$b=array();
        foreach($absen as $data){
            $x[] = $data['tgl_absen'];
            $y[] = $data['timestamp_pulang'];  
             
            if(!empty($data['timestamp_pulang'])){
                $a[] = $data['timestamp_pulang'];
            }
            if(empty($data['timestamp_pulang'])){
                $b[] = $data['timestamp_pulang'];
            }
        }  
        $tot_absen = count($x);
        $tot_sudah_pulang = count($a);
        $tot_belum_pulang = count($b);
        $absen = $data_absen->json();
        $persen = $tot_absen/767*100;
        return view('server3', compact('absen','tot_absen','tot_sudah_pulang','tot_belum_pulang','persen'));
    }

    public function pimpinan(){
        $data_pimpinan = Http::get('https://simpel.pasamanbaratkab.go.id/api_android/simaya/get_pimpinan.php');
        $pimpinan = json_decode($data_pimpinan->getBody());

        $pim_server1 = Http::get('http://mobileabsensi1.pasamanbaratkab.go.id/api_android/ambilabsen.php');
        $pim_server2 = Http::get('http://mobileabsensi3.pasamanbaratkab.go.id/api_android/ambilabsen.php');
        $pim_server3 = Http::get('http://mobileabsensi4.pasamanbaratkab.go.id/api_android/ambilabsen.php');
        $absen1 = $pim_server1->json();
        $absen2 = $pim_server2->json();
        $absen3 = $pim_server3->json();
        // dd($pimpinan);
        return view('pimpinan', compact('pimpinan','absen1','absen2','absen3'));
    } 
}
