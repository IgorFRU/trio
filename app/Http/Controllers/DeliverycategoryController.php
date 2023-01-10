<?php

namespace App\Http\Controllers;

use App\Delivery;
use App\Deliverycategory;
use Illuminate\Http\Request;

class DeliverycategoryController extends Controller
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
            'categories' => Deliverycategory::orderBy('id', 'DESC')->get()
        );

        return view('admin.deliverycategories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array (
            'category' => [],
            'categories' => Deliverycategory::get(),
            'delimiter' => ''
        );

        return view('admin.deliverycategories.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Deliverycategory::create($request->all());        
        
        return redirect()->route('admin.deliverycategories.index')
            ->with('success', 'Категория доставки успешно добавлена.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = array (
            'category' => Deliverycategory::where('id', $id)->firstOrFail(),
            'deliveries' => Delivery::where('deliverycategory_id', $id)->orderby('priority', 'DESC')->get(),
            
        );

        return view('admin.deliverycategories.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = array (
            'category' => Deliverycategory::where('id', $id)->firstOrFail(),
            
        );
        return view('admin.deliverycategories.edit', $data);
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
        $category = Deliverycategory::where('id', $id)->firstOrFail();
        $category->update($request->all());

        return redirect()->route('admin.deliverycategories.index')->with('success', 'Категория доставки успешно изменена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $category = Deliverycategory::where('id', $id)->firstOrFail();
        $category->delete();

        return redirect()->route('admin.deliverycategories.index')->with('success', 'Категория доставки успешно удалена');
    }
}
