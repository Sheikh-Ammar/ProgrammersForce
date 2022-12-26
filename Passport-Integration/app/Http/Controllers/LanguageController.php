<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Language::all();
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
            'name' => 'required|alpha'
        ]);
        $Language = Language::create($request->all());
        if ($Language) {
            return response()->json([
                'Message' => 'New Language Created Successfully !',
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
        $Language = Language::find($id);
        if (!$Language) {
            return response()->json([
                'Message' => 'No Language Found!',
                "Status" => 400,
            ]);
        } else {
            return $Language;
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
            'name' => 'required|alpha'
        ]);
        $Language = Language::find($id);
        $Language->update($request->all());
        if ($Language) {
            return response()->json([
                'Message' => 'Language Update Successfully !',
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
        $Language = Language::find($id)->delete();
        if ($Language) {
            return response()->json([
                'Message' => 'Language Delete Successfully !',
                "Status" => 200,
            ]);
        }
    }
}
