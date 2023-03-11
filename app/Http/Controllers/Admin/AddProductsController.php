<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Str;

class AddProductsController extends Controller
{
    public function index()
    {
        return view('admin.add_product');
    }

    public function submitForm(Request $request){
        // $validatedData = $request->validated();

        // $slug = Str::slug($request->title);
        // $uploadedFileUrl = Cloudinary::upload($request->file('main_image')->getRealPath())->getSecurePath();

        $gallery_images = $request->gallery_images;
        foreach ($gallery_images as $images) {
            
        }

        // Product::create([
        //     'title' => $validatedData->title,
        //     'slug' => $slug,
        //     'description' => $validatedData->description,
        //     'short_description' => $validatedData->short_description,
        //     'main_image' => $uploadedFileUrl,
        //     'gallery_images' => $validatedData->,
        //     'product_tags' => $validatedData->,
        // ]);

        return response()->json(['response' => compact('title', 'description', 'main_image', 'gallery_images')]);
    }
}
