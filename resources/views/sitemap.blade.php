{{ Request::header('Content-Type : text/xml') }}

<?php echo '<?xml version="1.0" encoding="UTF-8"?>';?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @forelse ($categories as $category)
        <ul>
            <li>
                <url>
                    <loc><a href="{{ route('category', $category->slug) }}">{{ $category->category }}</a></loc>
                    <changefreq>montly</changefreq>
                    <priority>1</priority>
                </url>
                @if ($category->children->count())
                    <ul>
                        @forelse ($category->children as $children)                        
                            <li>
                                <url>
                                    <loc><a href="{{ route('category', $children->slug) }}">{{ $children->category }}</a></loc>
                                    <changefreq>montly</changefreq>
                                    <priority>1</priority>
                                </url>
                            </li>
                        @empty
                            
                        @endforelse
                    </ul>
                @endif 
                
                @if ($category->products->count())
                    <ul>
                        @forelse ($category->products as $product)
                            @if ($product->published)
                                <li>
                                    <url>                                    
                                        <loc><a @if($category->parent_id) href="{{ route('product.subcategory', ['category' => $category->slug, 'subcategory' => $category->parent_id, 'product' => $product->slug]) }}"
                                            @else href="{{ route('product', ['category' => $category->slug, 'product' => $product->slug]) }}"
                                        @endif>{{ $product->product }}</a>
                                             </loc>
                                        <lastmod>{{ $product->updated_at->tz('GMT')->toAtomString() }}</lastmod>
                                        <changefreq>dayly</changefreq>
                                        <priority>1</priority>
                                    </url>
                                </li>
                            @endif                            
                        @empty
                            
                        @endforelse
                    </ul>
                @endif                
            </li>
        </ul>
    @empty
        
    @endforelse