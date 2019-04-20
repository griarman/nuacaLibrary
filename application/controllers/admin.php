<?php
/**
 * Created by PhpStorm.
 * User: grigo
 * Date: 12/04/2019
 * Time: 20:35
 */

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
    }
    public function index()
    {
        $data['error'] = $this->session->error;
        $this->load->view('admin/login',$data);
    }
}
