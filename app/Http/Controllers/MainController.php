<?php

namespace App\Http\Controllers;

use App\Article;
use App\Deliverycategory;
use App\Discount;
use App\Product;
use App\Property;
use App\Propertyvalue;
use App\Manufacture;
use App\Category;
use App\Set;
use App\Menu;
use App\Question;
use App\Setting;
use App\Topmenu;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Route;

use App\MyClasses\Cbr;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Prophecy\Prophet;

class MainController extends Controller
{
    public function index() {
        $today = Carbon::now()->toDateString();
        $discount_ids = array();
        $discount_not_ids = array();
        $discountAllIds = array();
        $discountProductsCount = 0;
        
        $discounts = Discount::orderBy('discount_end', 'ASC')->where('discount_end', '>=', $today)->first();
        // dd($discounts->discount_end, $today->toDateString());
        // dd($discounts->id);
        // dd($discounts->discount_end->toDateString());
        
        if (isset($discounts)) {
            $discountProductsCount = $discounts->priced_products->where('published', 1)->count();
            // dd($discounts->priced_products->where('published', 1)->count());
            while ($discountProductsCount <= 2) {
                if ($discounts->priced_products->where('published', 1)->count() == 0) {
                    $discount_not_ids[] = $discounts->id;
                }
                else {
                    $discount_ids[] = $discounts->id;
                } 
                $discountAllIds[] = $discounts->id;
                // dd($discountAllIds);
                $discounts = Discount::orderBy('discount_end', 'ASC')->whereNotIn('id', $discountAllIds)->where('discount_end', '>=', $today)->first();
                if (!isset($discounts)) {
                    break;
                }
            }
            // dd(count($discount_not_ids));
            // dd($discount_ids);
            $discounts = Discount::orderBy('discount_end', 'ASC')->whereIn('id', $discount_ids)->where('discount_end', '>=', $today)->get();
        } else {
            $discounts = null;
        }
        $hour = 60;
        $categories = Cache::remember('categories', $hour, function() {
            return Category::orderBy('category', 'ASC')->where('category_id', 0)->get();
        });
        $about = Setting::first();
        if ($about == NULL) {
            $about = Setting::create(
                [
                'site_name'        => 'Паркетный мир - Симферополь',
                'address'          => 'Симферополь, пр. Победы, 129/2',
                'phone_1'          => '9788160166',
                'phone_2'          => '',
                'email'            => 'info@parketpro.com',
                'viber'            => '9788160166',
                'whatsapp'         => '9788160166',
                'main_text'        => 'Паркет со всего мира по лучшим ценам!',
                'orderstatus_id'   => '1',
                'time_to_update_tomorrow' => 18,
                ]
            );
        }

        $articles = Article::orderby('id')->get();
        if (count($articles) > 5) {
            $articles = $articles->random(5);
        }
        
        $discount = Discount::with('product')->get();
        $discount_products = collect();

        $count = 6;
        if ($discount->count()) {
            $i = 0;
            foreach ($discount as $item) {
                if ($i < $count) {
                    foreach ($item->product as $product) {
                        // dd($product);
                        if ($product->actually_discount) {
                            $discount_products->push($product);
                            $i++;
                        }                        
                    }
                }              
            }
        }
        // dd($discount_products);

        $data = [
            'title'                 => 'Паркетный мир - Симферополь. Продажа, укладка, ремонт паркета, ламината, паркетной доски, массивной и инженерной доски. Всё для паркета: клеи, лаки, масла и воски. Доставка паркета по Крыму и Симферополю.',
            'description'           => 'Все виды паркета в Крыму по лучшим ценам',
            'menus'                 => Menu::orderBy('sortpriority', 'ASC')->get(),
            'categories'            => Category::orderBy('category', 'ASC')->get(),
            'lastProducts'          => Product::orderBy('id', 'DESC')->finaly()->limit(4)->get(),
            'recomended_products'   => Product::where([
                                            ['recomended', '1']
                                        ])->published()->get()->random(6),
            'discount_products'     => $discount_products,
            'articles'              => $articles,
            'about'                 => $about,
            'meta_description'      => 'Продажа паркета, паркетной доски, ламината, пробкового пола, инженерной и массивной доски, террасной доски из экзотических пород дерева. Укладка, реставрация и ремонт паркета в Крыму и Симферополе. Паркетные лаки, масла и воски, клеи, сопутствующие товары.',
        ];

        return view('welcome', $data);
    }

    /**
     * Undocumented function
     *
     * @param [type] $slug
     * @return void
     */
    public function staticpage($slug) {
        $staticpage = Topmenu::where('slug', $slug)->FirstOrFail();
        if(isset($staticpage)) {
            $staticpage->increment('views', 1);
        }
        
        $data = array (
            'staticpage' => $staticpage,
        );

        return view('staticpage', $data);
    }

    public function category($slug, Request $request) {
        // dd($request->field);
        // $today = Carbon::now();
        $filterManufacture = [];
        $manufactured_to_title = [];

        if (isset($request->prop)) {
            $prop = $request->prop;
        } else {
            $prop = 0;
        }
    
        if ($prop != 0) {
            // dd($prop);
        }

        $category = Category::where('slug', $slug)->with('property')->firstOrFail();
        if (isset($category)) {
            $category->increment('views', 1);
        }       

        $sort = (isset($_COOKIE['productsort'])) ? $sort = $_COOKIE['productsort'] : $sort = 'default';

        $itemsPerPage = (isset($_COOKIE['products_per_page'])) ? $itemsPerPage = $_COOKIE['products_per_page'] : $itemsPerPage = 48;
        

        // $products = Product::where('category_id', $category->id)->published()->get()->sortBy($sort_column);
        // $products = $products->paginate($itemsPerPage);
        // dd($products);
                
        // $category = Category::where('id', $category->id)->first();

        if ($category->subcategories) {
            $products = $category->with_subcategories;
        } else {
            // $currencies_count = Product::where('category_id', $category->id)->distinct()->count('currency_id');
            // $currencies_count --;
            $products = Product::where('category_id', $category->id)->finaly()->published()->order()->with('manufacture', 'images', 'unit', 'currency')->get();

            $products = $products->each(function ($item, $key) {
                $item['sort_price'] = $item->discount_price;                    
            });
            // if ($currencies_count) {
                
            // }            

            if (!isset($_COOKIE['productsort'])) {
                $_COOKIE['productsort'] = '';
            }

            if ($_COOKIE['productsort'] == 'price_up' || $_COOKIE['productsort'] == 'price_down') {
                $products = ($_COOKIE['productsort'] == 'price_up') ? $products->sortBy('sort_price') : $products->sortByDesc('sort_price') ;
            } elseif($_COOKIE['productsort'] == 'default') {
                $products = $products->sortByDesc('recomended')->sortBy('sort_price')->sortBy('product');
            // } else {
            //     $products = Product::where('category_id', $category->id)->finaly()->published()->order()->with('manufacture', 'images', 'unit', 'currency')->get();
            }            
        }
        
        $manufactures = Manufacture::whereIn('id', $products->pluck('manufacture_id'))->get();

        // $products = $products->paginate($itemsPerPage);
        $filtered = [];
        if ($request->field != NULL) {            
            foreach ($request->field as $key => $value) {
                if ($key == 'manufacture') {
                    $filterManufacture = explode(",", $value);
                } elseif($key != 'page') {
                    $filtered[$key] = $value;
                }
            }
        }

        // dd($filterManufacture);
        // dd(count($filterManufacture));
        $products_array = $products->pluck('id');

        $manufactured_to_title = Manufacture::whereIn('id', $filterManufacture)->orderBy('manufacture', 'ASC')->pluck('manufacture')->implode(', ');

        $checked_properties = [];

        if (count($filtered)) {
            // dd($filtered);
            $filtered_ids = [];            

            [$filtered_keys, $filtered_values] = Arr::divide($filtered);
            $filtered_product_ids = Propertyvalue::whereIn('product_id', $products->pluck('id'))->whereIn('property_id', $filtered_keys)->get();
            foreach ($filtered as $key => $value) {           
                if(!$filtered_product_ids->where('value', $value)->count() && Str::contains($value, ',')) {
                    $explode_values = explode(',', $value);
                    
                    $tmp = $filtered_product_ids->where('property_id', $key)->whereIn('value', $explode_values);
                    array_push($filtered_ids, $tmp->pluck('product_id'));
                    foreach ($tmp->unique('value')->pluck('id', 'value') as $key1 => $value1) {
                        // array_push($checked_properties[$key], $value1);
                        $checked_properties[$key] = $explode_values;
                    }
                    
                } else {
                    $tmp = $filtered_product_ids->where('property_id', $key)->where('value', $value);
                    array_push($filtered_ids, $tmp->pluck('product_id'));
                    // array_push($checked_properties[$key], $tmp->unique('value')->pluck('id')->toArray()[0]);
                    if ($tmp->unique('value')->pluck('value')->count()) {
                        $checked_properties[$key][] = $tmp->unique('value')->pluck('value')->toArray()[0];
                    }                    
                }
            }

            // [$trash, $checked_properties] = Arr::divide($checked_properties);

            // dd($checked_properties);
            // [$filtered_keys, $filtered_values] = Arr::divide($filtered);
            // // $filtered_product_ids = Propertyvalue::whereIn('property_id', $filtered_keys)->wherein('value', $filtered_values)->get();
            // $filtered_product_ids = Propertyvalue::whereIn('product_id', $products->pluck('id'))->whereIn('property_id', $filtered_keys)->get();

            // // dd($filtered_product_ids);
            // foreach ($filtered_keys as $key => $value) {
            //     // dd($filtered_keys, $filtered_product_ids);
            //     foreach ($filtered_values as $key1 => $value1) {
                
            //         if(!$filtered_product_ids->where('value', $value1)->count() && Str::contains($value1, ',')) {
            //             $explode_values = explode(',', $value1);
            //             // $filtered_values = Arr::except($filtered_values, $key);

            //             // foreach ($explode_values as $key => $value) {
            //             //     $filtered_values[] = $value;
            //             // }
            //             array_push($filtered_ids, $filtered_product_ids->where('property_id', $value)->whereIn('value', $explode_values));
            //             // $filtered_ids[] = $filtered_product_ids->where('property_id', $value)->whereIn('value', $explode_values);
            //             // dd($explode_values, $filtered_ids);
            //         } else {
                        
            //             array_push($filtered_ids, $filtered_product_ids->where('property_id', $value)->where('value', $value1));
            //             // dd($filtered_ids);
            //             // $filtered_ids[] = $filtered_product_ids->where('property_id', $value)->where('value', $value1);
            //         }
            //     }
            // }
            
            // dd($filtered_ids);
            // $filtered_product_ids = $filtered_product_ids->pluck('product_id');
            foreach ($filtered_ids as $key => $value) {
                // dd($value);
                $products = $products->whereIn('id', $value);
            }
        }

        if (count($filterManufacture) > 0) {
            $products = $products->whereIn('manufacture_id', $filterManufacture);
        }

        $products_count = $products->count();
        $products = $products->paginate($itemsPerPage);

        // if ($prop) {
        //     $prop_products_array = [];
        //     $prop_array = [];

        //     $new_array = [];
        //     foreach ($prop as $key => $value) {
        //         // dd($value);
        //         $prop_array[] = $key;
        //         if (strpos($value, ',')) {
        //             $values = [];
        //             $values = explode(",", $value);
                    
        //             // dd($values);                    
        //         } else {
        //             $values = [];
        //             $values = $value;
        //         }
        //         // $new_array[] = $key;
        //         $new_array[$key] = $values;
        //     }
        //     // dd($new_array);
        //     // dd($prop);
        //     // 

        //     $products_array = Propertyvalue::whereIn('property_id', $prop_array)->pluck('id');
        //     dd($products_array);
        //     $prop_array = Propertyvalue::whereIn('property_id', $prop_array)->pluck('product_id');
        //     // dd($prop_array);
            
        //     // dd($products);
        //     // $props = Propertyvalue::wherein('products', $products)->get();
        //     // dd($props);
            
        // } else {
        //     $new_array = [];
        // }
        // dd($products);      

        // выбираем все propertyvalues и кидаем в массив айдишники товаров
        // выбираем товары с параметром wherein (id товаров из массива)
        //

        
        $property_values = Propertyvalue::whereIn('product_id', $products_array)->with('properties')->get();

        // $property_values_filtered = $property_values->whereIn('property_id', $filtered_keys)->whereIn('value', $filtered_values);
        // dd($products_count, $property_values_filtered, $property_values_filtered->pluck('product_id'), $products->pluck('id')->sort());

        // $unique_property_values_2 = $property_values->pluck('product_id')->unique();
        $unique_property_values = $property_values->pluck('value')->unique();
        $properties = $property_values->whereIn('value', $unique_property_values)->unique('value');

        // foreach ($unique_property_values as $key => $value) {
        //     # code...
        // }

        // dd($filtered_keys, $products_array, $property_values, $property_values[0]->products, $unique_property_values, $properties);
        // dd($products_array, $property_values, $unique_property_values_2, $property_values[0]->products, $unique_property_values, $properties);
    

        $local_title = ($manufactured_to_title) ? $category->category . ' ' . $manufactured_to_title : $category->category ;
        $meta_description = ($manufactured_to_title) ? $category->category . ' ' . $manufactured_to_title : $category->category ;

        
        if (count($products)>1) {
            $minimal_price = $products->where('price', '>', 0)->min('sort_price');
            // if (isset($products[0]->sort_price)) {
            //     $minimal_price = $products->where('price', '>', 0)->min('sort_price');
            // } else {
            //     $minimal_price = $products->where('price', '>', 0)->min('price');
            // }

            $title = $category->category . ' ' . $manufactured_to_title . ' от ' . $minimal_price . ' рублей' . ' - Купить по лучшей цене в Симферополе с доставкой товары из категории ' . $category->category . ' - Паркетный мир (Симферополь)';
        } else {
            $minimal_price = 0;
            $title = $category->category . ' ' . $manufactured_to_title . ' - Купить по лучшей цене в Симферополе с доставкой товары из категории ' . $category->category . ' - Паркетный мир (Симферополь)';
        }
        $data = array (
            'title' => $title,
            'products' => $products,
            'products_count' => $products_count,
            'manufactured_to_title' => $manufactured_to_title,
            'category' => $category,
            'properties' => $properties,
            'checked_properties' => $checked_properties,
            // 'checked_properties' => $new_array,
            'local_title' => $local_title,
            'sort' => $sort,
            'manufactures'          => $manufactures,
            'filteredManufacture'   => $filterManufacture,
            'products_per_page' => $itemsPerPage,
            'meta_description' => $meta_description . '. Купить с доставкой по Симферполю и Крыму. Каталог товаров. Укладка, реставрация и ремонт паркета в Крыму и Симферополе. Паркетные лаки, масла и воски, клеи, сопутствующие товары.',
            'canonical' => $category->main_parrent,
            'minimal_price' => $minimal_price,
        );

        // dd($data['local_title']);
        
        return view('category', $data);
    }

    public function categories() {
        $hour = 60;
        $categories = Cache::remember('categories', $hour, function() {
            return Category::orderBy('category', 'ASC')->where('category_id', 0)->get();
        });
        $data = array (
            'title' => 'Паркет, паркетная доска, ламинат, натуральный штучный паркет и массивная доска. Пробковые полы и стеновые панели ламинированные, шпонированные и пробковые. Паркетная химия: клей для паркета, лак, шпаклёвка, имасла и воски от лучших мировых заводов: OSMO, Loba, Bona, Lechner, Berger, Uzin, Sika И других. Паркетный мир (Симферополь)',
            'categories' => $categories,
            'local_title' => 'Категории товаров',
            'menus' => Menu::orderBy('sortpriority', 'ASC')->get(),
            // 'subcategories' => Category::where('slug', $slug)->firstOrFail()
            'meta_description' => 'Каталог товаров в Паркетном мире. Паркет, массивная и инженерная доска, паркетная доска трехслойная, лаки, клеи, масла и воски для паркета, ламинат по лучшим ценам. Укладка, реставрация и ремонт паркета в Крыму и Симферополе. Паркетные лаки, масла и воски, клеи, сопутствующие товары.',
        );
        // dd($data['products']);
        return view('categories', $data);
    }

    public function articles() {
        $data = array (
            'title' => 'Статьи о паркете, ламинате, паркетной химии и других вопросах, касающихся напольных покрытий. Паркетный мир (Симферополь)',
            'articles' => Article::orderBy('id', 'DESC')->paginate(20),
            'local_title' => 'Статьи',
            'meta_description' => 'Статьи о паркете, ламинате, пробклвом паркете. Укладка, реставрация и ремонт паркета в Крыму и Симферополе. Паркетные лаки, масла и воски, клеи, сопутствующие товары.',
        );
        return view('articles', $data);
    }

    public function article($slug) {
        $article = Article::with('products')->where('slug', $slug)->FirstOrFail();
        if(isset($article)) {
            $article->increment('views', 1);
        }
        $local_title = $article->article;
        $data = array (
            'title' => $article->article . '. Статьи в Паркетном мире (Симферополь)',
            'article' => $article,
            'local_title' => $local_title,
            'meta_description' => $article->article . '. Укладка, реставрация и ремонт паркета в Крыму и Симферополе. Паркетные лаки, масла и воски, клеи, сопутствующие товары.',
        );
        return view('article', $data);
    }

    public function sales() {
        $today = Carbon::now()->toDateString();
        $data = array (
            'title' => 'Скидки, акции и уникальные предложения в Паркетном мире (Симферополь)',
            // 'sales' => Discount::orderBy('discount_end', 'ASC')->where('discount_end', '>=', $today)->get(),
            'sales' => Discount::orderBy('discount_end', 'DESC')->get(),
            'local_title' => 'Акции',
            'meta_description' => 'Скидки и акции в Паркетном мире - Симферополь. Только лучшие цены и предложения с доставкой по Крыму. Укладка, реставрация и ремонт паркета в Крыму и Симферополе. Паркетные лаки, масла и воски, клеи, сопутствующие товары.',
        );
        return view('sales', $data);
    }

    public function sale($slug) {
        $sale = Discount::where('slug', $slug)->with('product')->FirstOrFail();
        if(isset($sale)) {
            $sale->increment('views', 1);
        }
        $local_title = $sale->discount . ' ' . $sale->value . $sale->rus_type;
        $data = array (
            'title' => $local_title . '. Скидки и акции в Паркетном мире (Симферополь)',
            'sale' => $sale,
            'local_title' => $local_title,
            'meta_description' => $local_title . '. Акции и скидки в Паркетном мире. Укладка, реставрация и ремонт паркета в Крыму и Симферополе. Паркетные лаки, масла и воски, клеи, сопутствующие товары.',
        );
        return view('sale', $data);
    }

    public function manufactures() {
        $manufactures = Manufacture::orderBy('manufacture')->get();
        
        // dd($manufactures[0]->categories);
        $data = array (
            'title' => 'Производители, представленные в Паркетном мире (Симферополь)',
            'manufactures' => $manufactures,
            'meta_description' => 'Список производителей, представленных в Паркетном мире. Акции и скидки в Паркетном мире. Укладка, реставрация и ремонт паркета в Крыму и Симферополе. Паркетные лаки, масла и воски, клеи, сопутствующие товары.',
        );
        return view('manufactures', $data);
    }

    public function manufacture($slug) {
        // dd($slug);
        $sort = (isset($_COOKIE['productsort'])) ? $sort = $_COOKIE['productsort'] : $sort = 'default';

        $itemsPerPage = (isset($_COOKIE['products_per_page'])) ? $itemsPerPage = $_COOKIE['products_per_page'] : $itemsPerPage = 48;

        $manufacture = Manufacture::where('slug', $slug)->firstOrFail();
        
        $products = Product::whereManufactureId($manufacture->id)->published()->order()->with('manufacture', 'category', 'images', 'unit', 'currency')->paginate($itemsPerPage);
        
        $data = array (
            'title' => $manufacture->manufacture . '. Купить товары производителя ' . $manufacture->manufacture . ' с доставкой по Симферополю и Крыму - Паркетный мир (Симферополь)',
            'products' => $products,
            'manufacture' => $manufacture,
            'sort' => $sort,
            'products_per_page' => $itemsPerPage,
            'meta_description' => $manufacture->manufacture . '. Список товаров производителя ' . $manufacture . ' в Паркетном мире. Акции и скидки в Паркетном мире. Укладка, реставрация и ремонт паркета в Крыму и Симферополе. Паркетные лаки, масла и воски, клеи, сопутствующие товары.',
        );
        // dd($data['products']);
        return view('manufacture', $data);
    }

    public function product($category_slug = NULL, $slug) {
        $product = Product::where('slug', $slug)->published()->with('currencyrate')->firstOrFail();
        if (isset($product)) {
            $product->increment('views', 1);
        }
        if (isset($category_slug)) {
            // $id = Product::where('slug', $slug)->pluck('category_id')->first();
            $properties = $product->category->property;
            $propertyvalues = Propertyvalue::where('product_id', $product->id)->pluck('value', 'property_id');
        } else {
            $properties = array();
            $propertyvalues = array();
        }

        if (isset($product->category->category)) {
            $local_title = $product->product . ' ' . $product->scu . ' - ' . $product->category->category;
        } else {
            $local_title = $product->product . ' ' . $product->scu;
        }
        
        if (isset($product->manufacture->manufacture)) {
            $full_title = $local_title . ' ' . $product->manufacture->manufacture;
        } else {
            $full_title = $local_title;
        }
        
        $data = array (
            'title' => $local_title . ' - купить в Симферополе по лучшей цене с доставкой по Симферополю и Крыму. Паркетный мир - Симферополь',
            'product' => $product,
            'propertyvalues' => $propertyvalues,
            'local_title' => $local_title,
            'meta_description' => 'Купить ' . $full_title . ' по лучшей цене с доставкой по Симферополю и Крыму от Паркетного мира. Укладка, реставрация и ремонт паркета в Крыму и Симферополе. Паркетные лаки, масла и воски, клеи, сопутствующие товары.',
        );
        // dd($data['product']->images);
        return view('product', $data);
    }

    public function product2($slug) {
        $product = Product::where('slug', $slug)->firstOrFail();
        if (isset($category_slug)) {
            // $id = Product::where('slug', $slug)->pluck('category_id')->first();
            $properties = $product->category->property;
            $propertyvalues = Propertyvalue::where('product_id', $product->id)->pluck('value', 'property_id');
        } else {
            $properties = array();
            $propertyvalues = array();
        }

        $data = array (
            'product' => Product::where('slug', $slug)->firstOrFail(),
            'propertyvalues' => $propertyvalues,
        );
        // dd($data['product']->images);
        return view('product', $data);
    }
    
    public function sets() {
        $set = Set::get();
        $data = array (
            'sets' => $set,
        );
        // dd($set);
        return view('sets', $data);
    }

    public function set($slug) {
        $set = Set::where('slug', $slug)->firstOrFail();
        $data = array (
            // 'products' => Product::orderBy('id', 'DESC')->where('set_id', $set->id)->get(),
            'set' => $set,
        );
        // dd($set);
        return view('set', $data);
    }

    public function questions() {
        $questions = Question::orderBy('created_at', 'DESC')->published()->paginate(20);
        $data = array (
            'title' => 'Вопросы о паркете и ответы на них',
            'questions' => $questions,
            'meta_description' => 'Здесь вы можете задать любые интересующие вас вопросы о напольных покрытиях: какой паркет лучше выбрать, на что приклеить, чем покрыть и т.д.',
        );
        return view('questions', $data);
    }

    public function delivery() {
        $deliverycategories = Deliverycategory::orderBy('id', 'DESC')->get();
        $data = array (
            'title' => 'Доставка в "Паркетном мире"',
            'deliverycategories' => $deliverycategories,
            'meta_description' => 'Описание вариантов доставки приобретенного в "Паркетном мире" товара',
        );
        return view('delivery', $data);
    }

    public function questionsStore(Request $request) {
        $question = Question::create($request->all());

        return redirect()->back();
    }
    
    public function sitemap() {
        $categories = Cache::remember('categories', 10, function() {
            return Category::orderBy('category', 'ASC')->where('category_id', 0)->get();
        });

        return view('sitemap', compact('categories'));
    }

    public function productSort(Request $request) {
        // Cookie::forever('productsort', $request->productsort);
        if (isset($request->productsort) && $request->productsort != '') {
            setcookie('productsort', $request->productsort, time()+60*60*24*365);
        }
        if (isset($request->products_per_page) && $request->products_per_page != '') {
            setcookie('products_per_page', $request->products_per_page, time()+60*60*24*365); 
        }

        // $name = $request->cookie('productsort');
        // $name = Cookie::get('productsort');
        // $name = $request->productsort;
        // echo json_encode(array('productsort' => $_COOKIE['productsort'], 'products_per_page' => $_COOKIE['products_per_page']));
        // echo json_encode($name);
    }

    public function yandex() {
        $today = Carbon::now();
        $categories = Category::get();
        $products = Product::finaly()->published()->where('price', '>',  0)->get();

        // dd($categories);

        // return view('services.yandex.yml.index', compact('products', 'today', 'categories'));
        return response()->view('services.yandex.yml.index', compact('products', 'today', 'categories'))->header('Content-Type', 'text/xml');

        $xw = xmlwriter_open_memory();
        xmlwriter_set_indent($xw, 1);
        $res = xmlwriter_set_indent_string($xw, ' ');

        xmlwriter_start_document($xw, '1.0', 'UTF-8');
        
        xmlwriter_start_element($xw, 'yml_catalog');
        
            xmlwriter_start_attribute($xw, 'date');
            xmlwriter_text($xw, $today);
            xmlwriter_end_attribute($xw);       

            xmlwriter_start_element($xw, 'shop');
                xmlwriter_start_element($xw, 'name');
                    xmlwriter_text($xw, 'Паркетный мир');
                xmlwriter_end_element($xw);

                xmlwriter_start_element($xw, 'company');
                    xmlwriter_text($xw, 'ИП Дюндик Александр Константинович');
                xmlwriter_end_element($xw);

                xmlwriter_start_element($xw, 'url');
                    xmlwriter_text($xw, url('/'));
                xmlwriter_end_element($xw);

                xmlwriter_start_element($xw, 'currencies');
                    xmlwriter_start_element($xw, 'currency');
                        xmlwriter_start_attribute($xw, 'id');
                            xmlwriter_text($xw, 'RUR');
                        xmlwriter_end_attribute($xw);
                        xmlwriter_start_attribute($xw, 'rate');
                            xmlwriter_text($xw, '1');
                        xmlwriter_end_attribute($xw);
                    xmlwriter_end_element($xw);
                xmlwriter_end_element($xw);

                xmlwriter_start_element($xw, 'categories');
                    foreach ($categories as $category) {
                        xmlwriter_start_element($xw, 'category');
                            xmlwriter_start_attribute($xw, 'id');
                                xmlwriter_text($xw, $category->id);
                            xmlwriter_end_attribute($xw);

                            if ($category->have_parent) {
                                xmlwriter_start_attribute($xw, 'parentId');
                                    xmlwriter_text($xw, $category->parent_id);
                                xmlwriter_end_attribute($xw);
                            }
                            xmlwriter_text($xw, $category->category);
                        xmlwriter_end_element($xw);
                    }
                xmlwriter_end_element($xw);

                xmlwriter_start_element($xw, 'offers');
                    foreach ($products as $product) {
                        xmlwriter_start_element($xw, 'offer');
                            xmlwriter_start_attribute($xw, 'id');
                                xmlwriter_text($xw, $product->autoscu);
                            xmlwriter_end_attribute($xw);
                            
                            xmlwriter_start_element($xw, 'name');
                                xmlwriter_text($xw, $product->category->category . $product->manufacture->manufacture . $product->product);
                            xmlwriter_end_element($xw);

                            xmlwriter_start_element($xw, 'url');
                                xmlwriter_text($xw, route('product', ['category' => $product->category->slug, 'product' => $product->slug]));
                            xmlwriter_end_element($xw);

                            xmlwriter_start_element($xw, 'price');
                                xmlwriter_text($xw, $product->discount_price);
                            xmlwriter_end_element($xw);

                            if ($product->actually_discount) {
                                xmlwriter_start_element($xw, 'oldprice');
                                    xmlwriter_text($xw, $product->oldprice);
                                xmlwriter_end_element($xw);
                            }
                            
                            xmlwriter_start_element($xw, 'currencyId');
                                xmlwriter_text($xw, 'RUR');
                            xmlwriter_end_element($xw);

                            xmlwriter_start_element($xw, 'categoryId');
                                xmlwriter_text($xw, $product->category->id);
                            xmlwriter_end_element($xw);

                            xmlwriter_start_element($xw, 'category');
                                xmlwriter_text($xw, $product->category->category);
                            xmlwriter_end_element($xw);

                            xmlwriter_start_element($xw, 'picture');
                                if ($product->images->count()) {
                                    xmlwriter_text($xw, asset('imgs/products') .'/' .$product->images[0]->image);
                                }                                
                            xmlwriter_end_element($xw);

                            xmlwriter_start_element($xw, 'delivery');
                                xmlwriter_text($xw, 'true');
                            xmlwriter_end_element($xw);

                            xmlwriter_start_element($xw, 'pickup');
                                xmlwriter_text($xw, 'true');
                            xmlwriter_end_element($xw);

                            if (strtolower($product->delivery_time) == 'в наличии') {
                                xmlwriter_start_element($xw, 'store');
                                    xmlwriter_text($xw, 'true');
                                xmlwriter_end_element($xw);
                            }

                            if ($product->packaging) {
                                xmlwriter_start_element($xw, 'sales_notes');
                                    xmlwriter_text($xw, 'Продаётся кратно упаковкам по ' . $product->unit_in_package  . ' ' .  $product->unit->unit );
                                xmlwriter_end_element($xw);
                            }

                            xmlwriter_start_element($xw, 'sales_notes');
                                xmlwriter_text($xw, 'Доставляем по Крыму транспортными компаниями и личным транспортом' );
                            xmlwriter_end_element($xw);
                        xmlwriter_end_element($xw);
                    }
                xmlwriter_end_element($xw);

            xmlwriter_end_element($xw);

        xmlwriter_end_element($xw);


        xmlwriter_end_document($xw);

        // return xmlwriter_output_memory($xw);
        if (file_exists('yandex/xml/yandex.xml')) {
            $xml = file_get_contents('yandex/xml/yandex.xml');
            // dd($xml);
        
            // $current = file_get_contents($xml);
            // $current .= $xw;
            file_put_contents($xml, $xw);
        }

        // if (file_exists('yandex/xml/yandex.xml')) {
        //     $xml = simplexml_load_file('yandex/xml/yandex.xml');
        
        //     print_r($xml);
        // } else {
        //     exit('Не удалось открыть файл test.xml.');
        // }
    }
}
