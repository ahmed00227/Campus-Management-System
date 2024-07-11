<?php

namespace App\Http\Controllers;

use App\Events\NotifyUser;
use App\Jobs\registrationMail;
use App\Mail\Email;
use App\Mail\resetPassword;
use App\Models\student;
use App\Models\teacher;
use App\Models\User;
use App\Models\course;
use App\Rules\passcheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Rules\name;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Jobs\passwordReset;
use Mockery\Exception;

class UserController extends Controller
{
    public function resetPassword($token)
    {
        $user = User::where('password_reset_token', $token)->first();
        if ($user != null && (time() - strtotime($user->reset_token_at) < 3600)) {
            return view('resetPassword', compact('user'));
        } else {
            return 'This token has expired';
        }
    }

    public function savePassword(Request $request, $id)
    {
        $request->validate(['password' => 'required|min:8',
            'confirm' => 'required|same:password']);
        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->password_reset_token = null;
        $user->save();
        return redirect()->route('login')->with('note', 'Password updated successfully!');

    }

    public function getMail()
    {
        return view('getEmail');
    }

    public function checkMail(Request $request)
    {
        $request->validate(['email' => 'required|email'], [
            'email.email' => 'Enter a valid email'
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user == null) {
            return redirect()->route('s-register')->with('note', 'This Email is not registered!!! Register now');
        } elseif (($user->reset_token_at == null) || (time() - strtotime($user->reset_token_at) > 3600)) {
            $user->password_reset_token = Str::random(40);
            $user->reset_token_at = now();
            $user->save();
            dispatch(new passwordReset($user));
            return 'Email sent successfully check your mail to reset your password.The link will expire in 1 hour';
        } else {
            return 'We have already sent an email to you check you email to reset the password.';
        }
    }

    public function student_register()
    {
        return view('authentication.student_registration');
    }

    public function teacher_register()
    {
        return view('authentication.teacher_registration');
    }

    public function dashboard()
    {

        $user = Auth::user();

        if ($user->roles == 1) {
            $totalUsers = User::count();  // Replace with your user model
            $totalCourses = course::count(); // Replace with your course model
            $totalStudents = student::count(); // Replace with your student model
            $activeTeachers = teacher::where('status', 1)->count(); // Replace with your teacher model
            $pendingTeachers = teacher::where('status', 0)->count(); // Replace with your teacher model
            return view('dashboard', compact('totalUsers', 'totalCourses', 'totalStudents', 'activeTeachers', 'pendingTeachers'));
        }
        abort(403, view('errors.403'));
    }

    public function student_store(Request $request)
    {
        $request->validate([
            'name' => ['required', new name],
            'father_name' => ['required', new name],
            'email' => 'required|email|unique:App\Models\User',
            'roll_no' => 'required|numeric|max:1000',
            'password' => 'required|min:8',
            'confirm-password' => 'same:password',
            'profile_pic' => 'nullable|mimes:png,jpg,jpeg,webp,gif'
        ], [
            'email.unique' => 'This email is already associated with another account. Login!',
            'confirm-password.same' => 'This does not match the password'
        ]);
        $credentials = $request->only('email', 'password');
        $user = new User;
        //$user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        if ($request->hasFile('profile_pic')) {
            $name = time() . '_userDP_' . $request->profile_pic->getClientOriginalName();
            $path = $request->file('profile_pic')->storeAs('public/avatars', $name);
            $user->profile_pic = $name;
        }
        $user->email_verification_token = Str::random(40);

        $user->save();
        //dispatch(new registrationMail($user));
        $admins = User::where('roles', 1)->get();
        foreach ($admins as $admin) {
            event(new NotifyUser('A New Student Account Was created.', 'notify-channel', 'user-'.$admin->id));
        }
        Auth::attempt($credentials);

        $request->session()->regenerate();
        $user = Auth::user();
        $student = new student;
        $student->name = $request->name;
        $student->father_name = $request->father_name;
        $student->user_id = $user->id;
        $student->roll_no = $request->roll_no;
        $student->save();

        return redirect()->intended(route('home'))->with('note', 'Registration successful');
    }

    public function changePassword()
    {
        $user = Auth::user();
        return view('updatePassword', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $rules = [
            'password' => 'required|string',
            'newPassword' => 'required|min:8',
            'confirmPassword' => 'required|same:newPassword',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        if (!Hash::check($request->password, $user->password)) {
            $validator->errors()->add('password', 'Current password does not match.');
            return back()->withErrors($validator);
        }
        $user->password = Hash::make($request->newPassword);
        $user->save();
        return redirect()->route('home')->with('note', 'Password updated successfully!');
    }

    public function changeDp()
    {
        $user = Auth::user();
        return view('changeDp', compact('user'));
    }

    public function updateDp(Request $request)
    {
        $request->validate(['profile_pic' => 'nullable|mimes:png,jpg,jpeg,webp,gif']);
        $user = Auth::user();
        if ($request->hasFile('profile_pic')) {
            if ($user->profile_pic != null) {
                $filepath = 'storage/avatars/' . $user->profile_pic;
                if (File::exists($filepath)) {
                    File::delete($filepath);
                }
            }
            $name = time() . '_userDP_' . $request->profile_pic->getClientOriginalName();
            $path = $request->file('profile_pic')->storeAs('public/avatars', $name);
            $user->profile_pic = $name;
            $user->save();
        }
        return redirect()->route('home')->with('note', 'Profile Picture updated successfully');
    }

    public function teacher_store(Request $request)
    {


        $request->validate([
            'name' => ['required', new name],
            'salary' => 'required|numeric|min:1000',
            'email' => 'required|email|unique:App\Models\User',
            'password' => 'required|min:8',
            'confirm-password' => 'same:password',
            'profile_pic' => 'nullable|mimes:png,jpg,jpeg,webp,gif'

        ], [
            'email.unique' => 'This email is already associated with another account. Login!',
            'confirm-password.same' => 'This does not match the password'
        ]);
        $credentials = $request->only('email', 'password');

        $user = new User;
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->roles = User::TEACHER_ROLE;
        if ($request->hasFile('profile_pic')) {
            $name = time() . '_userDP_' . $request->profile_pic->getClientOriginalName();
            $path = $request->file('profile_pic')->storeAs('public/avatars', $name);

            $user->profile_pic = $name;
        }
        $user->email_verification_token = Str::random(40);
        $user->save();
        ///dispatch(new registrationMail($user));

        Auth::attempt($credentials);

        $request->session()->regenerate();
        $user = Auth::user();
        $teacher = new teacher;
        $teacher->teacher_name = $request->name;
        $teacher->user_id = $user->id;
        $teacher->salary = $request->salary;
        $teacher->save();
        $admins = User::where('roles', 1)->get();
        foreach ($admins as $admin) {
            event(new NotifyUser('A New Teacher Account Was created.', 'notify-channel', 'user-'.$admin->id));
        }
        return redirect()->intended(route('home'))->with('note', 'Registration successful ');
    }

    public function login()
    {
        return view('authentication.login');
    }

    public function loginSubmit(Request $request)
    {
        $request->validate(['email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->roles == 1) {
                return redirect()->intended(route('home'))->with('note', 'logged in as admin successfully');
            } elseif ($user->roles == 2) {
                return redirect()->intended(route('home'))->with('note', 'logged in as teacher successfully');
            } else
                return redirect()->intended(route('home'))->with('note', 'logged in as student successfully');

        } else {
            return redirect(route('login'))->with('note', 'You have entered wrong credentials');

        }
    }

    public function logout()
    {
        //return view('logout');

        Auth::logout();
        return redirect(route('login'))->with('note', 'logout successfully');
    }

    public function verifyEmail($token)
    {
        $user = null;
        $user = User::where('email_verification_token', $token)->first();
        if ($user != null) {
            if ($user->email_verified_at == null) {
                $user->email_verified_at = now();
                $user->save();
                return redirect()->route('login')->with('note', 'Your email has been verified successfully');
            } else {
                return redirect()->route('login')->with('note', 'Your email is already verified');
            }
        } else {
            return 'This token has expired';
        }
    }

    public function resendEmail($id)
    {
        $user = User::find($id);
        $user->email_verification_token = Str::random(40);
        $user->save();
        dispatch(new registrationMail($user));
        return redirect()->back()->with('note', 'Email sent successfully');
    }
}
