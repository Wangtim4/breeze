<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\CatrgoryController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class,'Index'])->name('index');

Route::get('/dashboard', function () {
    return view('frontend.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');

    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');

    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');

    Route::post('/user/password/update', [UserController::class, 'UserPasswordUpdate'])->name('user.password.update');

    Route::post('/user/profile/update', [UserController::class, 'UserProfileUpdate'])->name('user.profile.update');

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// 登入身分的不同route
Route::middleware(['auth', 'roles:admin'])->group(function() {

    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
   
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');

    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');

    // Catrgory All Route
    Route::controller(CatrgoryController::class)->group(function() {
        Route::get('/all/category', 'AllCategory')->name('all.category');
        Route::get('/add/category', 'AddCategory')->name('add.category');
        Route::post('/store/category', 'StoreCategory')->name('store.category');
        Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
        Route::post('/update/category', 'UpdateCategory')->name('update.category');
        Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
    });
    // End Catrgory All Route

    // SubCatrgory All Route
    Route::controller(CatrgoryController::class)->group(function() {
        Route::get('/all/subcategory', 'AllSubCategory')->name('all.subcategory');
        Route::get('/add/subcategory', 'AddSubCategory')->name('add.subcategory');
        Route::post('/store/subcategory', 'StoreSubCategory')->name('store.subcategory');
        Route::get('/edit/subcategory/{id}', 'EditSubCategory')->name('edit.subcategory');
        Route::post('/update/subcategory', 'UpdateSubCategory')->name('update.subcategory');
        Route::get('/delete/subcategory/{id}', 'DeleteSubCategory')->name('delete.subcategory');
    });
    // End SubCatrgory All Route

    // Instructor All Route
    Route::controller(AdminController::class)->group(function() {
        Route::get('/all/instructor', 'AllInstructor')->name('all.instructor');
        Route::post('/update/user/status', 'UpdateUserStatus')->name('update.user.status');
      });
    // End Instructor All Route
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

Route::get('/become/instructor', [AdminController::class, 'BecomeInstructor'])->name('become.instructor');

Route::post('/instructor/register', [AdminController::class, 'InstructorRegister'])->name('instructor.register');


Route::middleware(['auth', 'roles:instructor'])->group(function() {
    
    Route::get('/instructor/dashboard', [InstructorController::class, 'InstructorDashboard'])->name('instructor.dashboard');
    
    Route::get('/instructor/logout', [InstructorController::class, 'InstructorLogout'])->name('instructor.logout');
    
    Route::get('/instructor/profile', [InstructorController::class, 'InstructorProfile'])->name('instructor.profile');
    
    Route::post('/instructor/profile/store', [InstructorController::class, 'InstructorProfileStore'])->name('instructor.profile.store');

    Route::get('/instructor/change/password', [InstructorController::class, 'InstructorChangePassword'])->name('instructor.change.password');

    Route::post('/instructor/password/update', [InstructorController::class, 'InstructorPasswordUpdate'])->name('instructor.password.update');

     // Instructor All Route
     Route::controller(CourseController::class)->group(function() {
        Route::get('/all/course', 'AllCourse')->name('all.course');
        Route::get('/add/course', 'AddCourse')->name('add.course');
        
        Route::get('/subcategory/ajax/{category_id}', 'GetSubcategory');
      });
});

Route::get('/instructor/login', [InstructorController::class, 'InstructorLogin'])->name('instructor.login');