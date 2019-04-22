<?php

class add_faculty_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getFaculties()
    {
        return $this->db->get('faculty')->result_array();
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