<?php

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

Route::get('/incoming', 'CreateController@index');

Route::get('/create-notification', function () {
    return view('pages.create-notification');
});

Route::get('/getData', function() {
    return view('getData');
});

Route::get('/select2-remote-data-source', 'Select2Controller@select2RemoteDataSource');
Route::get('/select2-load-more', 'Select2Controller@select2LoadMore');


Route::get('/showletters','CreateController@showletters')->name('create.showletters');
Route::get('/copyletters','CreateController@copyletter')->name('create.copyletter');
Route::get('/outgoingletters', 'CreateController@outgoing')->name('create.outgoing');
Route::get('/received', 'CreateController@received')->name('create.received');
Route::get('/markedlist', 'CreateController@marked')->name('create.marked');

Route::resource('create','CreateController');

Route::resource('marked','MarkController');

Route::resource('reference','ReferenceController');
Route::resource('notify','NotifyController');

Route::resource('profile','UserProfile');

Route::get('/receive', function() {
    return view('pages.receive');
})->middleware('auth');


//adding resource in addition to default.
Route::get('create/showletters','CreateController@showletters');//->name('create.showletters');

Auth::routes(['verify' => true]);

Route::get('/contacts', function(){
    
    $users = App\User::paginate(10);
    return view('pages.contact',compact('users'));
});

Route::get('changepassword', 'ChangePasswordController@index');

Route::post('changepassword', 'ChangePasswordController@store')->name('change.password');

Route::get('/contactlist',function() {
    $contacts = DB::table('contact_list')->paginate(10);
    return view('pages.contactlist',compact('contacts'));
});

//Route::get('/send/email', 'MailController@sendmail');

//Route::get('send-mail','MailController@sendmail');
Route::get('/home', 'CreateController@index');
