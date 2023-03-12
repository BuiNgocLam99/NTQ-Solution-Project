<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Repositories\Category\CategoryRepositoryInterface;


class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->all();
        return view('admin.category.list', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:categories',
            ]
        );

        $slug = Str::slug($request->name);
        $checkSlug = Category::where('slug', $slug)->first();
        while ($checkSlug) {
            $slug = $checkSlug->slug .  Str::random(2);
        }

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'slug' => $slug,
        ];

        $this->categoryRepository->create($data);

        return response()->json([
            'success_message' => 'Category have created successfully!',
        ]);
    }

    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $old_category = $this->categoryRepository->find($id);

        if ($old_category->name != $request->name) {
            $this->validate(
                $request,
                [
                    'name' => 'required|unique:categories',
                ]
            );

            $slug = Str::slug($request->name);
            $checkSlug = Category::where('slug', $slug)->first();
            while ($checkSlug) {
                $slug = $checkSlug->slug . Str::random(2);
            }

            $data = [
                'name' => $request->name,
                'slug' => $slug,
                'description' => $request->description,
            ];

            $this->categoryRepository->update($id, $data);
        }

        $data = [
            'description' => $request->description,
        ];

        $this->categoryRepository->update($id, $data);
        
        return response()->json([
            'success_message' => 'Category have updated successfully!',
        ]);
    }

    public function delete($id)
    {
        $this->categoryRepository->delete($id);
        return response()->json([
            'success_message' => 'Delete Successfully',
        ]);
    }
}
 