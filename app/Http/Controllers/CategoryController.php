<?php

namespace App\Http\Controllers;


use App\Http\Requests\CategoryCreateRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ErrorResource;
use App\Models\Category;
use CreateCategoriesTable;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Returns all the categories and it's subcategories
     * @return CategoryCollection
     */
    public function index()
    {

        $categories = Category::whereNull('parent_id')->get();
        return new CategoryCollection($categories);

    }


    /**
     * Returns  a category, it's subcategories and a paginable collection of Products
     * @param Request $request
     * @param Category $category
     * @return CategoryResource
     */
    public function show(Request  $request, Category  $category) :CategoryResource
    {

        $perPage = $request->input('per_page', 10);
        $products = $category->products()->paginate($perPage);


        return new CategoryResource($category);
    }

    /**
     * Creates a new Category if request passes the CategoryCreateRequest validations
     * @param CategoryCreateRequest $request
     * @return CategoryResource
     */
    public function store(CategoryCreateRequest $request):CategoryResource
    {

        $category = Category::create($request->all());

        if($category->id == $category->parent_id)
        {
            $category->parent_id = null;
            $category->save();
        }
        return new CategoryResource($category);

    }

    /**
     * Transfer all the products in Category $source to Category $destination
     * @param Category $source The category holding the products
     * @param Category $destination The category that will receive the products
     * @return CategoryResource
     */
    public function transfer(Category $source, Category $destination) : CategoryResource
    {
        $source->products()->update(['category_id' => $destination->id]);

        return new CategoryResource($destination);
    }


    public function delete(Category  $category)
    {


        if($category->products()->count() > 0)
        {
            return new ErrorResource(['message' => 'A category must be empty for it to be deleted']);
        }
    }



}
