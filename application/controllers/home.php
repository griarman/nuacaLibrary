<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
    }
    public function index()
    {
        $data['faculties'] = $this->home_model->getFaculties();
        foreach ($data['faculties'] as $key => $value)
        {
            $data['faculties'][$key]['chairs'] = $this->home_model->getcharts($value['id']);
        }
        $this->load->view('header', $data);
        $this->load->view('home');

    }
}