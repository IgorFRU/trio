<?php

namespace App\Http\Controllers;

use App\Http\Services\Parser;
use Illuminate\Http\Request;
use DiDom\Document;

class ParserController extends Controller
{
    private static $html = '';
    private static $menu_class = '';
    private static $category_class = '';
    private static $menu_only = '';
    private static $category_only = '';
    private static $menu_urls = [];
    private static $products = [];

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request) {
        // $html = Parser::getPage([
        //     // "url" => "http://httpbin.org/ip"
        //     "url" => "https://parquetsale.ru"
        //     // "url" => "http://parketpro.com"
        // ]);

        if (isset($request->url)) {
            self::$html = $request->url;

            $document = new Document(self::$html, true);

            if (isset($request->category_class)) {
                self::$category_class = $request->category_class;
            }

            if (isset($request->menu_class)) {
                self::$menu_class = $request->menu_class;
                $menus = $document->find(self::$menu_class);

                $arr = [];
                $ttt = [];

                foreach($menus as $menu) {
                    // echo $menu->attr('href'), "\n";
                    $link = new class{};
                    $link->title = $menu->text();
                    $link->url = $menu->attr('href');
                    

                    if (self::$category_class !== '' && isset($request->menu_only) && $menu->text() === $request->menu_only) {
                        self::$menu_only = $request->menu_only;
                        $document2 = new Document(self::$html . $link->url, true);
                        $categories = $document2->find(self::$category_class);

                        $url = [];
                        foreach ($categories as $category) {
                            $category2 = new class{};
                            $category2->title = $category->text();
                            $category2->url = $category->attr('href');
                            $url[] = $category2;
                            
                            $document3 = new Document(self::$html . $category2->url, true);
                            $categories_sheet = $document3->find('.product__link');

                            foreach ($categories_sheet as $key => $sheet) {
                                // self::$products[] = $sheet->attr('href');
                                $product_page = new Document(self::$html . $sheet->attr('href'), true);
                                // dd();
                                $products = $product_page->find('.select-volume__item');
                                // self::$products[] = ;
                                // $prod_arr = [];
                                foreach ($products as $key => $product) {
                                    $prod = new class{};
                                    $prod->parent = trim($category->text(), " \t\n\r\0\x0B");
                                    $prod->title = trim($product->first('.volume__color')->text(), " \t\n\r\0\x0B");
                                    $prod->value = trim($product->first('.volume__price-wrap')->text(), " \t\n\r\0\x0B");
                                    $prod->price = trim($product->first('.volume__price')->text(), " \t\n\r\0\x0B");

                                    // dd($product->first('.volume__color')->text());
                                    // $prod_arr[] = $prod;     
                                    self::$products[] = $prod;                               
                                }
                                
                            }
                            
                            // dd($document3);
                        }
                        $link->categories = $url;
                    }

                    self::$menu_urls[] = $link;
                }
            }
        }
        // dd(self::$products);
        // dd(self::$menu_urls);

        // dd(self::$menu_urls);

        $data = [
            'url' => self::$html,
            'menu_class' => self::$menu_class,
            'category_class' => self::$category_class,
            'menus' => self::$menu_urls,
            'menu_only' => self::$menu_only,
            'products' => self::$products,
        ];

        return view('admin.parser.index', $data);

        

        // dd($menu_urls);

        

        // dd($menus);

        // $html = file_get_contents("https://parquetsale.ru");

        // $dom = phpQuery::newDocument($html);

        // if (!empty($html["data"])){

        //     $content = $html["data"]["content"];
        
        //     phpQuery::newDocument($content);
        
        //     $categories = pq(".b-category-menu")->find(".b-category-menu__link");
        
        //     $tmp = [];
        
        //     foreach($categories as $key => $category){
        
        //        $category = pq($category);
        
        //       $tmp[$key] = [
        //           "text" => trim($category->text()),
        //           "url"  => trim($category->attr("href"))
        //        ];
        
        //       $submenu = $category->next(".b-category-submenu")->find(".b-category-submenu__link");
        
        //      foreach($submenu as $submen){
        
        //            $submen = pq($submen);
        
        //           $tmp[$key]["submenu"][] = [
        //                "text" => trim($submen->text()),
        //                 "url"  => trim($submen->attr("href"))
        //          ];
        //       }
        //    }
        
        //    phpQuery::unloadDocuments();
        // }
        // dd($html);
    }

    // public function result(Request $request) {
    //     dd($request->all());
    // }
}
