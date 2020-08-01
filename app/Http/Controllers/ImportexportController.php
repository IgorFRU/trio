<?php

namespace App\Http\Controllers;

use App\Product;
use App\Vendor;
use App\Unit;
use App\Category;
use App\Currency;
use Excel;
use Illuminate\Http\Request;
use App\Imports\ProductsImport;
use App\Exports\ProductsExport;
use App\Manufacture;

class ImportexportController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin');
    }

    public function index() {

        $products = Product::imported()->orderBy('id', 'desc')->paginate(20);

        $data = array (
            'title' => 'Импорт/Экспорт',
            'delimiter' => '',
            'vendors' => Vendor::get(),
            'units' => Unit::get(),
            'manufactures' => Manufacture::get(),
            'currencies' => Currency::get(),
            'categories' => Category::with('children')->where('category_id', '0')->get(),
            'products' => $products,
        ); 

        return view('admin.importexport.index', $data);
    }

    public function import(Request $request) {
        
        if (isset($request->file)) {
            $request->validate([
                'file' => 'required|file|max:10000|mimes:xls,xlsx',
            ]);
            // dd($request->all()); 
            
            $excel = new ProductsImport($request->first_line - 1, $request->all(), $request->last_line, $request->packaging);
            Excel::import($excel, $request->file);

            return redirect()->route('admin.import-export.index');
        }

        $data = array (
            'title' => 'Импорт товаров',
            'delimiter' => '',
            'vendors' => Vendor::get(),
            'units' => Unit::get(),
            'manufactures' => Manufacture::get(),
            'currencies' => Currency::get(),
            'categories' => Category::with('children')->where('category_id', '0')->get(),
        ); 

        return view('admin.import.index', $data);    
    }

    public function export(Request $request) {
        // return $request->category;
        
        $categories = (isset($request->category) && count($request->category)) ? $request->category : [];
        $vendors = (isset($request->vendor) && count($request->vendor)) ? $request->vendor : [];
        $manufactures = (isset($request->manufacture) && count($request->manufacture)) ? $request->manufacture : [];

        $categories = (count($categories) == 1 && $categories[0] == 0) ? [] : $categories ;
        $vendors = (count($vendors) == 1 && $vendors[0] == 0) ? [] : $vendors ;
        $manufactures = (count($manufactures) == 1 && $manufactures[0] == 0) ? [] : $manufactures ;

        // return ['categories' => $categories, 'vendors' => $vendors, 'manufactures' => $manufactures];
        $products = Product::
        when(count($manufactures), function ($query, $manufactures) {
            return $query->whereIn('manufacture_id', $manufactures);
        })
        ->when(count($vendors), function ($query, $vendors) {
            return $query->whereIn('vendor_id', $vendors);
        })->orderBy('category_id', 'desc')->orderBy('id', 'desc')->with(['category', 'manufacture'])->get();

        return $products;
        dd($products, $request->all());
        ProductsExport::export($products);
    }
}
