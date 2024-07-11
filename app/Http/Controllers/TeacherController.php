<?php

namespace App\Http\Controllers;

use App\Rules\name;
use Illuminate\Http\Request;
use App\Models\teacher;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $teachers = teacher::simplePaginate(10);
        return view('teacher.index', ['teachers' => $teachers]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function show(string $id)
    {
        //
        $teachers = teacher::find($id);
        return view('teacher.show', compact('teachers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        $teachers = teacher::findorfail($id);

        if ($user->id == $teachers->user_id) {
            return view('teacher.edit', compact('teachers'));

        } else abort(403, view('errors.403'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $user = Auth::user();
        $teachers = teacher::findorfail($id);
        if ($user->id == $teachers->user_id) {
            $request->validate(['teacher_name' => ['required', new name], 'email' => 'email', 'salary' => 'required|numeric']);
            $teacher = teacher::findorfail($id);

            $teacher->teacher_name = $request->teacher_name;

            $teacher->salary = $request->salary;
            $teacher->save();
            return redirect()->route('t-info.show', $id)->with('note', "Data updated successfully");
        } else abort(403, view('errors.403'));

    }

    public function myCourse($id)
    {
        $teacher = teacher::find($id);
        return view('teacher.mycourse', compact('teacher'));
    }

    public function approve($id)
    {
        $teacher = teacher::find($id);
        $teacher->status = 1;
        $teacher->save();
        return redirect()->route('t-info.index')->with('note', 'Teacher Approved successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }

}
