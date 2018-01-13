<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::latest()->paginate();
        return view('subject.index',compact('subjects'));
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
        $this->validate($request,[
        	'code' => 'required|unique:subjects',
        	'name' => 'required|unique:subjects'
        ]);
        
        if(Subject::create($request->all())){
			flash()->success('Subject has been created.');
		}else{
			flash()->error('Unable to create subject.');
		}
		
		return redirect()->route('subjects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editSubject = Subject::find($id);
        $subjects = Subject::latest()->paginate();
        return view('subject.index',compact('editSubject','subjects'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
        	'code' => 'required|unique:subjects,code,'.$id,
        	'name' => 'required|unique:subjects,name,'.$id
        ]);
        $subject = Subject::findOrFail($id);
        $subject->fill($request->all());
        if($subject->save()){
			flash()->success('Subject has been updated.');
		}else{
			flash()->error('Unable to update subject.');
		}
		
		return redirect()->route('subjects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Subject::findOrFail($id)->delete()){
			flash('Subject has been deleted.');
		}else{
			flash('Subject not deleted.');
		}
		return redirect()->back();
    }
}
