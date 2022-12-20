<?php

namespace App\Http\Controllers;

use App\Models\Grades;
use Illuminate\Http\Request;

class GradesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Grades::all();
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
            'grades' => 'required|alpha'
        ]);
        $course = Grades::create($request->all());
        if ($course) {
            return response()->json([
                'Message' => 'New Grades Record Created Successfully !',
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
        $grades = Grades::find($id);
        if (!$grades) {
            return response()->json([
                'Message' => 'No Grade Found!',
                "Status" => 400,
            ]);
        } else {
            return $grades;
        }
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
            'grades' => 'required|alpha'
        ]);
        $course = Grades::find($id);
        $course->update($request->all());
        if ($course) {
            return response()->json([
                'Message' => 'Grades Record Update Successfully !',
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
        $grades = Grades::find($id)->delete();
        if ($grades) {
            return response()->json([
                'Message' => 'Grades Record Delete Successfully !',
                "Status" => 200,
            ]);
        }
    }
}
