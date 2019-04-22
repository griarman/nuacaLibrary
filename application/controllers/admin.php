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
        date_default_timezone_set('Asia/Yerevan');
        $this->load->model('admin_model');
        $this->load->model('global_model');
    }
    public function index()
    {
        if(!empty($_COOKIE['tk']) && !$this->admin_model->checkCookie($_COOKIE['tk'], time()))
        {
            redirect(base_url().'admin/home');
            die;
        }
        $data['error'] = $this->session->error;
        $data['title'] = 'Նույնականացում';
        $this->load->view('admin/login',$data);
        unset($data['error']);
        $this->session->unset_userdata('error');
    }
    public function home()
    {
        
        $this->check();
        $this->load->model('add_faculty_model');
        $data['title'] = 'Գլխավոր';
        $data['faculties'] = $this->global_model->getFaculties() ;
        $this->load->view('admin/home',$data);

    }
    public function chairs()
    {
        $this->check();
        $this->load->model('add_faculty_model');
        $data['title'] = 'Ավելացնել Ամբիոն';
        $data['faculties'] = $this->global_model->getFaculties();
        $data['chairs'] = $this->global_model->getChairs();
        $this->load->view('admin/chairs',$data);
    }
    private function check()
    {
        $this->admin_model->delExpiredTokens();
        if(empty($_COOKIE['tk']) || $this->admin_model->checkCookie($_COOKIE['tk'], time()))
        {
            redirect(base_url().'admin');
            die;
        }
    }
}
