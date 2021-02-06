<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'category', 
        'slug',
        'category_id', 
        'image', 
        'description', 
        'menu_id', 
        'meta_description', 
        'meta_keywords',
        'subcategories',
    ];

    // public function setSlugAttribute($value) {
    //     dd($value);
    //     $this->attributes['slug'] = Str::slug(mb_substr($this->category, 0, 60) . "-", "-");
    //     $double = Category::where('slug', $this->attributes['slug'])->first();

    //     if ($double) {
    //         $next_id = Category::select('id')->orderby('id', 'desc')->first()['id'];
    //         $this->attributes['slug'] .= '-' . ++$next_id;
    //     }
    // }

    

    public function children() {
        return $this->hasMany(Category::class, 'category_id');
    }

    public function parents() {
        return $this->belongsTo('App\Category', 'category_id', 'id');        
    }

    public function products() {
        return $this->hasMany(Product::class);
    }
    
    public function property() {
        return $this->belongsToMany(Property::class)->orderBy('property', 'asc');
    }

    public function menu() {
        return $this->belongsTo(Menu::class);
    }

    public function options() {
        return $this->belongsToMany(Option::class);
    }

    public function scopeOrder($query)
    {
        $sort = (isset($_COOKIE['productsort'])) ? $sort = $_COOKIE['productsort'] : $sort = 'default';        
        
        switch ($sort) {
            case 'nameAZ':
                $sort_column = 'product';
                $sort_order = 'ASC';
                break;
            case 'nameZA':
                $sort_column = 'product';
                $sort_order = 'DESC';
                break;
            case 'popular':
                $sort_column = 'views';
                $sort_order = 'DESC';
                break;
            case 'price_up':
                $sort_column = 'price';
                $sort_order = 'ASC';
                break;
            case 'price_down':
                // $sort_column = $this->discount_price;
                $sort_column = 'price';
                $sort_order = 'DESC';
                break;
            case 'new_up':
                $sort_column = 'id';
                $sort_order = 'DESC';
                break;                
            case 'new_down':
                $sort_column = 'id';
                $sort_order = 'ASC';
                break;
            default:
                $sort_column = 'product';
                $sort_order = 'ASC';
                break;
        }
        return $query->sortByDesc($sort_column, $sort_order);
    }

    public function getShortDescriptionAttribute() {
        if (strlen($this->description) > 220) {
            return Str::limit($this->description, 220);
        } else {
            return $this->description;
        }
    }

    public function getProductsCountAttribute() {
        return $this->products->where('imported', false)->where('published', 1)->count();
    }

    public function getWithSubcategoriesAttribute() {
        $products = Product::where('category_id', $this->id)->finaly()->published()->order()->with('manufacture', 'images', 'unit', 'currency')->get();

        if ($this->children) {
            foreach ($this->children as $children) {
                $products2 = Product::where('category_id', $children->id)->finaly()->published()->order()->with('manufacture', 'images', 'unit', 'currency')->get();;
                $products = $products->merge($products2);
            }
        }

        $sort = (isset($_COOKIE['productsort'])) ? $sort = $_COOKIE['productsort'] : $sort = 'default';        
        
        switch ($sort) {
            case 'nameAZ':
                $sort_column = 'product';
                $sort_order = 'ASC';
                break;
            case 'nameZA':
                $sort_column = 'product';
                $sort_order = 'DESC';
                break;
            case 'popular':
                $sort_column = 'views';
                $sort_order = 'DESC';
                break;
            case 'price_up':
                $sort_column = 'price';
                $sort_order = 'ASC';
                break;
            case 'price_down':
                // $sort_column = $this->discount_price;
                $sort_column = 'price';
                $sort_order = 'DESC';
                break;
            case 'new_up':
                $sort_column = 'id';
                $sort_order = 'DESC';
                break;                
            case 'new_down':
                $sort_column = 'id';
                $sort_order = 'ASC';
                break;
            default:
                $sort_column = 'product';
                $sort_order = 'ASC';
                break;
        }
        $products = ($sort_order == 'ASC') ? $products->sortBy($sort_column) : $products->sortByDesc($sort_column) ;
        return $products;

        // return $products;
    }
}
