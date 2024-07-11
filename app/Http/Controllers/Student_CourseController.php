<?php

namespace App\Http\Controllers;

use App\Jobs\courseAdded;
use App\Jobs\courseRemoved;
use Illuminate\Http\Request;
use App\Models\student;
use App\Models\student_course;
use App\Models\course;
use Illuminate\Support\Facades\Auth;
use App\Events\NotifyUser;

class Student_CourseController extends Controller
{
    //
    public function addStudent($id)
    {
        $courses = course::with('student')->find($id);
        $students = student::all();
        return view('add_student', compact('courses'), compact('students'));
    }

    public function saveStudent(Request $req)
    {
        $user = Auth::user();
        $course = course::findOrFail($req->course_id);

        if (!($user->roles == 1 || ($user->roles == 2 && $course->teacher->user_id == $user->id))) {
            abort(403, view('errors.403'));
        }
        $course->student()->sync($req->student_id);
        foreach ($req->student_id as $id) {
            $user = student::find($id);
            //dispatch(new courseAdded($user, $course));
            event(new NotifyUser('Your courses has been updated.', 'notify-channel', 'user-' . $user->user_id));
        }
        return redirect()->route('showStudent', $course->id)->with('note', 'Enrolled in the courses successfully');
    }

    public function addCourse($id)
    {
        $user = Auth::user();
        $student = student::findorfail($id);
        if ($user->roles == 3 && $student->user_id != $user->id) {
            abort(403, view('errors.403'));
        }
        $students = student::with('course')->find($id);
        $courses = course::all();
        return view('add_course', compact('courses'), compact('students'));
    }

    public function saveCourse(Request $req)
    {
        $user = Auth::user();
        $student = Student::findOrFail($req->student_id);
        if ($user->roles == 3 && $student->user_id != $user->id) {
            abort(403, view('errors.403'));
        }
        $student->course()->sync($req->course_id);
        event(new NotifyUser('Your courses has been updated.', 'notify-channel', 'user-' . $student->user_id));

        foreach ($req->course_id as $course_id) {

            $course = course::find($course_id);
          //  dispatch(new courseAdded($student, $course));
        }
        return redirect()->route('showCourse', $req->student_id)->with('note', 'Enrolled in the courses successfully');
    }


    public function showStudent($id)
    {
        $course = course::with('student')->find($id);


        return view('courseStudents', compact('course'));
    }

    public function showCourse($id)
    {
        $user = Auth::user();
        $student = student::findorfail($id);
        if ($user->roles == 3 && $student->user_id != $user->id) {
            abort(403, view('errors.403'));
        } elseif ($user->roles == 2) {
            abort(403, view('errors.403'));

        }
        $student = student::with('course')->find($id);
        return view('studentCourses', compact('student'));
    }

    public function delStudent($id, $dd)
    {
        $courses = course::find($id);
        $courses->student()->detach($dd);
        $student = student::find($dd);
        //dispatch(new courseRemoved($student, $courses));
        event(new NotifyUser('You were removed from a course.', 'notify-channel', 'user-' . $student->user_id));

        return redirect()->back()->with('note', 'Data deleted successfully');
    }

    public function delCourse($id, $dd)
    {
        $students = student::find($id);
        $courses = course::find($dd);
        $students->course()->detach($dd);
       // dispatch(new courseRemoved($students, $courses));
        event(new NotifyUser('You were removed from a course.', 'notify-channel', 'user-' . $students->user_id));

        return redirect()->back()->with('note', 'Data deleted successfully');
    }
}
