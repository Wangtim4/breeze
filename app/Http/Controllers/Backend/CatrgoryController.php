<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CatrgoryController extends Controller
{
    public function AllCategory(){

        $category = Category::latest()->get();
        return view("admin.backend.category.all_category",compact("category"));
    }   //end

    public function AddCategory(){
        return view("admin.backend.category.add_category");
    }

    public function StoreCategory(Request $request){
        if($request->file("image")){
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$request->file('image')->getClientOriginalExtension();
            $img = $manager->read($request->file("image"));
            $img = $img->resize(370,246);
            
            $img->toJpeg(80)->save(base_path('public/upload/category/'.$name_gen));
            $save_url = 'upload/category/'.$name_gen;

             Category::insert([
            'category_name'=> $request->category_name,
            'category_slug'=> strtolower(str_replace(' ','-',$request->category_name)),
            'image' => $save_url,
            // 需去php.ini改extension=gd 才可使用
        ]);
        }

        // $image = $request->file("image");
        // $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        // Image::make($image)->resize(370,246)->save('upload/category/'.$name_gen);
        // $save_url = 'upload/category/'.$name_gen;

        // Category::insert([
        //     'category_name'=> $request->category_name,
        //     'category_slug'=> strtolower(str_replace(' ','-',$request->category_name)),
        //     'image' => $save_url,
        // ]);

        $notification = array(
            'message'=> 'Category Inserted Successfully',
            'alert-type'=> 'success',
        );
        return redirect()->route('all.category')->with($notification);
    }//END

    public function EditCategory($id) {

        $category = Category::find($id);
        return view('admin.backend.category.edit_category',compact('category'));
    }//END

    
    public function UpdateCategory(Request $request) {

        $category_id = $request->id;

        if($request->file("image")){
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$request->file('image')->getClientOriginalExtension();
            $img = $manager->read($request->file("image"));
            $img = $img->resize(370,246);
            
            $img->toJpeg(80)->save(base_path('public/upload/category/'.$name_gen));
            $save_url = 'upload/category/'.$name_gen;

             Category::find($category_id)->update([
            'category_name'=> $request->category_name,
            'category_slug'=> strtolower(str_replace(' ','-',$request->category_name)),
            'image' => $save_url,
            // 需去php.ini改extension=gd 才可使用
        ]);

        
        $notification = array(
            'message'=> 'Category Updated With Image Successfully',
            'alert-type'=> 'success',
        );
        return redirect()->route('all.category')->with($notification);
        }else{
            
            Category::find($category_id)->update([
                'category_name'=> $request->category_name,
                'category_slug'=> strtolower(str_replace(' ','-',$request->category_name)),
            ]);

            $notification = array(
                'message'=> 'Category Updated Without Image Successfully',
                'alert-type'=> 'success',
            );
            return redirect()->route('all.category')->with($notification);
        }


    

    }//END


}
