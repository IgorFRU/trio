<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Cache;

use App\MyClasses\Cbr;

class Product extends Model
{
    protected $fillable = [
        'product',
        'product_pricename',
        'slug',
        'scu',
        'autoscu',
        'category_id',
        'manufacture_id',
        'vendor_id',
        'unit_id',
        'discount_id',
        'size_l',
        'size_w',
        'size_t',
        'size_type',
        'mass',
        'short_description',
        'description',
        'delivery_time',
        'meta_description',
        'meta_keywords',
        'published',
        'pay_online',
        'packaging',
        'unit_in_package',
        'amount_in_package',
        'price',
        'currency_id',
        'quantity',
        'quantity_vendor',
        'sample',
        'recomended',
        'imported'
    ];

    protected $casts = [
        'imported' => 'boolean',
    ];

    public function setImportedAttribute($value) {
        if ($value == 1) {
            $this->attributes['imported'] = true;
        } else {
            $this->attributes['imported'] = false;
        }
    }

    public function setSlugAttribute($value) {
        if (!isset($this->id)) {
            $this->attributes['slug'] = Str::slug(mb_substr($this->product, 0, 60), "-");
            if (isset($this->attributes['scu'])) {
                $this->attributes['slug'] .= '-' . Str::slug(mb_substr($this->attributes['scu'], 0, 10), "-");
            }        
            $double = Product::where('slug', $this->attributes['slug'])->first();

            if ($double) {
                $next_id = Product::select('id')->orderby('id', 'desc')->first()['id'];
                $this->attributes['slug'] .= '-' . ++$next_id;
            }
        }        
    }

    public function setAutoscuAttribute($value) {
        if (!isset($this->id)) {
            $this->attributes['autoscu'] = mt_rand(100, 999) . '-' . mt_rand(100, 999);
            while (Product::where('autoscu', $this->attributes['autoscu'])->count() > 0 ) {
                $this->attributes['autoscu'] = mt_rand(100, 999) . '-' . mt_rand(100, 999);
            }
        }
    }

    public function setPriceAttribute($value) {
        if ($value > 0) {
            $this->attributes['price'] = preg_replace('~,~', '.', $value);
        } elseif ($value == 0) {
            $this->attributes['price'] = 0;
        }
    }

    public function setUnitInPackageAttribute($value) {
        if ($value > 0) {
            $this->attributes['unit_in_package'] = preg_replace('~,~', '.', $value);
        }
        if ($this->unit_in_package == NULL || $this->unit_in_package == '' || $this->unit_in_package == 0) {
            $this->attributes['unit_in_package'] = 1;
        }
    }

    public function getCurrencyIdAttribute($value) {
        return $this->attributes['currency_id'];
        // return $value;
    }

    public function getPriceNumberAttribute() {
        return number_format($this->price, 2, ',', ' ');
    }

    public function getUnitNumberAttribute() {
        return number_format($this->unit_in_package, 3, ',', ' ');
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function currency() {
        return $this->belongsTo(Currency::class);
    }
    
    public function articles() {
        return $this->belongsToMany(Article::class);
    }
    
    public function sets() {
        return $this->belongsToMany(Set::class);
    }

    public function manufacture() {
        return $this->belongsTo(Manufacture::class);
    }

    public function unit() {
        return $this->belongsTo(Unit::class);
    }

    public function discount() {
        return $this->belongsTo(Discount::class);
    }

    public function images() {
        return $this->belongsToMany(Image::class);
    }

    public function child_products() {
        return $this->belongsToMany(Product::class)
        ->withPivot([
            'quantity',
            'quantity_for',
            'created_by',
            'updated_by',
        ]);;
    }

    public function parent_products() {
        return $this->belongsToMany(Product::class);
    }

    public function orders() {
        return $this->belongsToMany(Order::class);
    }

    public function cartproducts() {
        return $this->hasMany(Cart::class);
    }

    public function propertyvalue() {
        return $this->hasMany(Propertyvalue::class);
    }

    public function choisevalue() {
        return $this->hasMany(Choisevalue::class);
    }

    public function currencyrate() {
        return $this->belongsTo(Currencyrate::class, 'currency_id');
        
    }

    public function scopeFinaly($query) {
        return $query->where('imported', false);
    }

    public function scopeImported($query) {
        return $query->where('imported', true);
    }

    public function getAllViewsAttribute() {
        return Product::all()->sum('views');;
    }
    
    public function getAvgViewsAttribute() {
        return round(Product::all()->avg('views'), 2);
    }

    public function getPriceRubAttribute() {
        if ($this->currency->to_update) {
            $hour = 60;
            // dd($this->currency->currency);
            return Cache::remember($this->currency->currency . date('Y-m-d'), $hour, function() {
                return $this->currency->currencyrate->first()->value;
            });
            
        } else {
            return $this->price;
        }
    }

    //проверяет, отмечен ли товар в боковом меню фильтра товаров
    public function getPropertyActiveProductAttribute($property) {
        foreach ($this->propertyvalue as $key => $value) {
            return $value->property_id;
        }
    }

    public function getMainOrFirstImageAttribute($value) {
        foreach ($this->images as $image) {
            if ($image->main) {
                return $this->images->where('main', 1)->first();
            } else {
                return $this->images->first();
            }            
        }
    }

    public function getFullSizeAttribute() {
        $size = '';
        if ($this->size_type != '' && $this->size_type != NULL) {
            $size_type = '(' . $this->size_type . ')';
        } else {
            $size_type = '';
        }        
        if ($this->size_l != '' && $this->size_w != NULL) {
            $size .= 'длина: ' . $this->size_l . $size_type . '. ';
        }
        if ($this->size_w != '' && $this->size_l != NULL) {
            $size .= 'ширина: ' . $this->size_w . $size_type . '. ';
        }
        if ($this->size_t != '' && $this->size_t != NULL) {
            $size .= 'толщина: ' . $this->size_t . $size_type . '. ';
        }

        return $size;
    }

    public function getActuallyDiscountAttribute($value) {
        $today = Carbon::now();
        if (isset($this->discount) && $this->discount->discount_end >= $today) {
            return true;
        } else {
            return false;
        }        
    }

    public function getDiscountEndDayAttribute($value) {
        return $this->discount->discount_end;
    }

    // public function scopeDiscount($query) {
    //     $today = Carbon::now();
    //     return $query->where('discount_end_day' , '>=', $today);       
    // }

    public function getDiscountPriceAttribute($value) {   
        if ($this->currency->to_update) {
            $price = self::floatToInt($this->price * $this->price_rub);
        } else {
            $price = self::floatToInt($this->price);
        }
            
        if ($this->actually_discount) {
            if ($this->discount->type == '%') {
                if ($price * $this->discount->numeral <= 0) {
                    return 0;
                } else {
                    return round($price * $this->discount->numeral, 2);
                }            
            }
            else if ($this->discount->type == 'rub') {
                if ($price - $this->discount->value <= 0) {
                    return 0;
                } else {
                    return round($price - $this->discount->value, 2);
                }
            }
        } else {
            return $price;
        }
    }

    // public function getDiscountPriceAttribute($value) {        
    //     if ($this->currency->to_update) {
    //         $currencyrates = Cbr::getAssociate();
    //         $price = self::floatToInt($this->price * $currencyrates[$this->currency->id]);
    //     }
    //     else {
    //         $price = self::floatToInt($this->price);
    //     }
    //     if ($this->discount) {
    //         if ($this->discount->type == '%') {
    //             if ($price * $this->discount->numeral <= 0) {
    //                 return 0;
    //             } else {
    //                 return round($price * $this->discount->numeral, 2);
    //             }            
    //         }
    //         else if ($this->discount->type == 'rub') {
    //             if ($price - $this->discount->value <= 0) {
    //                 return 0;
    //             } else {
    //                 return round($price - $this->discount->value, 2);
    //             }
    //         }
    //     } else {
    //         return $price;
    //     }
    // }


    public function getOldPriceAttribute($value) {        
        if ($this->currency->to_update) {
            $currencyrates = Cbr::getAssociate();
            return self::floatToInt($this->price * $currencyrates[$this->currency->id]);
        }
        else {
            return self::floatToInt($this->price);
        }
    }

    public function getPackagePriceAttribute($value) {
        if ($this->packaging) {
            return self::floatToInt($this->discount_price * $this->unit_in_package);
        } else {
            return $this->discount_price;
        }
        
    }

    public function getNumberAttribute() {
        return number_format($this, 2, ',', ' ');
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

        return $query->orderBy($sort_column, $sort_order);
    }

    public function scopePublished($query)
    {
        return $query->where('published', 1);
    }

    public function floatToInt($number) { 
        $floor = floor($number);
        if ($number == $floor) { 
            return number_format($number, 0, '.', ''); 
        }
        else {
            return number_format(round($number, 2), 2, '.', '');
        } 
    } 
}
