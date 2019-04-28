<?php


class ChairsController extends CI_Controller
{
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
//            echo $this->regexp($name);
//            die;
            echo 'error2';
            die;
        }
        elseif(!$this->add_chairs_model->checkChairId($facultyId))
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
    private function regexp($str, $type = 'name')
    {
        $regexp = [
            'name' => '/^[ա-ֆ\s]{4,150}$/i'
        ][$type];
//        echo $regexp;
        return preg_match($regexp, $str);
    }
}