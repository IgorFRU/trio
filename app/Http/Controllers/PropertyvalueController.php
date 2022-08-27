<?php

namespace App\Http\Controllers;

use App\Propertyvalue;
use App\Property;
use App\Category;
use Illuminate\Http\Request;

class PropertyvalueController extends Controller
{
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Propertyvalue  $propertyvalue
     * @return \Illuminate\Http\Response
     */
    public function show(Propertyvalue $propertyvalue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Propertyvalue  $propertyvalue
     * @return \Illuminate\Http\Response
     */
    public function edit(Propertyvalue $propertyvalue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Propertyvalue  $propertyvalue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Propertyvalue $propertyvalue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Propertyvalue  $propertyvalue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Propertyvalue $propertyvalue)
    {
        //
    }
    
    public function massPropertyValuesEdit(Request $request) {
        $ids = [];
        foreach ($request->ids as $id) {
            $ids[] = (int)$id;
        }
        $category = Category::whereId($request->category_id)->first();

        if ($category) {
            $product_ids = $category->products->pluck('id');
            
            $property_id = Propertyvalue::whereIn('id', $ids)->first()->property_id;
            $old_values = Propertyvalue::whereIn('id', $ids)->where('property_id', $property_id)->pluck('value');
            $property = Propertyvalue::whereIn('value', $old_values)->whereIn('product_id', $product_ids)->where('property_id', $property_id)->get();
            if ($property) {
                foreach ($property as $item) {
                    $item->update(['value' => $request->new_value]);
                }
                return (['type' => 'success', 'msg' => 'Успешно заменены значения ' . $property->count() . ' характеристик']);
                // echo json_encode(['type' => 'success', 'msg' => 'Успешно заменены значения' . $property->count() . 'характеристик']);
            }
            // echo json_encode(['value' => $request->new_value, 'ids' => $ids, 'properties' => $property]);
            // echo json_encode(['properties' => $property, 'property_id' => $property_id]);
            // return 0;
            return(['type' => 'warning', 'msg' => 'Нечего менять']);
        // echo json_encode(['type' => 'warning', 'msg' => 'Нечего менять']);
        } else {
            return(['type' => 'warning', 'msg' => 'Нечего менять...']);
        }  
        return 0;        
    }
}
