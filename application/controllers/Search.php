<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'globalTrait.php';

class Search extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('global_model');
        $this->load->model('search_model');
    }
    public function searchBySubject()
    {
        $id = addslashes(trim($this->input->post('id', true)));
        echo json_encode($this->search_model->searchBySubject($id));

    }
}