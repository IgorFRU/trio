<?php

namespace App\Http\Controllers;

use App\Property;
use App\Category;
use Illuminate\Http\Request;

class PropertyController extends Controller
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

        if (isset($request->property_id) && $request->property_id != 0) {
            $property = Property::where('id', $request->property_id)->first();
        } else {
            $property = Property::where('property', $request->property)->first();
        }        
        if (Property::where('property', $request->property)->count() == 0) {
            $property = Property::create($request->all());
        }

        echo json_encode($property);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Property::where('id', $request->property_id)->delete();
        if (Property::where('id', $request->property_id)->count() == 0) {
            $property = $request->property_id;
        } else {
            $property = 0;
        }
        echo json_encode($property);

    }

    public function getPropertyValues(Request $request) {
        $category = Category::whereId($request->category_id)->first();
        if ($category) {
            $product_ids = $category->products->pluck('id');
            $property = Property::whereId($request->property_id)->with('values')->firstOrFail();
            $all_values = $property->values->whereIn('product_id', $product_ids);
            $unique_values = $all_values->unique('value');
            // echo json_encode(['unique_values' => $unique_values, 'category' => $category, 'product_ids' => $product_ids]);
            echo json_encode($unique_values);
        } else {
            return 0;
        }        
    }
}
