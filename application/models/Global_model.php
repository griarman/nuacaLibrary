<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Global_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getFaculties()
    {
        return $this->db->get('faculty')->result_array();
    }
    public function getChairs($facultyId = NULL)
    {
        return ($facultyId)? $this->db->get_where('chairs',['facultyId' => $facultyId])->result_array() :$this->db->get('chairs')->result_array();
    }
    public function getSubjects($chairId = null)
    {
        return ($chairId)? $this->db->get_where('subject',['chairId' => $chairId])->result_array() : $this->db->get('subject')->result_array();
    }
    public function getSubjectsByName($name = '')
    {
        $this->db->like('name', $name);
        return $this->db->get('subject')->result_array();
    }
    public function getFullInformation($subjectId = NULL)
    {
        $query = $subjectId ? "SELECT faculty.name as fName,chairs.name as cName FROM `subject`, faculty, chairs WHERE faculty.id = chairs.facultyId AND chairs.id = subject.chairId AND subject.id=$subjectId" :
                              "SELECT faculty.name as fName,chairs.name as cName FROM `subject`, faculty, chairs WHERE faculty.id = chairs.facultyId AND chairs.id = subject.chairId";
        return $this->db->query($query)->result_array();
    }
}
