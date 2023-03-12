<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Str;

class AddProductsController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.add_product', compact('categories'));
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:products',
            'description' => 'required|string',
            'main_image' => 'required|mimes:jpeg,jpg,png,gif|max:4000',
            'gallery_images.*' => 'image|mimes:jpeg,jpg,png,gif|max:4000',
            'gallery_images' => 'required|array',
            'categories_id' => 'required|numeric',
        ]);

        $slug = Str::slug($request->title);

        $main_image_url = Cloudinary::upload($request->file('main_image')->getRealPath())->getSecurePath();

        $gallery_image_urls = [];
        foreach ($request->file('gallery_images') as $image) {
            $uploaded = Cloudinary::upload($image->getRealPath())->getSecurePath();
            array_push($gallery_image_urls, $uploaded);
        }

        Product::create([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'main_image' => $main_image_url,
            'gallery_images' => json_encode($gallery_image_urls),
            'category_id' => $request->categories_id,
        ]);

        return response()->json(['success_message' => 'Product have created successfully!']);
    }
}
