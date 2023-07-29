<?php

namespace App\sys\Repository;

use App\sys\Model\Books;

class BooksRepository
{
    private $book;

    public function __construct()
    {
        $this->book = new Books();
    }

    public function create($data)
    {
        if($this->book->create($data))
            return true;

        return  false;
    }

    public function updated($data)
    {
        $book = $this->book->find($data['id']);
        $book->title = $data['title'];
        $book->author = $data['author'];
        $book->publication_date = $data['publication_date'];
        return $book->save();
    }

    public function getBy($id)
    {
        return $this->book->find($id);
    }

    public function get()
    {
       return $this->book->orderBy('publication_date', 'desc')->paginate(10);
    }

    public function destroy($id){
        $book = $this->book->findOrFail($id);
        return $book->delete();
    }

}
