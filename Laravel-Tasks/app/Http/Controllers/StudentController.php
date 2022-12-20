<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = DB::table('students')
            ->join('courses', 'students.course_id', '=', 'courses.id')
            ->join('grades', 'students.grades_id', '=', 'grades.id')
            ->select('students.fullname', 'students.email', 'students.number', 'students.cnic',  'courses.cname', 'grades.grades')
            ->get();

        return $students;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'fullname' => 'required|alpha',
            'email' => 'required|email|unique:students',
            'cnic' => 'required',
            'number' => 'required',
            'course_id' => 'required|integer',
            'grades_id' => 'required|integer',
        ]);
        $student = Student::create($request->all());
        if ($student) {
            return response()->json([
                'Message' => 'New Student Record Created Successfully !',
                "Status" => 200,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'fullname' => 'required|alpha',
            'email' => 'required|email|unique:students',
            'cnic' => 'required',
            'number' => 'required',
            'course_id' => 'required|integer',
            'grades_id' => 'required|integer',
        ]);
        $student = Student::find($id);
        $student->update($request->all());
        if ($student) {
            return response()->json([
                'Message' => 'Student Record Updated Successfully !',
                "Status" => 200,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id)->delete();
        if ($student) {
            return response()->json([
                'Message' => 'Student Record Delete Successfully !',
                "Status" => 200,
            ]);
        }
    }
}
