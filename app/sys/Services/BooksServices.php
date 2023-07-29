<?php

namespace App\sys\Services;

use App\sys\Repository\BooksRepository;
use App\sys\Services;
use Validator;

class BooksServices extends Services
{

    // connected With BookRepo
    private $bookRepo;
    public function __construct()
    {
        $this->bookRepo = new BooksRepository();
    }

    public function add($data)
    {
        // Valid
        $rules = [
            'title' => 'required|string|unique:books,title',
            'author' => 'required|string',
            'publication_date' => 'required|date',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            $this->setError($validator->errors());
            return false;
        }

        if ($this->bookRepo->create($data))
            return true;

        $this->setError(['ooh ..! Please try again']);
        return false;
    }
    public function updated($data)
    {
        // Valid
        if($check = $this->getById($data['id']))
        {
            $rules = [
                'title' => 'required|string|unique:books,title,' . $data['id'] . ',id',
                'author' => 'required|string',
                'publication_date' => 'required|date',
            ];

            $validator = Validator::make($data, $rules);

            if ($validator->fails()) {
                $this->setError($validator->errors());
                return false;
            }

            if ($this->bookRepo->updated($data))
                return true;

            $this->setError(['ooh ..! Please try again']);
            return false;
        }
        $this->setError(['ooh ..! Not Found ']);
        return false;
    }

    public function getById($id)
    {
        $book = $this->bookRepo->getBy($id);

        if(!empty($book))
            return $book;


        $this->setError(['ooh ..! Not Found']);
        return  false;
    }

    public function get()
    {
        return $this->bookRepo->get();
    }

    public function destroy($id){
        if($book = $this->getById($id))
            return $this->bookRepo->destroy($id);


        $this->setError(['ooh ..! Not Found']);
        return  false;
    }
}
