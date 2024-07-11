<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->roles == 1) {
            $students = student::simplePaginate(15);
            return view('student\index', compact('students'));

        } else abort(403, view('errors.403'));
    }

    public function show(string $id)
    {

        $user = Auth::user();
        $students = student::findorfail($id);
        if (($user->id == $students->user_id && $user->roles == 3) || $user->roles != 3) {
            return view('student.show', compact('students'));
        } else
            abort(403, view('errors.403'));


    }

    public function edit(string $id)
    {
        //
        $user = Auth::user();
        $students = student::findorfail($id);
        if ($user->id == $students->user_id) {
            return view('student.edit', compact('students'));
        } else abort(403, view('errors.403'));
    }

    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        if ($user->student->id == $id) {
            $request->validate(['name' => 'required|string', 'father_name' => 'required|string', 'email' => 'email', 'roll_no' => 'required|numeric']);
            $student = student::find($id);
            $student->name = $request->name;
            $student->father_name = $request->father_name;
            $student->roll_no = $request->roll_no;
            $student->save();
            return redirect()->route('s-info.show', $id)->with('note', "Data Updated successfully");
        } else abort(403, view('errors.403'));
    }

}
