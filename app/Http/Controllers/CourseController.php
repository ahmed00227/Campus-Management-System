<?php

namespace App\Http\Controllers;

use App\Events\NotifyUser;
use App\Jobs\courseAssign;
use App\Models\teacher;
use App\Rules\name;
use Illuminate\Http\Request;
use App\Models\course;
use Illuminate\Support\Facades\Auth;
use League\Csv\Writer;
use SplTempFileObject;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function downloadAllFiles()
    {

        if (Auth::user()->roles == 1) {
            $data = Course::select('id', 'course_name', 'course_code', 'credit_hours')->get();
            $course = $data->toArray();

            $csv = Writer::createFromFileObject(new SplTempFileObject());
            $csv->insertOne(['id', 'course_title', 'course_code', 'credit_hours']);
            $csv->insertAll($course);
            $csv->output('courses.csv');

        } else abort(403, view('errors.403'));
    }

    public function index()
    {

        if (Auth::user()->roles == 1) {
            $courses = course::get();
            return view('course.course_index', compact('courses'));
        } else abort(403, view('errors.403'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->roles == 1) {
            $teachers = teacher::get();
            //
            return view('course.createCourse', compact('teachers'));
        } else abort(403, view('errors.403'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['course_name' => ['required', new name], 'course_code' => 'required|numeric', 'credit_hours' => 'required|numeric']);
        $user = teacher::where('id', $request->teacher_id)->first();
        $courses = new course;
        $courses->course_name = $request->course_name;
        $courses->course_code = $request->course_code;
        $courses->credit_hours = $request->credit_hours;
        $courses->teacher_id = $request->teacher_id;
        $courses->save();
       // dispatch(new courseAssign($user, $courses));
        event(new NotifyUser('A New Course was assigned to you.', 'notify-channel', 'user-' . $user->user_id));

        return redirect()->route('c-info.index')->with('note', 'Course Added Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $courses = course::findorfail($id);
        return view('course.course_show', compact('courses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        if ($user->roles == 1) {
            $teachers = teacher::all();
            $courses = course::findorfail($id);
            return view('course.course_edit', compact('courses'), compact('teachers'));
        } else abort(403, view('errors.403'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(['course_name' => ['required', new name], 'course_code' => 'required|numeric', 'credit_hours' => 'required|numeric']);
        $course = course::find($id);

        $course->course_name = $request->course_name;
        $course->course_code = $request->course_code;
        $course->credit_hours = $request->credit_hours;
        $course->teacher_id = $request->teacher_id;
        $course->save();
        return redirect()->route('c-info.index')->with('note', "Course's data updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $user = Auth::user();
        if ($user->roles == 1) {
            course::destroy($id);
            return redirect()->route('c-info.index')->with('note', 'Data deleted successfully');
        } else abort(403, view('errors.403'));
    }
}
