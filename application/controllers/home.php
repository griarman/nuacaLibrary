<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('global_model');
    }
    public function index()
    {
        $data['faculties'] = $this->global_model->getFaculties();
        foreach ($data['faculties'] as $key => $value)
        {
            $data['faculties'][$key]['chairs'] = $this->global_model->getChairs($value['id']);
            foreach ($data['faculties'][$key]['chairs'] as $k => $v)
            {
                $data['faculties'][$key]['chairs'][$k]['subjects'] = $this->global_model->getSubjects($v['id']);
            }
        }
        $this->load->view('header', $data);
        $this->load->view('home');
    }
}