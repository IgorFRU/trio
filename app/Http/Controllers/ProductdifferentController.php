<?php

namespace App\Http\Controllers;

use App\Productdifferent;
use Illuminate\Http\Request;

class ProductdifferentController extends Controller
{
    public function store(Request $request)
    {

        if (isset($request->productdifferent_id) && $request->productdifferent_id != 0) {
            $productdifferent = Productdifferent::where('id', $request->productdifferent_id)->first();
        } else {
            $productdifferent = Productdifferent::where('productdifferent', $request->productdifferent)->first();
        }        
        if (Productdifferent::where('productdifferent', $request->productdifferent)->count() == 0) {
            $productdifferent = Productdifferent::create($request->all());
        } else {
            $productdifferent = Productdifferent::where('productdifferent', $request->productdifferent)->first();
        }

        echo json_encode($productdifferent);
    }

    public function destroy(Request $request)
    {
        Productdifferent::where('id', $request->id)->delete();
        if (Productdifferent::where('id', $request->id)->count() == 0) {
            $id = $request->id;
        } else {
            $id = 0;
        }
        echo json_encode($id);

    }
}
