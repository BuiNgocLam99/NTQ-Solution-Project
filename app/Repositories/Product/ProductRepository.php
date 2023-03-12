<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function all()
    {
        return $this->product->all();
    }

    public function create(array $data)
    {
        return $this->product->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->product->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->product->find($id)->delete();
    }

    public function find($id)
    {
        return $this->product->find($id);
    }
}
