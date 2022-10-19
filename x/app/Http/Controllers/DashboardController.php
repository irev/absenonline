<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index(){
        $admin_opd = Http::get('https://simpel.pasamanbaratkab.go.id/api_android/simaya/get_admin_opd.php');
        $admin = json_decode($admin_opd->getBody());  
        $dt = date("yyyy-mm-dd");
        $data_absen = Http::get('http://mobileabsensi1.pasamanbaratkab.go.id/api_android/ambilabsen.php')->json();
        // foreach()
        // dd($data_absen);
        return view('home', compact('admin'));
    }

    public function opd_id($id_user){
        $id_admin = $id_user;
        // dd($id_admin); 
        $data_absen = Http::get('http://mobileabsensi1.pasamanbaratkab.go.id/api_android/ambilabsen.php?id_user='.$id_user)->json();
        $data_absen3 = Http::get('http://mobileabsensi3.pasamanbaratkab.go.id/api_android/ambilabsen.php?id_user='.$id_user)->json();
        $data_absen4 = Http::get('http://mobileabsensi4.pasamanbaratkab.go.id/api_android/ambilabsen.php?id_user='.$id_user)->json();
        
        $x=array();$y=array();$a=array();$b=array();
        foreach($data_absen as $data){
            if($id_admin == $data['id_admin_instansi']){
                $x[] = $data['tgl_absen'];
                $y[] = $data['timestamp_pulang'];  
                
                if(!empty($data['timestamp_pulang'])){
                    $a[] = $data['timestamp_pulang'];
                }
                if(empty($data['timestamp_pulang'])){
                    $b[] = $data['timestamp_pulang'];
                }
            }else{

            }
        }  
        foreach($data_absen3 as $data){
            if($id_admin == $data['id_admin_instansi']){
                $x[] = $data['tgl_absen'];
                $y[] = $data['timestamp_pulang'];  
                
                if(!empty($data['timestamp_pulang'])){
                    $a[] = $data['timestamp_pulang'];
                }
                if(empty($data['timestamp_pulang'])){
                    $b[] = $data['timestamp_pulang'];
                }
            }else{

            }
        }  
        foreach($data_absen4 as $data){
            if($id_admin == $data['id_admin_instansi']){
                $x[] = $data['tgl_absen'];
                $y[] = $data['timestamp_pulang'];  
                
                if(!empty($data['timestamp_pulang'])){
                    $a[] = $data['timestamp_pulang'];
                }
                if(empty($data['timestamp_pulang'])){
                    $b[] = $data['timestamp_pulang'];
                }
            }else{

            }
        }  
        $tot_absen = count($x);
        $tot_sudah_pulang = count($a);
        $tot_belum_pulang = count($b); 
        return view('opd', compact('data_absen','data_absen3','data_absen4','tot_absen','tot_sudah_pulang','tot_belum_pulang','id_admin'));
    }

}
