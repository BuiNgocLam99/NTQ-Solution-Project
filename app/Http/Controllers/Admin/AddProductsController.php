<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use Illuminate\Http\Request;

class AddProductsController extends Controller
{
    public function index()
    {
        return view('admin.add_product');
    }

    public function submitForm(ProductFormRequest $request){
        $validatedData = $request->validated();

        $title = $validatedData->title;
        $description = $validatedData->description;
        $main_image = $validatedData->file('main_image');
        $gallery_images = $validatedData->file('gallery_images');
        return response()->json(['response' => compact('title', 'description', 'main_image', 'gallery_images')]);
    }
}
