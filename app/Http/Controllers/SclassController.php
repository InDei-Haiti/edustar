<?php

namespace App\Http\Controllers;

use App\Sclass;
use Illuminate\Http\Request;

class SclassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Sclass::latest()->paginate();
        return view('class.index',compact('classes'));
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
        	'name' => 'required|unique:sclasses'
        ]);
        
        if(Sclass::create($request->all())){
			flash()->success('Class has been created.');
		}else{
			flash()->error('Unable to create class.');
		}
		
		return redirect()->route('classes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Sclass $sclass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	//echo "hhhhhhhhhhhh"; exit;
        $e_class = Sclass::find($id);
        $classes = Sclass::latest()->paginate();
        return view('class.index',compact('e_class','classes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $this->validate($request,[
        	'name' => 'required|unique:sclasses'
        ]);
          $sclass = Sclass::findOrFail($id);
          $sclass->fill($request->all());
        if($sclass->save()){
			flash()->success('Class has been updated.');
		}else{
			flash()->error('Unable to update class.');
		}
		
		return redirect()->route('classes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Sclass::findOrFail($id)->delete()){
			flash()->success('Class has been deleted');
		}else{
			flash()->success('Class not deleted');
		}
		
		return redirect()->back();
    }
}
