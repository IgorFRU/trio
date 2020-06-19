<?php

namespace App\Http\Controllers;

use App\Article;
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

use Route;

use App\MyClasses\Cbr;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;

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
                ['site_name'        => 'Паркетный мир - Симферополь',
                'address'          => 'Симферополь, пр. Победы, 129/2',
                'phone_1'          => '9788160166',
                'phone_2'          => '',
                'email'            => 'info@parketpro.com',
                'viber'            => '9788160166',
                'whatsapp'         => '9788160166',
                'main_text'        => 'Паркет со всего мира по лучшим ценам!',
                'orderstatus_id'   => '1']
            );
        }

        $articles = Article::orderby('id')->get();
        if (count($articles) > 5) {
            $articles = $articles->random(5);
        }
        

        $data = [
            'title' => 'Паркетный мир - Симферополь. Продажа, укладка, ремонт паркета, ламината, паркетной доски, массивной и инженерной доски. Всё для паркета: клеи, лаки, масла и воски. Доставка паркета по Крыму и Симферополю.',
            'description' => 'Все виды паркета в Крыму по лучшим ценам',
            'menus' => Menu::orderBy('sortpriority', 'ASC')->get(),
            'categories' => Category::orderBy('category', 'ASC')->get(),
            'lastProducts' => Product::orderBy('id', 'DESC')->finaly()->limit(4)->get(),
            'recomended_products' => Product::where([
                ['recomended', '1']
            ])->get()->random(3),
            'articles' => $articles,
            'about' => $about,
            'meta_description' => 'Продажа паркета, паркетной доски, ламината, пробкового пола, инженерной и массивной доски, террасной доски из экзотических пород дерева. Укладка, реставрация и ремонт паркета в Крыму и Симферополе. Паркетные лаки, масла и воски, клеи, сопутствующие товары.',
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
        // dd($slug);
        // $today = Carbon::now();

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

        // $sort = $_COOKIE['productsort'];
        
        // switch ($sort) {
        //     case 'default':
        //         $sort_column = 'id';
        //         $sort_order = 'ASC';
        //         break;
        //     case 'discount':
        //         $sort_column = 'discount';
        //         break;
        //     case 'name':
        //         $sort_column = 'product';
        //         $sort_order = 'ASC';
        //         break;
        //     case 'popular':
        //         $sort_column = 'views';
        //         $sort_order = 'DESC';
        //         break;
        //     case 'price_up':
        //         $sort_column = 'price';
        //         $sort_order = 'ASC';
        //         break;
        //     case 'price_down':
        //         // $sort_column = $this->discount_price;
        //         $sort_column = 'price';
        //         $sort_order = 'DESC';
        //         break;
        //     case 'new_up':
        //         $sort_column = 'id';
        //         $sort_order = 'DESC';
        //         break;                
        //     case 'new_down':
        //         $sort_column = 'id';
        //         $sort_order = 'ASC';
        //         break;
        //     default:
        //         $sort_column = 'id';
        //         $sort_order = 'ASC';
        //         break;
        // }

        // dd(Product::where('category_id', $category->id)->where('discount_end_day', '>=', $today)->published()->get());

        $sort = (isset($_COOKIE['productsort'])) ? $sort = $_COOKIE['productsort'] : $sort = 'default';

        $itemsPerPage = (isset($_COOKIE['products_per_page'])) ? $itemsPerPage = $_COOKIE['products_per_page'] : $itemsPerPage = 48;
        

        // $products = Product::where('category_id', $category->id)->published()->get()->sortBy($sort_column);
        // $products = $products->paginate($itemsPerPage);
        // dd($products);
        $products = Product::where('category_id', $category->id)->finaly()->published()->order()->with('manufacture', 'images', 'unit', 'currency')->paginate($itemsPerPage);
        // dd(Product::where('category_id', $category->id)->published()->order());
        // $products = Product::orderBy('id', 'DESC')->where('category_id', $category->id)->where('published', 1)->paginate($itemsPerPage);

        if ($prop) {
            $prop_products_array = [];
            $prop_array = [];

            $new_array = [];
            foreach ($prop as $key => $value) {
                // dd($value);
                $prop_array[] = $key;
                if (strpos($value, ',')) {
                    $values = [];
                    $values = explode(",", $value);
                    
                    // dd($values);                    
                } else {
                    $values = [];
                    $values = $value;
                }
                // $new_array[] = $key;
                $new_array[$key] = $values;
            }
            // dd($new_array);
            // dd($prop);
            // 

            $products_array = Propertyvalue::whereIn('property_id', $prop_array)->pluck('id');
            // dd($products_array);
            $prop_array = Propertyvalue::whereIn('property_id', $prop_array)->pluck('product_id');
            // dd($prop_array);
            
            // dd($products);
            // $props = Propertyvalue::wherein('products', $products)->get();
            // dd($props);
            
        } else {
            $new_array = [];
        }  
        // dd($products);      

        // выбираем все propertyvalues и кидаем в массив айдишники товаров
        // выбираем товары с параметром wherein (id товаров из массива)
        //

        $products_array = $products->pluck('id');
        $property_values = Propertyvalue::whereIn('product_id', $products_array)->with('properties')->get();
        

        // $unique_property_values = $property_values->map(function ($property_values) {
        //     return collect($property_values)->unique('value')->all();
        // });

        $unique_property_values = $property_values->pluck('value')->unique();

        $properties = $property_values->whereIn('value', $unique_property_values)->unique('value');

        $local_title = $category->category;
        // dd($products_array, $property_values, $unique_property_values, $properties);
        if (isset($request->page) && $request->page > 1) {
            $main_page = 0;
        } else {
            $main_page = 1;
        }

        $data = array (
            'title' => $category->category . '. Купить по лучшей цене в Симферополе с доставкой товары из категории ' . $category->category . ' - Паркетный мир (Симферополь)',
            'products' => $products,
            'category' => $category,
            'properties' => $properties,
            'checked_properties' => $new_array,
            'local_title' => $local_title,
            // 'currencyrates' => Cbr::getAssociate(),
            'main_page' => $main_page,
            'sort' => $sort,
            'products_per_page' => $itemsPerPage,
            'meta_description' => $category->category . '. Купить с доставкой по Симферполю и Крыму. Каталог товаров. Укладка, реставрация и ремонт паркета в Крыму и Симферополе. Паркетные лаки, масла и воски, клеи, сопутствующие товары.',
            // 'subcategories' => Category::where('slug', $slug)->firstOrFail()
        );
        // dd($data['properties']);
        // dd($request->all());
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
        $sale = Discount::where('slug', $slug)->FirstOrFail();
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
        $manufactures = Manufacture::all();
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
        // dd($category);
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
        $questions = Question::orderBy('created_at')->published()->paginate(20);
        $data = array (
            'title' => 'Вопросы о паркете и ответы на них',
            'questions' => $questions,
            'meta_description' => 'Здесь вы можете задать любые интересующие вас вопросы о напольных покрытиях: какой паркет лучше выбрать, на что приклеить, чем покрыть и т.д.',
        );
        return view('questions', $data);
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
}
