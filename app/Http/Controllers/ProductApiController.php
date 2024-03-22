<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductApiRequest;
use App\Http\Requests\UpdateProductApiRequest;
use App\Repositories\Api\interfaces\ProductApiInterface;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    use ResponseTrait;

    protected $productApiRepository;

    public function __construct(ProductApiInterface $productApiRepository)
    {
        $this->middleware('auth:api');
        $this->productApiRepository = $productApiRepository;
    }

    public function index()
    {
        $products = $this->productApiRepository->index();
        return $this->makeResponse($products, 'Products fetched successfully', 200);
    }

    public function show($id)
    {
        $product = $this->productApiRepository->show($id);
        return $this->makeResponse($product, 'Product fetched successfully', 200);
    }

    public function store(CreateProductApiRequest $request)
    {
        $product = $this->productApiRepository->store($request);
        return $this->makeResponse($product, 'Product created successfully', 200);
    }

    public function update(UpdateProductApiRequest $request, $id)
    {
        $product = $this->productApiRepository->update($request, $id);
        return $this->makeResponse($product, 'Product updated successfully', 200);
    }

    public function destroy($id)
    {
        $this->productApiRepository->destroy($id);
        return $this->makeResponse([], 'Product deleted successfully', 200);
    }

}
