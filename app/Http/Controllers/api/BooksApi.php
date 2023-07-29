<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\sys\ApiResponse;
use App\sys\Services\BooksServices;
use Illuminate\Http\Request;

class BooksApi extends Controller
{
    use ApiResponse;

    private $books;

    public function __construct()
    {
        $this->books = new BooksServices();
    }

    public function index()
    {
        // get Data
        $books = $this->books->get();
        // response
        return $this->apiResponse(200, 'All Books', null, $books);
    }

    public function create(Request $request)
    {
        if ($this->books->add($request->all()))
            return $this->apiResponse(200, 'added successful', null, []);


        $errors = $this->books->errors();
        return $this->apiResponse(201, 'Have Errors', $errors, null);
    }

    public function update(Request $request)
    {
        if ($this->books->updated($request->all()))
            return $this->apiResponse(200, 'updated successful', null, []);


        $errors = $this->books->errors();
        return $this->apiResponse(201, 'Have Errors', $errors, null);
    }

    public function getByid($id = 0)
    {
        if ($book = $this->books->getById($id))
            return $this->apiResponse(200, 'get book Details', null, $book);


        $errors = $this->books->errors();
        return $this->apiResponse(201, 'Have Errors', $errors, null);

    }

    public function destroy($id = 0)
    {
        if($this->books->destroy($id))
            return $this->apiResponse(200, 'book Is Deleted', null, []);


        $errors = $this->books->errors();
        return $this->apiResponse(201, 'Have Errors', $errors, null);
    }


}
