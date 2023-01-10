<?php

namespace App\Http\Controllers;

use App\Delivery;
use App\Deliverycategory;
use Illuminate\Http\Request;

class DeliveryController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($request->category_id);
        $data = array (
            'category_id' => $request->category_id,
            'delivery' => [],
            'deliveries' => Deliverycategory::orderby('id', "DESC")->get(),
        );

        return view('admin.delivery.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $delivery = Delivery::create($request->all());
        
        return redirect()->route('admin.deliverycategories.index')
            ->with('success', 'Доставка успешно добавлена.');
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
        $data = array (
            'category' => Delivery::where('id', $id)->firstOrFail(),
            
        );
        return view('admin.delivery.edit', $data);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delivery = Delivery::where('id', $id)->firstOrFail();
        $delivery->delete();

        return redirect()->route('admin.deliverycategories.index')->with('success', 'Категория доставки успешно удалена');
    }
}
