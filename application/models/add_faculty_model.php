<?php
/**
 * Created by PhpStorm.
 * User: grigo
 * Date: 22/04/2019
 * Time: 04:05
 */

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
}