<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});



Auth::routes();

// Route::group(['prefix' => 'home'], function () {
    
// }
// );
// Route::resource('product', App\Http\Controllers\ProductController::class);

//lina 

Route::resource('invoices', App\Http\Controllers\InvoicesController::class);

Route::resource('sections', App\Http\Controllers\SectionController::class);

Route::resource('products', App\Http\Controllers\ProductsController::class);



//upload attachment only
Route::resource('InvoiceAttachments',  App\Http\Controllers\InvoiceAttachmentsController::class);

Route::get('/section/{id}',[App\Http\Controllers\InvoicesController::class,'getproducts']);

Route::get('/InvoicesDetails/{id}',[App\Http\Controllers\InvoicesController::class,'details']);

Route::get('download/{invoice_number}/{file_name}',[App\Http\Controllers\InvoicesDetailsController::class,'get_file']);

Route::get('View_file/{invoice_number}/{file_name}',[App\Http\Controllers\InvoicesDetailsController::class,'open_file']);

Route::post('delete_file',[App\Http\Controllers\InvoicesDetailsController::class,'destroy'])->name('delete_file');;


//edit invoice
Route::get('/edit_invoice/{id}',[App\Http\Controllers\InvoicesController::class,'edit']);

//delete invoice
Route::get('/delete_invoice/{id}',[App\Http\Controllers\InvoicesController::class,'destroy']);

//status_update
Route::get('/status_update/{id}',[App\Http\Controllers\InvoicesController::class,'status_update']);
Route::post('/status/{id}',[App\Http\Controllers\InvoicesController::class,'status'])->name('status');

//get paid-invoices
Route::get('/paid_invoices',[App\Http\Controllers\InvoicesController::class,'Invoice_Paid']);

//get unpaid invoices
Route::get('/unpaid_invoices',[App\Http\Controllers\InvoicesController::class,'Invoice_unPaid']);

//get Invoice_Partial 
Route::get('/Invoice_Partial',[App\Http\Controllers\InvoicesController::class,'Invoice_Partial']);

//invoice archive
Route::get('/archive',[App\Http\Controllers\ArchiveController::class,'index']);

//invoice cancel archive
Route::post('/cancel_archive',[App\Http\Controllers\ArchiveController::class,'update'])->name('cancel_archive');

//delete invoice  archive
Route::delete('/delete_archive',[App\Http\Controllers\ArchiveController::class,'destroy'])->name('delete_archive');

//print_invoice
Route::get('/print_invoice/{id}',[App\Http\Controllers\InvoicesController::class,'print_invoice']);

//export excel
Route::get('export_invoices', [App\Http\Controllers\InvoicesController::class, 'export']);



Route::group(['middleware' => ['auth']], function() {

    Route::resource('roles',App\Http\Controllers\RoleController::class);
    
    Route::resource('users',App\Http\Controllers\UserController::class);
    
});

Route::get('invoices_report', [App\Http\Controllers\invoices_ReportController::class, 'index']);


Route::post('search_invoices', [App\Http\Controllers\invoices_ReportController::class,'Search_invoices']);


Route::get('customers_report', [App\Http\Controllers\invoices_ReportController::class, 'customers_report'])->name('customers_report');

Route::post('customres_search', [App\Http\Controllers\invoices_ReportController::class,'customres_search']);

Route::get('index', [App\Http\Controllers\HomeController::class, 'home']);

Route::get('mark_all', [App\Http\Controllers\InvoicesController::class, 'mark_all'])->name('mark_all');

Route::get("/{page}", [AdminController::class, 'index']);





