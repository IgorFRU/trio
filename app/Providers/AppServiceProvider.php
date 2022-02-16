<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;
use App\Cart;
use App\Category;
use App\Deliverycategory;
use App\Article;
use App\Set;
use App\Setting;
use App\Product;
use App\Manufacture;
use App\Topmenu;
use App\Menu;
use App\Http\Services\WorkWithImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;

use App\MyClasses\Cbr;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!Collection::hasMacro('paginate')) {

            Collection::macro('paginate', 
                function ($perPage = 15, $page = null, $options = []) {
                $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
                return (new LengthAwarePaginator(
                    $this->forPage($page, $perPage)->values()->all(), $this->count(), $perPage, $page, $options))
                    ->withPath('');
            });
        }

        Schema::defaultStringLength(191); //NEW: Increase StringLength
        date_default_timezone_set('Europe/Moscow');

        self::globalData();
        self::sidebarMenu();
        self::adminMenu();
        self::footerData();


        Category::creating(function(Category $model){
            $model->slug = Str::slug(mb_substr($model->category, 0, 60) . "-", "-");
            $double = Category::where('slug', $model->slug)->first();
            if ($double) {
                $next_id = Category::select('id')->orderby('id', 'desc')->first()['id'];
                $model->slug .= '-' . ++$next_id;
            }

            if($model->image) {
                // dd($model);
                $path = public_path().'/imgs/categories/';
                $file = $model->image;
                $img = new WorkWithImage($file, $path);
                $model->image = $img->saveImage();
            }
        });

        Category::updating(function(Category $model) {
            if($model->image) {
                // dd($model->image);
                $old_image = Category::select('image')->find($model->id);
                // dd($old_image->image);
                if($model->image != $old_image->image) {

                    if (file_exists(public_path().'/imgs/categories/' . $old_image->image)) {                        
                        $file = new Filesystem;
                        $file->delete(public_path().'/imgs/categories/' . $old_image->image);
                    }
                    $path = public_path().'/imgs/categories/';
                    $file = $model->image;
                    $img = new WorkWithImage($file, $path);
                    $model->image = $img->saveImage();
                }
                
            }
        });

        Article::creating(function(Article $model){
            if($model->image) {
                // dd($model);
                $path = public_path().'/imgs/articles/';
                if (!file_exists($path)) {
                    mkdir($path, 0777);
                }
                $file = $model->image;
                $img = new WorkWithImage($file, $path);
                $model->image = $img->saveImage();
            }
        });

        Article::updating(function(Article $model) {
            if($model->image) {
                $old_image = Article::select('image')->find($model->id);
                if($model->image != $old_image->image) {
                    if (file_exists(public_path().'/imgs/articles/' . $old_image->image)) {                        
                        $file = new Filesystem;
                        $file->delete(public_path().'/imgs/articles/' . $old_image->image);
                    }
                    $path = public_path().'/imgs/articles/';
                    $file = $model->image;
                    $img = new WorkWithImage($file, $path);
                    $model->image = $img->saveImage();
                }                
            }
        });

        
        Set::creating(function(Set $model){
            if($model->image) {
                // dd($model);
                $path = public_path().'/imgs/sets/';
                if (!file_exists($path)) {
                    mkdir($path, 0777);
                }
                $file = $model->image;
                $img = new WorkWithImage($file, $path);
                $model->image = $img->saveImage();
            }
        });

        Set::updating(function(Set $model) {
            if($model->image) {
                $old_image = Set::select('image')->find($model->id);
                if($model->image != $old_image->image) {
                    if (file_exists(public_path().'/imgs/sets/' . $old_image->image)) {                        
                        $file = new Filesystem;
                        $file->delete(public_path().'/imgs/sets/' . $old_image->image);
                    }
                    $path = public_path().'/imgs/sets/';
                    $file = $model->image;
                    $img = new WorkWithImage($file, $path);
                    $model->image = $img->saveImage();
                }                
            }
        });


        // Product::creating(function(Product $model){
        //     $model->slug = Str::slug(mb_substr($model->product, 0, 60), "-");
        //     if ($model->scu) {
        //         $model->slug .= $model->scu;
        //     }
        //     $double = Product::where('slug', $model->slug)->first();
        //     if ($double) {
        //         $next_id = Product::select('id')->orderby('id', 'desc')->first()['id'];
        //         $model->slug .= '-' . ++$next_id;
        //     }
        // });

        // Manufacture::creating(function(Manufacture $model){
        //     if($model->image) {
        //         // dd($model);
        //         $path = public_path().'\imgs\manufactures\\';
        //         $file = $model->image;
        //         $img = new WorkWithImage($file, $path);
        //         $model->image = $img->saveImage();
        //     }
        // });

        // Manufacture::updating(function(Manufacture $model) {
        //     if($model->image) {
        //         // dd($model->image);
        //         $old_image = Manufacture::select('image')->find($model->id);
        //         // dd($old_image->image);
        //         if($model->image != $old_image->image) {
        //             $file = new Filesystem;
        //             $file->delete(public_path().'\imgs\manufactures\\' . $old_image->image);
        //             $path = public_path().'\imgs\manufactures\\';
        //             $file = $model->image;
        //             $img = new WorkWithImage($file, $path);
        //             $model->image = $img->saveImage();
        //         }
                
        //     }
        // });
    }

    public function sidebarMenu() {
        View::composer('components.categories-sidebar', function ($view){

            $hour = 60;
            $data = array ( 
                'menus' => Menu::orderBy('sortpriority', 'ASC')->with('category')->get(),
            );
            
            $view->with($data);
        });
    }

    public function globalData()
    {
        View::composer('layouts.main-app', function ($view){

            $hour = 60;

            $categories = Cache::remember('categories', $hour, function() {
                return Category::orderBy('category', 'ASC')->where('category_id', 0)->get();
            });
            $sets = Cache::remember('sets', $hour, function() {
                return Set::orderBy('set', 'ASC')->get();
            });  
            
            $topmenu = Topmenu::where('published', 1)
                ->OrderBy('priority', 'ASC')
                ->OrderBy('title', 'DESC')
                ->get();            
                
            $deliverycategories =Deliverycategory::orderBy('id', 'DESC')->get();

            $carts = Cart::where('session_id', session('session_id'))->get();
            // dd(session('session_id'));
            $carts1 = $carts->pluck('quantity', 'product_id');
            $carts2 = $carts->pluck('product_id');
            // dd($carts2);
            $products = Product::whereIn('id', $carts2)->get();

            $settings = Cache::remember('settings', $hour*3, function() {
                return Setting::first();
            }); 
            // dd($products);
            // $cart_products = array();
            // foreach ($carts as $key => $cart) {
            //     $cart_products[] = [
            //         'id' => 
            //     ];
            // }
            // $product = Product::where('id', $cart->product_id)->first();
        
        

            $data = array (
                'categories' => $categories,
                'deliverycategories' => $deliverycategories,
                'manufactures' => Manufacture::get(),
                'sets'        => $sets,
                'carts' => $carts1,
                'cart_products' => $products,
                'topmenu' => $topmenu,
                'settings' => $settings, 
                'menus' => Menu::orderBy('sortpriority', 'ASC')->get(),
            );
            
            $view->with($data);
        });
    }

    public function footerData() {
        View::composer('layouts.footer', function ($view){

            $hour = 60;
            
            $top_categories = Cache::remember('top_categories', $hour*3, function() {
                return Category::orderBy('views', 'DESC')->limit(4)->get();
            });

            $data = array (
                'top_categories' => $top_categories,
            );

            // $cbr = Cbr::get();

            // Cache::put('cbr', $cbr, 600);

            // $value = Cache::get('cbr');
            
            $view->with($data);
        });
    }

    public function adminMenu()
    {
        View::composer('layouts.admin-app', function ($view){

            $hour = 60;
            $cbrToday = Cbr::today();
            $cbrTomorrow = Cbr::tomorrow();
            $cbrNames = Cbr::getNames();             

            $data = array (
                'cbrToday'                  => $cbrToday,
                'cbrTomorrow'               => $cbrTomorrow,
                'cbrNames'                  => $cbrNames,
            );

            // $cbr = Cbr::get();

            // Cache::put('cbr', $cbr, 600);

            // $value = Cache::get('cbr');
            
            $view->with($data);
        });
    }
}
