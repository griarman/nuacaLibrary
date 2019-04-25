<?php

class FacultyController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('add_faculty_model');
    }
    public function addFaculty()
    {
        $name = addslashes(trim($this->input->post('newFaculty', true)));
        if(!$this->add_faculty_model->checkFaculty($name))
        {
            echo $this->add_faculty_model->addFaculty($name);
            die;
        }
        echo 'exists';
    }
    public function delFaculty()
    {
        $id = addslashes(trim($this->input->post('id', true)));
        if($this->add_faculty_model->checkFacultyId($id))
        {
            $this->add_faculty_model->delFaculty($id);
            die;
        }
        echo 'error';
    }
    public function updFaculty()
    {
        $id = addslashes(trim($this->input->post('id', true)));
        $name = addslashes(trim($this->input->post('name', true)));
        if($this->add_faculty_model->checkFacultyId($id))
        {
            if(!$this->add_faculty_model->checkFacultyName($id, $name))
            {
                echo $this->add_faculty_model->updFaculty($id, $name);
                die;
            }
            echo 'error1';
            die;
        }
        echo 'error';
    }

}