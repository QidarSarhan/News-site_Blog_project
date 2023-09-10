<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{

    public function index() 
    {
        $categories = Category::paginate(2);
        return CategoryResource::collection($categories);

    }

    public function navbarCategories() 
    {
        $categories = Category::with('children')->where('parent' , 0)->orWhere('parent' , null)->get();
        // return CategoryResource::collection($categories);
        return new CategoryCollection($categories);
    }

    public function  indexPageCategoriesWithPost() 
    {
        $categories_with_posts = Category::with(['posts'=>function ($q){
            $q->with('category')->limit(5);
        }])->get();

        return new CategoryCollection ($categories_with_posts);
    }

    public function show($id) 
    {
        $category = Category::where('id',$id)->firstOrFail();
        return CategoryResource::make($category);

    }
}
