<?php

class Search_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('global_model');
    }
    public function searchBySubject($id = null)
    {
        $arr = $this->db->get_where('subjectbook',['subjectId' => $id])->result_array() ;
        $books = [];
        foreach ($arr as $key => $value)
        {
            $books[] = $this->getBookInfo($value['bookId'])[0];
        }
        return $books;
    }
    private function getBookInfo($id)
    {
        return $this->db->get_where('books',['id' => $id])->result_array();
    }

}