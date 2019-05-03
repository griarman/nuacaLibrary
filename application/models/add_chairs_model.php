<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_chairs_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function addChair($name, $facultyId)
    {
        $data = ['name' => $name, 'facultyId' => $facultyId];
        $this->db->insert('chairs',$data);
        return $this->db->insert_id();
    }
    public function checkChair($name)
    {
        return $this->db->get_where('chairs', ['name' => $name])->num_rows();
    }
    public function checkChairId($id)
    {
        return $this->db->get_where('chairs',['id' => $id])->num_rows();
    }
    public function checkFacultyId($id)
    {
        return $this->db->get_where('faculty',['id' => $id])->num_rows();
    }
    public function checkChairName($id, $name)
    {
        return $this->db->get_where('chairs',['name' => $name, 'id!=' => $id])->num_rows();
    }
    public function delChair($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('chairs');
    }
    public function updChair($id, $name)
    {
        $this->db->set('name', $name);
        $this->db->where('id', $id);
        return $this->db->update('chairs');
    }
}