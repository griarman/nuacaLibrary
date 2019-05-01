<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_subject_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function addSubject($name, $chairId)
    {
        $data = ['name' => $name, 'chairId' => $chairId];
        $this->db->insert('subject',$data);
        return $this->db->insert_id();
    }
    public function checkSubject($name)
    {
        return $this->db->get_where('subject', ['name' => $name])->num_rows();
    }
    public function checkChairId($id)
    {
        return $this->db->get_where('chairs',['id' => $id])->num_rows();
    }
    public function checkSubjectName($id, $name)
    {
        return $this->db->get_where('subject',['name' => $name, 'id!=' => $id])->num_rows();
    }
    public function delSubject($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('subject');
    }
    public function updSubject($id, $name)
    {
        $this->db->set('name', $name);
        $this->db->where('id', $id);
        return $this->db->update('subject');
    }
}