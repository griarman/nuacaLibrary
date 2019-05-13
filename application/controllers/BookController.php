<?php
require_once 'GlobalTrait.php';
class BookController extends CI_Controller
{
    use GlobalTrait;
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Yerevan');
        $this->load->model('add_book_model');
        $this->load->model('global_model');
    }
    public function addBook()
    {
        $name = addslashes(trim($this->input->post('name', true)));
        $author = addslashes(trim($this->input->post('author', true)));
        $desc = addslashes(trim($this->input->post('description', true)));
        $year = addslashes(trim($this->input->post('year', true)));
        $subjects = explode(',',addslashes(trim($this->input->post('subjects', true))));
        $keyWords = json_decode($this->input->post('keyWords', true),true);
        switch(false){
            case $this->regexp($name,'bookReg'):
            case $this->regexp($author,'bookReg'):
            case $this->regexp($desc,'bookReg'):
            case $this->regexp($year,'year'):
                echo 'error1';
                die;
        }
        foreach ($subjects as $value)
            if(!$this->regexp($value,'digits'))die('error1');
        foreach ($keyWords as $value)
            if(!$this->regexp($value,'bookReg'))die('error1');
        if(empty($file = $_FILES['file']) || $file['type'] !== 'application/pdf' || $file['error'])
            die('error2');
        $src = date('YmdHis').mt_rand().'.pdf';
        $data = [
            'name' => $name,
            'description' => $desc,
            'author' => $author,
            'dateOfRelease' => $year,
            'src' => $src
        ];
        if (!empty($img = $_FILES['image']) )
        {   $type = explode('/', $img['type']);
            if($type[0] === 'image') {
                $newSrc = date('YmdHis').mt_rand().'.'.$type[1];
                $data['image'] = $newSrc;
                move_uploaded_file($img['tmp_name'], './books/images/'.$newSrc);
            }
        }
        move_uploaded_file($file['tmp_name'], './books/'.$src);
        $bookId = $this->add_book_model->addBook($data);
        foreach ($keyWords as $value)
        {
            $keyWordId = ($this->add_book_model->checkWord($value))? $this->add_book_model->checkWord($value, 'id') :
                                                                     $this->add_book_model->addKeyWord(['keyword' => $value]);
            $this->add_book_model->addKeyBook(['bookId' => $bookId, 'keywordId' => $keyWordId]);
        }
    }
}