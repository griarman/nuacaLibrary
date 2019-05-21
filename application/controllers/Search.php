<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'globalTrait.php';

class Search extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('global_model');
        $this->load->model('search_model');
    }
    public function searchBySubject()
    {
        $id = addslashes(trim($this->input->post('id', true)));
        echo json_encode($this->search_model->searchBySubject($id));
    }
    public function getAllBooks()
    {
        echo json_encode($this->search_model->getAllBooks());
    }
    public function advancedSearch()
    {
        $bookName = addslashes(trim($this->input->post('bookName', true)))?: null;
        $bookName = $bookName ?  preg_replace('/\s+/',' ',$bookName ): null;
        $authorName = addslashes(trim($this->input->post('authorName', true)))?: null;
        $authorName = $authorName ? preg_replace('/\s+/',' ',$authorName ): null;
        $releaseDate = addslashes(trim($this->input->post('releaseDate', true)))?: null;
        $subjectSel = addslashes(trim($this->input->post('subjectSel', true)))?: null;
        if(empty($bookName) && empty($authorName) && empty($releaseDate) && empty($subjectSel)){
            echo json_encode('error1');
            die;
        }
        !$subjectSel ?: $ids = $this->search_model->getIdsBySubjectId($subjectSel);
        $dateText =  $releaseDate ? "dateOfRelease = $releaseDate" : '';
        $idText = '';
        if(!empty($ids)){
            foreach ($ids as $key => $value)
                $ids[$key] = $value['bookId'];
            $idText = 'id IN('.implode(',', $ids).')';
        }
        $nameText = $bookName ? "name LIKE '%{$bookName}%'" : '';
        $authorText = $authorName ? "author LIKE '%{$authorName}%'" : '';
        $data = array_filter([$idText, $nameText, $authorText, $dateText], function ($v){
            return !empty($v);
        });
        if (empty($data)){
            echo json_encode([]);
            die;
        }
        $where = implode(' AND ', $data);
        echo json_encode($this->search_model->getBooksWhere($where));
    }
    public function simpleSearch()
    {
        $text = addslashes(trim($this->input->post('text', true)));
        if(empty($text)){
            echo json_encode('error');
            die;
        }
        $text = !$text ?:  preg_replace('/\s+/',' ',$text);
        $arr = explode(' ', $text);

        foreach($arr as $key => $value)
            $arr[$key] = "keyword LIKE '%{$value}%'";

        $where = implode(' OR ', $arr);
        $select = "SELECT * FROM `books` WHERE name LIKE '%$text%' OR id IN (SELECT bookId FROM keywords,keywordbook WHERE keywords.id = keywordId AND ($where))";
        echo json_encode($this->search_model->getBooksQuery($select));

    }
}