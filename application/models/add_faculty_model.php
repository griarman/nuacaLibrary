<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_faculty_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function checkFaculty($name)
    {
        return $this->db->get_where('faculty', ['name'=>$name])->num_rows();
    }
    public function addFaculty($name)
    {
        $data = ['name' => $name];
        $this->db->insert('faculty',$data);
        return $this->db->insert_id();
    }
    public function checkFacultyId($id)
    {
        return $this->db->get_where('faculty',['id' => $id])->num_rows();
    }
    public function checkFacultyName($id, $name)
    {
        return $this->db->get_where('faculty',['name' => $name, 'id!=' => $id])->num_rows();
    }
    public function delFaculty($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('faculty');
    }
    public function updFaculty($id, $name)
    {
        $this->db->set('name', $name);
        $this->db->where('id', $id);
        return $this->db->update('faculty');
    }
}