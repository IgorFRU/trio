<?php

namespace App\Http\Controllers;

use App\Product;
use App\Property;
use App\Currency;
use App\Choise;
use App\Propertyvalue;
use App\Image;
use App\ImageProduct;
use App\ArticleProduct;
use App\ProductSet;
use App\Category;
use App\Manufacture;
use App\Discount;
use App\Vendor;
use App\Unit;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;

use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;

class ProductController extends Controller
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
    public function index(Request $request)
    {
        $minutes = 2;
        if (isset($request->category)) {
            $category = $request->category;
        } else {
            $category = 0;
        }
        if (isset($request->manufacture)) {
            $manufacture = $request->manufacture;
        } else {
            $manufacture = 0;
        }

        $itemsPerPage = request()->cookie('itemsPerPage');

        if (is_null($itemsPerPage)) {
            $itemsPerPage = 10;
        }
        if (isset($request->pp)) {
            $itemsPerPage = $request->pp;
            Cookie::queue(cookie()->forever('itemsPerPage', $itemsPerPage));           
        }

        
        $pp = request()->cookie('p_published');
        $published = array();
        $published = ['0', '1'];
        if (isset($request->p_published)) {
            if ($request->p_published == 2) {                
                $published = ['0', '1'];
                $pp = 2;
            } else {
                $published [] = $request->p_published;
                $pp = $request->p_published;
            } 
            Cookie::queue('p_published', $pp, $minutes);           
        } else if (is_null($pp)) {
            $published = ['0', '1'];
            $pp = 2;
        }
        

        $products = Product::
        when($category, function ($query, $category) {
            return $query->where('category_id', $category);
        })
        ->when($manufacture, function ($query, $manufacture) {
            return $query->where('manufacture_id', $manufacture);
        })->orderBy('id', 'desc')->finaly()->with('category')->whereIn('published', $published)->with('manufacture')->paginate($itemsPerPage);

        $data = array (
            'products' => $products,
            'categories' => Category::with('children')->where('category_id', '0')->orderBy('category', 'asc')->get(),
            'delimiter' => '',
            'current_category' => $category,
            'current_manufacture' => $manufacture,
            'manufactures' => Manufacture::get(),
            'itemsPerPage' => $itemsPerPage,
            'productPublished' => $pp,
        ); 
        // dd($data);
        // dd($data['categories']);
        return view('admin.products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $today = Carbon::now();
        $product = Product::published()->finaly()->latest('id')->first();
        $product->images = [];

        if (isset($product->category->property)) {
            $properties = $product->category->property;
        } else {
            $properties = array();
        }

        $data = array (
            'product' => $product,
            'properties' => $properties,
            'propertyvalues' => Propertyvalue::where('product_id', $product->id)->pluck('value', 'property_id'),
            'choises_children' => Choise::children()->get(),
            'choises_parent' => Choise::parent()->get(),
            //коллекция вложенных подкатегорий
            'categories' => Category::with('children')->where('category_id', '0')->get(),
            'manufactures' => Manufacture::get(),
            'discounts' => Discount::where('discount_end', '>', $today)->orderBy('discount_start', 'DESC')->get(),
            'vendors' => Vendor::get(),
            'units' => Unit::get(),
            'currencies' => Currency::get(),
            'typeRequest' => 'create',       //тип запроса - создание или редактирование, чтобы можно было менять action формы
            //символ, обозначающий вложенность категорий
            'delimiter' => ''
        );
        // dd();
        
        return view('admin.products.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $product = Product::create($request->all());
        
        if (isset($request->image_id)) {
            $imagesArray = $request->image_id;
            
            foreach ($imagesArray as $image) {
                $imageCollection = Image::where('id', $image)->first();
                $old_name = $imageCollection->image;
                $new_name = Str::after($old_name, '-noprod-');
                $old_thumbnail = $imageCollection->thumbnail;
                $new_thumbnail = Str::after($old_thumbnail, '-noprod-');
                rename(public_path("imgs/products/". $old_name), public_path("imgs/products/". $new_name));
                rename(public_path("imgs/products/thumbnails/". $old_thumbnail), public_path("imgs/products/thumbnails/". $new_thumbnail));
                $imageCollection->image = $new_name;
                $imageCollection->thumbnail = $new_thumbnail;
                $imageCollection->update();
                $product->images()->attach($image);
            } 
        }
        
        // dd($product);
        
        // return redirect()->route('admin.products.index')
        //     ->with('success', 'Категория успешно добавлена.');
        return redirect()->route('admin.products.index', $product);
    }

    public function storeAjax(Request $request)
    {
        // dd($request->all());
        $product = Product::create($request->all());
        // $product->slug = $product->product;
        
        // return redirect()->route('admin.products.index')
        //     ->with('success', 'Категория успешно добавлена.');

        // return redirect()->route('admin.products.addImages', $product);
        // return response()->view('admin.products.addImages', $product);
        echo json_encode(array('id' => $product->id));
        // return response('Hello World', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, $addImages = null)
    {
        $today = Carbon::now();
        if (isset($product->category->property)) {
            $properties = $product->category->property;
        } else {
            $properties = array();
        }
        
        $data = array (
            'product' => $product,
            'choises_children' => Choise::children()->get(),
            'choises_parent' => Choise::parent()->get(),
            'categories' => Category::with('children')->where('category_id', '0')->get(),
            'manufactures' => Manufacture::get(),
            'currencies' => Currency::get(),
            'discounts' => Discount::where('discount_end', '>', $today)->orderBy('discount_start', 'DESC')->get(),
            'vendors' => Vendor::get(),
            'units' => Unit::get(),
            'properties' => $properties,
            'propertyvalues' => Propertyvalue::where('product_id', $product->id)->pluck('value', 'property_id'),
            'typeRequest' => 'edit',
            'delimiter' => ''
        );
        // dd(Choise::get());
        // dd($data['choises_children']);
        
        // dd($rr->category->first()->id);
        
        return view('admin.products.edit', $data);
    }

    // public function addImages(Product $product)
    // {
    //     // dd($product);
    //     $today = Carbon::now();
    //     $data = array (
    //         'product' => $product,
    //         'categories' => Category::with('children')->where('category_id', '0')->get(),
    //         'manufactures' => Manufacture::get(),
    //         'discounts' => Discount::where('discount_end', '>', $today)->orderBy('discount_start', 'DESC')->get(),
    //         'vendors' => Vendor::get(),
    //         'units' => Unit::get(),
    //         'typeRequest' => 'edit',
    //         'delimiter' => '',
    //         'addImages' => true,
    //     );
        
    //     return view('admin.products.edit', $data);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // dd($request->all());
        if (isset($request->property_values)) {
            $newProperties = $request->property_values;
            // dd($newProperties);
            $oldProperties = Propertyvalue::where('product_id', $product->id)->get();
            $oldPropertiesArray = $oldProperties->pluck('value', 'property_id');
            $oldKeys = array();
            foreach ($oldPropertiesArray as $key => $oldProperty) {
                if (isset($newProperties["$key"])) {
                    if ($newProperties["$key"] != $oldProperty) {
                        $toUpdate = $oldProperties->where('property_id', $key)->first();
                        $toUpdate->value = $newProperties["$key"];
                        $toUpdate->update();
                    }
                } else {
                    $toDelete = $oldProperties->where('property_id', $key)->first();
                    $toDelete->delete();
                }
                $oldKeys[] = $key;
                // dd($oldKeys);
            }

            foreach ($oldKeys as $oldKey) {
                $newProperties = Arr::except($newProperties, ["$oldKey"]);
                // dd($oldKey);
            }
            // dd($newProperties);
            foreach ($newProperties as $key => $newProperty) {
                // dd($key);
                if($newProperty != null) {
                    $propertyValue = new Propertyvalue;
                    $propertyValue->product_id = $product->id;
                    $propertyValue->property_id = $key;
                    $propertyValue->value = $newProperty;
    
                    $propertyValue->save();
                }
                
            }
        }
        $product->update($request->except('alias'));
        
        if (isset($request->image_id)) {
            $imagesArray = $request->image_id;
            
            foreach ($imagesArray as $image) {
                $imageCollection = Image::where('id', $image)->first();
                $old_name = $imageCollection->image;
                $new_name = Str::after($old_name, '-noprod-');
                $old_thumbnail = $imageCollection->thumbnail;
                $new_thumbnail = Str::after($old_thumbnail, '-noprod-');
                rename(public_path("imgs/products/". $old_name), public_path("imgs/products/". $new_name));
                rename(public_path("imgs/products/thumbnails/". $old_thumbnail), public_path("imgs/products/thumbnails/". $new_thumbnail));
                $imageCollection->image = $new_name;
                $imageCollection->thumbnail = $new_thumbnail;
                $imageCollection->update();
                $product->images()->attach($image);
            } 
        }

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $images = ImageProduct::where('product_id', $product->id)->get();
        $imagesIdArray = $images->pluck('image_id');
        foreach ($images as $image) {
            if (file_exists(public_path('imgs/products/'.$image->images->image))) {
                try {
                    $file = new Filesystem;
                    $file->delete(public_path('imgs/products/'. $image->images->image));
                } catch (\Throwable $th) {
                    echo 'Сообщение: '   . $th->getMessage() . '<br />';
                }                
            }
            if (file_exists(public_path() .'\imgs\products\thumbnails\\' . $image->images->thumbnail)) {
                try {
                    $file = new Filesystem;
                    $file->delete(public_path().'\imgs\products\thumbnails\\' . $image->images->thumbnail);
                } catch (\Throwable $th) {
                    echo 'Сообщение: '   . $th->getMessage() . '<br />';
                }                
            }
        }

        if ($product->images->count()) {
            $product->images()->detach($images);   
            Image::whereIn('id', $imagesIdArray)->delete();     
        }        
        
        $product->delete();

        return redirect()->route('admin.products.index');
    }

    public function search(Request $request) {

        // return 'p;l;';
        // return json_encode($request->all());
        // return json_encode(array(';;' => $request->search));

        $search = $request->search;
        $products = Product::where('autoscu', 'like', '%' . $search . '%')
            ->orWhere('scu', 'like', '%' . $search . '%')
            ->orWhere('product', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orWhere('price', 'like', '%' . $search . '%')
            ->get();

        $products = $products->map(function ($item, $key) {
            $item['category_name'] = $item->category->category;

            if(isset($item->discount) && $item->actually_discount) {
                $item['old_price'] = $item->old_price;
            }
            $item['new_price'] = $item->discount_price;
            $item['edit_link'] = route('admin.products.edit', ['id' => $item->id]);
            return $item;
        });

        return json_encode($products);
    }

    public function showInCategory($categoryId) {
        echo ($categoryId);
    }

    public function published(Request $request) {
        if (isset($request->product_group_ids) && count($request->product_group_ids) > 0) {
            $products = Product::whereIn('id', $request->product_group_ids)->get();
        
            foreach ($products as $key => $product) {
                $product->update(['published' => '1']);
            }

            return redirect()->back()->with('success', 'Товары успешно опубликованы');
        } else {
            redirect()->back()->with('warning', 'Вы не выбрали товары для публикования');
        }   
    }

    public function unimported(Request $request) {
        if (isset($request->product_group_ids) && count($request->product_group_ids) > 0) {
            $products = Product::whereIn('id', $request->product_group_ids)->get();
        
            foreach ($products as $key => $product) {         
                $product->update(['imported' => 0]);
            }

            return redirect()->back()->with('success', 'Товары успешно перенесены в основной раздел');
        } else {
            redirect()->back()->with('warning', 'Вы не выбрали товары для переноса в основной раздел');
        }   
    }

    public function massDestroy(Request $request) {
        if (isset($request->product_group_ids) && count($request->product_group_ids) > 0) {
            $products = Product::whereIn('id', $request->product_group_ids)->with('propertyvalue')->get();
        
            foreach ($products as $key => $product) {
                foreach ($product->images as $image) {
                    // удаляем изображение только если оно не принадлежит больше ни одному продукту
                    if ($image->products->count() === 1) {
                        if (file_exists(public_path('imgs/products/'.$image->image))) {
                            try {
                                $file = new Filesystem;
                                $file->delete(public_path('imgs/products/'. $image->image));
                            } catch (\Throwable $th) {
                                echo 'Сообщение: '   . $th->getMessage() . '<br />';
                            }
                        }
                        if (file_exists(public_path() .'/imgs/products/thumbnails/' . $image->thumbnail)) {
                            try {
                                $file = new Filesystem;
                                $file->delete(public_path().'/imgs/products/thumbnails/' . $image->thumbnail);
                            } catch (\Throwable $th) {
                                echo 'Сообщение: '   . $th->getMessage() . '<br />';
                            }
                        }
        
                        $product->images()->detach($image);
                        Image::where('id', $image->id)->delete();
                    }
                }     
                
                $product->delete();
            }            
            return redirect()->back()->with('success', 'Товары успешно удалены');
        } else {
            redirect()->back()->with('warning', 'Вы не выбрали товары для удаления');
        }
    }

    public function copy(Request $request) {

        if (isset($request->product_group_ids) && count($request->product_group_ids) > 0) {
            $products = Product::whereIn('id', $request->product_group_ids)->with('propertyvalue')->with('images')->get();
        
            $property_values = [];
            foreach ($products as $key => $product) {
                foreach ($product->propertyvalue as $key => $value) {
                    $property_values[$value->property_id] = $value->value;
                }

                $count = 2;
                while (Product::where('product', $product->product . ' (' . $count . ')')->count() > 0) {
                    $count++;
                }

                $data_to_product = [
                    'product' => $product->product . ' (' . $count . ')',
                    'scu' => $product->scu,
                    'category_id' => $product->category_id,
                    'manufacture_id' => $product->manufacture_id,
                    'vendor_id' => $product->vendor_id,
                    'product_pricename' => $product->product_pricename,
                    'unit_id' => $product->unit_id,
                    'discount_id' => $product->discount_id,
                    'size_l' => $product->size_l,
                    'size_w' => $product->size_w,
                    'size_t' => $product->size_t,
                    'size_type' => $product->size_type,
                    'mass' => $product->mass,
                    'short_description' => $product->short_description,
                    'description' => $product->description,
                    'delivery_time' => $product->delivery_time,
                    'meta_description' => $product->meta_description,
                    'meta_keywords' => $product->meta_keywords,
                    'published' => 0,
                    // 'published' => $product->published,
                    'pay_online' => $product->pay_online,
                    'packaging' => $product->packaging,
                    'unit_in_package' => $product->unit_in_package,
                    'amount_in_package' => $product->amount_in_package,
                    'currency_id' => $product->currency_id,
                    'price' => $product->price,
                    'quantity' => $product->quantity,
                    'quantity_vendor' => $product->quantity_vendor,
                    'profit' => $product->profit,
                    'profit_type' => $product->profit_type,
                    'incomin_price' => $product->incomin_price,
                    'propertyvalue' => $property_values,
                    'autoscu' => '',
                    'slug' => '',
                ];

                $new_product = Product::create($data_to_product);
                
                foreach ($property_values as $key => $value) {
                    if($value != null) {
                        $propertyValue = new Propertyvalue;
                        $propertyValue->product_id = $new_product->id;
                        $propertyValue->property_id = $key;
                        $propertyValue->value = $value;        
                        $propertyValue->save();
                    }
                }
                
                if ($product->images->count() > 0) {
                    foreach ($product->images as $key => $image) {
                        // $product->images()->attach($image->id);
                        $image->products()->attach($new_product->id);
                    }
                }                
            }

            return redirect()->back()->with('success', 'Товары успешно скопированы');
        } else {
            redirect()->back()->with('warning', 'Вы не выбрали товары для копирования');
        }        
    }

    public function getCategoryProperties(Request $request) {

        $category = Category::whereId($request->category_id)->with('property')->firstOrFail();
        echo json_encode($category->property);
    }
    
    public function ajaxSearch(Request $request) {
        $json = array();

        if (isset($request->object)) {
            $object = $request->object;
            if (isset($request->objectType) && $request->objectType == 'article') {
                $objectProducts = ArticleProduct::where('article_id', $object)->pluck('product_id');
            } else if (isset($request->objectType) && $request->objectType == 'set') {
                $objectProducts = ProductSet::where('set_id', $object)->pluck('product_id');
            }
            
            
        } else {
            $objectProducts[] = 0;
        }        
        
        // if (strlen($request->product) > 3) {
        //     // $json = array();
        //     $products = Product::where('product', 'like', '%' . $request->product . '%')
        //                         ->whereNotIn('id', $articleProducts)->get();
        //     if ($products) {
        //         // echo json_encode(array('products' => $product));
        //         foreach ($products as $key => $product) {
        //             // $json['content'] = $product;
                    
        //             $json[$key] = $product;
        //         }    
        //         if (count($json)) {
        //             echo json_encode($json);
        //         } else {
        //             $json[0] = 'Ничего не найдено';
        //             echo json_encode($json);
        //             // echo json_encode(array('msg' => 'Ничего'));
        //         }
        //     } else {
        //         echo json_encode(array('msg' => 'Ничего не найдено'));
        //         // $json['msg'] = 'Ничего не найдено';
        //         // echo json_encode($json);
        //     }            
        // }

        if (isset($request->category) && $request->category != 0) {
            $products = Product::where('category_id', $request->category)
                                ->whereNotIn('id', $objectProducts)->get();
            if ($products) {
                // echo json_encode(array('products' => $product));
                foreach ($products as $key => $product) {
                    // $json['content'] = $product;
                    
                    $json[$key] = $product;
                }    
                if (count($json)) {
                    echo json_encode($json);
                } else {
                    $json[0] = 'Ничего не найдено';
                    echo json_encode($json);
                    // echo json_encode(array('msg' => 'Ничего'));
                }
            } else {
                echo json_encode(array('msg' => 'Ничего не найдено'));
                // $json['msg'] = 'Ничего не найдено';
                // echo json_encode($json);
            }
        }
        // echo json_encode(array('response' => $request->product));
        // echo json_encode($request->all());
    }
}
