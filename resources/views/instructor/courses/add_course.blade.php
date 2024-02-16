@extends('instructor.instructor_dashboard')
@section('instructor')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Course</li>
                </ol>
            </nav>
        </div>
        
    </div>
    <!--end breadcrumb-->
    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Add Course</h5>

            <form id="myForm"  action="{{ route('store.category') }}" method="post" class="row g-3" enctype="multipart/form-data">
                @csrf
                {{-- 3.加入form-group --}}
                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Course Name</label>
                    <input type="text" class="form-control" name="course_name" id="input1">
                </div>
                
                <div class="form-group col-md-6">
                    <label for="title" class="form-label">Course Title</label>
                    <input type="text" class="form-control" name="course_title" id="title">
                </div>

                <div class="col-md-6 form-group">
                    <label for="image" class="form-label">Course Image</label>
                    <input type="file" class="form-control" id="course_image" name="image" id="image">
                </div>

                <div class="col-md-6"> 
                     {{-- 顯示上傳圖片 --}}
                     <img id="showImage" src="{{ (!empty($profileData->photo))?url('upload/admin_images/'.$profileData->photo):url('upload/no_image.jpg')}}"  class="rounded-circle p-1 bg-primary" width="100"> 
                </div>

                <div class="col-md-6 form-group">
                    <label for="input2" class="form-label">Course Intro Video</label>
                    <input type="file" class="form-control" accept="video/mp4, vedio/webm" name="video" >
                </div>

                <div class="col-md-6 form-group">
                
                </div>

                <div class="form-group col-md-6">
                    <label for="input2" class="form-label">Course Category</label>
                    <select class="form-select mb-3" name="category_id"id='input2'>
                        <option selected="" disabled>Open this select menu</option>
                        @foreach ($categories as $item)
                            
                        <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                        
                        @endforeach

                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="subcategory" class="form-label">Course SubCategory</label>
                    <select class="form-select mb-3" id="subcategory" name="category_id">
                        <option selected="" disabled>Open this select menu</option>
                       

                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="certificate" class="form-label">Certificate Available</label>
                    <select class="form-select mb-3" name="certificate" id="certificate">
                        <option selected="" disabled>Open this select menu</option>
                       <option value="Yes">Yes</option>
                       <option value="No">No</option>
                    </select>
                </div>
                
                <div class="form-group col-md-6">
                    <label for="label" class="form-label">Course Label</label>
                    <select class="form-select mb-3" name="label" id="label">
                        <option selected="" disabled>Open this select menu</option>
                       <option value="Begginer">Begginer</option>
                       <option value="Middle">Middle</option>
                       <option value="Advance">Advance</option>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="resources" class="form-label">Resources</label>
                    <input type="text" class="form-control" name="resources" id="resources">
                </div>
                
                <div class="form-group col-md-3">
                    <label for="selling_price" class="form-label">Course Price</label>
                    <input type="text" class="form-control" name="selling_price" id="selling_price">
                </div>
                
                <div class="form-group col-md-3">
                    <label for="discount_price" class="form-label">Discount Price</label>
                    <input type="text" class="form-control" name="discount_price" id="discount_price">
                </div>
                
                <div class="form-group col-md-3">
                    <label for="duration" class="form-label">Duration</label>
                    <input type="text" class="form-control" name="duration" id="duration">
                </div>
                
              
                
                <div class="form-group col-md-12">
                    <label for="prerequisites" class="form-label">Course Prerequisites</label>
                    <textarea class="form-control" name="prerequisites" id="prerequisitess"  rows="3" placeholder="Prerequisites ..."></textarea>
                </div>
                
                <div class="form-group col-md-12">
                    <label for="myeditorinstance" class="form-label">Course Description</label>
                    <textarea class="form-control" name="description" id="myeditorinstance"></textarea>
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-check"> 
                            <input class="form-check-input" type="checkbox" id="default" name="bestseller" value="1">
                            <label class="form-check-label" for="default">BestSeller</label>
                        </div>
                    </div>

                    <div class="col-md-4">                    
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1">
                            <label class="form-check-label" for="featured">Featured</label>
                        </div>
                    </div>

                    <div class="col-md-4">

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="highestrated" name="highestrated" value="1">
                            <label class="form-check-label" for="highestrated">Highest Rated</label>
                        </div>
                        
                    </div>
                </div>

                 <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" class="btn btn-primary px-4">Save Change</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
 
</div>
{{-- JS驗證顯示錯誤 --}}
<script type="text/javascript">
    $(document).ready(function (){
        // 1. 改form的id
        $('#myForm').validate({
            rules: {
                // 2. field_name改為驗證ID
                category_name: {
                    required : true,
                }, 
                
                image: {
                    required : true,
                }, 
                
            },
            messages :{
                category_name: {
                    required : 'Please Enter Category Name',
                }, 
                 
                image: {
                    required : 'Please Select Category Image',
                }, 
                 

            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>

{{-- 顯示上傳圖片 --}}
<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>


    
@endsection