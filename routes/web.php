<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\isLoggedIn;
use App\Http\Middleware\webguard;
use App\Http\Controllers\Student_CourseController;
use App\Http\Middleware\pending;
use App\Http\Middleware\restrictStudent;
use App\Http\Middleware\account_verification;

Route::middleware([webguard::class, pending::class, restrictStudent::class, account_verification::class])->group(function () {
    Route::get('/download/course', [CourseController::class, 'downloadAllFiles'])->name('download_courses');
    Route::get('/', function () {
        return view('home');
    })->name('home')->withoutMiddleware([pending::class, restrictStudent::class, account_verification::class]);
    Route::get('/language/{lang}', function ($lang) {
        session(['language' => $lang]);
        return redirect()->back();
    });
    Route::resource('c-info', CourseController::class);
    Route::resource('s-info', StudentController::class)->except(['create,store'])->withoutMiddleware(restrictStudent::class);
    Route::resource('t-info', TeacherController::class)->only(['index']);
    Route::get('t-info/show/{id}', [TeacherController::class, 'show'])->name('t-info.show')->withoutMiddleware(pending::class);

    Route::get('t-info/edit/{id}', [TeacherController::class, 'edit'])->name('t-info.edit')->withoutMiddleware(pending::class);
    Route::put('t-info/update/{id}', [TeacherController::class, 'update'])->name('t-info.update')->withoutMiddleware(pending::class);

    Route::get('/logout', [UserController::class, 'logout'])->name('logout')->withoutMiddleware([pending::class, restrictStudent::class, account_verification::class]);
    Route::get('\add\student\{id}', [Student_CourseController::class, 'addStudent'])->name('addStudent');
    Route::post('\save\student', [Student_CourseController::class, 'saveStudent'])->name('saveStudent');
    Route::get('\add\course\{id}', [Student_CourseController::class, 'addCourse'])->name('addCourse')->withoutMiddleware(restrictStudent::class);
    Route::post('\save\course', [Student_CourseController::class, 'saveCourse'])->name('saveCourse')->withoutMiddleware(restrictStudent::class);
    Route::get('/course/{id}/students', [Student_CourseController::class, 'showStudent'])->name('showStudent');
    Route::get('/student/{id}/courses', [Student_CourseController::class, 'showCourse'])->name('showCourse')->withoutMiddleware(restrictStudent::class);
    Route::delete('/student/{id}/course/{dd}', [Student_CourseController::class, 'delStudent'])->name('delStudent');
    Route::delete('/course/{id}/student/{dd}', [Student_CourseController::class, 'delCourse'])->name('delCourse')->withoutMiddleware(restrictStudent::class);

    Route::get('/teacher/{id}/courses', [TeacherController::class, 'myCourse'])->name('teacherCourse');

    Route::get('/approve/{id}', [TeacherController::class, 'approve'])->name('t-info.approve');
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
});
Route::middleware(isLoggedIn::class)->group(function () {
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::get('/teacher/register', [UserController::class, 'teacher_register'])->name('t-register');
    Route::post('/teacher/register', [UserController::class, 'teacher_store'])->name('t-create');

    Route::get('/student/register', [UserController::class, 'student_register'])->name('s-register');
    Route::post('/student/register', [UserController::class, 'student_store'])->name('s-create');
    Route::post('/login', [UserController::class, 'loginSubmit'])->name('check_login');

});


Route::get('about', function () {
    return view('about');
})->name('about');
Route::middleware([ account_verification::class,webguard::class])->group(function () {

    Route::get('/changePass', [UserController::class, 'changePassword'])->name('changePassword');
    Route::post('/changePass', [UserController::class, 'updatePassword'])->name('updatePassword');
    Route::get('changeDp', [UserController::class, 'changeDp'])->name('changeDp');
    Route::post('changeDp', [UserController::class, 'updateDp'])->name('updateDp');
});
Route::get('/verify/{token}', [UserController::class, 'verifyEmail'])->name('verify');
Route::get('/resend/{id}', [UserController::class, 'resendEmail'])->name('resend');

Route::get('/reset/{token}', [UserController::class, 'resetPassword'])->name('resetPassword');
Route::post('/reset/password/{id}', [UserController::class, 'savePassword'])->name('savePassword');
Route::get('/get/mail', [UserController::class, 'getMail'])->name('getMail');
Route::post('/get/mail', [UserController::class, 'checkMail'])->name('checkMail');
Route::fallback(function () {
    return redirect()->route('home');
});
Route::middleware(webguard::class)->group(function (){

    Route::get('/chat',[ChatController::class,'chat_page']
    )->name('ChatPage');
    Route::get('/chat/{id}',[ChatController::class,'chat_user']
    )->name('ChatUser');
    Route::post('/chat/send',[ChatController::class,'sendMessage']
    )->name('send.message');
    Route::post('/chat/read/{id}',[ChatController::class,'message_read'])->name('readMessage');
});
