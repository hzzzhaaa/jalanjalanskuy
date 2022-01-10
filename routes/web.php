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


Route::get('mailable', 'RouteController@mailable');


Route::group(['middleware' => ['auth']], function () {


    Route::get('/createOrganizer', 'OrganizerController@create')->name('organizer.create');
    Route::post('/createOrganizer', 'OrganizerController@store')->name('organizer.store');
    Route::get('/mytickets', 'TicketController@mytickets')->name('mytickets');
    Route::post('/mytickets/{ticketuser}/uploadreceipt', 'TicketController@uploadReceipt')->name('attendee.upload.receipt');
    Route::post('/mytickets/{ticket}/book', 'TicketController@bookTicket')->name('attendee.book.ticket');
    Route::post('/mytickets/{ticketuser}/feedback', 'TicketController@feedback')->name('attendee.feedback');


    Route::post('invitation/accept', 'MemberController@accept')->name('member.invite.accept');
    Route::post('invitation/decline', 'MemberController@decline')->name('member.invite.decline');


    Route::group(['middleware' => ['organizer']], function () {
        Route::get('dashboard', "DashboardController@index")->name('dashboard');
        Route::get('dashboard/organizer', 'DashboardController@organizer')->name('dashboard.organizer');
        Route::get('dashboard/organizer/{organizer}/edit', "OrganizerController@edit")->name('dashboard.organizer.edit');
        Route::post('dashboard/organizer/{organizer}/edit', "OrganizerController@update")->name('dashboard.organizer.update');


        Route::post('dashboard/member/kick/{user}', 'MemberController@kick')->name('kick');
        Route::post('dashboard/member/revoke/{user}', 'MemberController@revokeAdmin')->name('revoke.admin');
        Route::post('dashboard/member/admin/{user}', 'MemberController@setAdmin')->name('set.admin');
        Route::post('dashboard/member/invite','MemberController@invite')->name('members.invite');
        Route::get('dashboard/member', 'MemberController@index')->name('dashboard.member.index');
        Route::post('dashboard/member', 'MemberController@invite')->name('dashboard.member.invite');

        Route::get('dashboard/event/create', 'EventController@create')->name('dashboard.event.create');
        Route::post('dashboard/event/store', 'EventController@store')->name('dashboard.event.store');
        // Route::post('dashboard/event/{event}/remove', 'EventController@destroy')->name('dashboard.event.remove');
        // Route::post('dashboard/event/{event}/finish', 'EventController@finish')->name('dashboard.event.finish');
        Route::get('dashboard/event/{event}', 'EventController@show')->name('dashboard.event.show');
        Route::get('dashboard/event/{event}/edit', 'EventController@edit')->name('dashboard.event.edit');
        Route::post('dashboard/event/{event}/edit', 'EventController@update')->name('dashboard.event.update');
        Route::get('dashboard/event/{event}/attendee', 'EventController@show_attendee')->name('dashboard.event.attendee.index');
        Route::post('dashboard/event/{event}/publish', 'EventController@setPublish')->name('dashboard.event.publish');
        Route::post('dashboard/event/{event}/hide', 'EventController@setHidden')->name('dashboard.event.hide');

        Route::get('dashboard/event/{event}/ticket', 'TicketController@index')->name('dashboard.event.ticket.index');
        Route::post('dashboard/event/{event}/ticket', 'TicketController@store')->name('dashboard.event.ticket.store');
        // Route::post('dashboard/event/{event}/ticket', 'TicketController@store')->name('dashboard.event.ticket.store');
        Route::post('dashboard/event/ticket/{ticket}/onsale', 'TicketController@onsale')->name('dashboard.event.ticket.onsale');
        Route::get('dashboard/event/ticket/{ticket}/edit', 'TicketController@edit')->name('dashboard.event.ticket.edit');
        Route::get('dashboard/event/ticket/{ticket}/delete', 'TicketController@destroy')->name('dashboard.event.ticket.delete');
        Route::post('dashboard/event/ticket/{ticket}/update', 'TicketController@update')->name('dashboard.event.ticket.update');
        Route::post('dashboard/event/ticket/{ticket}/offsale', 'TicketController@offsale')->name('dashboard.event.ticket.offsale');
        Route::post('dashboard/event/{event}/{ticketuser}/remove', 'TicketController@removeAttendee')->name('user.ticket.remove');
        Route::post('dashboard/event/{event}/{ticketuser}/approve', 'TicketController@approveAttendee')->name('user.ticket.approve');
        Route::post('dashboard/event/{event}/{ticketuser}/decline', 'TicketController@declineAttendee')->name('user.ticket.decline');
        Route::post('dashboard/event/{event}/attendee/checkin', 'TicketController@postCheckin')->name('dashboard.event.checkin.post');
        Route::get('dashboard/event/{event}/checkin', 'TicketController@indexCheckin')->name('dashboard.event.checkin.index');
        Route::get('dashboard/event/{event}/feedback', 'TicketController@indexFeedback')->name('dashboard.event.feedback.index');

        Route::get('dashboard/event/{event}/div/{division}', 'DivisionController@show')->name('dashboard.event.division.show');
        Route::post('dashboard/event/{event}/creatediv', 'DivisionController@store')->name('dashboard.event.division.store');
        Route::post('dashboard/event/{event}/div/{division}/{deadline}', 'DivisionController@jobUpdate')->name('dashboard.event.division.jobs.update');
        Route::get('dashboard/event/{event}/creatediv', 'DivisionController@create')->name('dashboard.event.division.create');
        Route::post('dashboard/event/{event}/div/{division}/createjob', 'DivisionController@jobs_store')->name('dashboard.event.division.jobs.store');

    });


    Route::group(['middleware' => ['admin']], function () {
        Route::get('dashboard/users', 'UserController@index')->name('dashboard.user.index');
        // Route::post('dashboard/users/{user}/delete', 'UserController@destroy')->name('delete.user');

        Route::get('dashboard/organizers', 'OrganizerController@index')->name('dashboard.organizer.index');
        // Route::post('dashboard/organizers/{organizer}', 'OrganizerController@destroy')->name('delete.organizer');

        Route::get('dashboard/events', 'EventController@index')->name('dashboard.admin.event.index');
        // Route::post('dashboard/events/{event}/delete', 'EventController@adminDestroy')->name('delete.event');
        Route::post('dashboard/events/{event}/approve', 'EventController@approve')->name('approve.event');
    });
    Route::get('logout', 'Auth\LoginController@logout');


});

Route::get('/event/{event}', 'EventController@show1')->name('attendee.event.show');
Route::get('/organizer/{organizer}', 'OrganizerController@show')->name('attendee.organizer.show');
Route::get('/event', 'AttendeePagesController@event')->name('attendee.event');


Route::get('/redirect', 'Auth\LoginController@redirectToProvider');
Route::get('/callback', 'Auth\LoginController@handleProviderCallback');
Route::post('/register_google', 'Auth\LoginController@registerGoogle')->name('register.google');


Route::get('/', 'HomeController@show')->name('index');

Route::get('/howit', 'RouteController@howit')->name('howit');


Route::get('/contact', 'RouteController@contact')->name('contact');


Auth::routes(['verify' => true]);

Route::get('/404', 'RouteController@err404');

Route::get('/500', 'RouteController@err500');

// Route::get('qrcode', function () {
//     return view('qrcode');
// });

// Route::get('/coba', function(){
//     return view('satu');
// });
