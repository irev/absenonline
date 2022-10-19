<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends CI_Controller {


    function __construct() {
        parent::__construct();
        $this->API="https://simpel.pasamanbaratkab.go.id/api_android/simaya/";
        $this->load->library('session');
        $this->load->library('curl');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('Login_model');
        $this->load->library('form_validation');
    }

	public function index()
	{
	    
		$this->load->view('login');
    }
    

    function login(){
        // if(isset($_POST['submit'])){
        //     $data = array(
        //         'username' =>  $this->input->post('username'),
        //         'password' =>  $this->input->post('password'));
        //         $go_login =  $this->curl->simple_post($this->API.'model_login.php', $data, array(CURLOPT_BUFFERSIZE => 10)); 
        //     var_dump($data);
        //     //exit;
        //     if($go_login)
        //     {
        //         redirect('/dashboard_controller');
        //     }else{
        //         redirect('');
        //     }
        // }else{
        //     redirect('');
        // }

        $this->Login_model->loginAdmin();
    }


    function logout(){

        $this->session->sess_destroy();
        redirect('/login_controller');
    }
}
