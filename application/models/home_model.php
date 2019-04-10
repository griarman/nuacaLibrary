<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Home_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    public function getFaculties()
    {
        return $this->db->get('faculty')->result_array();
    }
    public function getCharts($id = null)
    {

        return $this->db->get_where('chairs',['facultyId' => $id])->result_array();
    }
}
