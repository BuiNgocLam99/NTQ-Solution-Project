<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'description' => 'required|string',
            'short_description' => 'required|max:100',
            'main_image' => 'required|mimes:jpeg,jpg,png,gif|max:4000',
            'gallery_images.*' => 'required|mimes:jpeg,png,gif|max:4000',
            'product_tags' => 'required',
            'product_categories' => 'required',

            // General Info
            'manufacturer_name' => 'required',
            'manufacturer_brand' => 'required',
            'stocks' => 'required|min:1|numeric',
            'price' => 'required|min:1|numeric',
            'discount' => 'nullable',
            'orders' => 'nullable',

            // Meta Data
            'meta_title' => 'required|string',
            'meta_keywords' => 'required|string',
            'meta_description' => 'required|string',

            // Publish
            'status' => Rule::in(['Published', 'Scheduled', 'Draft']),
            'visibility' => Rule::in(['Public', 'Hidden']),
            'publish_date_time' => 'date_format:d-m-Y'
        ];
    }
}
