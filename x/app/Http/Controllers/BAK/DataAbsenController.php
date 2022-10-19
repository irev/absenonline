<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DataAbsenController extends Controller
{
    public function server1(){
        $data_absen = Http::get('http://mobileabsensi1.pasamanbaratkab.go.id/api_android/ambilabsen.php');
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
        return view('server1', compact('absen','tot_absen','tot_sudah_pulang','tot_belum_pulang'));
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
        return view('server2', compact('absen','tot_absen','tot_sudah_pulang','tot_belum_pulang'));
        
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
        return view('server3', compact('absen','tot_absen','tot_sudah_pulang','tot_belum_pulang'));
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

    // public function index(){
    //     $response = Http::get('https://mobileabsensi.pasamanbaratkab.go.id/api_android/ambilabsen.php');
    //     $data_absen = $response->json();
    //     $x=array();$y=array();$a=array();$b=array();
    //     foreach($data_absen as $data){
    //         $x[] = $data['tgl_absen'];
    //         $y[] = $data['timestamp_pulang'];  
             
    //         if(!empty($data['timestamp_pulang'])){
    //             $a[] = $data['timestamp_pulang'];
    //         }
    //         if(empty($data['timestamp_pulang'])){
    //             $b[] = $data['timestamp_pulang'];
    //         }
    //     }  
    //     $tot_absen = count($x);
    //     $tot_sudah_pulang = count($a);
    //     $tot_belum_pulang = count($b);
    //     // dd($id_admin);
    //     $admin_opd = Http::get('https://simpel.pasamanbaratkab.go.id/api_android/simaya/get_admin_opd.php');
    //     $admin = json_decode($admin_opd->getBody()); 
    //     $xmin=array();
    //     foreach($admin->data as $min){
    //         $xmin[] = $min->id_user;
    //     }
    //     $id_admin= $xmin;
    //     // dd($id_admin);
    //     return view('absen', compact('data_absen','admin','tot_absen','tot_sudah_pulang','tot_belum_pulang','id_admin'));
    // }
}
