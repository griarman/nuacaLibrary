<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'globalTrait.php';

class ChairsController extends CI_Controller
{
    use GlobalTrait;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('add_chairs_model');
    }
    public function addChair()
    {
        $name = addslashes(trim($this->input->post('name', true)));
        $facultyId = addslashes(trim($this->input->post('facultyId', true)));
        if(!$this->regexp($name)){
            echo 'error2';
            die;
        }
        elseif(!$this->add_chairs_model->checkFacultyId($facultyId))
        {
            echo 'error1';
            die;
        }
        if(!$this->add_chairs_model->checkChair($name))
        {
            echo $this->add_chairs_model->addChair($name, $facultyId);
            die;
        }
        echo 'exists';
    }
    public function updChair()
    {
        $id = addslashes(trim($this->input->post('id', true)));
        $name = addslashes(trim($this->input->post('name', true)));
        if($this->add_chairs_model->checkChairId($id))
        {
            if(!$this->add_chairs_model->checkChairName($id, $name))
            {
                if(!$this->regexp($name)){
                    echo 'error2';
                    die;
                }
                echo $this->add_chairs_model->updChair($id, $name);
                die;
            }
            echo 'error1';
            die;
        }
        echo 'error';
    }
    public function delChair()
    {
        $id = addslashes(trim($this->input->post('id', true)));
        if($this->add_chairs_model->checkChairId($id))
        {
            $this->add_chairs_model->delChair($id);
            die;
        }
        echo 'error';
    }
}