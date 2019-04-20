<?php
/**
 * Created by PhpStorm.
 * User: grigo
 * Date: 20/04/2019
 * Time: 01:34
 */

defined('BASEPATH') OR exit('No direct script access allowed');
class Authorization extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->helper('cookie');
    }
    public function login()
    {
        $login = addslashes(trim($this->input->post('login', true)));
        $password = $this->input->post('password', true);
        if(empty($login) || empty($password)){
            $this->output->set_status_header(403);
            $this->output->set_output('Login and password are required')->_display();
            die;
        }
        $pass = hash('sha256',$password);
        $answer = $this->user_model->getUser($login, $pass);
        if(empty($answer)){
            $arr = ['error' => 'Նման մուտքանվան և գաղտնաբառի համադրություն գոյություն չունի '];
            $this->session->set_userdata($arr);
            redirect(base_url(). 'admin');
            die;
        }
    }
}
