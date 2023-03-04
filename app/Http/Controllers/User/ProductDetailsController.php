<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductDetailsController extends Controller
{
    public function index()
    {
        return view('user.product-details');
    }

    public function fetch(Request $request)
    {
        $data = $request->all();
		$var = [
			'purple' => [
				'price' => 23,
				'orders' => 2000,
				'revenue' => 789798,
				'images' => [
                    '/assets/images/products/img-5.png',
                ],
				'size' => [
					's' => [
						'stocks' => 5,
						'price' => 24,
					],
					'm' => [
						'stocks' => 5,
					],
					'l' => [
						'stocks' => 5,
					],
				]
			],
			'blue' => [
				'price' => 22,
				'orders' => 2030,
				'revenue' => 55555,
				'images' => [
                    '/assets/images/products/img-6.png',
                ],
				'size' => [
					's' => [
						'stocks' => 5,

					],
					'm' => [
						'stocks' => 5,
						'price' => 24,
					],
					'l' => [
						'stocks' => 5,
						'price' => 24,
					],
				]
            ],
		];

		$response = array_merge([
			'price' => 0,
			'orders' => 0,
			'revenue' => 0,
			'images' => [],
			'stocks' => 0
		], $var[strtolower($data['color'])] ?? []);

		$size = !empty($var[strtolower($data['color'])]['size'][strtolower($data['size'])]) ? $var[strtolower($data['color'])]['size'][strtolower($data['size'])] : [];
		$response = array_merge($response, $size);
		unset($response['size']);
		return $response;
    }
}
