<?php

namespace App\Http\Controllers;

use App\Models\section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Storage;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections=section::all();
        return view('section.section',compact('sections'));
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
        // $input=$request->all();

        // //التأكد من التسجيل مسبقا
        // $b_exists=section::where('section_name','=',$input['section_name'])->exists();

        // if($b_exists){
        //     session()->flash('Error','القسم مسجل مسبقا');
        //     return redirect('/sections');
        // }
        // else{
        //     section::create([
        //         'section_name'=>$request->section_name,
        //         'description'=>$request->description,
        //         'created_by'=>(Auth::user()->name),
        //     ]) ;


        $val=$request->validate([
            'section_name'=>'required|unique:sections|max:255',
        ],[
            'section_name.required'=>'يرجى ادخال اسم القسم',
            'section_name.unique'=>'  اسم القسم مسجل مسبقا',

        ]);
        section::create([
                    'section_name'=>$request->section_name,
                    'description'=>$request->description,
                    'created_by'=>(Auth::user()->name),
                ]) ;
    
            session()->flash('Add','تم إضافة القسم بنجاح');
            return redirect('/sections');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [

            'section_name' => 'required|max:255|unique:sections,section_name,'.$id,
        ],[

            'section_name.required' =>'يرجي ادخال اسم القسم',
            'section_name.unique' =>'اسم القسم مسجل مسبقا',

        ]);

        $sections = section::find($id);
        $sections->update([
            'section_name' => $request->section_name,
            'description' => $request->description,
        ]);

        session()->flash('edit','تم تعديل القسم بنجاج');
        return redirect('/sections');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        section::find($id)->delete();
        session()->flash('delete','تم حذف القسم بنجاح');
        return redirect('/sections');
    }
}
