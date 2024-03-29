<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Course;
use App\Models\Course_goal;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CourseController extends Controller
{
    public function AllCourse(){

        $id = Auth::user()->id;
        $courses = Course::where('instructor_id',$id)->orderBy('id','desc')->get();
        return view('instructor.courses.all_course',compact('courses'));

    }//end
    public function AddCourse(){

        $categories = Category::latest()->get();
        return view('instructor.courses.add_course',compact('categories'));

    }//end
    
    public function GetSubcategory($category_id){

        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name','ASC')->get();
        return json_encode($subcat);

    }//end



}
