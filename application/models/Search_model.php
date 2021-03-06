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
        $arr = $this->getIdsBySubjectId($id);
        $books = [];
        foreach ($arr as $key => $value) {
            $books[] = $this->getBookInfo($value['bookId'])[0];
        }
        return $books;
    }

    public function getAllBooks()
    {
        $books = $this->getBookInfo();
     /*   echo '<pre>';
        print_r($books);
        die;*/
        foreach ($books as $key => $value) {
            $id = $this->getSubjectIds($value['id']);
//            echo '<pre>';
//            print_r($id);continue;
            foreach ($id as $k => $v)
                $id[$k] = $v['subjectId'];
            $subjects = $this->getSubjectsName(array_unique($id));
            $books[$key]['subjects'] = $subjects;
        }
//           echo '<pre>';
//        print_r($books);
//        die;
        return array_reverse($books);
    }

    private function getSubjectsName($id)
    {
        $this->db->where_in('id', $id);
        return $this->db->get('subject')->result_array();
    }

    private function getSubjectIds($id)
    {
//        $this->db->where(['bookId', $id]);
//        $this->db->select('subjectId');
//        $this->db->from('subjectbook');
        return $this->db->query("SELECT subjectId FROM subjectbook WHERE bookId= $id")->result_array();
    }

    private function getBookInfo($id = null)
    {
        return $id ? $this->db->get_where('books', ['id' => $id])->result_array() : $this->db->get('books')->result_array();
    }
    public function getIdsBySubjectId($id)
    {
        return $this->db->get_where('subjectbook', ['subjectId' => $id])->result_array();
    }
    public function getBooksWhere($where)
    {
        $this->db->where($where);
        return $this->db->get('books')->result_array();
    }
    public function getBooksQuery($query)
    {
        return $this->db->query($query)->result_array();
    }


}