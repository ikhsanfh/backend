<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    //
    public function index()
    {
        $book = Book::latest()->paginate(5);

        return new BookResource(true, 'List Data Book', $book);
    }
    
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'title'=>'required',
            'description'=>'required',
            'image_url'=>'required',
            'release_year'=>'required',
            'price'=>'required',
            'total_page'=>'required',
            'category_id'=>'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $book = Book::create([
            'title'   => $request->title,
            'description'   => $request->description,
            'image_url'   => $request->image_url,
            'release_year'   => $request->release_year,
            'price'   => $request->price,
            'total_page'   => $request->total_page,
            'category_id'   => $request->category_id,
        ]);

        //return response
        return new BookResource(true, 'Data Book Berhasil Ditambahkan!', $book);
    }

    public function show(Book $book)
    {
        return new BookResource(true, 'Data Book ditemukan', $book);
    }
    
    public function update(Request $request, Book $book)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'title'=>'required',
            'description'=>'required',
            'image_url'=>'required',
            'release_year'=>'required',
            'price'=>'required',
            'total_page'=>'required',
            'category_id'=>'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

       
            $book->update([
            'title'   => $request->title,
            'description'   => $request->description,
            'image_url'   => $request->image_url,
            'release_year'   => $request->release_year,
            'price'   => $request->price,
            'total_page'   => $request->total_page,
            'category_id'   => $request->category_id,
            ]);
        

        //return response
        return new BookResource(true, 'Data buku Berhasil Diubah!', $book);
    }

    public function destroy(Book $book)
    {
        //delete post
        $book->delete();

        //return response
        return new BookResource(true, 'Data buku Berhasil Dihapus!', null);
    }

}
