<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $category = Category::latest()->paginate(5);

        return new CategoryResource(true, 'List Data Category', $category);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'=>'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $category = Category::create([
            'name'   => $request->name,
        ]);

        //return response
        return new CategoryResource(true, 'Data Category Berhasil Ditambahkan!', $category);
    }

    public function show(Category $category)
    {
        return new CategoryResource(true, 'Data Category ditemukan', $category);
    }

    public function update(Request $request, Category $category)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

       
            $category->update([
                'name'     => $request->name,
            ]);
        

        //return response
        return new CategoryResource(true, 'Data Category Berhasil Diubah!', $category);
    }

    public function destroy(Category $category)
    {
        //delete post
        $category->delete();

        //return response
        return new CategoryResource(true, 'Data Category Berhasil Dihapus!', null);
    }

}
