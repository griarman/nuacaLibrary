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
        $this->load->model('global_model');
    }
    public function addSubject()
    {
        $subject = addslashes(trim($this->input->post('subject', true)));
        $chairId = addslashes(trim($this->input->post('chairId', true)));
//        $arr = ['ա','բ','գ','դ','ե','զ','է','ը','թ','ժ','ի','լ','խ','ծ','կ','հ','ձ','ղ','ճ','մ','յ',
//            'ն','շ','ո','չ','պ','ջ','ռ','ս','վ','տ','ր','ց','ու','փ','ք','և','օ','ֆ'];
//        $arr1 = ['Ա','Բ','Գ','Դ','Ե','Զ','Է','Ը','Թ','Ժ','Ի','Լ','Խ','Ծ','Կ','Հ','Ձ','Ղ','Ճ','Մ','Յ',
//            'Ն','Շ','Ո','Չ','Պ','Ջ','Ռ','Ս','Վ','Տ','Ր','Ց','ՈՒ','Փ','Ք','և','Օ','Ֆ'];
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
            $id = $this->add_subject_model->addSubject($subject, $chairId);
            $fullInfo = $this->global_model->getFullInformation($id)[0];
            $fullInfo['id'] = $id;
            echo json_encode($fullInfo);
            die;
        }
        echo 'exists';
    }
    public function searchSubjects()
    {
        $text = addslashes(trim($this->input->post('text', true)));
        if(!$this->regexp($text, 'search')){
            echo 'error';
            die;
        }
        $subjects = $this->global_model->getSubjectsByName($text);
        foreach ($subjects as $key => $value)
        {
            $subjects[$key]['parents'] = $this->global_model->getFullInformation($value['id'])[0];
        }
        echo json_encode($subjects);
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