<?php
/**
 * Created by PhpStorm.
 * User: grigo
 * Date: 23/04/2019
 * Time: 02:22
 */

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
}