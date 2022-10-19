<?php

class Jamkerja_model extends CI_model
{
    private $table;
    function __construct()
    {
        $this->table = 'jam_kerja';    
        
    }

    function add($data){
        $this->db->insert($this->table, $data);
    }

}
