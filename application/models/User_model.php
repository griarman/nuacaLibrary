<?php
/**
 * Created by PhpStorm.
 * User: grigo
 * Date: 20/04/2019
 * Time: 01:44
 */

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getUser($login,$password)
    {
        $response = $this->db->get_where('admin', [
            'login' => $login,
            'password' => $password
        ]);

        return $response->num_rows();
    }
    public function addCookie($token, $time)
    {
        $data = ['token'=>$token, 'expireDate' => $time];
        $this->db->insert('adminToken', $data);
    }
}