<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
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

Route::get('/', function () {
    return view('welcome');
});



//Page Route
Route::get('/login', [UserController::class, 'LoginPage']);
Route::get('/userRegistration', [UserController::class, 'RegistrationPage']);
Route::get('/sendOTP', [UserController::class, 'SendOTP']);

Route::get('/reset-password', [UserController::class, 'ResetPass']) 
->middleware([TokenVerificationMiddleware::class]);

Route::get('/verifyOtp', [UserController::class, 'VerifyOTPPage']); 

Route::get('/dashboard', [DashboardController::class, 'DashboardPage']) 
    ->middleware([TokenVerificationMiddleware::class]);

Route::get('/profile', [UserController::class, 'ProfilePage'])
    ->middleware([TokenVerificationMiddleware::class]);

//Logout Route
Route::get('/logout',[UserController::class, 'userLogout']);

Route::get('/categoryPage',[CategoryController::class,'CategoryPage'])
    ->middleware([TokenVerificationMiddleware::class]);

Route::get('/customerPage',[CustomerController::class,'CustomerPage'])
    ->middleware([TokenVerificationMiddleware::class]);


//Email Campaign Page Route
Route::get('/email-campaign',[CustomerController::class,  'EmailPage']);
    
    // Define a route to handle the form submission
Route::post('/emailCampaign', [CustomerController::class, 'sendEmailToAllCustomers']);


//Product Page Route 
Route::get('/products', [ProductController::class, 'ProductPage'])
    ->middleware([TokenVerificationMiddleware::class]);




//API Web Route for Authentication

//Page Route
Route::get('/login', [UserController::class, 'LoginPage']);
Route::get('/userRegistration', [UserController::class, 'RegistrationPage']);
Route::get('/sendOTP', [UserController::class, 'SendOTP']);

Route::get('/reset-password', [UserController::class, 'ResetPass']) 
->middleware([TokenVerificationMiddleware::class]);

Route::get('/verifyOtp', [UserController::class, 'VerifyOTPPage']); 

Route::get('/dashboard', [DashboardController::class, 'DashboardPage']) 
    ->middleware([TokenVerificationMiddleware::class]);

Route::get('/profile', [UserController::class, 'ProfilePage'])
    ->middleware([TokenVerificationMiddleware::class]);





//Authentication API
Route::post('/registration',[UserController::class, 'UserRegistration']);

Route::post('/user-login',[UserController::class, 'UserLogin']);

Route::post('/send-otp',[UserController::class, 'SendOTPCode']);

Route::post('/verify-otp',[UserController::class, 'VerifyOTP']);

//API Route for password reset
Route::post('/reset-password',[UserController::class, 'ResetPassword'])
    ->middleware([TokenVerificationMiddleware::class]);


//User Profile API Route

Route::get('/user-profile',[UserController::class, 'UserProfile'])
    ->middleware([TokenVerificationMiddleware::class]);


Route::post('/user-update',[UserController::class,'UpdateProfile'])
    ->middleware([TokenVerificationMiddleware::class]);








//Category API Route
Route::post("/create-category",[CategoryController::class,'CategoryCreate'])->middleware([TokenVerificationMiddleware::class]);
Route::get("/list-category",[CategoryController::class,'CategoryList'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/delete-category",[CategoryController::class,'CategoryDelete'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/update-category",[CategoryController::class,'CategoryUpdate'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/category-by-id",[CategoryController::class,'CategoryByID'])->middleware([TokenVerificationMiddleware::class]);


// Customer API
Route::post("/create-customer",[CustomerController::class,'CustomerCreate'])->middleware([TokenVerificationMiddleware::class]);
Route::get("/list-customer",[CustomerController::class,'CustomerList'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/delete-customer",[CustomerController::class,'CustomerDelete'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/update-customer",[CustomerController::class,'CustomerUpdate'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/customer-by-id",[CustomerController::class,'CustomerByID'])->middleware([TokenVerificationMiddleware::class]);



//Product API
Route::post('/create-product', [ProductController::class, 'createProduct'])
    ->middleware([TokenVerificationMiddleware::class]);

Route::post('/delete-product', [ProductController::class, 'DeleteProduct'])
    ->middleware([TokenVerificationMiddleware::class]);

Route::get('/list-product', [ProductController::class, 'ProductList'])
    ->middleware([TokenVerificationMiddleware::class]);

Route::post('/update-product', [ProductController::class, 'ProductUpdate'])
    ->middleware([TokenVerificationMiddleware::class]);
    
Route::post("/product-by-id",[ProductController::class,'ProductByID'])
    ->middleware([TokenVerificationMiddleware::class]);


//Event page Route
Route::get('/events', [EventsController::class, 'EventPage'])
    ->middleware([TokenVerificationMiddleware::class]);



//Event Route API
Route::post('/create-event', [EventsController::class, 'createEvents'])
    ->middleware([TokenVerificationMiddleware::class]);

Route::post('/delete-event', [EventsController::class, 'DeleteEvent'])
    ->middleware([TokenVerificationMiddleware::class]);

Route::get('/list-event', [EventsController::class, 'EventList'])
    ->middleware([TokenVerificationMiddleware::class]);

Route::post('/update-event', [EventsController::class, 'EventUpdate'])
    ->middleware([TokenVerificationMiddleware::class]);
    
Route::post("/event-by-id",[EventsController::class,'EventByID'])
    ->middleware([TokenVerificationMiddleware::class]);


//Todo Route
Route::post('/todos', [TodoController::class, 'TodoCreate']);
Route::get('/todo-list', [TodoController::class, 'TodoList']);
Route::get('/todo-delete', [TodoController::class, 'CustomerDelete']);
Route::post('/todo-update', [TodoController::class, 'CustomerUpdate']);