@extends('admin.admin_dashboard')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
                </ol>
            </nav>
        </div>
        
    </div>
    <!--end breadcrumb-->
    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Edit Category</h5>

            <form id="myForm"  action="{{ route('update.category') }}" method="post" class="row g-3" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ $category->id }}">

                {{-- 3.加入form-group --}}
                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Category Name</label>
                    <input type="text" class="form-control" name="category_name" id="input1"
                    value="{{ $category->category_name }}">
                </div>
                <div class="col-md-6">

                </div>
                <div class="col-md-6 form-group">
                    <label for="input2" class="form-label">Category Image</label>
                    <input type="file" class="form-control" id="image" name="image" >
                </div>
                <div class="col-md-6">
                      {{-- 顯示上傳圖片 --}}
                      <img id="showImage" src="{{asset($category->image)}}" alt="Admin" class="rounded-circle p-1 bg-primary" width="80">
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
{{-- <script type="text/javascript">
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
    
</script> --}}

{{-- 顯示上傳圖片 --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
    
@endsection