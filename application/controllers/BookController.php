<?php

class BookController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('add_book_model');
        $this->load->model('global_model');
    }

}