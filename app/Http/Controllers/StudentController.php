<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Region;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('region')->paginate(20);

        return view('users.students.index',compact('students'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = Region::all();
        return view('users.students.create',compact('regions', $regions));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'name' => 'required',
            'student_group' => 'required',
            'region_id' => 'required',
        ]);

        $student = new Student;

        $student->nis = $request->nis;
        $student->name = $request->name;
        $student->student_group = $request->student_group;
        $student->region_id = $request->region_id;

        $student->save();

        return redirect()->route('students.index')
                        ->with('success','Berhasil Menyimpan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $regions = Region::all();
        return view('users.students.edit',compact('student', 'regions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {


        $request->validate([
            'nis' => 'required',
            'name' => 'required',
            'student_group' => 'required',
            'region_id' => 'required',
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')
                        ->with('success','Berhasil Update !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->presences()->delete();
        $student->delete();

        return redirect()->route('students.index')
                        ->with('success','Berhasil Hapus !');
    }

}
