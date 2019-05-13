<?php

class add_book_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function addBook($data)
    {
        $this->db->insert('books', $data);
        return $this->db->insert_id();
    }
    public function checkWord($word, $info = 'count')
    {
        $result = $this->db->get_where('keywords', ['keyword' => $word]);
        return ($info === 'count')? $result->num_rows(): $result->result_array()[0];
    }
    public function addKeyWord($data)
    {
        $this->db->insert('keywords', $data);
        return $this->db->insert_id();
    }
    public function addKeyBook($data)
    {
        $this->db->insert('keywordbook', $data);
    }
}