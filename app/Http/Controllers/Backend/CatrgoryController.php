<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CatrgoryController extends Controller
{
    public function AllCategory(){

        $category = Category::latest()->get();
        return view("admin.backend.category.all_category",compact("category"));
    }   //end

    public function AddCategory(){
        return view("admin.backend.category.add_category");
    }
}
