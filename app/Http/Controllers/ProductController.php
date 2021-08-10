<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListRequest;
use App\Http\Requests\ProductCreateRequest;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(ListRequest $request) : ProductCollection
    {

        $perPage = $request->input('per_page', 10);

        $queryField =$request->input('queryField', null);
        $querySearch =$request->input('querySearch', null);

        $queries = [];
        if($queryField != null && $querySearch != null)
        {
            $queries[$queryField] = $querySearch;
        }
        $products = Product::sorter($perPage, $request->input('order_field'), $request->input('order_direction'), $queries);

        return new ProductCollection($products);
    }


    public function store(ProductCreateRequest $request) : ProductResource
    {


        $request->merge(['seller_id' => $request->user()->id]);
        $product = Product::create($request->input());

        $images = $request->input('images', []);

        foreach ($images as $image)
        {
            ProductImage::create(['product_id' => $product->id,
                'url' => $image]);

        }

        return new ProductResource($product);
    }

    public function show(Product  $product) : ProductResource
    {
        $product->updateCounter();
        return new ProductResource($product);
    }
}
