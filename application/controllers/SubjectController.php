<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'globalTrait.php';

class SubjectController extends CI_Controller
{
    use globalTrait;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('add_subject_model');
    }
    public function addSubject()
    {
        $subject = addslashes(trim($this->input->post('subject', true)));
        $chairId = addslashes(trim($this->input->post('chairId', true)));
        if(!$this->regexp($subject)){
            echo 'error2';
            die;
        }
        elseif(!$this->add_subject_model->checkChairId($chairId))
        {
            echo 'error1';
            die;
        }
        if(!$this->add_subject_model->checkSubject($subject))
        {
            echo $this->add_subject_model->addSubject($subject, $chairId);
            die;
        }
        echo 'exists';
    }
    public function updSubject()
    {
        $id = addslashes(trim($this->input->post('id', true)));
        $name = addslashes(trim($this->input->post('name', true)));
        if($this->add_subject_model->checkSubjectId($id))
        {
            if(!$this->add_subject_model->checkSubjectName($id, $name))
            {
                if(!$this->regexp($name)){
                    echo 'error2';
                    die;
                }
                echo $this->add_subject_model->updSubject($id, $name);
                die;
            }
            echo 'error1';
            die;
        }
        echo 'error';
    }
    public function delSubject()
    {
        $id = addslashes(trim($this->input->post('id', true)));
        if($this->add_subject_model->checkSubjectId($id))
        {
            $this->add_subject_model->delSubject($id);
            die;
        }
        echo 'error';
    }

}