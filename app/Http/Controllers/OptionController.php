<?php

namespace App\Http\Controllers;

use App\Option;
use App\Category;
use App\Choise;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array (
            'options' => Option::orderBy('option', 'ASC')->with('categories')->get(),
            'choises' => Choise::orderBy('choise', 'ASC')->get(),
        );
        return view('admin.options.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array (
            'option' => [],
            'categories' => Category::all(),
        );
        
        return view('admin.options.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $option = Option::create($request->all()); 
        $option->categories()->sync($request->category);

        return redirect()->route('admin.options.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function show(Option $option)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function edit(Option $option)
    {
        $data = array (
            'option' => $option,
            'categories' => Category::all(),
        );
        
        return view('admin.options.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Option $option)
    {
        $option->update($request->all());
        $option->categories()->sync($request->category);

        return redirect()->route('admin.options.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function destroy(Option $option)
    {
        $option->delete();
        return redirect()->route('admin.options.index');
    }
}
