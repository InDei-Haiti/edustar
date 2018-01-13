<?php

namespace App\Http\Controllers;

use App\Academic;
use Illuminate\Http\Request;

class AcademicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $academics = Academic::latest()->paginate();
        return view('academic.index',compact('academics'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Academic  $academic
     * @return \Illuminate\Http\Response
     */
    public function show(Academic $academic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Academic  $academic
     * @return \Illuminate\Http\Response
     */
    public function edit(Academic $academic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Academic  $academic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Academic $academic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Academic  $academic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Academic $academic)
    {
        //
    }
}
