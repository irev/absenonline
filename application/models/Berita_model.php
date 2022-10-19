<?php



use GuzzleHttp\Client;

class Berita_model extends CI_model
{



    private $_client;


    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'https://simpel2.pasamanbaratkab.go.id/api_android/simaya/'
        ]);
    }
 

    public function getDaftarUser($username_admin)
    { 
        $data = [
            "username" => $username_admin
        ];

        $response = $this->_client->request('POST', 'daftar_user.php', ['form_params' => $data]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result['data'];
    }


    public function getAdminOPD()
    {
        $response = $this->_client->request('GET', 'get_admin_opd.php');

        $result = json_decode($response->getBody()->getContents(), true);

        return $result['data'];
    }

    public function getNamaOPDbyIDAdmin($id)
    {
        $response = $this->_client->request('GET', "get_admin_opd_by_id.php?id_user=$id");

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;
    }
    
    public function getNamaOPDbyUsernameAdmin($id)
    {
        $response = $this->_client->request('GET', "get_instansi_by_admin.php?username=$id");

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;
    }

     
    
} 
