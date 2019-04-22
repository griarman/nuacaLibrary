<?php
/**
 * Created by PhpStorm.
 * User: grigo
 * Date: 12/04/2019
 * Time: 20:36
 */

class Admin_model extends CI_Model
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
    public function checkCookie($token, $time)
    {
        $this->db->where('token', $token);
        $this->db->where('expireDate>=', $time);
        return empty($this->db->get('adminToken')->result_array()[0]);
    }
    public function delCookie($token)
    {
        $this->db->delete('adminToken',['token'=>$token]);
    }
    public function delExpiredTokens()
    {
        $this->db->delete('adminToken',['expireDate<='=>time()]);
    }
}