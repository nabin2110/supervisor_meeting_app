<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MeetingController;
use Illuminate\Support\Facades\Mail;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/meeting',[MeetingController::class,'create'])->name('meeting.create');
Route::post('/meeting/store',[MeetingController::class,'store'])->name('meeting.store');
Route::get('/send-test-email',function(){
    Mail::raw('Test Mail',function($message){
        $message->to('nabinthapa2110@gmail.com')
        ->subject('test mail');
    });
});
Route::post('/meeting/response', [MeetingController::class, 'updateResponse'])->name('meeting.response');
