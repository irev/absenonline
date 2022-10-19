<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index(){
        $admin_opd = Http::get('https://simpel.pasamanbaratkab.go.id/api_android/simaya/get_admin_opd.php');
        $admin = json_decode($admin_opd->getBody());   
        return view('home', compact('admin'));
    }
}
