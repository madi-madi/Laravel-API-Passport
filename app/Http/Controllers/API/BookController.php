<?php

namespace App\Http\Controllers\API;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
class BookController extends BaseController
{


    public function index()
    {
        $books = Book::all(); //all
        return $this->sendResponse($books->toArray(),'Books read successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // store create
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'name'=>'required',
            'details'=>'required',
        ]);

        if ($validator->fails()) {
            return $this->sendErrorResponse('error validation',$validator->errors());
        }
        
        $book = Book::create($input);
        return $this->sendResponse($book->toArray(),'Book  create success ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        if (is_null($book)) {
            return $this->sendErrorResponse('Book not found !');
        }
        return $this->sendResponse($book->toArray(),'Book read successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request ,Book $book)
    {
        $input = $request->all();
        // return request()->all();
        $validator = 
        Validator::make($input,[
            'name'=>'required',
            'details'=>'required',
        ]);

        if ($validator->fails()) {
            return $this->sendErrorResponse('error validation',$validator->errors());
        }
        
        // $book = Book::where('id',$id)->update($input); //return id 
        $book->name = $input['name'];
        $book->details = $input['details'];
        $book->save();

        return $this->sendResponse($book->toArray(),'Book  update success ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        if (is_null($book)) {
            sendErrorResponse('Book not found !');
        }
        $book->delete();
        return $this->sendResponse($book->toArray(),'Book delete successfully');
    }
}
