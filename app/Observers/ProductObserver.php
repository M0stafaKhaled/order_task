<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{

    public function deleting($product)
    {
        if ($product->image) {
            $product->deleteImage($product->getRawOriginal('image'), Product::IMAGE_PATH);
        }
    }
}
