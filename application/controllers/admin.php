<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
        $this->correct(__FUNCTION__,func_get_args());
        $this->check();
        $this->load->model('add_faculty_model');
        $data['title'] = 'Գլխավոր';
        $data['faculties'] = $this->global_model->getFaculties() ;
        $this->load->view('admin/home',$data);
    }
    public function chairs()
    {
        $this->correct(__FUNCTION__,func_get_args());
        $this->check();
        $this->load->model('add_faculty_model');
        $data['title'] = 'Ավելացնել Ամբիոն';
        $data['faculties'] = $this->global_model->getFaculties();
        foreach ($data['faculties'] as $key => $value)
        {
            $data['faculties'][$key]['chairs'] = (!empty($chairs = $this->global_model->getChairs($value['id'])))? $chairs: [];
        }
        $this->load->view('admin/chairs',$data);
    }
    public function subject()
    {
        $this->correct(__FUNCTION__,func_get_args());
        $this->check();
        $this->load->model('add_subject_model');
        $data['title'] = 'Ավելացնել Առարկա';
        $data['subjects'] = $this->global_model->getSubjects();
        $data['chairs'] = $this->global_model->getChairs();
        foreach ($data['subjects'] as $key => $value)
        {
            $data['subjects'][$key]['parents'] = $this->global_model->getFullInformation($value['id'])[0];
        }
        $this->load->view('admin/subject',$data);
    }
    public function books()
    {
        $this->correct(__FUNCTION__,func_get_args());
        $this->check();
        $this->load->model('add_book_model');
        $data['subjects'] = $this->global_model->getSubjects();
        $data['title'] = 'Ավելացնել Գիրք';
        $this->load->view('admin/books',$data);
    }
    private function correct($name, $arr)
    {
        if(!empty($arr)){
            redirect(base_url()."admin/$name");
            die;
        }
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
    public function exit()
    {
        $this->admin_model->delCookie($_COOKIE['tk']);
        setcookie('tk','',1,'/');
        redirect(base_url().'admin');
    }
}
