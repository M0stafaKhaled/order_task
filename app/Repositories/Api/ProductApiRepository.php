<?php

namespace App\Repositories\Api;

use App\Exceptions\GeneralJsonException;
use App\Models\Product;
use App\Repositories\Api\interfaces\ProductApiInterface;
use App\Traits\ImageTrait;
use App\Traits\PaginationTrait;

class ProductApiRepository implements ProductApiInterface
{
    use PaginationTrait, ImageTrait;

    public function index()
    {
        $products = Product::query();
        return $this->pagination($products, class_basename($products->getModel()) . 's');
    }

    /**
     * @throws GeneralJsonException
     */
    public function show($id)
    {
        return $this->getProduct($id);
    }

    public function store($request)
    {
        $data = $request->except(['_token', 'image']);
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'), Product::IMAGE_PATH);
        }
        $product = Product::create($data);
        return $product;
    }

    public function update($request, $id)
    {
        $product = $this->getProduct($id);

        $data = $request->except(['_token', '_method', 'image']);
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'), Product::IMAGE_PATH, $product->getRawOriginal('image'));
        }
        $product->update($data);
        $product->refresh();
        return $product;
    }

    public function destroy($id)
    {
        $product = $this->getProduct($id);
        // be aware that this will delete the image from the storage by the observer
        $product->delete();
        return $product;
    }

    /**
     * @throws GeneralJsonException
     */
    private function getProduct($id): Product
    {
        $product = Product::find($id);
        if (!$product) {
            throw new GeneralJsonException('Product Not Found' , 404);
        }
        return $product;
    }
}
