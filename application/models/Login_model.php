<?php


use GuzzleHttp\Client;

class Login_model extends CI_model
{


    private $_client;


    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'https://simpel.pasamanbaratkab.go.id/api_android/simaya/'
        ]);
    }


    public function loginAdmin()
    {

        $data = [
            "username" => $this->input->post('username', true),
            "password" => $this->input->post('password', true)
        ];

        var_dump($data);
        $response = $this->_client->request('POST', 'model_login_admin.php', ['form_params' => $data]);

        $result = json_decode($response->getBody()->getContents(), true);

        if ($result['success'] == 1 && $result['id_groups'] == 2) {
            $arraydata = array(
                'masuk' => true,
                'nama_instansi'  => $result['nama_instansi'],
                'id_instansi'  => $result['id_instansi'],
                'id_user'  => $result['id_user'],
                'nama_lengkap'  => $result['nama_lengkap'],
                'username'  => $result['username']
            );
            $this->session->set_userdata($arraydata);
            redirect('/dashboard_controller');
        } else {
            redirect('');
        }
        var_dump($result);
        return $result;
    }
}
