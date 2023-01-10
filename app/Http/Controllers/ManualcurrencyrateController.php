<?php

namespace App\Http\Controllers;

use App\Manualcurrencyrate;
use App\Currency;
use App\Manufacture;
use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ManualcurrencyrateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $data = array (
            'rates'         => Manualcurrencyrate::orderBy('id', 'DESC')->with('category', 'manufacture')->get(),
            'currencies'    => Currency::orderBy('id', 'DESC')->get(),
            'categories'    => Category::with('children')->where('category_id', '0')->orderBy('category', 'asc')->get(),
            'manufactures'  => Manufacture::get(),
            'delimiter'     => '',
        );
        // dd($data['rates']);
        return view('admin.manualcurrencyrate.index', $data);
    }

    public function getManufactures(Request $request) {
        $id = $request->id;
        $manufacture_ids = Product::where('category_id', $id)->pluck('manufacture_id');
        $manufacture_ids = $manufacture_ids->unique();
        return json_decode(Manufacture::wherein('id', $manufacture_ids)->get());
        // return json_encode(Category::where('id', $id)->firstOrFail()->manufactures()->get());
        // return json_encode(Category::where('id', $id)->firstOrFail()->manufactures()->get());

        // $category = Category::where('id', $id)->firstOrFail();
        // $manufactures = $category->manufactures()->get();

        // return json_encode($manufactures);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array (
            'manufacture' => [],
        );
        // dd($data['categories']);
        
        return view('admin.manualcurrencyrate.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
        $rate = Manualcurrencyrate::create($request->all());
        
        return redirect()->route('admin.manualcurrencyrate.index');
    }

    /**
     * Fll new line or update exist line
     *
     * @param Request $request
     * @return void
     */
    public function newOrUpdate(Request $request)
    {
        $category_id = $request->data['category'];
        $manufacture_id = $request->data['manufacture'];
        $rates = $request->data['rate_values'];
        
        foreach ($rates as $key => $value) {
            $rate = Manualcurrencyrate::where('category_id', $category_id)->where('manufacture_id', $manufacture_id)->where('currency_id', $key)->first();
            if (isset($rate)) {
                $rate->update(['rate' => $value]);
            } else {
                $rate = Manualcurrencyrate::create([
                    'category_id' => $category_id,
                    'manufacture_id' => $manufacture_id,
                    'currency_id' => $key,
                    'rate' => $value
               ]);
            }
            // if ($rate->count) {
                
            // }
        }
        $rate = Manualcurrencyrate::where('category_id', $category_id)->where('manufacture_id', $manufacture_id)->get();
        // dd($request->all());
        // $rate = Manualcurrencyrate::create($request->all());
        // return json_encode($request->data['rate_values']['2']);
        // return json_encode($rate);
        // return json_encode($rate);
        // return redirect()->route('admin.manualcurrencyrate.index');
        
        return json_encode($rate);
    }

    /**
     * Update one line
     *
     * @param Request $request
     * @return void
     */
    public function fastUpdate(Request $request)
    {
        $category_id = $request->category_id;
        $manufacture_id = $request->manufacture_id;
        $currency_id = $request->currency_id;
        $rate_value = $request->rate_value;
        
        $rate = Manualcurrencyrate::where('category_id', $category_id)->where('manufacture_id', $manufacture_id)->where('currency_id', $currency_id)->first();
        
        if (isset($rate)) {
            $rate->update(['rate' => $rate_value]);
        }        
        return json_encode($rate);
    }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\Manufacture  $manufacture
     * @return \Illuminate\Http\Response
     */
    public function show(Manualcurrencyrate $rate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Manufacture  $manufacture
     * @return \Illuminate\Http\Response
     */
    public function edit(Manualcurrencyrate $rate)
    {
        $data = array (
            'manufacture' => $rate
        );
        
        return view('admin.manualcurrencyrate.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Manualcurrencyrate $rate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manualcurrencyrate $rate)
    {
        $rate->update($request->all());

        return redirect()->route('admin.manualcurrencyrate.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Manualcurrencyrate  $rate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manualcurrencyrate $manualcurrencyrate)
    {
        $manualcurrencyrate->delete();
        return redirect()->route('admin.manualcurrencyrates.index');
    }
}
