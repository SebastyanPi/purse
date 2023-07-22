<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
})->name('home');

Route::get('/Student', function () {
    return view('login');
});
Route::get('/Receipts', function () {
    return view('receipts.index');
});

Route::get('/abonos/', function () {
    return view('viewStudent.abonos.index');
})->name('abonos');

Route::get('/cartera/', function () {
    return view('viewStudent.cartera.index');
})->name('cartera');


Route::get('otros/abonos/', function () {
    return view('viewStudent.otrosAbonos.index');
})->name('otros.abonos');

Route::get('financiera/', function () {
    return view('viewStudent.financiera.index');
})->name('financiera');

Route::get('/receipts/third/entry/', function () {
    return view('third.thirdEntryReceipts');
})->name('third.receipts.entry');

Route::get('/receipts/third/entry/{id}', [App\Http\Controllers\ThirdReceiptsController::class, 'redireccionarEntry'])->name('third.receipts.entry.edit');

Route::get('/receipts/third/discharge/', function () {
    return view('third.thirdDischargeReceipts');
})->name('third.receipts.discharge');

Route::get('/receipts/third/discharge/{id}', [App\Http\Controllers\ThirdReceiptsController::class, 'redireccionarDischarge'])->name('third.receipts.discharge.edit');

Route::get('/pdf', function () {
    return view('layouts.pdf');
});

Route::get('/synchronization', function () {
    return view('cloud.synchronization');
})->name('cloud.synchronization');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(App\Http\Controllers\viewStudentController::class)->group(function(){
    Route::get('/view/student/{estado}','index')->name('view.student.index');
    Route::post('/view/student/search','search')->name('view.student.search');
    Route::get('/cartera/{id}', 'carteraTable')->name('cartera.index');
    Route::get('/student/{id}','show')->name('student.view');
    Route::post('/privileges/post/','privileges')->name('post.privileges');
    Route::get('/login/privileges/{no}/{route}','loginPrivilegies')->name('login.privileges');; 
    Route::get('/abono/privileges/admin/{no}','viewAbonos' )->name('show.admin');
    Route::get('/otros/privileges/admin/{no}','viewOtros' )->name('otros.admin');
    Route::post('/purse/all/','cartera')->name('purse.all');
});

Route::controller(App\Http\Controllers\CostController::class)->group(function(){
    Route::post('/cost/store','store')->name('cost.store');
    Route::get('/financiera/{id}','show' )->name('cost.show');
});    

Route::controller(App\Http\Controllers\ConsecutiveController::class)->group(function(){
    Route::get('/consecutive','index')->name('consecutive.index');
    Route::post('/consecutive/store','store')->name('consecutive.store');
});    

Route::controller(App\Http\Controllers\EntryController::class)->group(function(){
    Route::post('/entry/all','all')->name('entry.all');
    Route::post('/entry/store','store')->name('entry.store');
    Route::post('/entry/update/{id}','update')->name('entry.update');
    Route::post('/entry/destroy/{id}','destroy')->name('entry.destroy');
    Route::get('/entry/print/{id}','print')->name('entry.print');
    Route::get('/entry/pdf/{id}','ViewPdf')->name('entry.Viewpdf');
    Route::get('/entry/pdfUnited/{id}','ViewPdfUnitedOther')->name('entry.ViewPdfUnitedOther');
    Route::get('/abonos/{id}','show')->name('entry.show');
}); 

Route::controller(App\Http\Controllers\OtherEntryController::class)->group(function(){
    Route::post('/other/all','all')->name('entry.all');
    Route::post('/other/entry/store','store')->name('other.entry.store');
    Route::post('/other/entry/update/{id}','update')->name('other.entry.update');
    Route::post('/other/entry/destroy/{id}','destroy')->name('other.entry.destroy');
    Route::get('/other/entry/pdf/{id}','ViewPdf')->name('other.entry.Viewpdf');
    Route::get('/otros/abonos/{id}','show')->name('other.entry.show');
}); 

Route::controller(App\Http\Controllers\SettingController::class)->group(function(){
    Route::get('/setting','index')->name('setting.index');
    Route::post('/setting/concepto/store','StoreConcepto')->name('concepto.store');
    Route::post('/setting/elaborado/store','StoreElaborado')->name('elaborado.store');
    Route::post('/setting/haber/store','StoreHaber')->name('haber.store');
    Route::post('/setting/debe/store','StoreDebe')->name('debe.store');
    Route::post('/setting/OtrosConcepto/store','StoreOtrosConcepto')->name('otrosConceptos.store');
}); 

Route::controller(App\Http\Controllers\PurseController::class)->group(function(){
    Route::post('/purse/edit/','edit')->name('purse.edit');
    Route::post('/purse/total/','total')->name('purse.total');
    Route::get('/purse/pdf/{id}','ViewPdf')->name('purse.Viewpdfc');
});

Route::controller(App\Http\Controllers\HistoryPurseController::class)->group(function(){
    Route::post('/history/search/','search')->name('purse.history');
    Route::post('/history/delete/','delete')->name('history.delete');
}); 

Route::controller(App\Http\Controllers\SynchronizationController::class)->group(function(){
    Route::get('/synchronization/local-cloud','transfer_local_cloud')->name('synchronization.local');
    Route::get('/synchronization/cloud-local','transfer_cloud_local')->name('synchronization.cloud');
    Route::get('/synchronization/count/local-cloud','count_local_cloud')->name('synchronization.count');
}); 

Route::controller(App\Http\Controllers\thirdEntryController::class)->group(function(){
    Route::get('/third/entry/','index')->name('third.entry');
    Route::post('/third/entry/add','store')->name('third.entry.add');
    Route::get('/third/entry/edit/{id}','edit')->name('third.entry.edit');
    Route::post('/third/entry/update/{id}','update')->name('third.entry.update');
    Route::get('/third/search/{name}', 'search')->name('third.search');
});

Route::controller(App\Http\Controllers\ThirdActivityController::class)->group(function(){
    Route::get('/third/activity/','list')->name('third.activity');
    Route::post('/third/activity/add','store')->name('third.activity.add');
    Route::post('/third/activity/update/{id}','update')->name('third.activity.update');
    Route::get('/third/activity/','list')->name('third.activity');
});

Route::controller(App\Http\Controllers\ThirdReceiptsController::class)->group(function(){
    Route::post('/receipts/store','store')->name('receipts.store');
});

Route::controller(App\Http\Controllers\StudentController::class)->group(function(){
    Route::get('/student/search/{name}','search')->name('student.search.consult');
    Route::get('/student/search/all/{name}','searchAll')->name('student.searchAll.consult');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


