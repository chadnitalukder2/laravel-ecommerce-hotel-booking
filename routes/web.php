<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\RoomListController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\BookAreaController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\FrontendRoomController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\UserController;
use App\Models\Testimonial;
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
Route::get('/', [UserController::class, 'Index']);

Route::get('/dashboard', function () {
    return view('frontend.dashboard.user_dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/profile/store', [UserController::class, 'UserStore'])->name('profile.store');
    Route::get('/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/password/change/store', [UserController::class, 'PasswordChangeStore'])->name('password.change.store');
});

require __DIR__.'/auth.php';

// Admin  Group Middleware
Route::middleware(['auth', 'roles:admin'])->group(function(){

    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');



});// End Admin  Group Middleware

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

// Admin  Group Middleware
Route::middleware(['auth', 'roles:admin'])->group(function(){
    
    //Team all route
    Route::controller(TeamController::class)->group(function(){
        Route::get('/all/team', 'AllTeam')->name('all.team');
        Route::get('/add/team', 'AddTeam')->name('add.team');
        Route::post('/team/store', 'TeamStore')->name('team.store');
        Route::get('/edit/team/{id}', 'EditTeam')->name('edit.team');
        Route::post('/team/update', 'TeamUpdate')->name('team.update');
        Route::get('/delete/team/{id}', 'DeleteTeam')->name('delete.team');
    });

     //Team all route
    Route::controller(BookAreaController::class)->group(function(){
        Route::get('/book/area', 'BookArea')->name('book.area');
        Route::post('/update/book/area', 'UpdateBookArea')->name('update.book.area');
    });

    //Room Type route
    Route::controller(RoomTypeController::class)->group(function(){
        Route::get('/room/type/list', 'RoomTypeList')->name('room.type.list');
        Route::get('/add/room/type', 'AddRoomType')->name('add.room.type');
        Route::post('/room/type/store', 'RoomTypeStore')->name('room.type.store');
    });

      //Room All route
      Route::controller(RoomController::class)->group(function(){
        Route::get('/edit/room/{id}', 'EditRoom')->name('edit.room');
        Route::post('/update/room/{id}', 'UpdateRoom')->name('update.room');
        Route::get('/delete/room/{id}', 'DeleteRoom')->name('delete.room');

        Route::get('/multi/image/delete/{id}', 'MultiImageDelete')->name('multi.image.delete');

        Route::post('/store/room/number/{id}', 'StoreRoomNumber')->name('store.room.number');
        Route::get('/edit/room/no/{id}', 'EditRoomNo')->name('edit.room.no');
        Route::post('/update/room/number/{id}', 'UpdateRoomNumber')->name('update.room.number');
         Route::get('/delete/room/no/{id}', 'DeleteRoomNo')->name('delete.room.no');
    });

    //Admin Booking All Route
    Route::controller(BookingController::class)->group(function () {
        Route::get('/booking/list', 'BookingList')->name('booking.list');
        Route::get('/edit/booking/{id}', 'EditBooking')->name('edit.booking');
     //Booking Update
        Route::post('/update/booking/status/{id}', 'UpdateBookingStatus')->name('update.booking.status');
        Route::post('/update/booking/{id}', 'UpdateBooking')->name('update.booking');

        // Assign Room Route 
        Route::get('/assign_room/{id}', 'AssignRoom')->name('assign_room');
        Route::get('/assign_room/store/{booking_id}/{room_number_id}', 'AssignRoomStore')->name('assign_room_store');
        Route::get('/assign_room_delete/{id}', 'AssignRoomDelete')->name('assign_room_delete');

    });

    //Admin Room List CRoute
    Route::controller(RoomListController::class)->group(function () {
        Route::get('/view/room/list', 'ViewRoomList')->name('view.room.list');
        Route::get('/add/room/list', 'AddRoomList')->name('add.room.list');
        Route::post('/store/room/list', 'StoreRoomList')->name('store.room.list');
        Route::get('/download/invoice/{id}', 'DownloadInvoice')->name('download.invoice');
    });

    //Admin  Smtp Setting
    Route::controller(SettingController::class)->group(function () {
        Route::get('/setting', 'SmtpSetting')->name('smtp.setting');
        Route::post('/smtp/update', 'SmtpUpdate')->name('smtp.update');

    });

    //Admin  testimonial All Route
    Route::controller(TestimonialController::class)->group(function () {
        Route::get('/all/testimonial', 'AllTestimonial')->name('all.testimonial');
       
    });


  
}); //End Admin  Middleware


//Frontend Room
Route::controller(FrontendRoomController::class)->group(function () {
    Route::get('/rooms', 'frontendRoomAll')->name('froom.all');
    Route::get('/room/details/{id}', 'RoomDetailsPage');
    Route::get('/bookings', 'BookingSearch')->name('booking.search');

    Route::get('/search/room/details/{id}', 'SearchRoomDetails')->name('search_room_details');

    Route::get('/check_room_availability', 'CheckRoomAvailability')->name('check_room_availability');
});

//Auth Middleware user must have login for access this route
Route::middleware(['auth'])->group(function(){
//CheckOut All Route
    Route::controller(BookingController::class)->group(function () {
        Route::get('/checkout', 'Checkout')->name('checkout');
        Route::post('/booking/store/', 'BookingStore')->name('user_booking_store');
        Route::post('/checkout/store/', 'CheckoutStore')->name('checkout_store');

        Route::match(['get', 'post'], '/stripe_pay', [BookingController::class, 'stripe_pay'])->name('stripe_pay');

        //User Booking Route
        Route::get('/user/booking', 'UserBooking')->name('user.booking');
        Route::get('/user/invoice/{id}', 'UserInvoice')->name('user.invoice');

    });

});//end group auth middleware
  