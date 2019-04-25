<?php


class ChairsController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('add_chairs_model');
    }

}